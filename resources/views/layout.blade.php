<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ __('Emailia') }}</title>
        <livewire:styles />
        <link href="{{ asset('vendor/emailia/emailia.css') }}" rel="stylesheet">
        @stack('emailiaStyles')
    </head>
    <body>
        {{ $slot }}
        <livewire:scripts />
        <script src="{{ asset('vendor/emailia/emailia.js') }}" defer></script>
        @stack('emailiaScripts')
    </body>
</html>
