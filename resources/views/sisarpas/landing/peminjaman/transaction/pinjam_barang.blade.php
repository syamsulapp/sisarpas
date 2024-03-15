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
                        <div class="warna">
                            <b>Form Peminjaman</b>
                        </div>
                        <form>
                            <div class="warna-form">
                                <div class="row mb-3">
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
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Tanggal Peminjaman</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" id="inputPassword3" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Tanggal Pengembalian</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" id="inputPassword3" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Dokumen Pendukung</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="file" id="formFile" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label"
                                        style="font-weight: 600">Keterangan</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
