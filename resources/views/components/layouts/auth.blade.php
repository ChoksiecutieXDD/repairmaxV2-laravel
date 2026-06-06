<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Repairmax' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo-r-blue.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-r-blue.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-[#020617] text-white font-sans antialiased"
    x-data="{ isLoading: false }"
    x-on:login-success.window="isLoading = true; setTimeout(() => window.location.href = $event.detail.url, 1500)">

    <!-- Fullscreen Loading Overlay -->
    <div x-show="isLoading"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-[9999] bg-[#020617] flex flex-col items-center justify-center"
        x-cloak
        style="display: none;">
        <div class="relative flex items-center justify-center">
            <!-- Subtle outer ring -->
            <div class="absolute h-32 w-32 rounded-full border border-blue-500/10"></div>
            <!-- Spinning loader ring -->
            <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-r-2 border-transparent border-t-blue-500 border-r-blue-500"></div>
            <!-- Centered logo (Blue version) -->
            <img src="{{ asset('img/logo-r-blue.png') }}" class="absolute h-12 w-auto animate-pulse" alt="Logo">
        </div>
    </div>

    <main class="min-h-screen flex flex-col lg:flex-row bg-[#020617] relative overflow-hidden">
        {{-- Unified Glow Effects across the entire page --}}
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-blue-600/15 rounded-full blur-[130px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[20%] w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute top-[20%] right-[-10%] w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[130px] pointer-events-none"></div>
        <div class="absolute bottom-[10%] right-[15%] w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none"></div>

        {{-- Left Panel --}}
        <div class="hidden lg:flex lg:w-5/12 text-white p-12 lg:p-16 flex-col justify-between sticky top-0 h-screen items-start relative z-10">

            <div class="relative z-10">
                <a href="/" class="transition-colors duration-300 hover:opacity-80 flex items-center gap-2.5">
                    <img src="{{ asset('img/logo-r-white.png') }}" alt="Repairmax Logo" class="h-8 w-auto">
                    <span class="font-[Montserrat] text-xl font-bold tracking-tight text-white">Repairmax</span>
                </a>
            </div>

            <div class="max-w-md relative z-10">
                <h2 class="text-5xl font-extrabold leading-tight mb-4 bg-gradient-to-r from-blue-400 via-blue-300 to-cyan-400 bg-clip-text text-transparent">
                    {{ $heading ?? 'Welcome.' }}
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    {{ $subheading ?? 'Log in or create an account to track your device repairs, view service tickets, and manage your appointments.' }}
                </p>
            </div>

            <div class="text-sm text-gray-650 relative z-10">
                &copy; {{ date('Y') }} Repairmax All rights reserved.
            </div>
        </div>

        {{-- Right Panel (Form) --}}
        <div class="w-full lg:w-7/12 flex flex-col justify-center px-4 sm:px-6 lg:px-16 py-12 lg:py-24 relative min-h-screen z-10">

            <div class="w-full max-w-lg mx-auto relative z-10">
                <div class="lg:hidden mb-8">
                    <div class="flex justify-center sm:justify-start">
                        <a href="/" class="transition-colors duration-300 hover:opacity-80 flex items-center gap-2.5">
                            <img src="{{ asset('img/logo-r-white.png') }}" alt="Repairmax Logo" class="h-8 w-auto">
                            <span class="font-[Montserrat] text-xl font-bold tracking-tight text-white">Repairmax</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white/[0.03] backdrop-blur-md rounded-[2.5rem] border border-white/10 p-8 sm:p-10 shadow-2xl">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </main>

    @livewireScripts

    <x-ui.toast />
    <x-ui.confirm />
</body>

</html>