<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Disposisi;
use App\Models\Disposisistaff;
use App\Models\Files;
use App\Models\konfirmasi;
use App\Models\outgoing;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class InposController extends Controller
{
    public function storefile(Request $request)
    {
        $request->validate([
            'file_pdf' => 'required|mimes:pdf',
            'keterangan' => 'required',
            'tujuan' => 'required'
        ], [
            'file_pdf.required' => 'File wajib diisi',
            'tujuan' => 'Tujuan wajib diisi',
            'keterangan' => 'Keterangan wajib diisi',
            'file_pdf.mimes' => 'File hanya diperbolehkan Berjenis PDF'
        ]);

        $nomor_surat = Helper::generateAutoIncrement2();
        $tanggal = date('Y-m-d H:i:s');
        $nama_file = Helper::IDGenerator(new Files, 'nama_file', 3, date("dm", strtotime($tanggal)));
        $foto_file = $request->file('file_pdf');
        $foto_nama = $nama_file . "." . $request->file('file_pdf')->getClientOriginalExtension();
        $foto_file->move(public_path('file-pdf'), $foto_nama);
        $prefix = 'KCU-PG';
        if ($request->input('aksi') == true) {
            $aksi = 2;
        } else {
            $aksi = 0;
        }
        $data = [
            'nomor_surat' => $nomor_surat,
            'nama_file' => $nama_file,
            'tanggal' => $tanggal,
            'id_pos' => Session('id_pos'),
            'file_pdf' => $foto_nama,
            'aksi' => $aksi,
            'status' => 0,
            'keterangan' => $request->input('keterangan'),
            'tujuan' => $request->input('tujuan')
        ];

        // if ($request->fails()) {
        //     return back()->with('errors', $request->messages()->all()[0])->withInput();
        // }

        Files::create($data);

        // Mendapatkan URL file yang diupload
        $file_path = asset('file-pdf/' . $foto_nama);

        return redirect('/unggah')->with('success', 'Berhasil Upload File')->with('file_path', $file_path);
    }

    public function storedisposisi(Request $request, $nomor_surat)
    {
        $request->validate([
            'perihal' => 'required',
            'catatan' => 'required',
            'divisi' => 'required'
        ], [
            'perihal.required' => 'Perihal wajib diisi',
            'catatan.required' => 'Catatan wajib diisi',
            'divisi.required' => 'Divisi wajib diisi',
        ]);

        $data = [
            'perihal' => json_encode($request->input('perihal')),
            'catatan' => $request->input('catatan'),
            'status' => 0,
            'nomor_surat' => $nomor_surat,
            'divisi' => $request->input('divisi')
        ];

        // dd($data);
        Files::where('nomor_surat', $nomor_surat)->update(['aksi' => 1, 'status' => 0]);
        Disposisi::create($data);
        return redirect()->back()->with('success', 'File Berhasil Di Disposisi');
    }

    public function storedisposisistaff(Request $request, $nomor_surat)
    {
        $request->validate([
            'perihal' => 'required',
            'catatan' => 'required',
            'id_pos' => 'required'
        ], [
            'perihal.required' => 'File wajib diisi',
            'catatan.required' => 'Catatan wajib diisi',
            'id_pos.required' => 'Staff wajib diisi',
        ]);

        $data = [
            'perihal' => json_encode($request->input('perihal')),
            'catatan' => $request->input('catatan'),
            'status' => 0,
            'nomor_surat' => $nomor_surat,
            'id_pos' => $request->input('id_pos'),
            'divisi' => Session('divisi')
        ];
        // dd($data);
        $file = Files::where('nomor_surat', $nomor_surat)->update(['aksi' => 1, 'status' => 0]);
        $disposisi = Disposisi::where('nomor_surat', $nomor_surat)->update(['status' => 1]);
        Disposisistaff::create($data);
        return redirect()->back()->with('success', 'File Berhasil Di Disposisi');
    }

    public function storekonfirmasi(Request $request, $nomor_surat)
    {
        $request->validate([
            'file_pdf' => 'required|mimes:jpeg,png,jpg,pdf,gif',
            'keterangan' => 'required',
        ], [
            'file_pdf.required' => 'File wajib diisi',
            'keterangan' => 'Keterangan wajib diisi',
            'file_pdf.mimes' => 'File hanya diperbolehkan berekstensi JPEG, PNG, JPG, PDF, dan GIF'
        ]);

        $nama_file = Helper::IDGenerator(new konfirmasi, 'nama_file', 3, 'K');
        $foto_file = $request->file('file_pdf');
        $foto_nama = $nama_file . "." . $request->file('file_pdf')->getClientOriginalExtension();
        $foto_file->move(public_path('file-konfirmasi'), $foto_nama);
        $data = [
            'nomor_surat' => $nomor_surat,
            'nama_file' => $foto_nama,
            'keterangan' => $request->input('keterangan'),
            'id_pos' => Session('id_pos')
        ];
        // dd($data);
        konfirmasi::create($data);
        Files::where('nomor_surat', $nomor_surat)->update(['aksi' => 2, 'status' => 0]);

        Disposisistaff::where('nomor_surat', $nomor_surat)->update(['status' => 1]);
        Disposisi::where('nomor_surat', $nomor_surat)->update(['status' => 1]);
        return redirect()->back()->with('success', 'File Berhasil Di Konfirmasi');
    }

    public function storeuser(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'nama' => 'Nama wajib diisi',
            'jabatan' => 'Jabatan wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password harus terdiri dari minimal : 6 karakter',
            'password.regex' => 'Password harus terdiri dari huruf besar, huruf kecil, dan angka',
        ]);

        if ($request->input('jabatan') == 'Admin') {
            $level = 1;
        } elseif ($request->input('jabatan') == 'Executive General Manager') {
            $level = 2;
        } elseif ($request->input('jabatan') == 'Deputi Executive General Manager') {
            $level = 5;
        } elseif ($request->input('jabatan') == 'Manager') {
            $level = 3;
        } elseif ($request->input('jabatan') == 'Staff') {
            $level = 4;
        }
        $data = [
            'id_pos' => $request->input('id_pos'),
            'nama' => $request->input('nama'),
            'jabatan' => $request->input('jabatan'),
            'password' => Hash::make($request->input('password')),
            'divisi' => $request->input('divisi'),
            'tujuan' => $request->input('tujuan'),
            'level' => $level
        ];

        // if ($request->fails()) {
        //     return back()->with('errors', $request->messages()->all()[0])->withInput();
        // }

        User::create($data);
        return redirect('/dashboard')->with('success', 'Berhasil Menambahkan User');
    }

    public function delete($file_pdf)
    {
        $files = Files::where('file_pdf', $file_pdf)->first();
        if ($files->file_pdf == $file_pdf && $files->aksi == 0) {
            Files::where('file_pdf', $file_pdf)->where('aksi', 0)->Delete();
            $title = 'Delete User!';
            $text = "Are you sure you want to delete?";
            confirmDelete($title, $text);
            return redirect('/arsip')->with('success', 'File berhasil dihapus');
        } else {
            return redirect('/arsip')->with('errors', 'File yang sudah ditindak lanjuti tidak dapat dihapus');
        }
    }


    public function outgoing(Request $request)
    {
        $request->validate([
            'lampiran' => 'mimes:jpeg,png,jpg,pdf,gif',
            'level' => 'required'
        ], [
            'level' => 'Arah tujuan surat wajib diisi',
            'lampiran.mimes' => 'File hanya diperbolehkan Berjenis PDF,jpeg,png,jpg,pdf,gif'
        ]);

        $nomor_surat = Helper::generateAutoIncrement();
        $tanggal = date('Y-m-d H:i:s');
        $lampiran = Helper::IDGenerator(new outgoing, 'lampiran', 3, date("dm", strtotime($tanggal)));
        $foto_file = $request->file('lampiran');
        if ($foto_file) {
            $foto_nama = $lampiran . "." . $request->file('lampiran')->getClientOriginalExtension();
            $foto_file->move(public_path('outgoing/lampiran'), $foto_nama);
        } else {
            $foto_nama = null;
        }
        $isi_surat = $request->input('isi_surat');
        $isi_surat2 = nl2br($isi_surat);
        $data = [
            'nomor_surat' => $nomor_surat,
            'tanggal' => $tanggal,
            'id_pos' => Session('id_pos'),
            'level' => $request->input('level'),
            'divisi' => Session('divisi'),
            'status' => 0,
            'perihal' => $request->input('perihal'),
            'isi_surat' => strip_tags($isi_surat2, '<br>'),
            'tujuan' => $request->input('tujuan'),
            'lampiran' => $foto_nama
        ];

        // dd($data);
        outgoing::create($data);
        return redirect('/outgoing-preview/' . $nomor_surat)->with('success', 'Berhasil buat surat');
    }

    public function exportpdf($nomor_surat)
    {
        // require_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf();
        $isi_surat = outgoing::where('nomor_surat', $nomor_surat)->first();
        $user = User::where('divisi', $isi_surat->divisi)
            ->where('level', 3)
            ->first();
        $html = View::make('outgoing.hasil2', compact('user', 'isi_surat'))->render();
        // $options = new Options();
        // $options->set('isRemoteEnabled', true); // Enable remote asset support

        // if (extension_loaded('curl')) {
        //     $options->set('isPhpEnabled', true); // Enable PHP to use curl
        // } else {
        //     ini_set('allow_url_fopen', true); // Enable allow_url_fopen setting
        // }

        // // Set the path(s) for Dompdf "chroot" option if accessing local files
        // $options->set('chroot', public_path('assetsurat'));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->setBasePath(public_path('assetsurat/posLogo.png'));
        $dompdf->render();
        return $dompdf->stream();
    }


    public function kirimsurat($nomor_surat)
    {
        outgoing::where('nomor_surat', $nomor_surat)->update(['status' => 1]);
        return redirect()->back()->with('success', 'Surat Berhasil Dikirim');
    }

    public function setujuisurat($nomor_surat)
    {
        outgoing::where('nomor_surat', $nomor_surat)->update(['status' => 2]);
        return redirect()->back()->with('success', 'Surat sudah disetujui');
    }
}
