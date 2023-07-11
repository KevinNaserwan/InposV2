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
        @if (Session('level') == 4)
            <div class="pagetitle">
                <h1>Outgoing</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">Outgoing</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Outgoing</h5>

                                <!-- General Form Elements -->
                                <form method="POST" action="/outgoingprocess" enctype="multipart/form-data" id="postForm">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tujuan Divisi</label>
                                        <div class="col-sm-10">
                                            <select name="level" id="level" class="form-control">
                                                <option disabled selected value>Tujuan</option>
                                                <option value="0">Eksternal</option>
                                                <option value="1">Internal</option>
                                            </select>
                                        </div>
                                    </div>
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
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Tujuan</label>
                                        <div class="col">
                                            <input type="text" value="" name="tujuan" id="tujuan"
                                                class="form-control" placeholder="Masukan Tujuan">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Perihal</label>
                                        <div class="col">
                                            <input type="text" value="" name="perihal" id="perihal"
                                                class="form-control" placeholder="Masukan Perihal">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Lampiran</label>
                                        <div class="col">
                                            <input type="file" value="" name="lampiran" id="lampiran"
                                                class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label for="inputText" class="col-sm-2 col-form-label">Isi Surat</label>
                                        <div class="col-sm-10">
                                            <!-- Quill Editor Full -->
                                            <div id="quill_editor"></div>
                                            <input type="hidden" id="isi_surat" name="isi_surat">
                                            <!-- End Quill Editor Full -->
                                        </div>
                                    </div>
                                    <div class="row pt-3">
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
        @elseif(Session('level') == 3)
            <div class="pagetitle">
                <h1>Tabel Surat Masuk</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Outgoing</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Masuk</h5>
                                {{-- <a href="{{ url('contact-add') }}" class="btn btn-primary mb-2">Add</a> --}}

                                <!-- Default Table -->
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nomor Surat</th>
                                            <th scope="col">Perihal</th>
                                            <th scope="col">Tujuan</th>
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
                                        @foreach ($listmasuk as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->nomor_surat }}</td>
                                                <td>{{ $item->perihal }}</td>
                                                <td>{{ $item->tujuan }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge bg-danger">Menunggu Konfirmasi</span>
                                                    @elseif ($item->status == 1)
                                                        <span class="badge bg-warning">Dikonfirmasi Manager</span>
                                                    @elseif ($item->status == 2)
                                                        <span class="badge bg-primary">Dikonfirmasi General Manager</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="/outgoing-preview/{{ $item->nomor_surat }}">Buka</a>
                                                    {{-- <form action="/arsip/delete/{{ $item->file_pdf }}" method="POST"
                                                        style="display: inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger"
                                                            id="delete">Delete</button>
                                                    </form> --}}
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
        @elseif (Session('level') == 2)
            <div class="pagetitle">
                <h1>Tabel Surat Masuk</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Outgoing</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Masuk</h5>
                                {{-- <a href="{{ url('contact-add') }}" class="btn btn-primary mb-2">Add</a> --}}

                                <!-- Default Table -->
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nomor Surat</th>
                                            <th scope="col">Perihal</th>
                                            <th scope="col">Tujuan</th>
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
                                        @foreach ($listkepalamasuk as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->nomor_surat }}</td>
                                                <td>{{ $item->perihal }}</td>
                                                <td>{{ $item->tujuan }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge bg-danger">Menunggu Konfirmasi</span>
                                                    @elseif ($item->status == 1)
                                                        <span class="badge bg-warning">Dikonfirmasi Manager</span>
                                                    @elseif ($item->status == 2)
                                                        <span class="badge bg-primary">Dikonfirmasi General Manager</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="/outgoing-preview/{{ $item->nomor_surat }}">Buka</a>
                                                    {{-- <form action="/arsip/delete/{{ $item->file_pdf }}" method="POST"
                                                            style="display: inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger"
                                                                id="delete">Delete</button>
                                                        </form> --}}
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
        @elseif (Session('level') == 1)
            <div class="pagetitle">
                <h1>Tabel Surat Masuk</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Menu</a></li>
                        <li class="breadcrumb-item active">Outgoing</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Surat Masuk</h5>
                                {{-- <a href="{{ url('contact-add') }}" class="btn btn-primary mb-2">Add</a> --}}

                                <!-- Default Table -->
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nomor Surat</th>
                                            <th scope="col">Perihal</th>
                                            <th scope="col">Tujuan</th>
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
                                        @foreach ($listmasukadmin as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item->nomor_surat }}</td>
                                                <td>{{ $item->perihal }}</td>
                                                <td>{{ $item->tujuan }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge bg-danger">Menunggu Konfirmasi</span>
                                                    @elseif ($item->status == 1)
                                                        <span class="badge bg-warning">Dikonfirmasi Manager</span>
                                                    @elseif ($item->status == 2)
                                                        <span class="badge bg-primary">Dikonfirmasi General Manager</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="/outgoing-preview/{{ $item->nomor_surat }}">Buka</a>
                                                    {{-- <form action="/arsip/delete/{{ $item->file_pdf }}" method="POST"
                                                            style="display: inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger"
                                                                id="delete">Delete</button>
                                                        </form> --}}
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
        @endif
    </main><!-- End #main -->

    <script>
        var quill = new Quill('#quill_editor', {
            theme: 'snow'
        });

        var form = document.getElementById('postForm');
        form.onsubmit = function() {
            var isi_surat = document.getElementById('isi_surat');
            isi_surat.value = quill.root.innerHTML;
        };
    </script>
@endsection
