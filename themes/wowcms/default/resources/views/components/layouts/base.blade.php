<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ filled($title = $livewire->getTitle()) ? "{$title} - " : null }}
        {{ config('app.name') }}
    </title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @themeVite('resources/css/app.css', 'themes/wowcms/default/build')
</head>

<body class="antialiased">

{{ $slot }}

@livewire('notifications')
@filamentScripts

</body>
</html>
