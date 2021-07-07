<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{darkMode: localStorage.getItem('darkMode') === 'true'}"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      x-bind:class="{ 'dark': darkMode }"
>
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
<body class="{{$attributes['bodyClass'] ?? ''}}">
    <x-mobile-menu/>
    <div class="flex">
        <x-sidebar/>
        <!-- BEGIN: Content -->
        <div class="content">
            <x-topbar :header="$header"/>
            {{ $slot }}
        </div>
    </div>

    <!-- BEGIN: Dark Mode Switcher-->
    <div data-url="#" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
        <div class="dark-mode-switcher__toggle border" x-bind:class="{ 'dark-mode-switcher__toggle--active': darkMode }"></div>
    </div>
    <!-- END: Dark Mode Switcher-->

    @stack('modals')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
    ...
    <x-livewire-alert::scripts />
</body>
</html>
