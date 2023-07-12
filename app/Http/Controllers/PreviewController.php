<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Files;
use App\Models\konfirmasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreviewController extends Controller
{
    //
    function showfile($nama_file)
    {
        $view = Files::where('nama_file', $nama_file)->first();

        // // Memeriksa jabatan user yang sedang membuka file
        $user = Session('id_pos'); // Menyimpan informasi user yang sedang login
        if ($user != 001) {
            Files::where('nama_file', $nama_file)
                ->update(['status' => 1]);
        }

        // Mengambil data dari tabel disposisi
        $disposisi = Disposisi::where('nomor_surat', $view->nomor_surat)->first();
        return view("preview/index", ['preview' => $view, 'disposisi' => $disposisi]);
    }

    public function unduh($nama_file)
    {
        $view = Files::where('nama_file', $nama_file)->first();
        // Menambahkan fitur unduh file
        $filePdfPath = public_path('file-pdf/' . $view->file_pdf); // Mendapatkan path file PDF
        $fileName = $view->file_pdf; // Nama file PDF

        return response()->download($filePdfPath, $fileName);
        // ->deleteFileAfterSend(true);
    }

    public function unduhkonfirmasi($nama_file)
    {
        $view = konfirmasi::where('nama_file', $nama_file)->first();
        // Menambahkan fitur unduh file
        $filePdfPath = public_path('file-konfirmasi/' . $view->nama_file); // Mendapatkan path file PDF
        $fileName = $view->nama_file; // Nama file PDF

        return response()->download($filePdfPath, $fileName);
        // ->deleteFileAfterSend(true);
    }

    function showfilekeluar($nama_file)
    {
        $view = Files::where('nama_file', $nama_file)->first();

        // // Memeriksa jabatan user yang sedang membuka file
        $user = Session('id_pos'); // Menyimpan informasi user yang sedang login
        if ($user != 001) {
            Files::where('nama_file', $nama_file)
                ->update(['status' => 0]);
        }

        // Mengambil data dari tabel disposisi
        $disposisi = Disposisi::where('nomor_surat', $view->nomor_surat)->first();

        return view("preview/index", ['preview' => $view, 'disposisi' => $disposisi]);
    }

    public function arsipfile($nama_file)
    {
        // Ambil semua data files
        Files::where('nama_file', $nama_file)->update(['aksi' => 2]);

        // // Jika data files tidak kosong
        // if (!$files->isEmpty()) {
        //     // Lakukan perulangan untuk setiap item
        //     foreach ($files as $file) {
        //         // Misalnya, perbarui status file menjadi 1 (Sudah Dibaca)
        //         $file->status = 2;
        //         $file->save(); // Simpan perubahan pada database
        //     }
        // }

        // Kode lainnya untuk menampilkan data pada view
        return redirect()->back()->with('success', 'File Berhasil Di Arsipkan');
    }

    public function konfirmasidetail($nomor_surat)
    {
        $view = konfirmasi::where('nomor_surat', $nomor_surat)->first();
        return view('konfirmasi.preview', ['preview' => $view,]);
    }

}
