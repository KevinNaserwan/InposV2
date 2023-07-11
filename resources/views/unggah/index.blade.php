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
                            <a href="/unggah" class="nav-link">
                                <i class="bi bi-circle"></i><span>Unggah</span>
                            </a>
                        </li>
                    @elseif (Session('level') == 2)
                        <li>
                            <a href="/arsip">
                                <i class="bi bi-circle"></i><span>Surat Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/unggah" class="nav-link">
                                <i class="bi bi-circle"></i><span>Surat Keluar</span>
                            </a>
                        </li>
                        <li>
                            <a href="/konfirmasimasuk">
                                <i class="bi bi-circle"></i><span>konfirmasi Masuk</span>
                            </a>
                        </li>
                    @elseif (Session('level') == 3)
                        <li>
                            <a href="/arsip">
                                <i class="bi bi-circle"></i><span>Surat Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/unggah" class="nav-link">
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
                    @endif
                </ul>
            </li><!-- End Components Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">
        @if (Session('level') == 1)
            <div class="pagetitle">
                <h1>Unggah File</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Unggah</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Unggah File</h5>

                                @if (Session::has('file_path'))
                                    <div class="preview-file">
                                        <p>File yang baru dimasukkan:</p>
                                        <iframe src="{{ Session::get('file_path') }}" width="100%"
                                            height="500"></iframe>
                                    </div>
                                @endif
                                <form method="POST" action="/unggahproses" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Lampiran</label>
                                        <div class="col-sm-10">
                                            <input type="file" value="" name="file_pdf" class="form-control"
                                                id="file_pdf" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="" name="keterangan" class="form-control"
                                                id="keterangan" placeholder="Masukkan Teks...." required>
                                            <div class="col mt-3">
                                                <input class="form-check-input" type="checkbox" name="aksi"
                                                    value="2" id="aksi">
                                                <label class="form-check-label" for="aksi">Arsipkan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Unggah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                    </div>
                </div>
            </section>
        @elseif (Session('level') == 2)
            <div class="pagetitle">
                <h1>Tabel Surat Keluar</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Surat Keluar</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Keluar</h5>
                                {{-- <a href="{{ url('contact-add') }}" class="btn btn-primary mb-2">Add</a> --}}

                                <!-- Default Table -->
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama File</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Pengirim</th>
                                            <th scope="col">Aksi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody> --}}
                                    {{-- akan di isi --}}
                                    {{-- @foreach ($data as $dt)
                            <tr>
                              <th scope="row">{{$loop->index + 1}}</th>
                              <td>{{$dt->name}}</td>
                              <td>{{$dt->email}}</td>
                              <td>{{$dt->plan}}</td>
                              <td>{{$dt->project}}</td>
                              <td>
                                <a href="{{url('contact-edit')}}/{{$dt->id}}" class="btn btn-sm btn-success">Edit</a>
                                <a onclick="return confirm('yakin hapus data?')" href="{{url('contact-delete')}}/{{$dt->id}}" class="btn btn-sm btn-danger">Delete</a>
                              </td>
                            </tr>
                            @endforeach --}}
                                    {{-- </tbody> --}}
                                    <tbody>
                                        @foreach ($keluarkepala as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
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
                                                        @if ($item->aksi == 1)
                                                            <span class="badge bg-danger">Belum Dibaca</span>
                                                        @else
                                                            <span class="badge bg-success">Sudah Dibaca</span>
                                                        @endif
                                                    @elseif ($item->status == 1)
                                                        <span class="badge bg-success">Sudah Dibaca</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="/previewkeluar/{{ $item->nama_file }}">Buka</a>
                                                    <form action="/arsip/delete/{{ $item->file_pdf }}" method="POST"
                                                        style="display: inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger"
                                                            id="delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Default Table Example -->
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </section>
        @elseif (Session('level') == 3)
            <div class="pagetitle">
                <h1>Tabel Surat Keluar</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Surat Keluar</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Keluar</h5>
                                {{-- <a href="{{ url('contact-add') }}" class="btn btn-primary mb-2">Add</a> --}}

                                <!-- Default Table -->
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama File</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Pengirim</th>
                                            <th scope="col">Aksi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tindakan</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody> --}}
                                    {{-- akan di isi --}}
                                    {{-- @foreach ($data as $dt)
                            <tr>
                              <th scope="row">{{$loop->index + 1}}</th>
                              <td>{{$dt->name}}</td>
                              <td>{{$dt->email}}</td>
                              <td>{{$dt->plan}}</td>
                              <td>{{$dt->project}}</td>
                              <td>
                                <a href="{{url('contact-edit')}}/{{$dt->id}}" class="btn btn-sm btn-success">Edit</a>
                                <a onclick="return confirm('yakin hapus data?')" href="{{url('contact-delete')}}/{{$dt->id}}" class="btn btn-sm btn-danger">Delete</a>
                              </td>
                            </tr>
                            @endforeach --}}
                                    {{-- </tbody> --}}
                                    <tbody>
                                        @foreach ($disposisimanager as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
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
                                                    @if ($item->aksi == 2)
                                                        @if ($item->status == 0)
                                                            <span class="badge bg-success">Sudah Dibaca</span>
                                                        @elseif ($item->status == 1)
                                                            <span class="badge bg-danger">Belum Dibaca</span>
                                                        @endif
                                                    @elseif($item->aksi == 1)
                                                        @if ($item->status == 1)
                                                            <span class="badge bg-success">Sudah Dibaca</span>
                                                        @elseif ($item->status == 0)
                                                            <span class="badge bg-danger">Belum Dibaca</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="/previewkeluar/{{ $item->nama_file }}">Buka</a>
                                                    <form action="/arsip/delete/{{ $item->file_pdf }}" method="POST"
                                                        style="display: inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger"
                                                            id="delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Default Table Example -->
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </section>
        @elseif (Session('level') == 4)
            <div class="pagetitle">
                <h1>Unggah File</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Unggah</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Konfirmasi Disposisi</h5>

                                @if (Session::has('file_path'))
                                    <div class="preview-file">
                                        <p>File yang baru dimasukkan:</p>
                                        <iframe src="{{ Session::get('file_path') }}" width="100%"
                                            height="500"></iframe>
                                    </div>
                                @endif
                                <form method="POST" action="/konfirmasiproses/{{ $nomor->nomor_surat }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Lampiran</label>
                                        <div class="col-sm-10">
                                            <input type="file" value="" name="file_pdf" class="form-control"
                                                id="file_pdf" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="" name="keterangan" class="form-control"
                                                id="keterangan" placeholder="Masukkan Teks...." required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Unggah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

    </main><!-- End #main -->
@endsection