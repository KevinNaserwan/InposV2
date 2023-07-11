<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Files;
use App\Models\konfirmasi;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function showarsip(Request $request)
    {
        if ($request->keyword) {
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 0)->pluck('nomor_surat');
            $konfirmasiFiles = konfirmasi::pluck('nomor_surat');
            $disposisiFiles = Disposisi::pluck('nomor_surat');
            $arsip = Files::search($request->keyword)->get();
            $files = Files::search($request->keyword)
                ->get();
            $filesmasuk = Files::search($request->keyword)->get();
            $filesDisposisiStaff = Files::search($request->keyword)->get();
            $jumlahFileDivisi3 = Files::search($request->keyword)->get();
        } else {
            $arsip = Files::all()->take(10);
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 0)->pluck('nomor_surat');
            $konfirmasiFiles = konfirmasi::pluck('nomor_surat');
            $disposisiFiles = Disposisi::pluck('nomor_surat');

            $files = Files::whereNotIn('nomor_surat', $konfirmasiFiles)
                ->whereNotIn('nomor_surat', $disposisiFiles)
                ->get();
            $filesmasuk = Files::whereIn('nomor_surat', $disposisiFiles)->whereHas('disposisi', function ($query) {
                $query->where('divisi', Session('divisi'))->where('status', 0);
            })->get();
            $filesDisposisiStaff = Files::whereHas('disposisiStaff', function ($query) {
                $query->where('divisi', Session('divisi'))->where('id_pos', Session('id_pos'))->where('status', 0);
            })->get();
            $jumlahFileDivisi3 = Files::whereHas('disposisi', function ($query) {
                $query->where('divisi', Session('divisi'))->where('status', 0);
            })->take(10)->get();
        }
        return view("arsip.index", ['arsip' => $arsip, 'suratmasuk' => $jumlahFileDivisi3, 'managermasuk' => $filesmasuk, 'staffmasuk' => $filesDisposisiStaff, 'kepalamasuk' => $files]);
    }

}
