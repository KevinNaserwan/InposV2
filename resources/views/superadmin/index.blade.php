@extends('Layout/main')
@section('isi')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>General Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">General</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data User</h5>
                            <a href="{{ url('user-add') }}" class="btn btn-primary mb-2">Add</a>

                            <!-- Default Table -->
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">id</th>
                                        <th scope="col">nama</th>
                                        <th scope="col">role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $dt->name }}</td>
                                            <td>{{ $dt->email }}</td>
                                            <td>{{ $dt->role }}</td>

                                            <td>
                                                <a href="{{ url('user-edit') }}/{{ $dt->id }}"
                                                    class="btn btn-sm btn-success">Edit</a>
                                                <a onclick="return confirm('yakin hapus data?')"
                                                    href="{{ url('user-delete') }}/{{ $dt->id }}"
                                                    class="btn btn-sm btn-danger">Delete</a>
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
        </section>

    </main><!-- End #main -->

    //add
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>General Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">General</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data User</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ url('user-store') }}">
                                {{-- ;arabel memerlukan code akses untuk mengirimkan data menggunakan method oist --}}
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Id</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('id_pos') }}" name="id_pos"
                                            class="form-control @error('id_pos') is-invalid @enderror">
                                        {{-- pesan error validation --}}
                                        @error('id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('nama') }}" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror">
                                        {{-- pesan error validation --}}
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="role">
                                            <option disabled selected value>Pilih role</option>
                                            <option value="admin">Admin</option>
                                            <option value="pegawa">KCU</option>
                                            <option value="boss">Deputi</option>
                                            <option value="boss">Manager</option>
                                            <option value="boss">Staff</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- session ketik memilih role manager dan staff --}}
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="divisi">
                                            <option disabled selected value>Pilih divisi</option>
                                            <option value="2">Pelayanan Outlet & Operasi Cabang</option>
                                            <option value="3">Operasi Kurir</option>
                                            <option value="4">Solusi Teknologi</option>
                                            <option value="5">Keuangan & Aset</option>
                                            <option value="6">Kesekretariatan</option>
                                            <option value="7">Pengawas Umum</option>
                                            <option value="8">Bisnis Jasa Keuangan</option>
                                            <option value="9">Penjualan, Korporat, Kurir Logistik</option>
                                            <option value="10">Ritel/Kemitraan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        {{-- pesan error validation --}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit Button</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit Form</button>
                                    </div>
                                </div>
                        </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->

    //edit
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>General Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">General</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Data User</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ url('user-store') }}">
                                {{-- ;arabel memerlukan code akses untuk mengirimkan data menggunakan method oist --}}
                                @csrf
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Id</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('id_pos') }}" name="id_pos"
                                            class="form-control @error('id_pos') is-invalid @enderror">
                                        {{-- pesan error validation --}}
                                        @error('id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('nama') }}" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror">
                                        {{-- pesan error validation --}}
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="role">
                                            <option disabled selected value>Pilih role</option>
                                            <option value="admin">Admin</option>
                                            <option value="pegawa">KCU</option>
                                            <option value="boss">Deputi</option>
                                            <option value="boss">Manager</option>
                                            <option value="boss">Staff</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- session ketik memilih role manager dan staff --}}
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Divisi</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="divisi">
                                            <option disabled selected value>Pilih divisi</option>
                                            <option value="2">Pelayanan Outlet & Operasi Cabang</option>
                                            <option value="3">Operasi Kurir</option>
                                            <option value="4">Solusi Teknologi</option>
                                            <option value="5">Keuangan & Aset</option>
                                            <option value="6">Kesekretariatan</option>
                                            <option value="7">Pengawas Umum</option>
                                            <option value="8">Bisnis Jasa Keuangan</option>
                                            <option value="9">Penjualan, Korporat, Kurir Logistik</option>
                                            <option value="10">Ritel/Kemitraan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        {{-- pesan error validation --}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit Button</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit Form</button>
                                    </div>
                                </div>
                        </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>

            </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
