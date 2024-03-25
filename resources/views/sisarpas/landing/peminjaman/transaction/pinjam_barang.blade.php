@extends('sisarpas.landing.layouts.app')

@section('title', 'Halaman Transaction Pinjam')

@section('content-landing')

    @push('header')
        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo">
                    <a href="{{ route('sisarpas.landing') }}"><img src="{{ asset('sisarpas/assets/img/logo.png') }}" alt="logo"
                            style="border-radius: 50%" /></a>
                </h1>
                <nav id="navbar" class="navbar">
                    <ul>
                        <!-- <li></li> -->
                        <a class="nav-link scrollto">Peminjaman Sarana dan Prasarana </a>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            </div>
        </header>
    @endpush

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    @endpush
    <!-- End Header -->
    <main id="main" data-aos="fade-up">
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $errors)
                                    <ul>
                                        <li> {{ $errors }}</li>
                                    </ul>
                                @endforeach
                            </div>
                        @endif
                        <button class="warna" type="button" data-item="{{ $listDaftarPeminjam }}"
                            data-bs-target="#daftarPeminjaman" data-bs-toggle="modal" data-bs-dismiss="modal">Daftar
                            Peminjam</button>

                        <form method="POST" action="{{ route('transaction.submit.pinjam.barang') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="warna-form">
                                {{-- <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Tujuan</label>
                                    <div class="col-sm-7">
                                        <select class="form-select" id="inlineFormSelectPref">
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label" style="font-weight: 600">ID
                                        Barang</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="barangs_id"
                                            placeholder="Masukan tujuan pinjam" value="{{ $id->id }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label" style="font-weight: 600">User
                                        ID
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="users_id" class="form-control"
                                            placeholder="Masukan tujuan pinjam"
                                            value="{{ Auth::guard('user')->user()->id }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal_pinjam" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Tanggal Peminjaman</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam"
                                            value="{{ old('tanggal_pinjam') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal_pengembalian" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Tanggal Pengembalian</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="tanggal_pengembalian"
                                            id="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Kategori</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="kategori_pinjam"
                                            placeholder="Masukan kategori pinjam" value="{{ $id->kategori_barang }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label" style="font-weight: 600">Tujuan
                                        Pinjam</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="tujuan_pinjam"
                                            placeholder="Masukan tujuan pinjam" value="{{ old('tujuan_pinjam') }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Keterangan Pinjam</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="keterangan_pinjam" id="exampleFormControlTextarea1" rows="3">{{ old('keterangan_pinjam') }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Dokumen Pendukung</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="file" name="dokumen_pendukung"
                                            id="formFile" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Status
                                        Pinjam</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="status_pinjam"
                                            placeholder="Masukan tujuan pinjam" value="diajukan" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="ajukan">
                                <button type="submit" class="btn-ajukan" style="font-weight: bold;">Ajukan
                                    Permohonan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->
    <div class="modal fade" id="daftarPeminjaman" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Daftar Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="card">
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="card-header flex-column flex-md-row">
                                <div class="head-label text-center">
                                    <h5 class="card-title mb-0">Daftar Peminjaman SARPRAS</h5>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table id="example" class="table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mahasiswa</th>
                                        <th>Barang Yang Di Pinjam</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status Pinjam</th>
                                        <th>Tanggal Pengajuan Pinjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listDaftarPeminjam as $ldp)
                                        <tr>
                                            <td>
                                                <button type="button" data-item="{{ $ldp->id }}"
                                                    class="btn rounded-pill btn-icon btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#detailModalBarang--{{ $ldp->id }}">
                                                    <i class='bx bx-info-circle' style='color:#8f0d04'></i>
                                                </button>
                                                {{ $ldp->id }}
                                            </td>
                                            <td>{{ $ldp->users->name }}</td>
                                            <td>{{ $ldp->barangs->nama_barang }}</td>
                                            <td>{{ $ldp->tanggal_pinjam }}</td>
                                            <td>{{ $ldp->tanggal_pengembalian }}</td>
                                            <td>
                                                @if ($ldp->status_pinjam == 'dipinjam' || $ldp->status_pinjam == 'dikembalikan')
                                                    <span class="badge text-bg-success"> {{ $ldp->status_pinjam }}
                                                    @elseif($ldp->status_pinjam == 'diajukan')
                                                        <span class="badge text-bg-warning">
                                                            {{ $ldp->status_pinjam }}
                                                        @elseif($ldp->status_pinjam == 'ditolak')
                                                            <span class="badge text-bg-danger">
                                                                {{ $ldp->status_pinjam }}
                                                @endif
                                                </span>
                                            </td>
                                            <td>{{ $ldp->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Mahasiswa</th>
                                        <th>Barang Yang Di Pinjam</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status Pinjam</th>
                                        <th>Tanggal Pengajuan Pinjam</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div> --}}
                    <table id="exampleDataTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Transaction Pinjam</th>
                                <th>Mahasiswa</th>
                                <th>Barang Yang Di Pinjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Pinjam</th>
                                <th>Tanggal Pengajuan Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listDaftarPeminjam as $ldp)
                                <tr>
                                    <td>
                                        {{ $ldp->id }}
                                    </td>
                                    <td>{{ $ldp->users->name }}</td>
                                    <td>{{ $ldp->barangs->nama_barang }}</td>
                                    <td>{{ $ldp->tanggal_pinjam }}</td>
                                    <td>{{ $ldp->tanggal_pengembalian }}</td>
                                    <td>
                                        @if ($ldp->status_pinjam == 'dipinjam' || $ldp->status_pinjam == 'dikembalikan')
                                            <span class="badge text-bg-success"> {{ $ldp->status_pinjam }}
                                            @elseif($ldp->status_pinjam == 'diajukan')
                                                <span class="badge text-bg-warning">
                                                    {{ $ldp->status_pinjam }}
                                                @elseif($ldp->status_pinjam == 'ditolak')
                                                    <span class="badge text-bg-danger">
                                                        {{ $ldp->status_pinjam }}
                                        @endif
                                        </span>
                                    </td>
                                    <td>{{ $ldp->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID Transaction Pinjam</th>
                                <th>Mahasiswa</th>
                                <th>Barang Yang Di Pinjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Pinjam</th>
                                <th>Tanggal Pengajuan Pinjam</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#exampleDataTable');
    </script>
@endpush
