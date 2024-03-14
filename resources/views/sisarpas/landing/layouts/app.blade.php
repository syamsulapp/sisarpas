<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>@yield('title')</title>
    <meta content="{{ csrf_token() }}" name="description" />
    <meta content="{{ csrf_token() }}" name="keywords" />

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

    <!-- header with condition -->
    @if (Request::is('peminjaman/alat/barang') || Request::is('peminjaman/ruangan/aula'))
        <!-- header peminjaman -->
        @include('sisarpas.landing.layouts.peminjaman.header')
    @else
        <!-- header landing -->
        @include('sisarpas.landing.layouts.header')
    @endif
    <!-- content-->
    @yield('content-landing')
    <!-- footer-->
    @include('sisarpas.landing.layouts.footer')


    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('sisarpas/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    {{-- <script src="{{ asset('sisarpas/assets/vendor/php-email-form/validate.js') }}"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset('sisarpas/assets/js/main.js') }}"></script>

    <script>
        function toggleActive(button) {
            // Menghapus kelas "active" dari semua tombol
            var buttons = document.querySelectorAll(".btn-cari, .btn-aula");
            buttons.forEach(function(btn) {
                btn.classList.remove("active");
            });

            // Menambahkan kelas "active" pada tombol yang diklik
            button.classList.add("active");
        }
    </script>
</body>

</html>
