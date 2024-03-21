<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>E-CODEC | {{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistem Informasi Report HARSIS (SIMHARSIS)" />
    <meta name="keywords" content="SIMHARSIS">
    <meta name="author" content="MozesJR" />
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" /> --}}

    {{-- <link rel="icon" href="https://ableproadmin.com/bootstrap/default/assets/images/favicon.svg"
        type="image/x-icon"> --}}
    {{-- <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/inter/inter.css"
        id="main-font-link" /> --}}
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/feather.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/fontawesome.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/fonts/material.css" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/style.css"
        id="main-style-link" />
    <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/style-preset.css" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" /> --}}

    @yield('cssTambahan')
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast=""
    data-pc-theme="light">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    {{-- Memanggil NavBar --}}
    @include('layouts.navbar')

    {{-- Memanggil Header --}}
    @include('layouts.header')

    {{-- isi data content --}}
    @yield('content')
    @include('sweetalert::alert')
    {{-- <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ripple.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script> --}}

    <!-- [Page Specific JS] start -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/apexcharts.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/popper.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/simplebar.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/bootstrap.min.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/fonts/custom-font.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/pcoded.js"></script>
    <script src="https://ableproadmin.com/bootstrap/default/assets/js/plugins/feather.min.js"></script>
    @yield('jsTambahan')


</body>

</html>
