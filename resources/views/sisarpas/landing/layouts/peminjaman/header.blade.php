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
                <div class="button">
                    <a href="{{ route('user.dashboard') }}" class="btn-login">Daftar Peminjaman</a>
                </div>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
            <ul>
                <!-- <li></li> -->
                <div class="button">
                    <a href="{{ route('sisarpas.landing') }}" class="btn-login">Kembali Ke Landing</a>
                </div>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</header>
