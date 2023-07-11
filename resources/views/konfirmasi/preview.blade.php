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
                </ul>
            </li><!-- End Components Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Preview</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                    <li class="breadcrumb-item active">Konfirmasi</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card preview">
                        <div class="card-body">
                            <h5 class="card-title">Konfirmasi</h5>
                            <div class="row">
                                <div class="col flex ">
                                    <iframe src="{{ asset('file-konfirmasi/' . $preview->nama_file) }}" frameborder="20" width="100%"
                                        height="400px" style="justify-content-center"></iframe>
                                </div>
                                <div class="col tombol">
                                    <div class="row">
                                        <div class="col">
                                            <h5>catatan:</h5>
                                            <p>{{$preview->keterangan}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-sm badge disposisi" style="background-color: green"
                                                href="{{ url('/unduh') }}">Unduh</a>
                                        </div>
                                    </div>
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
            margin-top: 10px;
        }

        .disposisi {
            width: 200px;
            height: 50px;
            padding-top: 18px;
            margin-bottom: 10px;
            border-radius: 10px;
            font-size: 15px;
        }
        .konfirmasi {
            width: 100%;
            /* Sesuaikan dengan lebar iframe */
            height: 400px;
            /* Sesuaikan dengan tinggi iframe */
        }

        .konfirmasi img {
            width: 100%;
            /* Skala gambar sesuai lebar iframe */
            height: auto;
            /* Menyesuaikan tinggi gambar secara proporsional */
        }
    </style>
@endsection
