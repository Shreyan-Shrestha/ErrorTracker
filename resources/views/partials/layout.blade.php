<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title', 'ErrorTracker') </title>
    @vite(['resources/css/app.css', 'resources/css/nepali.datepicker.v5.0.6.min.css', 'resources/js/app.js'])
    <script src="{{ asset('js/nepali.datepicker.v5.0.6.min.js') }}"></script>
</head>

<body class="flex min-h-screen flex-col bg-base-200 @yield('bodyClass')">
    <div class="drawer drawer-open">
        <input id="sidebar" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content">
            @include('partials.navbar')
            <x-alert />
            @yield('content')
        </div>

        @include('partials.sidebar')
    </div>

    @stack('scripts')
</body>

</html>