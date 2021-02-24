<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    <link rel="stylesheet" href="{{ asset('icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pikaday.css') }}">
    @livewireStyles
    @stack('styles')
    <!-- Scripts -->
    <script src="{{ url(mix('js/app.js')) }}" defer></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-screen text-gray-800 bg-red-100">
    <div class="grid h-full p-3 grid-rows-8">
        <header class="flex justify-center row-span-1">
            <a href="{{ route('home') }}">
                <div class="flex items-center py-2 space-x-3">
                    <div class="w-14 h-14">
                        <img class="object-cover w-full h-full" src="{{ asset('img/logo.png') }}" alt="logo">
                    </div>
                    <h1 class="text-5xl font-semibold">ASEANA</h1>
                </div>
            </a>
        </header>
        <main class="my-2 row-span-7">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/pikaday.js') }}"></script>
    <script src="{{ url(mix('js/sweetalert2.js')) }}"></script>
    <x-livewire-alert::scripts />
    @stack('scripts')
</body>
</html>
