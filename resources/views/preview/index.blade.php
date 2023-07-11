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
            <h1>Preview</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                    <li class="breadcrumb-item">Arsip</li>
                    <li class="breadcrumb-item active">Preview</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card preview">
                        <div class="card-body">
                            <h5 class="card-title">Preview File</h5>
                            <div class="row">
                                <div class="col">
                                    <iframe src="{{ asset('file-pdf/' . $preview->file_pdf) }}" frameborder="20"
                                        width="800" height="500"></iframe>
                                </div>
                                <div class="col tombol">

                                    @if (Session('level') == 3)
                                        <div class="Deskripsi Berkas">
                                            <p><strong>Perihal : </strong></p>
                                            <p>{{ implode(', ', [$disposisi->perihal]) }}</p>
                                            <p><strong>Catatan : </strong></p>
                                            <p>{{ $disposisi->catatan }}</p>
                                        </div>
                                    @else
                                    @endif
                                    @if (Session('level') == 1)
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-sm badge disposisi" style="background-color: green"
                                                    href="{{ url('/unduh') }}">Unduh</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <form action="/arsipfile/{{ $preview->nama_file }}" method="POST">
                                                @csrf
                                                <div class="col mt-2">
                                                    <input class="form-check-input" type="checkbox" name="aksi"
                                                        value="2" id="aksi">
                                                    <label class="form-check-label mb-3" for="aksi">Arsipkan</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    @elseif (Session('level') == 2)
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-sm badge disposisi" style="background-color: green"
                                                    href="{{ url('/unduh') }}">Unduh</a>
                                                @if ($preview->aksi == 2)
                                                @else
                                                    <a class="btn btn-sm badge disposisi" style="background-color: orange"
                                                        href="/disposisi/{{ $preview->nomor_surat }}">Disposisi</a>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif (Session('level') == 3)
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-sm badge disposisi" style="background-color: green"
                                                    href="{{ url('/unduh') }}">Unduh</a>
                                                @if ($preview->aksi == 2)
                                                @elseif($preview->aksi == 0 || 1)
                                                    <a class="btn btn-sm badge disposisi" style="background-color: orange"
                                                        href="/disposisi/{{ $preview->nomor_surat }}">Disposisi</a>
                                                    <a class="btn btn-sm badge disposisi" style="background-color: blue"
                                                        href="/konfirmasimanager/{{ $preview->nomor_surat }}">Konfirmasi</a>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif (Session('level') == 4)
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-sm badge disposisi" style="background-color: green"
                                                    href="{{ url('/unduh') }}">Unduh</a>
                                                <a class="btn btn-sm badge disposisi" style="background-color: blue"
                                                    href="/konfirmasi/{{ $preview->nomor_surat }}">Konfirmasi</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <style>
        .tombol {
            margin-top: 50px;
            margin-left: 20px
        }

        .lanjutan {
            margin-top: 70px;
        }

        .tombol p {
            margin-bottom: 10px;
        }

        .disposisi {
            width: 200px;
            height: 50px;
            padding-top: 18px;
            margin-bottom: 10px;
            border-radius: 10px;
            font-size: 15px;
        }
    </style>
@endsection
