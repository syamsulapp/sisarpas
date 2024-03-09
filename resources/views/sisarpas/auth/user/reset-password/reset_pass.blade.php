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
                        <h2>Set New password</h2>
                        <p>Must be at least 8 characters</p>
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
                        <div class="input-group mb-3" hidden>
                            <span class="input-group-text" id="basic-addon1">
                                <svg viewBox="0 0 24 24" width="18" height="18" stroke="#8F0D04" stroke-width="3"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input type="email" name="email" class="form-control form-control-lg bg-light fs-6"
                                placeholder="email" value="{{ $token['email'] }}" hidden />
                        </div>
                        <div class="input-group mb-3" hidden>
                            <span class="input-group-text" id="basic-addon1">
                                <svg viewBox="0 0 24 24" width="18" height="18" stroke="#8F0D04" stroke-width="3"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input type="number" name="token" class="form-control form-control-lg bg-light fs-6"
                                placeholder="token" value="{{ $token['token'] }}" hidden />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg viewBox="0 0 24 24" width="18" height="18" stroke="#8F0D04" stroke-width="3"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password" />
                        </div>
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="basic-addon1">
                                <svg viewBox="0 0 24 24" width="18" height="18" stroke="#8F0D04" stroke-width="3"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                            <input type="password" name="password_confirmation"
                                class="form-control form-control-lg bg-light fs-6" placeholder="Confirm password" />
                        </div>
                        <div class="input-group mb-4 mt-3 d-flex justify-content-between"></div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn-primary w-100 fs-6">Reset password</button>
                        </div>
                    </form>
                    <div class="input-group mb-3">
                        <a href="{{ route('user.login') }}" class="btn btn-lg btn-light w-100 fs-6">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="css-i6dzq1">
                                <polyline points="9 10 4 15 9 20"></polyline>
                                <path d="M20 4v7a4 4 0 0 1-4 4H4"></path>
                            </svg>
                            <small>Back to login</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_reset_password')
    <script type="text/javascript" src="{{ asset('sisarpas/assets/script.js') }}"></script>
@endpush
