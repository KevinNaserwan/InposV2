@extends('Layout/main')
@section('isi')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            @if (Session('level') == 0)
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Create User</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            @else
                <li class="nav-item">
                    <a class="nav-link " href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Beranda</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            @endif
            <li class="nav-item">
                <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Menu List</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    @if (Session('level') == 0)
                        <li>
                            <a href="/liststaff">
                                <i class="bi bi-circle"></i><span>List Staff</span>
                            </a>
                        </li>
                        <li>
                            <a href="/listmanager">
                                <i class="bi bi-circle"></i><span>List Manager</span>
                            </a>
                        </li>
                        <li>
                            <a href="/listgm">
                                <i class="bi bi-circle"></i><span>List EGM</span>
                            </a>
                        </li>
                        <li>
                            <a href="/listdeputi">
                                <i class="bi bi-circle"></i><span>List Deputi EGM</span>
                            </a>
                        </li>
                        <li>
                            <a href="/listadmin">
                                <i class="bi bi-circle"></i><span>List Admin</span>
                            </a>
                        </li>
                    @elseif (Session('level') == 1)
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
                            <a href="/buatsurat">
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
                    @elseif (Session('level') == 5)
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
                    @endif
                </ul>
            </li><!-- End Components Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Beranda</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                    <li class="breadcrumb-item active">Dasbor</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div>
                    <div class="row">


                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">List Staff</h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Nippos</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Jabatan</th>
                                                <th scope="col">Divisi</th>
                                                <th scope="col">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($liststaff->isEmpty())
                                                <tr>
                                                    <td colspan="7" style="text-align: center" class=" pt-5 pb-5">
                                                        Data belum ada</td>
                                                </tr>
                                            @endif
                                            @foreach ($liststaff as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + $liststaff->firstItem() }}</th>
                                                    <td>{{ $item->id_pos }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->jabatan }}</td>
                                                    <td>
                                                        @if ($item->divisi == 0 )
                                                        -
                                                        @elseif ($item->divisi == 2)
                                                            Pelayanan Outlet & Operasi Cabang
                                                        @elseif ($item->divisi == 3)
                                                            Operasi Kurir
                                                        @elseif ($item->divisi == 4)
                                                            Solusi Teknologi
                                                        @elseif ($item->divisi == 5)
                                                            Keuangan & Aset
                                                        @elseif ($item->divisi == 6)
                                                            Kesekretariatan
                                                        @elseif ($item->divisi == 7)
                                                            Pengawasan Umum
                                                        @elseif ($item->divisi == 8)
                                                            Bisnis Jasa Keuangan
                                                        @elseif ($item->divisi == 9)
                                                            Bisnis Penjualan, Korporat, Kurir Logistik
                                                        @elseif ($item->divisi == 10)
                                                            Ritel/Kemitraan
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="/edit/{{ $item->id_pos }}">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $liststaff->links() }}

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->


                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
    </main>
@endsection
