<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Repairmax' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/repair-square-icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/repair-square-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-[#020617] text-white font-sans antialiased">

    <main class="min-h-screen flex flex-col lg:flex-row">

        {{-- Left Panel --}}
        <div class="hidden lg:flex lg:w-5/12 bg-[#020617] text-white p-12 lg:p-16 flex-col justify-between sticky top-0 h-screen items-start relative overflow-hidden">
            {{-- Glow effects --}}
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/15 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="relative z-10">
                <h1 class="text-3xl font-bold tracking-tight text-white">Repairmax</h1>
            </div>

            <div class="max-w-md relative z-10">
                <h2 class="text-5xl font-extrabold leading-tight mb-4 bg-gradient-to-r from-blue-400 via-blue-300 to-cyan-400 bg-clip-text text-transparent">
                    {{ $heading ?? 'Welcome.' }}
                </h2>
                <p class="text-gray-400 text-lg leading-relaxed">
                    {{ $subheading ?? 'Log in or create an account to track your device repairs, view service tickets, and manage your appointments.' }}
                </p>
            </div>

            <div class="text-sm text-gray-600 relative z-10">
                &copy; {{ date('Y') }} Repairmax All rights reserved.
            </div>
        </div>

        {{-- Right Panel (Form) --}}
        <div class="w-full lg:w-7/12 flex flex-col justify-center px-4 sm:px-8 lg:px-16 py-12 lg:py-24 relative min-h-screen bg-white">


            <div class="hidden lg:block absolute top-16 left-24">
                <a href="/" class="inline-flex items-center gap-2.5 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Home
                </a>
            </div>

            <div class="w-full max-w-md mx-auto relative z-10">
                <div class="lg:hidden mb-12">
                    <a href="/" class="inline-flex items-center gap-2.5 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to Home
                    </a>
                    <div class="text-center sm:text-left">
                        <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent tracking-tight">Repairmax.</h1>
                    </div>
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