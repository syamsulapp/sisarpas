@extends('sisarpas.auth.layouts.app')

@section('title', 'Reset Password')

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
                        <h2>Forgot Password?</h2>
                        <p>No worries, we'll send you reset instructions</p>
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
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <svg viewBox="0 0 24 24" width="18" height="18" stroke="#8F0D04" stroke-width="3"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </span>
                        <input type="email" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Email address" />
                    </div>
                    <div class="input-group mb-4 mt-3 d-flex justify-content-between"></div>
                    <div class="input-group mb-3">
                        <button class="btn-primary w-100 fs-6" data-toggle="modal" data-target="#exampleModal">Reset
                            password</button>
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

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="{{ route('user.forgot_password') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-4" style="text-align: center">
                                            <img src="{{ asset('sisarpas/assets/img/Mail-icon.png') }}" />
                                        </div>
                                        <div class="satu" style="text-align: center">
                                            <h4 style="font-weight: bold">Reset email sent</h4>
                                            <p class="mb-4">We hava just sent an email with a password reset link to
                                                <b>email@gmail.com</b>
                                            </p>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info">Go it</button>
                                    <a href="{{ route('user.forgot_password') }}" class="btn btn-secondary">Back</a>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                </div>
            </div>
        </div>
    </div>
@endsection
