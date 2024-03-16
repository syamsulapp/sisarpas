<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('sisarpas/assets/admin/assets') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sisarpas/assets/admin/assets/img/favicon/logo.png') }}" />

    <!-- Fonts -->
    <link rel="{{ csrf_token() }}" href="https://fonts.googleapis.com" />
    <link rel="{{ csrf_token() }}" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('sisarpas/assets/admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/admin/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/admin/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('sisarpas/assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sisarpas/assets/admin/assets/js/config.js') }}"></script>

    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css" />
    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
    <script defer src="{{ asset('sisarpas/assets/admin/assets/vendor/js/script.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- sidebar -->
            @include('sisarpas.admin.layouts.sidebar')
            <!-- end sidebar -->
            <!-- Layout container -->
            <div class="layout-page">

                <!-- header -->
                @include('sisarpas.admin.layouts.header')
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- content -->
                    @yield('content-admin-dashboard')

                    <!-- footer -->
                    @include('sisarpas.admin.layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    @stack('script-image-prev')
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('sisarpas/assets/admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('sisarpas/assets/admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('sisarpas/assets/admin/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


</body>

</html>
