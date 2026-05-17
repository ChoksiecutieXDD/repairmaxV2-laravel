<header
    x-data="{ 
        mobileMenuOpen: false, 
        scrolled: false, 
        isHomePage: false,
        get isSolid() { return true }
    }"
    @scroll.window="scrolled = (window.scrollY > 50)"
    id="main-header"
    class="fixed top-0 w-full z-50 transition-all duration-300 bg-white border-b border-gray-200 shadow-sm">
    <nav aria-label="Help Navigation" class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 grid grid-cols-12 gap-6 items-center h-20">

        <div class="col-span-8 lg:col-span-3">
            <a href="/" id="brand-logo" class="text-2xl md:text-3xl font-extrabold tracking-tight text-gray-900 transition-colors duration-300 hover:opacity-80"
                aria-label="Repairmax Home">
                Repairmax
            </a>
        </div>

        <div class="col-span-4 flex justify-end lg:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                class="p-2 focus:outline-none transition-colors duration-200 hover:opacity-80 text-gray-900 bg-transparent border-none shadow-none hover:bg-transparent"
                aria-label="Toggle navigation menu" :aria-expanded="mobileMenuOpen" aria-controls="primary-menu">
                <span class="material-symbols-outlined text-3xl" aria-hidden="true" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
            </button>
        </div>

        <div id="primary-menu"
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            class="absolute top-20 left-0 w-full py-8 flex flex-col items-center gap-6 bg-white border-b border-gray-200 shadow-xl lg:static lg:col-span-9 lg:!flex lg:flex-row lg:justify-end lg:w-auto lg:py-0 lg:gap-8 lg:bg-transparent lg:border-none lg:shadow-none"
            role="menubar">

            @php
            $navLinks = [
            ['url' => '/help', 'label' => 'Help Center'],
            ['url' => '/help/track', 'label' => 'Track Repair'],
            ['url' => '/help/contact', 'label' => 'Contact Us'],
            ['url' => '/help/faqs', 'label' => 'FAQs'],
            ['url' => '/help/ai-support', 'label' => 'AI Support'],
            ];
            @endphp

            @foreach($navLinks as $link)
            <a href="{{ $link['url'] }}"
                class="nav-link text-base font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200"
                role="menuitem">
                {{ $link['label'] }}
            </a>
            @endforeach

        </div>
    </nav>
</header>
