@extends('sisarpas.auth.layouts.app-reset')

@section('title', 'Reset Password')

@push('css_reset_password')
    <link rel="stylesheet" href="{{ asset('sisarpas/assets/css/boostraps.css') }}" />
@endpush

@section('content')
    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #8f0d04">
                <div class="featured-image mb-3">
                    <img src="{{ asset('sisarpas/assets/img/itera-new.png') }}" class="img-fluid" style="width: 250px" />
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600">Be
                    Verified</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem; font-family: 'Courier New', Courier, monospace"><a
                        href="{{ route('sisarpas.landing') }}">Sistem Informasi Sarana dan
                        Prasarana ITERA</a></small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Reset Password</h2>
                        <p>Token Untuk Reset Password Telah Dikirim K Email, Harap Cek Di Email Anda </b></p>
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
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $errors)
                                <ul>
                                    <li> {{ $errors }}</li>
                                </ul>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('user_reset_password') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="otp-field mb-4">
                                <input name="token1" type="number" />
                                <input name="token2" type="number" disabled />
                                <input name="token3" type="number" disabled />
                                <input name="token4" type="number" disabled />
                                <input name="token5" type="number" disabled />
                                <input name="token6" type="number" disabled />
                            </div>
                        </div>
                        <div class="input-group mb-4 mt-3 d-flex justify-content-between"></div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn-primary w-100 fs-6">Continue</button>
                    </form>
                </div>
                <div class="input-group mb-3">
                    <a href="{{ route('user.login') }}" class="btn btn-lg btn-light w-100 fs-6">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <polyline points="9 10 4 15 9 20"></polyline>
                            <path d="M20 4v7a4 4 0 0 1-4 4H4"></path>
                        </svg>
                        <small>Back to login</small>
                    </a>
                </div>
                <div class="row">
                    <small>Belum Mendapatkan Token? <a href="{{ route('user.forgot_password') }}">Minta Di Sini!</a></small>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script_reset_password')
    <script type="text/javascript" src="{{ asset('sisarpas/assets/script.js') }}"></script>
@endpush
