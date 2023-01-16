<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="">
    <meta name="description" content="" />
    <title>Login | Express Delivery PRO</title>

    <!-- Favicon -->
{{--    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">--}}
{{--    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">--}}
{{--    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">--}}
    <meta name="msapplication-TileColor" content="#0010f7">
    <meta name="theme-color" content="#ffffff">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />

    <!-- Plugin -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icons/iconly/index.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icons/remix-icon/index.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">

    <!-- Base -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/base/typography.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/base/base.css')}}">

    <!-- Layouts -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/components.css')}}">

    <!-- Pages -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/authentication.css')}}">

    <title>Login - Express Delivery PRO</title>
</head>

<body>
<div class="row hp-authentication-page d-flex flex-column">
    <div class="position-absolute w-100 h-100" style="top: 0px; left: 0px; z-index: -1;">
        <svg width="1440" height="1080" viewBox="0 0 1440 1080" fill="none" xmlns="http://www.w3.org/2000/svg" class="hp-stroke-color-dark-80 w-100 h-100">
            <path opacity="0.5" d="M3574 1540L907.175 -134.641L1053.03 429.011L387.731 -53.7583L937.881 929.474L32.0529 297.577L254.672 889.032L-2135.09 -460" stroke="#F7FAFC" stroke-width="100"></path>
        </svg>
    </div>

    <div class="col-12">
        <div class="row px-16 px-sm-64 py-16 mb-48 border-bottom hp-border-color-dark-70 align-items-center justify-content-between">
            <div class="w-auto hp-flex-none pl-0 col">
                <div class="hp-header-logo d-flex align-items-center">
                    <a href="/login" class="position-relative">
                        <img class="hp-logo hp-sidebar-hidden hp-dir-none hp-dark-none" src="{{asset('assets/img/logo-exp.png')}}" alt="logo" height="45">
                    </a>
                </div>
            </div>

            <div class="w-auto hp-flex-none col">
                <div class="row align-items-center">
                    <div class="col px-0">
                        <span class="hp-p1-body hp-text-color-black-100 hp-text-color-dark-0 d-block hp-auth-header-title"> Need Help? </span>
                    </div>

                    <div class="col ms-24 px-0">
                        <a href="#" class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="hp-text-color-black-100 hp-text-color-dark-0">
                                <path d="M13.19 6h-6.4c-.26 0-.51.01-.75.04C3.35 6.27 2 7.86 2 10.79v4c0 4 1.6 4.79 4.79 4.79h.4c.22 0 .51.15.64.32l1.2 1.6c.53.71 1.39.71 1.92 0l1.2-1.6c.15-.2.39-.32.64-.32h.4c2.93 0 4.52-1.34 4.75-4.04.03-.24.04-.49.04-.75v-4c0-3.19-1.6-4.79-4.79-4.79ZM6.5 14c-.56 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1Zm3.49 0c-.56 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.44 1-1 1Zm3.5 0c-.56 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1Z" fill="currentColor"></path>
                                <path d="M21.98 6.79v4c0 2-.62 3.36-1.86 4.11-.3.18-.65-.06-.65-.41l.01-3.7c0-4-2.29-6.29-6.29-6.29l-6.09.01c-.35 0-.59-.35-.41-.65C7.44 2.62 8.8 2 10.79 2h6.4c3.19 0 4.79 1.6 4.79 4.79Z" fill="currentColor"></path>
                            </svg>

                            <span class="ms-6 d-block hp-p1-body hp-text-color-black-100 hp-text-color-dark-0"> Support </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-32 flex-shrink-1 col d-flex">
        <div class="row h-100 m-auto w-100 align-items-center" style="max-width: 390px;">
            <div class="col-12">
                <h1 class="mb-0 mb-sm-24">Login</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="mt-16 mt-sm-32 mb-8" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-16">
                        <label for="loginEmail" class="form-label">Email :</label>
                        <input type="email" name="email" class="form-control" id="loginEmail">
                    </div>

                    <div class="mb-16">
                        <label for="loginPassword" class="form-label">Password :</label>
                        <input type="password" name="password" class="form-control" id="loginPassword">
                    </div>

                    <div class="row align-items-center justify-content-between mb-16">
                        <div class="col hp-flex-none w-auto">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label ps-4" for="exampleCheck1">Remember me</label>
                            </div>
                        </div>

                        <div class="col hp-flex-none w-auto">
                            <a class="hp-button text-black-80 hp-text-color-dark-40" href="#">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Sign in
                    </button>
                </form>

            </div>
        </div>
    </div>

    <div class="my-48 px-24 col-12">
        <p class="hp-p1-body text-center hp-text-color-black-60 mb-8"> Copyright 2021 Express Delivery PRO. </p>
    </div>
</div>

<!-- Plugin -->
<script src="{{asset('assets/js/plugin/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/bootstrap.bundle.min.js')}}"></script>

</body>


</html>
