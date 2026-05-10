<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Repairmax - Next-Generation Phone Repair Services platform.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Repairmax' }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/repairlogocircle.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="{{ asset('js/landing.js') }}" defer></script>

    @livewireStyles
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-100">

    <x-landing-header />

    <main>
        {{ $slot }}
    </main>

    <x-landing-footer />
    <x-float-chatbot />

    @livewireScripts
</body>

</html>