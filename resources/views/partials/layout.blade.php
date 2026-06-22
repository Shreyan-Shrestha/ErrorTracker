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
            <x-alert />
            @yield('content')
        </div>

        @include('partials.sidebar')
    </div>

    <script>
        function OpenCreateModal(action, modalId = 'modal_create') {
            document.getElementById('create_form_' + modalId).action = action;
            document.getElementById(modalId).showModal();
        }

        function OpenEditModal(btn) {
    const modalId = btn.dataset.modal;
    document.getElementById('create_form_' + modalId).action = btn.dataset.action;
    document.getElementById(modalId).showModal();

    // populate fields from data attributes
    Object.entries(btn.dataset).forEach(([key, value]) => {
        const field = document.querySelector('#' + modalId + ' [name="' + key + '"]');
        if (field) field.value = value;
    });
}
    </script>
    @stack('scripts')
</body>

</html>