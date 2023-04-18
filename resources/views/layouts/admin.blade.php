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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    {{-- <link rel="stylesheet" href="https://ableproadmin.com/bootstrap/default/assets/css/style.css"> --}}
    @yield('cssTambahan')
</head>

<body class="">
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
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ripple.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>
    @yield('jsTambahan')


</body>

</html>
