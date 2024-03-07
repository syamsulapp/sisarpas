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
