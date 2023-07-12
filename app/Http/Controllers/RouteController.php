<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Disposisistaff;
use App\Models\Files;
use App\Models\konfirmasi;
use App\Models\outgoing;
use App\Models\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function dashboard()
    {
        $arsip = Files::paginate(10);
        $suratkepala = Files::where('aksi', 0)->count();
        $suratkepalatoday = Files::whereDate('tanggal', now()->format('Y-m-d'))->paginate(10);
        $suratmanagertoday = Files::whereHas('disposisi', function ($query) {
            $query->where('divisi', Session('divisi'));
        })->whereDate('tanggal', now()->format('Y-m-d'))->paginate(10);
        $suratstafftoday = Files::whereHas('disposisiStaff', function ($query) {
            $query->where('id_pos', Session('id_pos'))->where('divisi', Session('divisi'));
        })->whereDate('tanggal', now()->format('Y-m-d'))->paginate(10);
        $disposisikepala = Files::where('aksi', 1)->count();
        $files = Files::whereDate('tanggal', now()->format('Y-m-d'))->paginate(10);
        $menunggukepala = Files::whereHas('disposisi', function ($query) {
            $query->where('status', 0);
        })->count();
        // $jumlahFileDivisi3 = Files::whereHas('disposisi', function ($query) {
        //     $query->where('divisi', Session('divisi'));
        // })->count();
        // $suratmanager = Disposisi::where('status', 1)->where('divisi',Session('divisi'))->count();
        $suratmanager = Files::whereHas('disposisi', function ($query) {
            $query->where('divisi', Session('divisi'))->where('status', 0);
        })->count();
        $disposisimanager = Files::whereHas('disposisiStaff', function ($query) {
            $query->where('divisi', Session('divisi'))->where('status', 0);
        })->count();
        $filesDisposisiStaff = Files::whereHas('disposisiStaff', function ($query) {
            $query->where('divisi', Session('divisi'))->where('id_pos', Session('id_pos'))->where('status', 0);
        })->count();
        $fileskonfirmasiStaff = Files::whereHas('disposisiStaff', function ($query) {
            $query->where('divisi', Session('divisi'))->where('id_pos', Session('id_pos'))->where('status', 1);
        })->count();

        $fileskonfirmasikepala = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
            ->where('file.aksi', 2)
            ->select('file.*')
            ->count();

        $fileskonfirmasimanager = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
            ->join('disposisi', 'konfirmasi.nomor_surat', '=', 'disposisi.nomor_surat')
            ->where('disposisi.divisi', Session('divisi'))
            ->select('file.*')
            ->count();

        // $menunggumanager = Files::whereHas('disposisiStaff', function ($query) {
        //     $query->where('divisi', Session('divisi'))->where('status', 0);
        // })->count();
        // dd($suratkepalatoday);
        return view("dashboard.index", [
            'konfirmasikepala' => $suratkepala,
            'disposisikepala' => $disposisikepala,
            'files' => $files,
            // 'filesDisposisi' => $jumlahFileDivisi3,
            'suratmanager' => $suratmanager,
            'disposisimanager' => $disposisimanager,
            'filesDisposisiStaff' => $filesDisposisiStaff,
            'arsip' => $arsip,
            'menunggukepala' => $menunggukepala,
            'konfirmasistaff' => $fileskonfirmasiStaff,
            'suratkepalatoday' => $suratkepalatoday,
            'suratmanagertoday' => $suratmanagertoday,
            'suratstafftoday' => $suratstafftoday,
            'countkonfirmkepala' => $fileskonfirmasikepala,
            'countkonfirmmanager' => $fileskonfirmasimanager
        ]);
    }


    public function unggah(Request $request)
    {
        if ($request->has('search')) {
            $arsip = Files::where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 1)->pluck('nomor_surat');
            $disposisiFileskepala = Disposisi::wherein('status', [0, 1])->pluck('nomor_surat');
            $konfirmasiFiles = konfirmasi::pluck('nomor_surat');
            $filekeluarkepala = Files::whereIn('nomor_surat', $disposisiFileskepala)
                ->orWhereIn('nomor_surat', $konfirmasiFiles)
                ->wherein('aksi', [1, 2])
                ->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $filesDivisi3 = Files::whereIn('nomor_surat', $disposisiFiles)->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $arsip = Files::paginate(10);
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 1)->pluck('nomor_surat');
            $disposisiFileskepala = Disposisi::wherein('status', [0, 1])->pluck('nomor_surat');
            $konfirmasiFiles = konfirmasi::pluck('nomor_surat');
            $filekeluarkepala = Files::whereIn('nomor_surat', $disposisiFileskepala)
                ->orWhereIn('nomor_surat', $konfirmasiFiles)
                ->wherein('aksi', [1, 2])
                ->paginate(10);
            $filesDivisi3 = Files::whereIn('nomor_surat', $disposisiFiles)->paginate(10);
            // dd($disposisiFileskepala );
        }
        return view("unggah.index", ['arsip' => $arsip, 'disposisimanager' => $filesDivisi3, 'keluarkepala' => $filekeluarkepala]);
    }

    public function konfirmasi(Request $request, $nomor_surat)
    {
        if ($request->has('search')) {
            $arsip = Files::where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $nomor = Files::where('nomor_surat', $nomor_surat)->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->first();
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 1)->pluck('nomor_surat');
            $filesDivisi3 = Files::whereIn('nomor_surat', $disposisiFiles)->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $arsip = Files::all();
            $nomor = Files::where('nomor_surat', $nomor_surat)->first();
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 1)->pluck('nomor_surat');
            $filesDivisi3 = Files::whereIn('nomor_surat', $disposisiFiles)->paginate(10);
        }
        return view("unggah.index", ['arsip' => $arsip, 'disposisimanager' => $filesDivisi3, 'nomor' => $nomor]);
    }

    public function konfirmasimanager(Request $request, $nomor_surat)
    {
        if ($request->has('search')) {
            $arsip = Files::where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $nomor = Files::where('nomor_surat', $nomor_surat)->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->first();
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 1)->pluck('nomor_surat');
            $filesDivisi3 = Files::whereIn('nomor_surat', $disposisiFiles)->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $arsip = Files::paginate(10);
            $nomor = Files::where('nomor_surat', $nomor_surat)->first();
            $disposisiFiles = Disposisi::where('divisi', Session('divisi'))->where('status', 1)->pluck('nomor_surat');
            $filesDivisi3 = Files::whereIn('nomor_surat', $disposisiFiles)->paginate(10);
        }
        return view("unggah.konfirmasi", ['arsip' => $arsip, 'disposisimanager' => $filesDivisi3, 'nomor' => $nomor]);
    }

    function disposisi($nomor_surat)
    {
        $nomor = Files::where('nomor_surat', $nomor_surat)->first();
        $staff = User::where('divisi', Session('divisi'))->where('level', 4)->paginate(10);
        return view("disposisi.index", ['nomor' => $nomor, 'staff' => $staff]);
    }

    function konfirmasikeluar(Request $request)
    {
        if ($request->has('search')) {
            $files = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->join('disposisistaff', 'konfirmasi.nomor_surat', '=', 'disposisistaff.nomor_surat')
                ->where('disposisistaff.id_pos', Session('id_pos'))
                ->select('file.*')->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            // $id_pos = Disposisistaff::where('id_pos', Session('id_pos'))->value('id_pos');
            $files = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->join('disposisistaff', 'konfirmasi.nomor_surat', '=', 'disposisistaff.nomor_surat')
                ->where('disposisistaff.id_pos', Session('id_pos'))
                ->select('file.*')
                ->paginate(10);
        }
        return view('konfirmasi.index', ['konfirmasistaff' => $files]);
    }

    function konfirmasimanagerkeluar(Request $request)
    {
        if ($request->has('search')) {
            $files = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->join('disposisi', 'konfirmasi.nomor_surat', '=', 'disposisi.nomor_surat')
                ->where('disposisi.divisi', Session('divisi'))
                ->select('file.*')->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            // $id_pos = Disposisistaff::where('id_pos', Session('id_pos'))->value('id_pos');
            $files = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->join('disposisi', 'konfirmasi.nomor_surat', '=', 'disposisi.nomor_surat')
                ->where('disposisi.divisi', Session('divisi'))
                ->select('file.*')
                ->paginate(10);
        }
        return view('konfirmasi.manager', ['konfirmasistaff' => $files]);
    }

    public function konfirmasimasuk(Request $request)
    {
        if ($request->has('search')) {
            $files = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->join('disposisistaff', 'konfirmasi.nomor_surat', '=', 'disposisistaff.nomor_surat')
                ->where('disposisistaff.divisi', Session('divisi'))
                ->select('file.*')->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
            $pengirim = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->leftJoin('disposisistaff', 'konfirmasi.nomor_surat', '=', 'disposisistaff.nomor_surat')
                ->leftJoin('user', function ($join) {
                    $join->on('disposisistaff.id_pos', '=', 'user.id_pos')
                        ->orWhere(function ($query) {
                            $query->where('disposisistaff.divisi', '=', 'user.divisi')
                                ->where('user.level', '=', 3);
                        });
                })
                ->where('file.aksi', 2)
                ->select('file.*', 'user.nama')->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->first();
            $fileskonfirmasikepala = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->where('file.aksi', 2)
                ->select('file.*')->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $files = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->join('disposisistaff', 'konfirmasi.nomor_surat', '=', 'disposisistaff.nomor_surat')
                ->where('disposisistaff.divisi', Session('divisi'))
                ->select('file.*')
                ->paginate(10);
            $pengirim = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->leftJoin('disposisistaff', 'konfirmasi.nomor_surat', '=', 'disposisistaff.nomor_surat')
                ->leftJoin('user', function ($join) {
                    $join->on('disposisistaff.id_pos', '=', 'user.id_pos')
                        ->orWhere(function ($query) {
                            $query->where('disposisistaff.divisi', '=', 'user.divisi')
                                ->where('user.level', '=', 3);
                        });
                })
                ->where('file.aksi', 2)
                ->select('file.*', 'user.nama')
                ->first();
            $fileskonfirmasikepala = Files::join('konfirmasi', 'konfirmasi.nomor_surat', '=', 'file.nomor_surat')
                ->where('file.aksi', 2)
                ->select('file.*')
                ->paginate(10);
        }
        return view('konfirmasi.index', ['konfirmasimanager' => $files, 'konfirmasikepala' => $fileskonfirmasikepala, 'pengirim' => $pengirim]);
    }

    public function outgoing(Request $request)
    {
        if ($request->has('search')) {
            $listsuratmasuk = outgoing::where('divisi', Session('divisi'))->where('nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $listsuratmasukkepala = outgoing::wherein('status', [1, 2])->where('nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $listsuratmasukadmin = outgoing::where('nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
            $jabatan = outgoing::join('user', 'outgoing.id_pos', '=', 'user.id_pos')
                ->select('outgoing.*', 'user.jabatan')->where('nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->first();
        } else {
            $listsuratmasuk = outgoing::where('divisi', Session('divisi'))->paginate(10);
            $listsuratmasukkepala = outgoing::wherein('status', [1, 2])->paginate(10);
            $listsuratmasukadmin = outgoing::paginate(10);
            $jabatan = outgoing::join('user', 'outgoing.id_pos', '=', 'user.id_pos')
                ->select('outgoing.*', 'user.jabatan')
                ->first();
        }
        return view('outgoing.main', ['listmasuk' => $listsuratmasuk, 'listkepalamasuk' => $listsuratmasukkepala, 'listmasukadmin' => $listsuratmasukadmin, 'jabatan' => $jabatan]);
    }

    public function outgoingstaff(Request $request)
    {
        if ($request->has('search')) {
            $listsuratmasukstaff = outgoing::where('id_pos', Session('id_pos'))->where('file' . '.' . 'nomor_surat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $listsuratmasukstaff = outgoing::where('id_pos', Session('id_pos'))->paginate(10);
            $jabatan = outgoing::join('user', 'outgoing.id_pos', '=', 'user.id_pos')
                ->select('outgoing.*', 'user.jabatan')->where('nomor_surat', 'LIKE', '%' . $request->search . '%')
                ->first();
        }
        return view('outgoing.outgoingstaff', ['liststaffmasuk' => $listsuratmasukstaff, 'jabatan' => $jabatan]);
    }

    public function hasil($nomor_surat)
    {
        $isi_surat = outgoing::where('nomor_surat', $nomor_surat)->first();
        $users = User::where('divisi', $isi_surat->divisi)
            ->where('level', 3)
            ->first();
        return view('outgoing.hasil', ['user' => $users, 'isi_surat' => $isi_surat]);
        // dd($users);
    }
}
