<header
    x-data="{ 
        mobileMenuOpen: false, 
        scrolled: false, 
        servicesMenuOpen: false,
        isHomePage: {{ request()->is('/') ? 'true' : 'false' }},
        get isSolid() { return !this.isHomePage || this.scrolled || this.mobileMenuOpen || this.servicesMenuOpen }
    }"
    @scroll.window="scrolled = (window.scrollY > 50)"
    id="main-header"
    class="fixed top-0 w-full z-50 transition-all duration-300"
    :class="isSolid ? 'bg-white border-b border-gray-200 shadow-sm' : 'bg-transparent border-none'">
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
            class="absolute top-20 left-0 w-full py-8 flex flex-col items-center gap-6 bg-white border-b border-gray-200 shadow-xl lg:static lg:col-span-9 lg:!flex lg:flex-row lg:justify-end lg:w-auto lg:py-0 lg:gap-8 lg:bg-transparent lg:border-none lg:shadow-none lg:h-full"
            role="menubar">

            @php
            $navLinks = [
            ['url' => route('about'), 'label' => 'About Us'],
            ['url' => route('services'), 'label' => 'Services'],
            ['url' => route('help'), 'label' => 'Help'],
            ['url' => route('login'), 'label' => 'Login'],
            ];
            @endphp

            @foreach($navLinks as $link)
                @if($link['label'] === 'Services')
                    <!-- Services Dropdown (Shopify Style) -->
                    <div class="relative lg:static lg:h-full lg:flex lg:items-center" 
                         @mouseenter="servicesMenuOpen = true" 
                         @mouseleave="servicesMenuOpen = false">
                        <a href="{{ $link['url'] }}"
                           class="nav-link text-base font-medium transition-colors duration-200 flex items-center gap-0.5 py-2"
                           :class="isSolid ? 'text-gray-600 hover:text-gray-900' : 'text-gray-300 hover:text-white'">
                            Services
                            <span class="material-symbols-outlined text-[18px] transition-transform duration-300 select-none pointer-events-none hidden lg:inline-block" :class="servicesMenuOpen ? 'rotate-180' : ''">keyboard_arrow_down</span>
                        </a>
                        
                        <!-- Mega Menu Dropdown Container -->
                        <div x-show="servicesMenuOpen"
                             x-transition:enter="transition ease-out duration-250"
                             x-transition:enter-start="opacity-0 -translate-y-3"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-3"
                             class="absolute left-0 right-0 w-full z-40 top-20 hidden lg:block bg-white border-b border-gray-200 shadow-2xl"
                             style="display: none;">
                             
                            <div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-12 gap-8 text-left">
                                <!-- Column 1: Hardware Repairs -->
                                <div class="col-span-3 space-y-6">
                                    <h4 class="text-xs font-black uppercase tracking-wider text-gray-400">Hardware Repairs</h4>
                                    <div class="space-y-4">
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Screen Replacement</span>
                                            <span class="text-xs block mt-1 text-gray-500">OEM-quality display restorations.</span>
                                        </a>
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Battery & Power</span>
                                            <span class="text-xs block mt-1 text-gray-500">Long-lasting capacity upgrades.</span>
                                        </a>
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Charging Ports</span>
                                            <span class="text-xs block mt-1 text-gray-500">Restore flawless power connectivity.</span>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Column 2: OS & System -->
                                <div class="col-span-3 space-y-6">
                                    <h4 class="text-xs font-black uppercase tracking-wider text-gray-400">Software & OS</h4>
                                    <div class="space-y-4">
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Data Recovery</span>
                                            <span class="text-xs block mt-1 text-gray-500">Retrieve lost media and files safely.</span>
                                        </a>
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">OS Reinstallation</span>
                                            <span class="text-xs block mt-1 text-gray-500">Maximize and speed up performance.</span>
                                        </a>
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Virus Removal</span>
                                            <span class="text-xs block mt-1 text-gray-500">Deep cleanse spyware and threats.</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Column 3: Audio & Diagnostics -->
                                <div class="col-span-3 space-y-6">
                                    <h4 class="text-xs font-black uppercase tracking-wider text-gray-400">Audio & Diagnostics</h4>
                                    <div class="space-y-4">
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Audio Jack Repair</span>
                                            <span class="text-xs block mt-1 text-gray-500">Fix static audio and loose headphone ports.</span>
                                        </a>
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Speaker Replacement</span>
                                            <span class="text-xs block mt-1 text-gray-500">Restore crisp and loud acoustics.</span>
                                        </a>
                                        <a href="/services" class="group block">
                                            <span class="text-sm font-bold block text-gray-900 group-hover:text-blue-500 transition-colors">Complete Inspection</span>
                                            <span class="text-xs block mt-1 text-gray-500">Full multi-point diagnostic check.</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Column 4: Premium Right Sidebar Card (Matches Shopify style side banner!) -->
                                <div class="col-span-3 pl-6 border-l border-gray-150">
                                    <div class="rounded-2xl p-6 h-full flex flex-col justify-between overflow-hidden relative group text-left transition-all bg-gray-50 text-gray-900 border border-gray-100/50">
                                        <!-- Ambient background glow inside card -->
                                        <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                        
                                        <div class="relative z-10 space-y-3">
                                            <span class="text-[9px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 px-2.5 py-1 rounded-full inline-block">Built into every repair</span>
                                            <h4 class="text-base font-extrabold tracking-tight text-gray-900">Nationwide Service Warranty</h4>
                                            <p class="text-xs leading-relaxed text-gray-500">Proven to convert device health to pristine state. Guaranteed with 90 days solid warranty coverage.</p>
                                        </div>
                                        
                                        <div class="relative z-10 pt-4">
                                            <a href="/booking" class="inline-flex items-center gap-1 text-xs font-black uppercase tracking-wider text-blue-600 hover:text-blue-500 transition-colors">
                                                Book Repair Now
                                                <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ $link['url'] }}"
                        class="nav-link text-base font-medium transition-colors duration-200"
                        :class="isSolid ? 'text-gray-600 hover:text-gray-900' : 'text-gray-300 hover:text-white'"
                        role="menuitem">
                        {{ $link['label'] }}
                    </a>
                @endif
            @endforeach

            <a href="/booking" id="book-btn"
                class="px-6 py-2.5 text-sm md:text-base font-bold rounded-[1.25rem] shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 lg:ml-2"
                :class="isSolid ? 'bg-gray-900 text-white hover:bg-gray-700' : 'bg-white text-gray-900 hover:bg-gray-200'"
                role="menuitem">
                Book Repair
            </a>

        </div>
    </nav>
</header>