@extends('Layout/main')
@section('isi')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed " href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Beranda</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Menu</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    @if (Session('level') == 1)
                        <li>
                            <a href="/arsip">
                                <i class="bi bi-circle"></i><span>Arsip</span>
                            </a>
                        </li>
                        <li>
                            <a href="/unggah">
                                <i class="bi bi-circle"></i><span>Unggah</span>
                            </a>
                        </li>
                        <li>
                            <a href="/outgoing-masuk">
                                <i class="bi bi-circle"></i><span>Outgoing</span>
                            </a>
                        </li>
                    @elseif (Session('level') == 2)
                        <li>
                            <a href="/arsip">
                                <i class="bi bi-circle"></i><span>Surat Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/unggah">
                                <i class="bi bi-circle"></i><span>Surat Keluar</span>
                            </a>
                        </li>
                        <li>
                            <a href="/konfirmasimasuk">
                                <i class="bi bi-circle"></i><span>konfirmasi Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/outgoing-masuk">
                                <i class="bi bi-circle"></i><span>Outgoing</span>
                            </a>
                        </li>
                    @elseif (Session('level') == 3)
                        <li>
                            <a href="/arsip">
                                <i class="bi bi-circle"></i><span>Surat Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/unggah">
                                <i class="bi bi-circle"></i><span>Surat Keluar</span>
                            </a>
                        </li>
                        <li>
                            <a href="/konfirmasimasuk">
                                <i class="bi bi-circle"></i><span>konfirmasi Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/konfirmasimanagerkeluar">
                                <i class="bi bi-circle"></i><span>konfirmasi Keluar</span>
                            </a>
                        </li>
                        <li>
                            <a href="/outgoing-masuk">
                                <i class="bi bi-circle"></i><span>Outgoing</span>
                            </a>
                        </li>
                    @elseif (Session('level') == 4)
                        <li>
                            <a href="/arsip">
                                <i class="bi bi-circle"></i><span>Surat Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/konfirmasikeluar">
                                <i class="bi bi-circle"></i><span>konfirmasi Keluar</span>
                            </a>
                        </li>
                        <li>
                            <a href="/buatsurat">
                                <i class="bi bi-circle"></i><span>Buat Surat</span>
                            </a>
                        </li>
                        <li>
                            <a href="/outgoingstaff">
                                <i class="bi bi-circle"></i><span>Outgoing</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li><!-- End Components Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Disposisi</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                    <li class="breadcrumb-item">Menu</li>
                    <li class="breadcrumb-item active">Disposisi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Disposisi</h5>

                            <!-- General Form Elements -->
                            @if (Session('level') == 2)
                                <form method="POST" action="/disposisiproses/{{ $nomor->nomor_surat }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tujuan Divisi</label>
                                        <div class="col-sm-10">
                                            <select name="divisi" id="divisi" class="form-control">
                                                <option disabled selected value>Pilih divisi</option>
                                                <option value="1">Deputi EGM</option>
                                                <option value="2">Pelayanan Outlet & Operasi Cabang</option>
                                                <option value="3">Operasi Kurir</option>
                                                <option value="4">Solusi Teknologi</option>
                                                <option value="5">Keuangan & Aset</option>
                                                <option value="6">Kesekretariatan</option>
                                                <option value="7">Pengawas Umum</option>
                                                <option value="8">Bisnis Jasa Keuangan</option>
                                                <option value="9">Penjualan, Korporat, Kurir Logistik</option>
                                                <option value="10">Ritel/Kemitraan</option>
                                                <option value="11" style="font-weight:bold">Semua</option>
                                            </select>
                                        </div>
                                    </div>
                                @elseif(Session('level') == 3)
                                    <form method="POST" action="/disposisistaff/{{ $nomor->nomor_surat }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Staff</label>
                                            <div class="col-sm-10">
                                                <select name="id_pos" id="id_pos" class="form-control">
                                                    <option disabled selected value>Pilih Staff</option>
                                                    @foreach ($staff as $item)
                                                        <option value="{{ $item->id_pos }}">{{ $item->id_pos }} ||
                                                            {{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                            @endif
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Perihal</label>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="perihal[]" value="Segera tanggapi"
                                        id="perihal">
                                    <label class="form-check-label" for="Segera Tanggapi ">Segera tanggapi</label>
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" name="perihal[]"
                                                value="Harap dipedomani" id="perihal">
                                            <label class="form-check-label" for="Harap dipedomani">Harap
                                                dipedomani</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input class="form-check-input" type="checkbox" name="perihal[]"
                                                        value="Monitor
                                                            pelaksanaan"
                                                        id="perihal">
                                                    <label class="form-check-label" for="rememberMe">Monitor
                                                        pelaksanaan</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="perihal[]"
                                                                value="Bicarakan
                                                                    dengan saya"
                                                                id="perihal">
                                                            <label class="form-check-label" for="rememberMe">Bicarakan
                                                                dengan saya</label>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="perihal[]" value="true" id="perihal">
                                                                    <label class="form-check-label"
                                                                        for="rememberMe">Konsepkan surat ...<label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="perihal[]" value="true"
                                        id="perihal">
                                    <label class="form-check-label" for="rememberMe">Proses Lebih Lanjut</label>
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" name="perihal[]"
                                                value="true" id="perihal">
                                            <label class="form-check-label" for="rememberMe">Koordinasikan dengan
                                                ...</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input class="form-check-input" type="checkbox" name="perihal[]"
                                                        value="true" id="perihal">
                                                    <label class="form-check-label" for="rememberMe">Buat
                                                        Analisa/Kajian</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="perihal[]" value="true" id="perihal">
                                                            <label class="form-check-label" for="rememberMe">Buat
                                                                surat usulan</label>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="perihal[]" value="true" id="perihal">
                                                                    <label class="form-check-label"
                                                                        for="rememberMe">FYI<label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="checkbox" name="perihal" value="true"
                                        id="perihal">
                                    <label class="form-check-label" for="rememberMe">Teruskan ke
                                        ...</label>
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-check-input" type="checkbox" name="perihal"
                                                value="true" id="perihal">
                                            <label class="form-check-label" for="rememberMe">Laporkan
                                                ke ...<label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" value="" name="catatan" id="catatan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
