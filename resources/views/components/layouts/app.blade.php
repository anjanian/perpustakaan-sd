<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('logo.jpg') }}" type="image/jpeg">
        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')
        @vite('resources/css/filament/admin/theme.css')
    </head>

    <body class="antialiased">
        {{ $slot }}

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>