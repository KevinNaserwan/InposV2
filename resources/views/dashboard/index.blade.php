@extends('Layout/main')
@section('isi')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="/dashboard">
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
                <div class="User Greetings">
                    <p>Selamat datang, <span id="nama user"><strong>{{ Session('nama') }}!</strong></span>
                        Anda masuk sebagai <span
                            style="display: inline-block; padding: 5px 10px;
                        background-color: blue; color: #fff; font-weight: bold; border-radius: 4px;"
                            class="badge">{{ Session('jabatan') }}</span>
                    </p>
                </div>
                @if (Session('level') == 1)
                    <!-- Left side columns -->
                    <div>
                        <div class="row">


                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Hari ini</a></li>
                                            <li><a class="dropdown-item" href="#">Bulan ini</a></li>
                                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Status Berkas <span>| Hari ini</span></h5>

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Nama File</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Pengirim</th>
                                                    <th scope="col">Aksi</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($files->isEmpty())
                                                    <tr>
                                                        <td colspan="7" style="text-align: center" class=" pt-5 pb-5">
                                                            Data belum ada</td>
                                                    </tr>
                                                @endif
                                                @foreach ($files as $index => $item)
                                                    <tr>
                                                        <th scope="row">{{ $index + $files->firstItem() }}</th>
                                                        <td>{{ $item->file_pdf }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>{{ $item->posisi['jabatan'] }}</td>
                                                        <td>
                                                            @if ($item->aksi == 0)
                                                                <span class="badge bg-success">Disimpan</span>
                                                            @elseif ($item->aksi == 1)
                                                                <span class="badge bg-warning">Disposisi</span>
                                                            @elseif ($item->aksi == 2)
                                                                <span class="badge bg-primary">Diarsipkan</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->status == 0)
                                                                @if ($item->aksi == 1 || $item->aksi == 2)
                                                                    <span class="badge bg-success">Sudah Dibaca</span>
                                                                @else
                                                                    <span class="badge bg-danger">Belum Dibaca</span>
                                                                @endif
                                                            @elseif ($item->status == 1)
                                                                <span class="badge bg-success">Sudah Dibaca</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $files->links() }}

                                    </div>

                                </div>
                            </div><!-- End Recent Sales -->


                        </div>
                    </div><!-- End Left side columns -->
                @elseif (Session('level') == 2)
                    <!-- Left side columns -->
                    <div>
                        <div class="row">
                            <!-- Sales Card -->
                            <div class="col-xxl-3 col-md-3">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Surat Masuk
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cart"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $konfirmasikepala }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-3 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Disposisi
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $disposisikepala }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Revenue Card -->

                            <!-- Customers Card -->
                            <div class="col-xxl-3 col-md-3">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Menunggu
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $menunggukepala }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customers Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-3 col-md-3">
                                <div class="card info-card confirm-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Konfirmasi
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $countkonfirmkepala }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Revenue Card -->

                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">This Month</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">This Year</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Status Berkas <span>| Hari Ini</span>
                                        </h5>

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Nama File</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Pengirim</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($suratkepalatoday as $index => $item)
                                                    <tr>
                                                        <th scope="row">{{ $index + $suratkepalatoday->firstItem() }}
                                                        </th>
                                                        <td>{{ $item->file_pdf }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>{{ $item->posisi['jabatan'] }}</td>
                                                        <td>
                                                            @if ($item->aksi == 0)
                                                                <span class="badge bg-success">Disimpan</span>
                                                            @elseif ($item->aksi == 1)
                                                                <span class="badge bg-warning">Disposisi</span>
                                                            @elseif ($item->aksi == 2)
                                                                <span class="badge bg-primary">Diarsipkan</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $suratkepalatoday->links() }}
                                    </div>
                                </div>
                            </div>
                            <!-- End Recent Sales -->
                        </div>
                    </div>
                    <!-- End Left side columns -->
                @elseif (Session('level') == 3)
                    <!-- Left side columns -->
                    <div>
                        <div class="row">
                            <!-- Sales Card -->
                            <div class="col-xxl-3 col-md-6">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Surat Masuk
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cart"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $suratmanager }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-3 col-md-6">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Disposisi
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $disposisimanager }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Revenue Card -->

                            <!-- Customers Card -->
                            <div class="col-xxl-3 col-xl-12">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Menunggu
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $disposisimanager }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customers Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-3 col-md-4">
                                <div class="card info-card confirm-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Konfirmasi
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-check-circle"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $countkonfirmmanager }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Revenue Card -->

                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">This Month</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">This Year</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Status Berkas <span>| Hari Ini</span>
                                        </h5>

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Nama File</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Pengirim</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($suratmanagertoday as $index => $item)
                                                    <tr>
                                                        <th scope="row">{{ $index + $suratmanagertoday->firstItem() }}
                                                        </th>
                                                        <td>{{ $item->file_pdf }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>{{ $item->posisi['jabatan'] }}</td>
                                                        <td>
                                                            @if ($item->aksi == 0)
                                                                <span class="badge bg-success">Disimpan</span>
                                                            @elseif ($item->aksi == 1)
                                                                <span class="badge bg-warning">Disposisi</span>
                                                            @elseif ($item->aksi == 2)
                                                                <span class="badge bg-primary">Diarsipkan</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $suratmanagertoday->links() }}
                                    </div>
                                </div>
                            </div>
                            <!-- End Recent Sales -->
                        </div>
                    </div>
                    <!-- End Left side columns -->
                @elseif (Session('level') == 4)
                    <!-- Left side columns -->
                    <div>
                        <div class="row">
                            <!-- Sales Card -->
                            <div class="col-xxl-6 col-md-6">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Surat Masuk
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cart"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $filesDisposisiStaff }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-6 col-md-6">
                                <div class="card info-card confirm-card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Konfirmasi
                                        </h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $konfirmasistaff }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Revenue Card -->

                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="#">Today</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">This Month</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">This Year</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Status Berkas <span>| Hari Ini</span>
                                        </h5>

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Nama File</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Pengirim</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($suratstafftoday as $index => $item)
                                                    <tr>
                                                        <th scope="row">{{ $index + $suratstafftoday->firstItem() }}
                                                        </th>
                                                        <td>{{ $item->file_pdf }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>{{ $item->posisi['jabatan'] }}</td>
                                                        <td>
                                                            @if ($item->aksi == 0)
                                                                <span class="badge bg-success">Disimpan</span>
                                                            @elseif ($item->aksi == 1)
                                                                <span class="badge bg-warning">Disposisi</span>
                                                            @elseif ($item->aksi == 2)
                                                                <span class="badge bg-primary">Diarsipkan</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $suratstafftoday->links() }}
                                    </div>
                                </div>
                            </div>
                            <!-- End Recent Sales -->
                        </div>
                    </div>
                    <!-- End Left side columns -->
                @endif
                {{-- <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">


                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Hari ini</a></li>
                                        <li><a class="dropdown-item" href="#">Bulan ini</a></li>
                                        <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Status Berkas <span>| Hari ini</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Nama File</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Pengirim</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><a href="#">1</a></th>
                                                <td>Tugas Perintah Anak Magang.pdf</td>
                                                <td><a href="#" class="text-primary">Tugas yang akan
                                                        diberikan kepada anak magang</a></td>
                                                <td>Manajer SDM</td>
                                                <td><span class="badge bg-success">Terbaca</span></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><a href="#">2</a></th>
                                                <td>Lembar Pengesahan Kepada Camat regional Kemuning.pdf</td>
                                                <td><a href="#" class="text-primary">Lembar pengesahan
                                                        Kepala Camat Kemuning</a></td>
                                                <td>KCU Palembang</td>
                                                <td><span class="badge bg-danger">Belum terbaca</span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->


                    </div>
                </div><!-- End Left side columns --> --}}


            </div>
        </section>

    </main><!-- End #main -->
@endsection
