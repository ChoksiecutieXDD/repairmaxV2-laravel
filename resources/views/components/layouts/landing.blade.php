<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Repairmax - Next-Generation Phone Repair Services platform.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Repairmax' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/repair-square-icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/repair-square-icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @livewireStyles
    <script>
        // Suppress browser extension message port console clutter
        window.addEventListener('unhandledrejection', function (event) {
            if (event.reason && (event.reason.message && event.reason.message.includes('message port closed') || event.reason.stack && event.reason.stack.includes('extension'))) {
                event.preventDefault();
            }
        });
        window.addEventListener('error', function (event) {
            if (event.message && (event.message.includes('message port closed') || event.filename && event.filename.includes('extension'))) {
                event.preventDefault();
            }
        });
    </script>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-100">

    @if(request()->is('help*'))
        <x-help-header />
    @else
        <x-landing-header />
    @endif

    <main>
        {{ $slot }}
    </main>

    <x-landing-footer />
    <x-float-chatbot />

    @livewireScripts
</body>

</html>