@extends('sisarpas.auth.layouts.app')

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
                        <h2>Password Reset</h2>
                        <p>we sent a code to <b>admin@gmail.com</b></p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="otp-field mb-4">
                            <input type="number" />
                            <input type="number" disabled />
                            <input type="number" disabled />
                            <input type="number" disabled />
                            <input type="number" disabled />
                            <input type="number" disabled />
                        </div>
                    </div>
                    <div class="input-group mb-4 mt-3 d-flex justify-content-between"></div>
                    <div class="input-group mb-3">
                        <button class="btn-primary w-100 fs-6">Continue</button>
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
                        <small>Didn't receive the email? <a href="{{ route('user.forgot_password') }}">Click to
                                resend!</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_reset_password')
    <script type="text/javascript" src="{{ asset('sisarpas/assets/script.js') }}"></script>
@endpush
