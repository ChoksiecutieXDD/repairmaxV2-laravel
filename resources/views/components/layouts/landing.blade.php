<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Repairmax - Next-Generation Phone Repair Services platform.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Repairmax' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo-r-blue.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-r-blue.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Force browser autofill to blend with dark theme inputs */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #090d16 inset !important;
            -webkit-text-fill-color: #ffffff !important;
            transition: background-color 50000s ease-in-out 0s;
        }
    </style>

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

<body class="font-sans antialiased text-gray-300 bg-[#020617]">

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
    <x-ui.toast />

    <script>
        (function() {
            let observer;

            function initScrollAnimations() {
                // If observer already exists, disconnect it to avoid duplicate bindings
                if (observer) {
                    observer.disconnect();
                }

                const observerOptions = {
                    threshold: 0.05,
                    rootMargin: '0px 0px -20px 0px'
                };

                observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                const elements = document.querySelectorAll('.fade-in-element, .fade-in-left, .fade-in-right');
                elements.forEach(el => {
                    if (!el.classList.contains('visible')) {
                        observer.observe(el);
                    }
                });
            }

            // Run on load with a slight delay to allow layout calculations to settle
            if (document.readyState === 'complete') {
                setTimeout(initScrollAnimations, 50);
            } else {
                window.addEventListener('load', () => {
                    setTimeout(initScrollAnimations, 50);
                });
            }

            // Support Livewire SPA page navigation or partial updates
            document.addEventListener('livewire:navigated', () => {
                setTimeout(initScrollAnimations, 50);
            });
            document.addEventListener('livewire:load', () => {
                setTimeout(initScrollAnimations, 50);
            });
        })();
    </script>

    <x-cookie-consent />

    @livewireScripts
</body>

</html>