<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>@yield('title')</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{ asset('sisarpas/assets/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('sisarpas/assets/img/logo.png') }}" rel="apple-touch-icon" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('sisarpas/assets/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('sisarpas/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sisarpas/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('sisarpas/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sisarpas/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sisarpas/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('sisarpas/assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>

    <!-- header-->
    @include('sisarpas.landing.layouts.header')
    <!-- content-->
    @yield('content-landing')
    <!-- footer-->
    @include('sisarpas.landing.layouts.footer')


    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('sisarpas/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('sisarpas/assets/js/main.js') }}"></script>
</body>

</html>
