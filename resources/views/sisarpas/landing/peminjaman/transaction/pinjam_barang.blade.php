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
                        <div class="warna">
                            <b>Form Peminjaman</b>
                        </div>
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
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Tanggal Peminjaman</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="tanggal_pinjam"
                                            id="inputPassword3" />
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
                                            placeholder="Masukan tujuan pinjam">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Keterangan Pinjam</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" name="keterangan_pinjam" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                                    <label for="inputEmail3" class="col-sm-5 col-form-label" style="font-weight: 600">Status
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
@endsection
