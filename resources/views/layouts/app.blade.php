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

    @stack('css')

    <title>@yield('title')</title>

</head>

<body>
<main class="hp-bg-color-dark-90 d-flex min-vh-100">
    <div class="hp-sidebar hp-bg-color-black-20 hp-bg-color-dark-90 border-end border-black-40 hp-border-color-dark-80">
        <div class="hp-sidebar-container">
            <div class="hp-sidebar-header-menu">
                <div class="row justify-content-between align-items-end mx-0">
                    <div class="w-auto px-0 hp-sidebar-collapse-button hp-sidebar-visible">
                        <div class="hp-cursor-pointer">
                            <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.91102 1.73796L0.868979 4.78L0 3.91102L3.91102 0L7.82204 3.91102L6.95306 4.78L3.91102 1.73796Z" fill="#B2BEC3"></path>
                                <path d="M3.91125 12.0433L6.95329 9.00125L7.82227 9.87023L3.91125 13.7812L0.000224113 9.87023L0.869203 9.00125L3.91125 12.0433Z" fill="#B2BEC3"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="w-auto px-0">
                        <div class="hp-header-logo d-flex align-items-center">
                            <a href="/" class="position-relative">
                                <img class="hp-logo hp-sidebar-hidden hp-dir-none hp-dark-none" src="{{asset('assets/img/logo-exp.png')}}" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>

                @include('parts.menu')
            </div>

            <div class="row justify-content-between align-items-center hp-sidebar-footer mx-0 hp-bg-color-dark-90">
                <div class="divider border-black-40 hp-border-color-dark-70 hp-sidebar-hidden mt-0 px-0"></div>

                <div class="col">
                    <div class="row align-items-center">

                        <div class="w-auto ms-8 px-0 hp-sidebar-hidden mt-4" style="font-size: 12px;">
                            Coding by <a href="https://t.me/ruslankandiba" target="_blank" class="hp-badge-text fw-normal hp-text-color-dark-30">Roosych</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="hp-main-layout">

        @include('parts.header')

        @include('parts.mobilemenu')

        @yield('content')


    </div>
</main>


@include('parts.footer')

</body>

</html>