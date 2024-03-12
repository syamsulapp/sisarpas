@extends('sisarpas.admin.layouts.app')

@section('title', 'Dashboard Admin');

@section('content-admin-dashboard')
    <!-- Content wrapper -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
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
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ Auth::guard('admin')->user()->name }}!
                                    🎉</h5>
                                <p class="mb-4">Anda Sebagai Admin
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('sisarpas/assets/admin/assets/img/illustrations/Online test-pana.png') }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

@endsection
