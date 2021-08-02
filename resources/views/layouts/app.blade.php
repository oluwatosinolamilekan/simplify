<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (Auth::user()->preferences['dark_mode'] ?? false) class="dark" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    {{--    add jquery cdn--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script
        src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
        crossorigin="anonymous"></script>
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
            <x-topbar :header="$header ?? ''"/>
            {{ $slot }}
        </div>
    </div>

    <!-- BEGIN: Dark Mode Switcher-->
    <livewire:common.dark-mode-switcher />
    <!-- END: Dark Mode Switcher-->

    @stack('modals')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" ></script>

    <x-livewire-alert::scripts />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{--Usersnap integration--}}
    <script>
        window.onUsersnapCXLoad = function(api) {
            api.init();
        }
        var script = document.createElement('script');
        script.defer = 1;
        script.src = 'https://widget.usersnap.com/global/load/36b42ad3-6732-4cc9-a329-05e1b43e4a47?onload=onUsersnapCXLoad';
        document.getElementsByTagName('head')[0].appendChild(script);
    </script>
</body>
</html>
