<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="theme-color" content="#000000" />

    <title>@yield('title', 'Dashboard')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/icon/192x192.png') }}">

    {{-- CSS utama --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- LEAFLET CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>


    {{-- Manifest --}}
    <link rel="manifest" href="{{ asset('__manifest.json') }}">
</head>

<body style="background-color:#e9ecef;">

    {{-- HEADER --}}
    @yield('header')

    {{-- CONTENT --}}
    <div id="appCapsule">
        @yield('content')
    </div>

    {{-- ===================== --}}
    {{-- JAVASCRIPT --}}
    {{-- ===================== --}}

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- WebcamJS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    {{-- Leaflet --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script utama --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- Bottom Nav --}}
    @include('layouts.bottomNav')

    {{-- Script tambahan --}}
    @include('layouts.script')

    {{-- Script halaman --}}
    @stack('myscript')

</body>
</html>