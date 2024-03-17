@extends('sisarpas.landing.layouts.app')

@section('title', 'Sistem Informasi Sarana dan Prasarana ITERA')

@section('content-landing')

    <!-- header landing -->
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
                        <li>
                            <a class="nav-link scrollto active" href="#beranda">Beranda</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="#about">Layanan Mahasiswa</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="#services">Penjadwalan</a>
                        </li>
                        <li>
                            <!-- <a class="nav-link scrollto" href="#team">Tutorial</a> -->
                            <a class="nav-link scrollto" href="#team">Informasi</a>
                        </li>
                        <li>
                            <a class="nav-link scrollto" href="#contact">Kontak</a>
                        </li>
                        <!-- <li></li> -->
                        <div class="button">
                            @if (Route::has('user.login'))
                                @auth
                                    <a href="{{ route('user.dashboard') }}" class="btn-login">Dashboard</a>
                                @else
                                    <a href="{{ route('user.login') }}" class="btn-login">Login</a>
                                @endauth
                            @endif
                        </div>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <!-- .navbar -->
            </div>
        </header>
        <!-- End Header -->
    @endpush
    <!-- ======= beranda Section ======= -->
    @foreach ($landing_header as $lh)
        <section id="beranda" class="d-flex align-items-center"
            style="background: url('{{ asset('/sisarpas/assets/landingFile/' . $lh->file) }}') top left">
            <div class="container" data-aos="zoom-out" data-aos-delay="100">
                <h1>Sistem Informasi</h1>
                <h1>Sarana dan Prasarana</h1>
                <h1>ITERA</h1>
                <h2>
                    Sistem Informasi Sarana dan Prasarana berfungsi untuk mengelola <br />
                    dan memfasilitasi mahasiswa dalam penggunaan sarana dan <br />
                    prasarana di Institut Teknologi Sumatera
                </h2>
                <div class="d-flex">
                    <a href="{{ route('peminjaman.barang', ['kategori' => 'barang']) }}"
                        class="btn-get-started scrollto">Lihat
                        Fasilitas</a>
                </div>
            </div>
        </section>
        <!-- End beranda -->
    @endforeach

    <main id="main">
        <!-- ======= Layanan Sarana ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Layanan Mahasiswa</h2>
                    <h3>Layanan Sarana dan Prasarana</h3>
                    <p></p>
                </div>

                <div class="row">
                    <!-- peralatan -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon">
                                <img src="{{ asset('sisarpas/assets/img/peralatan.png') }}" alt="peralatan" width="400"
                                    height="100" />
                            </div>
                            <h4>
                                <a href="{{ route('peminjaman.barang', ['kategori' => 'barang']) }}">Peralatan</a>
                            </h4>
                            <p>SARPRAS menyediakan layanan peminjaman peralatan yang efisien untuk mendukung kegiatan dengan
                                kualitas terbaik.</p>
                        </div>
                    </div>
                    <!-- end peralatan -->

                    <!-- ruang aula -->
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon">
                                <img src="{{ asset('sisarpas/assets/img/rumah.png') }}" alt="aula" width="400"
                                    height="100" />
                            </div>
                            <h4>
                                <a href="{{ route('peminjaman.ruangan', ['kategori' => 'ruangan']) }}">Ruang Aula</a>
                            </h4>
                            <p>SARPRAS menyediakan layanan peminjaman ruang aula dengan fasilitas yang lengkap, memberikan
                                dukungan optimal untuk beragam kegiatan.</p>
                        </div>
                    </div>
                    <!-- ruang aula -->
                </div>
            </div>
        </section>
        <!-- End Layanan Sarana -->

        <!-- ======= Penjadwalan Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Penjadwalan</h2>
                    <h3>Informasi Penjadwalan</h3>
                    <p></p>
                </div>

                <div class="row">
                    @foreach ($landing_jadwal_ruangan as $ljr)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box">
                                <div class="icon">
                                    <i class="bx bxl-dribbble"></i>
                                </div>
                                <h4>
                                    <a href="{{ route('user.dashboard') }}">{{ $ljr->barangs->nama_barang }}</a>
                                </h4>
                                <p>Jadwal yang digunakan pada ruangan ini adalah: Waktu Mulai:{{ $ljr->start_at }}, Waktu
                                    Berakhir: {{ $ljr->end_at }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End penjadwalan Section -->

        <!-- ======= informasi Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Informasi</h2>
                    <h3>Informasi Penting</h3>
                    <p></p>
                </div>

                <div class="row">
                    @foreach ($landing_video as $lv)
                        <div class="col-lg-8 col-md-9 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <video width="410px" controls>
                                        <source src="{{ asset('sisarpas/assets/landingFile/' . $lv->file) }}"
                                            type="video/mp4" />
                                    </video>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Informasi Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Kontak</h2>
                    <h3>Mengalami Kendala?</h3>
                    <p></p>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <form action="{{ route('sisarpas.contact') }}" method="POST" class="php-email-form">
                            @csrf
                            <div class="text-centers">
                                <h3>Hubungi Kami</h3>
                            </div>
                            @session('success')
                                <div class="alert alert-success" role="alert">
                                    {{ $value }}
                                </div>
                            @endsession
                            @session('error')
                                <div class="alert alert-danger" role="alert">
                                    {{ $value }}
                                </div>
                            @endsession
                            <div class="form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="Masukkan Email Anda" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <textarea class="form-control  @error('message') is-invalid @enderror" name="message" rows="5"
                                    placeholder="Masukkan Pesan Anda"></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit" style="font-weight: bold">Kirim</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center"
                        data-aos="fade-up" data-aos-delay="100">
                        <h4>Mengalami Kendala?</h4>
                        <p>Silahkan hubungi kontak kami, kami siap membantu anda</p>
                        <h5>Kontak</h5>
                        <ul>
                            <li>
                                <i class="bx bx-home"></i>
                                <div>
                                    <h6>Gedung D Lantai 1, ITERA, Jalan Terusan Ryacudu, Way Hui, Kecamatan Jati Agung,
                                        Lampung Selatan 35365</h6>
                                </div>
                            </li>
                            <li>
                                <i class="bx bx-phone"></i>
                                <div>
                                    <h6>(08123) 12345678</h6>
                                </div>
                            </li>
                            <li>
                                <i class="bx bx-mail-send"></i>
                                <div>
                                    <h6>loremipsum123@gmail.com</h6>
                                </div>
                            </li>
                            <li>
                                <i class="bx bx-buildings"></i>
                                <div>
                                    <h6>Ruang SARPRAS 1203</h6>
                                </div>
                            </li>
                        </ul>
                        <h5>Social Media</h5>
                        <ul>
                            <li>
                                <i class="bx bxl-facebook-circle"></i>
                                <div>
                                    <h6>sarpraas1234</h6>
                                </div>
                            </li>
                            <li>
                                <i class="bx bxl-instagram"></i>
                                <div>
                                    <h6>sarpras0987</h6>
                                </div>
                            </li>
                            <li>
                                <i class="bx bxl-youtube"></i>
                                <div>
                                    <h6>sarprasitera</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Section -->
    </main>
    <!-- End #main -->
@endsection
