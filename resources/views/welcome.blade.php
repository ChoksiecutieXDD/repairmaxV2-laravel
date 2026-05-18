<x-layouts.landing title="Repairmax | Home">

    <section id="intro" class="relative w-full min-h-screen flex items-center overflow-hidden pt-20 pb-20">
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('video/commercial-repairing-scene.mp4') }}" type="video/mp4">
        </video>

        <div class="absolute inset-0 bg-gray-900/85 z-10"></div>

        <div class="relative z-20 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto fade-in-element text-center">
                <h2 class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-8 tracking-tighter drop-shadow-2xl leading-[1.1]">
                    Next-Generation<br>Device Repair
                </h2>
                <p class="text-xl md:text-2xl text-gray-200 mb-12 font-medium leading-relaxed max-w-2xl mx-auto">
                    Fast, transparent, and seamless. We are bringing device repair into the 21st century.
                </p>

                <div class="flex flex-col items-center gap-4 w-full max-w-[420px] mx-auto">
                    <!-- Primary CTA -->
                    <a href="/booking" class="w-full inline-flex items-center justify-center px-6 py-3.5 text-base font-bold text-gray-900 bg-white hover:bg-gray-200 rounded-2xl transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.15)] hover:-translate-y-0.5 active:scale-98 shrink-0">
                        <span class="material-symbols-outlined mr-2">bolt</span>
                        Start Your Repair
                    </a>

                    <!-- Subdued Separator -->
                    <div class="w-full flex items-center justify-center gap-3 py-0.5">
                        <div class="h-px bg-white/10 flex-1"></div>
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none">or subscribe</span>
                        <div class="h-px bg-white/10 flex-1"></div>
                    </div>

                    <!-- Subscription Form -->
                    <form action="/subscribe" method="POST" class="flex flex-col sm:flex-row gap-2.5 w-full items-stretch">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email" required
                            class="flex-1 px-5 py-3 bg-white/10 text-white rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 border border-white/20 text-sm placeholder-gray-400 transition-all backdrop-blur-md">
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition-all duration-300 active:scale-95 text-sm shrink-0 shadow-lg">
                            Subscribe
                        </button>
                    </form>

                    @if (session('subscribe_success'))
                        <div class="w-full p-2.5 bg-white/10 border border-white/20 text-green-400 rounded-xl text-xs text-center backdrop-blur-md">
                            {{ session('subscribe_success') }}
                        </div>
                    @endif

                    <p class="text-xs text-gray-400 text-center tracking-wide font-medium">Want to know more? Head over to your email</p>
                </div>
            </div>

            </div>
        </div>
    </section>

    <section class="py-10 md:py-16 bg-gray-900 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 text-center divide-y sm:divide-y-0 sm:divide-x divide-gray-700 fade-in-element">
                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center justify-center pt-6 sm:pt-0">
                    <span class="material-symbols-outlined text-4xl text-gray-300 mb-3">settings_suggest</span>
                    <span class="text-gray-100 font-bold text-lg mb-1">OEM Quality Parts</span>
                    <p class="text-gray-400 text-xs sm:text-sm">Factory-grade components only</p>
                </div>
                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center justify-center pt-6 sm:pt-0">
                    <span class="material-symbols-outlined text-4xl text-gray-300 mb-3">smart_toy</span>
                    <span class="text-gray-100 font-bold text-lg mb-1">24/7 AI Booking</span>
                    <p class="text-gray-400 text-xs sm:text-sm">Schedule on your own time</p>
                </div>
                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center justify-center pt-6 sm:pt-0">
                    <span class="material-symbols-outlined text-4xl text-gray-300 mb-3">gpp_good</span>
                    <span class="text-gray-100 font-bold text-lg mb-1">100% Secure Data</span>
                    <p class="text-gray-400 text-xs sm:text-sm">Strict privacy protocols</p>
                </div>
                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center justify-center pt-6 sm:pt-0">
                    <span class="material-symbols-outlined text-4xl text-gray-300 mb-3">workspace_premium</span>
                    <span class="text-gray-100 font-bold text-lg mb-1">90-Day Guarantee</span>
                    <p class="text-gray-400 text-xs sm:text-sm">Peace of mind included</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16 fade-in-element">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">A Seamless Digital Process</h2>
                <p class="text-base md:text-lg text-gray-600 leading-relaxed">We have eliminated the waiting rooms and confusing paperwork. Our streamlined process gets your device back in your hands faster.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-8 md:gap-12 fade-in-element">
                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center text-center">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-100 rounded-full flex items-center justify-center mb-5 border-2 border-gray-300">
                        <span class="text-xl md:text-2xl font-bold text-gray-900">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Book Online</h3>
                    <p class="text-gray-600 text-sm md:text-base">Use our AI chatbot to instantly diagnose your issue and secure a drop-off time slot.</p>
                </div>

                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center text-center">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-100 rounded-full flex items-center justify-center mb-5 border-2 border-gray-300">
                        <span class="text-xl md:text-2xl font-bold text-gray-900">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Drop Off</h3>
                    <p class="text-gray-600 text-sm md:text-base">Bring your device in. We securely log it into our system and give you a unique tracking ticket.</p>
                </div>

                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center text-center">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-100 rounded-full flex items-center justify-center mb-5 border-2 border-gray-300">
                        <span class="text-xl md:text-2xl font-bold text-gray-900">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Track Live</h3>
                    <p class="text-gray-600 text-sm md:text-base">Watch your repair progress in real-time on our dashboard. Receive automated SMS updates.</p>
                </div>

                <div class="sm:col-span-6 lg:col-span-3 flex flex-col items-center text-center">
                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gray-100 rounded-full flex items-center justify-center mb-5 border-2 border-gray-300">
                        <span class="text-xl md:text-2xl font-bold text-gray-900">4</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pick Up</h3>
                    <p class="text-gray-600 text-sm md:text-base">Pay your digital invoice securely online and pick up your fully restored device.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform Modules Section -->
    <section id="services" class="py-24 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-16 md:mb-24 max-w-3xl mx-auto text-center fade-in-element">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-[0.2em] mb-4">Core Infrastructure</h2>
                <h3 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-6">Built for Reliability.</h3>
                <p class="text-lg text-gray-600 leading-relaxed">Our platform is built on a modular architecture designed to handle every stage of the device lifecycle with surgical precision.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 fade-in-element">
                <!-- Advanced Ticketing -->
                <article class="group bg-[#F8FAFC] p-8 md:p-10 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-blue-100 transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-gray-900 text-3xl">confirmation_number</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Advanced Ticketing</h4>
                    <p class="text-gray-600 leading-relaxed">Secure, unique ticketing to track diagnostics, repair milestones, and quality checks in real-time.</p>
                </article>

                <!-- AI Chatbot -->
                <article class="group bg-[#F8FAFC] p-8 md:p-10 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-blue-100 transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-gray-900 text-3xl">smart_toy</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">AI Chatbot</h4>
                    <p class="text-gray-600 leading-relaxed">Automated 24/7 assistance to diagnose symptoms and secure your drop-off slot instantly.</p>
                </article>

                <!-- Dashboard -->
                <article class="group bg-[#F8FAFC] p-8 md:p-10 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-blue-100 transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-gray-900 text-3xl">analytics</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Smart Dashboard</h4>
                    <p class="text-gray-600 leading-relaxed">A centralized view for our team to oversee workloads, track repair times, and ensure strict quality.</p>
                </article>

                <!-- Notifications -->
                <article class="group bg-[#F8FAFC] p-8 md:p-10 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-blue-100 transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-gray-900 text-3xl">notifications_active</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Live Updates</h4>
                    <p class="text-gray-600 leading-relaxed">Stay informed with instant SMS and email updates the moment your repair status changes.</p>
                </article>

                <!-- Inventory -->
                <article class="group bg-[#F8FAFC] p-8 md:p-10 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-blue-100 transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-gray-900 text-3xl">inventory_2</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Stock Control</h4>
                    <p class="text-gray-600 leading-relaxed">Real-time monitoring of screens and batteries ensures we always have the parts needed.</p>
                </article>

                <!-- Invoicing -->
                <article class="group bg-[#F8FAFC] p-8 md:p-10 rounded-[2rem] border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-blue-100 transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-gray-900 text-3xl">receipt_long</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Digital Payments</h4>
                    <p class="text-gray-600 leading-relaxed">Receive detailed digital invoices and pay securely online before you even arrive for pickup.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Advantage Section -->
    <section id="why" class="py-24 md:py-32 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 fade-in-element">
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-[0.2em] mb-4">Precision First</h2>
                <h3 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight mb-6">The Repairmax Standard.</h3>
                <p class="text-lg text-gray-600 leading-relaxed">We don't just replace parts; we restore your device to its optimal factory condition using industry-leading standards.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 fade-in-element">
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl border border-gray-100">
                        <span class="material-symbols-outlined text-4xl text-gray-900">memory</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Micro-Soldering</h4>
                    <p class="text-gray-600 leading-relaxed">Expert motherboard diagnostics and micro-component replacement for complex hardware damage that others can't fix.</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl border border-gray-100">
                        <span class="material-symbols-outlined text-4xl text-gray-900">precision_manufacturing</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Diagnostic Precision</h4>
                    <p class="text-gray-600 leading-relaxed">Advanced voltage testing and ultrasonic cleaning to identify shorts and liquid damage other shops miss.</p>
                </div>

                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mb-8 shadow-xl border border-gray-100">
                        <span class="material-symbols-outlined text-4xl text-gray-900">fact_check</span>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4">Strict QC</h4>
                    <p class="text-gray-600 leading-relaxed">A strict 24-point post-repair inspection ensures every sensor and component is functioning flawlessly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Can Repair Section -->
    <section id="repairs" class="py-24 md:py-32 bg-[#020617] relative overflow-hidden">
        <!-- Radial Glow Effects -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-blue-900/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="mb-16 md:mb-24 max-w-3xl mx-auto text-center fade-in-element">
                <h2 class="text-xs font-bold text-blue-500 uppercase tracking-[0.2em] mb-4">Repair Catalog</h2>
                <h3 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-8">Hardware Expertise.</h3>
                <p class="text-xl text-gray-400 leading-relaxed">Our technicians are certified for advanced micro-soldering and complex hardware restoration across all major device ecosystems.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 fade-in-element">
                <!-- Screen Replacements -->
                <article class="group relative p-8 md:p-10 rounded-[2.5rem] bg-gray-900/40 border border-white/5 hover:border-white/20 transition-all duration-500 backdrop-blur-sm overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-blue-600 group-hover:border-blue-500 transition-all duration-500 shadow-inner">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-white text-3xl transition-colors">smartphone</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-4">Screen Replacements</h4>
                        <p class="text-gray-400 leading-relaxed">Factory-grade displays with perfect true-tone color calibration and touch responsiveness.</p>
                    </div>
                </article>

                <!-- Battery Issues -->
                <article class="group relative p-8 md:p-10 rounded-[2.5rem] bg-gray-900/40 border border-white/5 hover:border-white/20 transition-all duration-500 backdrop-blur-sm overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-indigo-600 group-hover:border-indigo-500 transition-all duration-500 shadow-inner">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-white text-3xl transition-colors">battery_charging_full</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-4">Battery Power</h4>
                        <p class="text-gray-400 leading-relaxed">High-cycle OEM batteries to restore your device's original endurance and performance peaks.</p>
                    </div>
                </article>

                <!-- Charging Port -->
                <article class="group relative p-8 md:p-10 rounded-[2.5rem] bg-gray-900/40 border border-white/5 hover:border-white/20 transition-all duration-500 backdrop-blur-sm overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-cyan-600 group-hover:border-cyan-500 transition-all duration-500 shadow-inner">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-white text-3xl transition-colors">usb</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-4">Charging Port</h4>
                        <p class="text-gray-400 leading-relaxed">Precision micro-component repair for loose, damaged, or unresponsive charging connectors.</p>
                    </div>
                </article>

                <!-- Water Damage -->
                <article class="group relative p-8 md:p-10 rounded-[2.5rem] bg-gray-900/40 border border-white/5 hover:border-white/20 transition-all duration-500 backdrop-blur-sm overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-blue-400 group-hover:border-blue-400 transition-all duration-500 shadow-inner">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-white text-3xl transition-colors">water_drop</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-4">Water Damage</h4>
                        <p class="text-gray-400 leading-relaxed">Ultrasonic cleaning and motherboard diagnostics to recover data and restore liquid-exposed logic boards.</p>
                    </div>
                </article>

                <!-- Camera & Lens -->
                <article class="group relative p-8 md:p-10 rounded-[2.5rem] bg-gray-900/40 border border-white/5 hover:border-white/20 transition-all duration-500 backdrop-blur-sm overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-violet-600 group-hover:border-violet-500 transition-all duration-500 shadow-inner">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-white text-3xl transition-colors">photo_camera</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-4">Camera & Lens</h4>
                        <p class="text-gray-400 leading-relaxed">Replacing shattered lens glass and failed sensor modules to restore crystal clear focus and clarity.</p>
                    </div>
                </article>

                <!-- Audio & Speaker -->
                <article class="group relative p-8 md:p-10 rounded-[2.5rem] bg-gray-900/40 border border-white/5 hover:border-white/20 transition-all duration-500 backdrop-blur-sm overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center mb-8 border border-white/10 group-hover:bg-slate-600 group-hover:border-slate-500 transition-all duration-500 shadow-inner">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-white text-3xl transition-colors">volume_up</span>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-4">Audio Restore</h4>
                        <p class="text-gray-400 leading-relaxed">Resolving muffled earpieces and blown speakers to bring back high-fidelity sound to your calls.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ================= SERVICES SPLIT-SCREEN CAROUSEL SECTION ================= -->
    @php
        $carouselServices = \App\Models\FaultType::orderBy('name', 'asc')->get();
    @endphp
    <section class="py-24 relative overflow-hidden bg-[#020617] border-t border-b border-white/5" 
             x-data="{ 
                activeIdx: 0, 
                services: {{ Js::from($carouselServices->map(fn($s) => [
                    'id' => $s->id,
                    'name' => $s->name,
                    'description' => $s->description,
                    'image_path' => asset($s->image_path),
                    'base_price' => number_format($s->base_price, 2),
                    'categoryName' => (str_contains(strtolower($s->name), 'screen') || str_contains(strtolower($s->name), 'glass') || str_contains(strtolower($s->name), 'lcd')) ? 'Screen & Display' :
                                      ((str_contains(strtolower($s->name), 'battery') || str_contains(strtolower($s->name), 'charge') || str_contains(strtolower($s->name), 'power')) ? 'Power & Charging' :
                                      ((str_contains(strtolower($s->name), 'audio') || str_contains(strtolower($s->name), 'speaker') || str_contains(strtolower($s->name), 'microphone')) ? 'Audio & Sound' :
                                      ((str_contains(strtolower($s->name), 'software') || str_contains(strtolower($s->name), 'system') || str_contains(strtolower($s->name), 'boot') || str_contains(strtolower($s->name), 'data')) ? 'Software & Systems' : 'Hardware & Modules'))),
                    'badgeClass' => (str_contains(strtolower($s->name), 'screen') || str_contains(strtolower($s->name), 'glass') || str_contains(strtolower($s->name), 'lcd')) ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20' :
                                    ((str_contains(strtolower($s->name), 'battery') || str_contains(strtolower($s->name), 'charge') || str_contains(strtolower($s->name), 'power')) ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' :
                                    ((str_contains(strtolower($s->name), 'audio') || str_contains(strtolower($s->name), 'speaker') || str_contains(strtolower($s->name), 'microphone')) ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' :
                                    ((str_contains(strtolower($s->name), 'software') || str_contains(strtolower($s->name), 'system') || str_contains(strtolower($s->name), 'boot') || str_contains(strtolower($s->name), 'data')) ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20')))
                ])) }},
                next() {
                    this.activeIdx = (this.activeIdx + 1) % this.services.length;
                },
                prev() {
                    this.activeIdx = (this.activeIdx - 1 + this.services.length) % this.services.length;
                }
             }">
             
        <!-- Decorative Background Glows -->
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-[600px] h-[600px] bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute top-1/2 right-0 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
                
                <!-- Left Side: Labels and Navigation -->
                <div class="lg:col-span-5 text-left space-y-8">
                    <div class="space-y-4">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20 inline-block">
                            What We Fix
                        </span>
                        <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-[1.15]">
                            Our Featured <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">Repair Services</span>
                        </h2>
                        <p class="text-base md:text-lg text-gray-400 font-medium leading-relaxed">
                            Browse our high-quality repair catalog. We offer quick, reliable, and premium repairs for screens, batteries, ports, and more.
                        </p>
                    </div>

                    <!-- Sleek Premium Details Checklist -->
                    <div class="space-y-5 pt-6 border-t border-white/5">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-400 mt-0.5 text-[20px]">verified_user</span>
                            <div>
                                <h4 class="text-sm font-bold text-white">Premium Certified OEM Parts</h4>
                                <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">We only use top-tier, quality-guaranteed parts for all repairs.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-400 mt-0.5 text-[20px]">query_builder</span>
                            <div>
                                <h4 class="text-sm font-bold text-white">Same-Day Express Service</h4>
                                <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">Most smartphone and tablet repairs are completed within 2 hours.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-400 mt-0.5 text-[20px]">shield</span>
                            <div>
                                <h4 class="text-sm font-bold text-white">90-Day Solid Warranty Coverage</h4>
                                <p class="text-xs text-gray-400 mt-0.5 leading-relaxed">Enjoy complete peace of mind with our worry-free repair warranty.</p>
                            </div>
                        </div>
                    </div>

                    <!-- View All Services CTA Button -->
                    <div class="pt-2 w-full">
                        <a href="/services" class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 border border-white/10 bg-white/5 hover:bg-white/10 text-white rounded-2xl font-bold text-xs tracking-wider uppercase active:scale-95 transition-all shadow-md">
                            <span class="material-symbols-outlined text-[16px]">menu_book</span>
                            View All Services
                        </a>
                    </div>
                </div>

                <!-- Right Side: Single Card Display & Navigation -->
                <div class="lg:col-span-7 flex flex-col items-center lg:items-end">
                    <!-- Card Display -->
                    <div class="relative w-full max-w-lg min-h-[480px] flex items-center justify-center">
                        <template x-for="(service, index) in services" :key="service.id">
                            <div class="bg-gray-900 rounded-[2.5rem] border border-white/10 shadow-2xl overflow-hidden flex flex-col group w-full transition-all duration-500 transform"
                                 :class="{
                                     'opacity-100 scale-100 translate-x-0 pointer-events-auto z-10 relative': activeIdx === index,
                                     'opacity-0 scale-95 -translate-x-12 pointer-events-none absolute inset-0': activeIdx > index,
                                     'opacity-0 scale-95 translate-x-12 pointer-events-none absolute inset-0': activeIdx < index
                                 }">
                                 
                                <!-- Card Image -->
                                <div class="relative h-64 overflow-hidden bg-gray-950 shrink-0">
                                    <img :src="service.image_path" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90" 
                                         :alt="service.name">
                                    
                                    <!-- Category Badge -->
                                    <span :class="service.badgeClass"
                                          class="absolute top-6 left-6 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm bg-gray-900/80"
                                          x-text="service.categoryName">
                                    </span>
                                </div>

                                <!-- Card Body -->
                                <div class="p-8 flex flex-col flex-1">
                                    <h3 class="text-2xl font-extrabold text-white tracking-tight mb-3" x-text="service.name"></h3>
                                    
                                    <!-- Description (constrained with premium blend fade) -->
                                    <div class="relative h-20 overflow-hidden mb-6">
                                        <p class="text-sm text-gray-400 leading-relaxed font-medium" x-text="service.description"></p>
                                        <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-gray-900 to-transparent pointer-events-none"></div>
                                    </div>
                                    
                                    <!-- Pricing and View Details -->
                                    <div class="flex items-center justify-between pt-6 border-t border-white/5 mt-auto">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Starting from</span>
                                            <span class="text-2xl font-black text-white mt-1" x-text="'₱' + service.base_price"></span>
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            <a :href="'/services/' + service.id" class="inline-flex items-center justify-center px-4 py-3.5 bg-white/10 hover:bg-white/20 text-white rounded-xl font-bold text-[10px] active:scale-95 transition-all whitespace-nowrap">
                                                Details
                                            </a>
                                            <a :href="'/booking?service=' + encodeURIComponent(service.name)" class="inline-flex items-center justify-center gap-1 px-4 py-3.5 bg-white hover:bg-blue-600 text-gray-900 hover:text-white rounded-xl font-bold text-[10px] shadow-md active:scale-95 transition-all whitespace-nowrap">
                                                Book
                                                <span class="material-symbols-outlined text-[14px]">calendar_month</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Navigation controls inline directly below card container -->
                    <div class="mt-8 flex items-center justify-between w-full max-w-lg px-2">
                        <button @click="prev()" 
                                class="w-14 h-14 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 text-gray-300 hover:text-white shadow-xl active:scale-95 flex items-center justify-center transition-all">
                            <span class="material-symbols-outlined font-black text-2xl">arrow_back</span>
                        </button>
                        
                        <button @click="next()" 
                                class="w-14 h-14 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 text-gray-300 hover:text-white shadow-xl active:scale-95 flex items-center justify-center transition-all">
                            <span class="material-symbols-outlined font-black text-2xl">arrow_forward</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonials Section (SaaS Infinite Scroll) -->
    <section x-data="{}" class="pt-24 pb-12 bg-[#F3F4F6] overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-8 relative z-10">
            <h2 class="text-xs font-bold text-blue-600 uppercase tracking-[0.2em] mb-4">Customer Success</h2>
            <h3 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight">Trusted by the best.</h3>
        </div>

        <!-- Infinite Scroll Container -->
        <div class="relative flex overflow-hidden group py-12">
            <!-- Doubled items for seamless loop -->
            <div class="flex animate-marquee whitespace-nowrap">
                <!-- Original Set -->
                <div class="flex gap-8 px-4">
                    <!-- Testimonial 1 (5 Stars) -->
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=1" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">John Doe</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">iPhone 15 Pro Max</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;Absolutely incredible service! My iPhone screen was replaced in under 45 minutes and it looks brand new.&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                        </div>
                    </div>
                    <!-- Testimonial 2 (4 Stars) -->
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=2" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">Sarah Wilson</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">Samsung S23 Ultra</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;The AI booking assistant made scheduling so easy. I love that I could track my repair status in real-time!&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                        </div>
                    </div>
                    <!-- Testimonial 3 (5 Stars) -->
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=3" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">Michael Chen</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">MacBook Pro M2</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;High-quality parts and professional staff. The 90-day warranty gives me real peace of mind.&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                        </div>
                    </div>
                    <!-- Testimonial 4 (3 Stars - Realistic touch) -->
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=4" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">Emma Thompson</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">Google Pixel 7</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;The only repair shop I trust. Transparent pricing and no hidden fees. Highly recommended!&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                            <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                        </div>
                    </div>
                </div>
                <!-- Duplicate Set for Seamless Loop (Identical to above) -->
                <div class="flex gap-8 px-4">
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=1" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">John Doe</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">iPhone 15 Pro Max</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;Absolutely incredible service! My iPhone screen was replaced in under 45 minutes and it looks brand new.&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                        </div>
                    </div>
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=2" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">Sarah Wilson</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">Samsung S23 Ultra</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;The AI booking assistant made scheduling so easy. I love that I could track my repair status in real-time!&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                        </div>
                    </div>
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=3" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">Michael Chen</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">MacBook Pro M2</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;High-quality parts and professional staff. The 90-day warranty gives me real peace of mind.&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                        </div>
                    </div>
                    <div class="w-[350px] md:w-[450px] bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 whitespace-normal">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://i.pravatar.cc/150?u=4" class="w-14 h-14 rounded-full shadow-sm" alt="">
                            <div>
                                <h4 class="text-gray-900 font-bold text-lg">Emma Thompson</h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest">Google Pixel 7</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-xl leading-relaxed italic">&ldquo;The only repair shop I trust. Transparent pricing and no hidden fees. Highly recommended!&rdquo;</p>
                        <div class="mt-8 flex text-yellow-400 gap-1">
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1">star</span>
                            <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                            <span class="material-symbols-outlined text-gray-300 text-sm">star</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gradient Overlays (SaaS style) -->
            <div class="absolute inset-y-0 left-0 w-48 bg-gradient-to-r from-[#F3F4F6] to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-48 bg-gradient-to-l from-[#F3F4F6] to-transparent z-10 pointer-events-none"></div>
        </div>

        <style>
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee {
                animation: marquee 40s linear infinite;
            }
            .group:hover .animate-marquee {
                animation-play-state: paused;
            }
        </style>
    </section>

    <!-- Final CTA Section (SaaS Redesign) -->
    <section class="py-12 bg-[#F3F4F6] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-gray-900 rounded-[4rem] p-12 md:p-24 overflow-hidden">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[120px]"></div>
                <div class="absolute -bottom-32 -left-32 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[100px]"></div>

                <div class="relative z-10 max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl md:text-7xl font-black text-white mb-8 leading-[1.1] tracking-tighter text-balance">
                        Ready to restore your <span class="text-blue-500">peace of mind?</span>
                    </h2>
                    <p class="text-xl text-gray-400 mb-12 leading-relaxed max-w-xl mx-auto">
                        Experience the future of repair. Book in seconds, track in real-time, and get back to your life with zero stress.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                        <a href="/booking" class="w-full sm:w-64 group inline-flex items-center justify-center px-10 py-5 text-xl font-bold text-gray-900 bg-white hover:bg-blue-500 hover:text-white rounded-2xl transition-all duration-300 active:scale-95 shadow-xl">
                            <span class="material-symbols-outlined mr-2 group-hover:animate-bounce">bolt</span>
                            Start Repair
                        </a>
                        <a href="/services" class="w-full sm:w-64 group inline-flex items-center justify-center px-10 py-5 text-xl font-bold text-white bg-white/10 hover:bg-white/20 rounded-2xl transition-all duration-300 active:scale-95 backdrop-blur-md border border-white/20 hover:border-white/40 shadow-lg">
                            <span class="material-symbols-outlined mr-2 group-hover:rotate-45 transition-transform duration-300">handyman</span>
                            View Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Application update trigger -->
</x-layouts.landing>