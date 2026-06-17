<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title', 'ErrorTracker') </title>
    @vite(['resources/css/app.css', 'resources/css/nepali.datepicker.v5.0.6.min.css', 'resources/js/nepali.datepicker.v5.0.6.min.js'])
</head>

<body class="flex min-h-screen flex-col bg-base-200 @yield('bodyClass')">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content">
            @include('partials.navbar')

            @yield('content')
        </div>
        
        @include('partials.sidebar')
    </div>
    @stack('scripts')
</body>

</html>