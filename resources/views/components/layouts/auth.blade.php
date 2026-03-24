<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Repairmax' }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('img/repairlogocircle.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-900 font-sans antialiased">

    <main class="min-h-screen flex flex-col lg:flex-row">

        <div class="hidden lg:flex lg:w-5/12 bg-gray-900 text-gray-100 p-16 flex-col justify-between sticky top-0 h-screen items-start">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-white">Repairmax</h1>
            </div>

            <div class="max-w-md">
                <h2 class="text-4xl font-semibold leading-tight mb-4 text-white">
                    {{ $heading ?? 'Welcome.' }}
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    {{ $subheading ?? 'Log in or create an account to track your device repairs, view service tickets, and manage your appointments.' }}
                </p>
            </div>

            <div class="text-sm text-gray-600">
                &copy; {{ date('Y') }} Repairmax All rights reserved.
            </div>
        </div>

        <div class="w-full lg:w-7/12 flex flex-col justify-center p-8 pt-24 sm:p-12 sm:pt-28 lg:p-24 relative min-h-screen bg-gray-50">

            <div class="absolute top-6 left-6 sm:top-10 sm:left-10 lg:top-16 lg:left-24">
                <a href="/" class="inline-flex items-center gap-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Home
                </a>
            </div>

            <div class="w-full max-w-md mx-auto">
                <div class="lg:hidden mb-10 text-center sm:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Repairmax.</h1>
                </div>

                {{ $slot }}
            </div>

        </div>
    </main>

    @livewireScripts

    <x-ui.toast />
    <x-ui.confirm />
</body>

</html>