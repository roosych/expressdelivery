<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="description" content="" />

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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/colors.css')}}">

    <!-- Base -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/base/base.css')}}">

    <!-- Layouts -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/layouts/sider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/layouts/header.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/layouts/page-content.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/components.css')}}">
    <!-- Customizer -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/layouts/customizer.css')}}">
    <link rel="stylesheet" type="text/css" href="https://yoda.hypeople.studio/yoda-admin-template/app-assets/css/layouts/horizontal-menu.css">

    @stack('css')

    <title>@yield('title')</title>

</head>



<body class="horizontal-active light">
<main class="hp-bg-color-dark-90 d-flex min-vh-100">
    <div class="hp-main-layout hp-main-layout-horizontal">
        <header>
            <div class="row w-100 m-0">
                <div class="col px-0">
                    <div class="row w-100 align-items-center justify-content-between position-relative">
                        <div class="col w-auto hp-flex-none hp-mobile-sidebar-button me-24 px-0" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                            <button type="button" class="btn btn-text btn-icon-only">
                                <i class="ri-menu-fill hp-text-color-black-80 hp-text-color-dark-30 lh-1" style="font-size: 24px;"></i>
                            </button>
                        </div>


                        <div class="hp-horizontal-logo-menu d-flex align-items-center w-auto">
                            <div class="col hp-flex-none w-auto hp-horizontal-block">
                                {{--<div class="hp-header-logo d-flex align-items-center">
                                    <a href="/" class="position-relative">
                                        <img class="hp-logo hp-sidebar-hidden hp-dir-none hp-dark-none" src="{{asset('assets/img/logo-exp.png')}}" alt="logo" width="210">
                                    </a>
                                </div>--}}
                            </div>

                            @include('parts.menu-horizontal')

                        </div>


                        <div class="col hp-flex-none w-auto pe-0">
                            <div class="row align-items-center justify-content-end">
                                <div class="hover-dropdown-fade w-auto px-0 ms-6 position-relative">
                                    <div class="hp-cursor-pointer rounded-4 border hp-border-color-dark-80">
                                        <div class="rounded-3 overflow-hidden m-4 d-flex">
                                            <div class="avatar-item hp-bg-info-4 d-flex" style="width: 32px; height: 32px;">
                                                <img src="{{asset('assets/img/user-avatar-4.png')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hp-header-profile-menu dropdown-fade position-absolute pt-18" style="top: 100%; width: 260px;">
                                        <div class="rounded hp-bg-black-0 hp-bg-dark-100 px-18 py-24">

                                            <div class="col-12 ">
                                                <a class="hp-p1-body fw-medium"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <div class="hp-main-layout-content">

            <div class="row mb-32 g-32">
                <div class="col flex-grow-1 overflow-hidden">
                    <div class="row g-32">


                        @yield('content')


                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

@include('parts.footer')

</body>

</html>