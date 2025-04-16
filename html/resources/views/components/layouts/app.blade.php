<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
         @endif
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
    hola soy el header
        {{ $slot }}

    hola soy el footer
    </body>
</html>