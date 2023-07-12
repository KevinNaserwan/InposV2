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
use Illuminate\Support\Facades\View;

class InposController extends Controller
{
    public function storefile(Request $request)
    {
        $request->validate([
            'file_pdf' => 'required|mimes:pdf',
            'keterangan' => 'required',
        ], [
            'file_pdf.required' => 'File wajib diisi',
            'keterangan' => 'Keterangan wajib diisi',
            'file_pdf.mimes' => 'File hanya diperbolehkan Berjenis PDF'
        ]);

        $nomor_surat = Helper::IDGenerator2(new Files, 'nomor_surat', 3, 'KCU-PLG');
        $tanggal = date('Y-m-d H:i:s');
        $nama_file = Helper::IDGenerator(new Files, 'nama_file', 3, date("dm", strtotime($tanggal)));
        $foto_file = $request->file('file_pdf');
        $foto_nama = $nama_file . "." . $request->file('file_pdf')->getClientOriginalExtension();
        $foto_file->move(public_path('file-pdf'), $foto_nama);
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
            'keterangan' => $request->input('keterangan')
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
        $file = Files::where('nomor_surat', $nomor_surat)->update(['aksi' => 1, 'status' => 0]);
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
            'keterangan' => $request->input('keterangan')
        ];
        // dd($data);
        konfirmasi::create($data);
        Files::where('nomor_surat', $nomor_surat)->update(['aksi' => 2, 'status' => 0]);

        Disposisistaff::where('nomor_surat', $nomor_surat)->update(['status' => 1]);
        Disposisi::where('nomor_surat', $nomor_surat)->update(['status' => 1]);
        return redirect()->back()->with('success', 'File Berhasil Di Konfirmasi');
    }

    public function delete($file_pdf)
    {
        $files = Files::where('file_pdf', $file_pdf)->first();
        if ($files->file_pdf == $file_pdf && $files->aksi == 0) {
            Files::where('file_pdf', $file_pdf)->where('aksi', 0)->Delete();
            $title = 'Delete User!';
            $text = "Are you sure you want to delete?";
            confirmDelete($title, $text);
            return redirect('/unggah')->with('success', 'File berhasil dihapus');
        } else {
            return redirect('/unggah')->with('errors', 'File yang sudah ditindak lanjuti tidak dapat dihapus');
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
        $dompdf = new Dompdf();
        $isi_surat = outgoing::where('nomor_surat', $nomor_surat)->first();
        $user = User::where('divisi', $isi_surat->divisi)
            ->where('level', 3)
            ->first();
        $html = View::make('outgoing.hasil2', compact('user', 'isi_surat'))->render();
        // $options = new Options();
        // $options->set('isRemoteEnabled', true); // Aktifkan dukungan aset gambar remote
        // $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream();
        // $pdf = Pdf::loadView('outgoing.hasil', ['user' => $users, 'isi_surat' => $isi_surat])->setPaper('a4', 'potrait');
        // return $pdf->download('invoice.pdf');
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
