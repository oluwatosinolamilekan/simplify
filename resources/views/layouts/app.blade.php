<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('mix/css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('mix/js/app.js') }}" defer></script>
</head>
<body class="{{$attributes['bodyClass'] ?? ''}} bg-white">
    <x-mobile-menu/>
    <div class="flex">
        <x-sidebar/>
        <!-- BEGIN: Content -->
        <div class="content">
            <x-topbar :header="$header"/>
            {{ $slot }}
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
