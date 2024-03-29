@extends('sisarpas.auth.layouts.app')

@section('title', 'User Login')

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
                    <div class="header-text mb-4">
                        <h2>Selamat Datang Di Halman</h2>
                        <p>Login User Si Sarpas.</p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $errors)
                                <ul>
                                    <li> {{ $errors }}</li>
                                </ul>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('user.login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg viewBox="0 0 24 24" width="18" height="18" stroke="#8F0D04" stroke-width="3"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <input type="text" name="email" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Email address" />
                        </div>
                        <div class="input-group mb-1">
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
                        <div class="input-group mb-5 mt-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck" />
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                        Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="{{ route('user.forgot_password') }}">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>
                    <div class="row">
                        <small>Belum punya Akun? <a href="{{ route('user.register') }}">Daftar Sekarang!</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
