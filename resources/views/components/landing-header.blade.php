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
    :class="servicesMenuOpen ? 'shadow-2xl' : (isSolid ? 'backdrop-blur-md shadow-sm' : '')"
    :style="servicesMenuOpen ? 'background-color: #020617;' : (isSolid ? 'background-color: rgba(2,6,23,0.92);' : 'background-color: transparent;')">
    <nav aria-label="Main Navigation" class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 grid grid-cols-12 gap-6 items-center h-20">

        @php
        $navLinks = [
            ['url' => route('about'), 'label' => 'About Us'],
            ['url' => route('services'), 'label' => 'Services'],
            ['url' => route('help'), 'label' => 'Help'],
            ['url' => route('login'), 'label' => 'Login'],
        ];
        @endphp

        <!-- Logo Column (Left) -->
        <div class="col-span-8 lg:col-span-3 flex items-center">
            <a href="/" id="brand-logo" class="transition-colors duration-300 hover:opacity-80 flex items-center gap-2.5"
                aria-label="Repairmax Home">
                <img src="{{ asset('img/logo-r-white.png') }}" alt="Repairmax Logo" class="h-8 w-auto">
                <span class="font-[Montserrat] text-xl font-bold tracking-tight text-white">Repairmax</span>
            </a>
        </div>

        <!-- Desktop Navigation Column (Center) -->
        <div class="hidden lg:flex lg:col-span-6 justify-center items-center h-full">
            <div class="flex items-center gap-8 h-full">
                @foreach($navLinks as $link)
                    @if($link['label'] === 'Services')
                        @php
                            $allFaults = \App\Models\FaultType::where('is_active', true)->get();
                            
                            $matchesAny = function($fault, $terms) {
                                $name = strtolower($fault->name);
                                for ($i = 0; $i < count($terms); $i++) {
                                    if (str_contains($name, $terms[$i])) {
                                        return true;
                                    }
                                }
                                return false;
                            };

                            // Group 1: Screen & Power
                            $screenAndPower = $allFaults->filter(fn($f) => $matchesAny($f, ['screen', 'glass', 'lcd', 'battery', 'charge', 'power']))->take(4);
                            
                            // Group 2: Hardware Repairs
                            $hardwareRepairs = $allFaults->filter(fn($f) => !$matchesAny($f, ['screen', 'glass', 'lcd', 'battery', 'charge', 'power', 'software', 'system', 'boot', 'data', 'audio', 'speaker', 'microphone']))->take(4);
                            
                            // Group 3: Software & Audio
                            $softwareAndAudio = $allFaults->filter(fn($f) => $matchesAny($f, ['software', 'system', 'boot', 'data', 'audio', 'speaker', 'microphone']))->take(4);
                        @endphp
                        <!-- Services Dropdown (Shopify Style) -->
                        <div class="relative lg:static lg:h-full lg:flex lg:items-center" 
                             @mouseenter="servicesMenuOpen = true" 
                             @mouseleave="servicesMenuOpen = false">
                            <a href="{{ $link['url'] }}"
                               class="nav-link text-base font-medium text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-0.5 py-2">
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
                                 class="absolute left-0 right-0 w-full z-40 top-20 hidden lg:block bg-[#020617] shadow-2xl"
                                 style="display: none;">
                                 
                                <div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-12 gap-8 text-left">
                                    <!-- Column 1: Screen & Power -->
                                    <div class="col-span-3 space-y-6">
                                        <h4 class="text-xs font-black uppercase tracking-wider text-gray-400">Screen & Power</h4>
                                        <div class="space-y-4">
                                            @forelse($screenAndPower as $service)
                                                <a href="{{ route('services.detail', $service->id) }}" class="group block">
                                                    <span class="text-sm font-bold block text-white group-hover:text-blue-400 transition-colors">{{ $service->name }}</span>
                                                    <span class="text-xs block mt-1 text-gray-400">{{ \Illuminate\Support\Str::limit($service->description, 60) }}</span>
                                                </a>
                                            @empty
                                                <span class="text-xs text-gray-400">No screen/power services available.</span>
                                            @endforelse
                                        </div>
                                    </div>
                                    
                                    <!-- Column 2: Hardware Repairs -->
                                    <div class="col-span-3 space-y-6">
                                        <h4 class="text-xs font-black uppercase tracking-wider text-gray-400">Hardware Repairs</h4>
                                        <div class="space-y-4">
                                            @forelse($hardwareRepairs as $service)
                                                <a href="{{ route('services.detail', $service->id) }}" class="group block">
                                                    <span class="text-sm font-bold block text-white group-hover:text-blue-400 transition-colors">{{ $service->name }}</span>
                                                    <span class="text-xs block mt-1 text-gray-400">{{ \Illuminate\Support\Str::limit($service->description, 60) }}</span>
                                                </a>
                                            @empty
                                                <span class="text-xs text-gray-400">No hardware services available.</span>
                                            @endforelse
                                        </div>
                                    </div>
    
                                    <!-- Column 3: Software & Audio -->
                                    <div class="col-span-3 space-y-6">
                                        <h4 class="text-xs font-black uppercase tracking-wider text-gray-400">Software & Audio</h4>
                                        <div class="space-y-4">
                                            @forelse($softwareAndAudio as $service)
                                                <a href="{{ route('services.detail', $service->id) }}" class="group block">
                                                    <span class="text-sm font-bold block text-white group-hover:text-blue-400 transition-colors">{{ $service->name }}</span>
                                                    <span class="text-xs block mt-1 text-gray-400">{{ \Illuminate\Support\Str::limit($service->description, 60) }}</span>
                                                </a>
                                            @empty
                                                <span class="text-xs text-gray-400">No software/audio services available.</span>
                                            @endforelse
                                        </div>
                                    </div>
    
                                    <!-- Column 4: Premium Right Sidebar Card -->
                                    <div class="col-span-3 pl-6 border-l border-white/5">
                                        <div class="rounded-2xl p-6 h-full flex flex-col justify-between overflow-hidden relative group text-left transition-all bg-white/[0.03] backdrop-blur-md text-white border border-white/10 shadow-2xl">
                                            <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                            
                                            <div class="relative z-10 space-y-3">
                                                <span class="text-[9px] font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2.5 py-1 rounded-full inline-block">Built into every repair</span>
                                                <h4 class="text-base font-extrabold tracking-tight text-white">Nationwide Service Warranty</h4>
                                                <p class="text-xs leading-relaxed text-gray-400">Proven to convert device health to pristine state. Guaranteed with 90 days solid warranty coverage.</p>
                                            </div>
                                            
                                            <div class="relative z-10 pt-4">
                                                <a href="/booking" class="inline-flex items-center gap-1 text-xs font-black uppercase tracking-wider text-blue-400 hover:text-blue-300 transition-colors">
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
                            class="nav-link text-base font-medium text-gray-300 hover:text-white transition-colors duration-200"
                            role="menuitem">
                            {{ $link['label'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Action / Toggle Column (Right) -->
        <div class="col-span-4 lg:col-span-3 flex justify-end items-center gap-4">
            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                class="p-2 focus:outline-none transition-colors duration-200 hover:opacity-80 bg-transparent border-none shadow-none hover:bg-transparent text-white lg:hidden"
                aria-label="Toggle navigation menu" :aria-expanded="mobileMenuOpen" aria-controls="primary-menu">
                <span class="material-symbols-outlined text-3xl" aria-hidden="true" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
            </button>

            <!-- Book Repair Button -->
            <a href="/booking" id="book-btn"
                class="hidden lg:flex px-6 py-2.5 text-sm md:text-base font-bold rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 bg-blue-600 text-white hover:bg-blue-700 items-center gap-1.5"
                role="menuitem">
                Book Repair
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="primary-menu"
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            class="absolute top-20 left-0 w-full py-8 flex flex-col items-center gap-6 bg-[#020617] border-b border-white/5 shadow-xl lg:hidden"
            role="menubar"
            style="display: none;">

            @foreach($navLinks as $link)
                <a href="{{ $link['url'] }}"
                    class="nav-link text-base font-medium text-gray-300 hover:text-white transition-colors duration-200"
                    role="menuitem">
                    {{ $link['label'] }}
                </a>
            @endforeach

            <a href="/booking" id="book-btn"
                class="px-6 py-2.5 text-sm md:text-base font-bold rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 bg-blue-600 text-white hover:bg-blue-700 flex items-center gap-1.5"
                role="menuitem">
                Book Repair
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

    </nav>
</header>