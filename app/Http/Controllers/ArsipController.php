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
        if ($request->has('search')) {
            $arsip = Files::where('nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 0)->pluck('nomor_surat');
            $konfirmasiFiles = konfirmasi::pluck('nomor_surat');
            $disposisiFiles = Disposisi::pluck('nomor_surat');

            $files = Files::whereNotIn('nomor_surat', $konfirmasiFiles)
                ->whereNotIn('nomor_surat', $disposisiFiles)->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
            $filesmasuk = Files::whereIn('nomor_surat', $disposisiFiles)->whereHas('disposisi', function ($query) {
                $query->where('divisi', Session('divisi'))->where('status', 0);
            })->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $filesDisposisiStaff = Files::whereHas('disposisiStaff', function ($query) {
                $query->where('divisi', Session('divisi'))->where('id_pos', Session('id_pos'))->where('status', 0);
            })->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $jumlahFileDivisi3 = Files::whereHas('disposisi', function ($query) {
                $query->where('divisi', Session('divisi'))->where('status', 0);
            })->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $arsip = Files::paginate(10);
            $arsipdeputi = Files::where('tujuan', 1)->where('aksi', 0)->paginate(10);
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 0)->pluck('nomor_surat');
            $konfirmasiFiles = konfirmasi::pluck('nomor_surat');
            $disposisiFiles = Disposisi::pluck('nomor_surat');

            $files = Files::whereNotIn('nomor_surat', $konfirmasiFiles)
                ->whereNotIn('nomor_surat', $disposisiFiles)
                ->paginate(10);
            $filesmasuk = Files::whereIn('nomor_surat', $disposisiFiles)->whereHas('disposisi', function ($query) {
                $query->where('divisi', Session('divisi'))->where('status', 0);
            })->paginate(10);
            $filesDisposisiStaff = Files::whereHas('disposisiStaff', function ($query) {
                $query->where('divisi', Session('divisi'))->where('id_pos', Session('id_pos'))->where('status', 0);
            })->paginate(10);
            $jumlahFileDivisi3 = Files::whereHas('disposisi', function ($query) {
                $query->where('divisi', Session('divisi'))->where('status', 0);
            })->paginate(10);
            $disposisiFiles = Disposisi::pluck('nomor_surat');
            $divisiDisposisi = Disposisi::whereIn('nomor_surat', $disposisiFiles)
                ->whereHas('file')
                ->get();
            // ->pluck('divisi')
            // ->flatten()
            // ->unique()
            // ->implode(', ');
        }
        return view("arsip.index", ['arsip' => $arsip, 'arsipdeputi' => $arsipdeputi, 'suratmasuk' => $jumlahFileDivisi3, 'managermasuk' => $filesmasuk, 'staffmasuk' => $filesDisposisiStaff, 'kepalamasuk' => $files, 'divisi' => $divisiDisposisi, 'disposisiFiles' => $disposisiFiles]);
    }

}
