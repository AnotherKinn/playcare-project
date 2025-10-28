<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PlayCare') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    {{-- Navbar --}}
    @auth
        @if(Auth::user()->role === 'parent')
            @include('layouts.navbar-mini')
        @endif
    @endauth

    <div class="d-flex" >
        {{-- Sidebar (desktop & offcanvas di mobile) --}}
        @auth
            @if (Auth::user()->role === 'parent')
                @include('layouts.sidebar-parent')
            @elseif (Auth::user()->role === 'admin')
                @include('layouts.sidebar-admin')
            @elseif (Auth::user()->role === 'staff')
                @include('layouts.sidebar-staff')
            @endif
        @endauth

        {{-- Konten Utama --}}
        <div class="flex-grow-1 p-4" style="min-height: 100vh;">
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Responsive Sidebar Fix -->
    <script>
        // Hilangkan margin kiri kalau layar kecil (biar konten full)
        const adjustLayout = () => {
            if (window.innerWidth < 768) {
                document.querySelector('.flex-grow-1').style.marginLeft = '0';
            } else {
                document.querySelector('.flex-grow-1').style.marginLeft = '260px';
            }
        };
        window.addEventListener('resize', adjustLayout);
        adjustLayout();
    </script>
</body>
</html>
