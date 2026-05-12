<header
    x-data="{ 
        mobileMenuOpen: false, 
        scrolled: false, 
        isHomePage: {{ request()->is('/') ? 'true' : 'false' }},
        get isSolid() { return !this.isHomePage || this.scrolled || this.mobileMenuOpen }
    }"
    @scroll.window="scrolled = (window.scrollY > 50)"
    id="main-header"
    class="fixed top-0 w-full z-50 transition-all duration-300"
    :class="isSolid ? 'bg-white/80 backdrop-blur-md border-b border-gray-200' : 'bg-transparent border-none'">
    <nav aria-label="Main Navigation" class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 grid grid-cols-12 gap-6 items-center h-20">

        <div class="col-span-8 lg:col-span-3">
            <a href="/" id="brand-logo" class="text-2xl md:text-3xl font-extrabold tracking-tight transition-colors duration-300 hover:opacity-80"
                :class="isSolid ? 'text-gray-900' : 'text-white'"
                aria-label="Repairmax Home">
                Repairmax
            </a>
        </div>

        <div class="col-span-4 flex justify-end lg:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                class="p-2 focus:outline-none transition-colors duration-200 hover:opacity-80 bg-transparent border-none shadow-none hover:bg-transparent"
                :class="isSolid ? 'text-gray-900' : 'text-white'"
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
            ['url' => route('about'), 'label' => 'About Us'],
            ['url' => route('services'), 'label' => 'Services'],
            ['url' => route('repairs'), 'label' => 'What We Repair'],
            ['url' => route('faq'), 'label' => 'FAQ'],
            ['url' => route('contact'), 'label' => 'Contact'],
            ['url' => route('login'), 'label' => 'Login'],
            ];
            @endphp

            @foreach($navLinks as $link)
            <a href="{{ $link['url'] }}"
                class="nav-link text-base font-medium transition-colors duration-200"
                :class="isSolid ? 'text-gray-600 hover:text-gray-900' : 'text-gray-300 hover:text-white'"
                role="menuitem">
                {{ $link['label'] }}
            </a>
            @endforeach

            <a href="/booking" id="book-btn"
                class="px-6 py-2.5 text-sm md:text-base font-bold rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 lg:ml-2"
                :class="isSolid ? 'bg-gray-900 text-white hover:bg-gray-700' : 'bg-white text-gray-900 hover:bg-gray-200'"
                role="menuitem">
                Book Repair
            </a>

        </div>
    </nav>
</header>