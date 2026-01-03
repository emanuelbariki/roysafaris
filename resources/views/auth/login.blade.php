<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.shared.title-meta', ["title" => "Log In"])

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body class="account-body accountbg">

<!-- Register page -->
<div class="container">
    <div class="row vh-100 d-flex justify-content-center">
        <div class="col-12 align-self-center">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card">
                        <div class="card-body p-0 auth-header-box">
                            <div class="text-center p-3">
                                <a href="{{ route('login') }}" class="logo logo-admin">
                                    <img
                                        src="{{ asset('assets/images/logo-sm.png') }}"
                                        height="50"
                                        alt="safari"
                                        class="auth-logo">
                                </a>

                                <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">Roy Safaris LTD Admin</h4>
                                <p class="text-muted  mb-0">Sign in to continue to App.</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Username</label>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" name="email" id="email"
                                               placeholder="Enter Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" id="userpassword"
                                               placeholder="Enter password">
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-switch switch-success">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customSwitchSuccess2" name="remember">
                                            <label class="custom-control-label text-muted" for="customSwitchSuccess2">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>

                                    {{-- // TODO: add the forget password view --}}
                                    <div class="col-sm-6 text-right">
                                        <a href="{{ route('password.request') }}" class="text-muted font-13">
                                            <i class="dripicons-lock"></i> Forgot password?
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary btn-block waves-effect waves-light"
                                                type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="m-3 text-center text-muted">
                                <p class="">
                                    Don't have an account ? <a href="auth-register.html" class="text-primary ml-2">
                                        Free Resister
                                    </a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>

</body>

</html>
