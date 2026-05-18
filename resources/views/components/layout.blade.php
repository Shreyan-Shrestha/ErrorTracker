@props([
    'title' => 'ErrorTracker'
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/css/nepali.datepicker.v5.0.6.min.css', 'resources/js/nepali.datepicker.v5.0.6.min.js'])
</head>
<body {{ $attributes->merge([ 'class' => ' ' ]) }}>
    {{ $slot }}
</body>
</html>