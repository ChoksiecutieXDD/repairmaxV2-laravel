<x-layouts.landing title="Help & Support Center | Repairmax">
    <main class="relative pb-24 md:pb-32 overflow-hidden bg-[#020617]">
        <!-- Gradient Banner Header -->
        <section class="w-full bg-gradient-to-b from-[#0f172a] via-[#12183a] to-[#020617] pt-32 lg:pt-40 pb-32 md:pb-40 relative overflow-hidden">
            <!-- Glow Effects Inside Banner -->
            <div class="absolute top-0 left-1/4 -translate-x-1/2 w-125 h-125 bg-blue-600/8 rounded-full blur-[140px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-1/4 translate-x-1/2 w-125 h-125 bg-indigo-600/8 rounded-full blur-[140px] pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <span class="text-xs font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3.5 py-1.5 rounded-full inline-block mb-4 shadow-sm">
                    How can we help you today?
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight">
                    Help & Support Center
                </h1>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed font-medium mb-10">
                    Choose a channel below to track your ticket, read our frequently asked questions, get in touch with our branch, or chat with our automated systems.
                </p>

                <!-- Search Bar -->
                <form action="{{ route('help.faqs') }}" method="GET" class="max-w-4xl mx-auto">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-gray-400 group-focus-within:text-white transition-colors">search</span>
                        </div>
                        <input type="text" name="q" placeholder="Search for answers (e.g. warranty, price, duration)..."
                            class="w-full pl-14 pr-32 py-4 bg-white/5 border border-white/10 text-white rounded-2xl outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-base shadow-sm placeholder-gray-400">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-bold rounded-xl transition-all text-sm flex items-center gap-1.5 cursor-pointer">
                            <span>Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Help Hub Bento Grid Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- Bento Card 1: Track Repair (Col span 2) -->
                <div class="col-span-1 md:col-span-2 bg-white/[0.03] backdrop-blur-md rounded-4xl border border-white/10 p-8 md:p-10 shadow-2xl flex flex-col justify-between group hover:shadow-3xl hover:bg-white/[0.05] hover:-translate-y-1 transition-all duration-300">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-500/10 text-blue-400 border border-blue-500/15 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl font-bold">track_changes</span>
                            </div>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight mb-0">Track Your Repair</h2>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed max-w-xl text-left">
                            Get real-time live updates on your repair stage, technician assignment, diagnostic notes, and estimated pickup times using your unique booking code.
                        </p>
                        
                        <!-- Interactive Mockup for Bento Visual Richness -->
                        <div class="bg-white/[0.02] border border-white/5 rounded-2xl p-4 flex flex-col sm:flex-row gap-4 items-center w-full">
                            <div class="relative w-full">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-[18px]">tag</span>
                                <input type="text" placeholder="e.g. BK-00001" disabled class="w-full pl-9 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-xl text-xs text-gray-500 cursor-not-allowed">
                            </div>
                            <a href="{{ route('help.track') }}" class="w-full sm:w-auto px-5 py-2.5 bg-blue-600/80 hover:bg-blue-600 text-white text-xs font-bold rounded-xl transition-all shadow-md text-center shrink-0">
                                Track Now
                            </a>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-between text-left">
                        <span class="text-xs text-gray-500">Enter your Booking reference number to track live status.</span>
                        <a href="{{ route('help.track') }}" class="inline-flex items-center gap-1.5 text-blue-400 hover:text-blue-300 text-sm font-bold transition-colors">
                            <span>Access Portal</span>
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Bento Card 2: FAQs Quick List (Col span 1) -->
                <div class="col-span-1 bg-white/[0.03] backdrop-blur-md rounded-4xl border border-white/10 p-8 shadow-2xl flex flex-col justify-between group hover:shadow-3xl hover:bg-white/[0.05] hover:-translate-y-1 transition-all duration-300 text-left">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-500/10 text-blue-400 border border-blue-500/15 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl font-bold">quiz</span>
                            </div>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight mb-0">Popular Guides</h2>
                        </div>
                        
                        <!-- Short links list -->
                        <ul class="space-y-3.5 text-sm">
                            <li>
                                <a href="/help/article/prepare-phone-repair" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-xs text-gray-500">chevron_right</span>
                                    How to prepare device for repair
                                </a>
                            </li>
                            <li>
                                <a href="/help/article/warranty-policy" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-xs text-gray-500">chevron_right</span>
                                    How 90-Day Warranty works
                                </a>
                            </li>
                            <li>
                                <a href="/help/article/liquid-damage" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center gap-2">
                                    <span class="material-symbols-outlined text-xs text-gray-500">chevron_right</span>
                                    Handling liquid damaged phones
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <a href="{{ route('help.faqs') }}" class="mt-8 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/5 hover:bg-white/10 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full text-center">
                        <span>Browse FAQ Database</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Bento Card 3: AI Diagnostic Support (Col span 1) -->
                <div class="col-span-1 bg-white/[0.03] backdrop-blur-md rounded-4xl border border-white/10 p-8 shadow-2xl flex flex-col justify-between group hover:shadow-3xl hover:bg-white/[0.05] hover:-translate-y-1 transition-all duration-300 text-left">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-500/10 text-blue-400 border border-blue-500/15 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl font-bold">smart_toy</span>
                            </div>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight mb-0">AI Diagnostics</h2>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Troubleshoot device glitches, run instant symptom diagnostics, calculate price estimates, or reserve quick-pass queue tickets 24/7.
                        </p>
                        
                        <!-- Small interactive preview -->
                        <div class="bg-blue-500/5 border border-blue-500/10 rounded-2xl p-4 flex items-center gap-3">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span class="text-xs text-blue-300 font-medium">AI Agent online and ready</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('help.ai-support') }}" class="mt-8 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full text-center">
                        <span>Launch AI Support</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Bento Card 4: Browse Documentation (Col span 2) -->
                <div class="col-span-1 md:col-span-2 bg-white/[0.03] backdrop-blur-md rounded-4xl border border-white/10 p-8 md:p-10 shadow-2xl flex flex-col justify-between group hover:shadow-3xl hover:bg-white/[0.05] hover:-translate-y-1 transition-all duration-300 text-left">
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-500/10 text-blue-400 border border-blue-500/15 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl font-bold">menu_book</span>
                            </div>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight mb-0">Browse Documentation</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <h4 class="text-sm font-black uppercase tracking-wider text-blue-400 mb-2.5">Getting Started</h4>
                                <ul class="space-y-2 text-xs text-gray-400">
                                    <li><a href="/help/article/prepare-phone-repair" class="hover:text-white transition-colors">Prepare phone for repair</a></li>
                                    <li><a href="/help/article/diagnostics-report" class="hover:text-white transition-colors">Diagnostics report details</a></li>
                                    <li><a href="/help/article/liquid-damage" class="hover:text-white transition-colors">Handling water damage</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-sm font-black uppercase tracking-wider text-blue-400 mb-2.5">Warranty & Policy</h4>
                                <ul class="space-y-2 text-xs text-gray-400">
                                    <li><a href="/help/article/warranty-policy" class="hover:text-white transition-colors">How 90-Day Warranty works</a></li>
                                    <li><a href="/help/faqs" class="hover:text-white transition-colors">Browse all FAQs</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="text-sm font-black uppercase tracking-wider text-blue-400 mb-2.5">Accounts & Payments</h4>
                                <ul class="space-y-2 text-xs text-gray-400">
                                    <li><a href="/help/article/payment-methods" class="hover:text-white transition-colors">Pay via GCash / Maya online</a></li>
                                    <li><a href="/help/article/receipt-details" class="hover:text-white transition-colors">Get physical corporate receipt</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-white/5 flex justify-end">
                        <span class="text-xs text-gray-500">Need specific documentation? Use our search bar above.</span>
                    </div>
                </div>

                <!-- Bento Card 5: Get in Touch (Col span 3) -->
                <div class="col-span-1 md:col-span-3 bg-white/[0.03] backdrop-blur-md rounded-4xl border border-white/10 p-8 md:p-10 shadow-2xl group hover:shadow-3xl hover:bg-white/[0.05] hover:-translate-y-1 transition-all duration-300">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center text-left">
                        <!-- Left: Branch Details -->
                        <div class="lg:col-span-7 space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-500/10 text-blue-400 border border-blue-500/15 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl font-bold">support_agent</span>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold text-white tracking-tight mb-0">Get in Touch</h2>
                                    <p class="text-xs text-blue-400 uppercase tracking-widest font-black mt-0.5">Flagship Service Desk & Branch Location</p>
                                </div>
                            </div>
                            
                            <p class="text-gray-400 text-sm leading-relaxed max-w-2xl">
                                Locate our flagship store in Payatas, Quezon City, check operating hours, dial our direct customer line, or send us a message online using our support request forms.
                            </p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                                <div class="flex items-center gap-2.5">
                                    <span class="material-symbols-outlined text-blue-400 text-[18px]">location_on</span>
                                    <div>
                                        <p class="font-bold text-white mb-0">Litex, Quezon City</p>
                                        <p class="text-gray-500 mt-0.5 mb-0">Commonwealth Ave.</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="material-symbols-outlined text-blue-400 text-[18px]">schedule</span>
                                    <div>
                                        <p class="font-bold text-white mb-0">Mon – Sat: 9am – 6pm</p>
                                        <p class="text-gray-500 mt-0.5 mb-0">Sunday: Closed</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="material-symbols-outlined text-blue-400 text-[18px]">call</span>
                                    <div>
                                        <p class="font-bold text-white mb-0">+63 912 345 6789</p>
                                        <p class="text-gray-550 mt-0.5 mb-0">Direct phone line</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right: Actions -->
                        <div class="lg:col-span-5 flex flex-col sm:flex-row gap-4 justify-end w-full lg:w-auto">
                            <a href="{{ route('help.contact') }}" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full lg:w-auto text-center">
                                <span>Submit Online Enquiry</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Common Questions Section -->
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Common Questions</h2>
                <p class="text-gray-400 mt-2 text-sm md:text-base">Here are some of our most frequently asked customer questions.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">How long does a typical repair take?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>Most screen replacements, battery replacements, and modular component repairs are completed within 1-2 hours of drop-off. More complex operations like motherboard repairs or water damage treatments typically require 3-5 business days.</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">What does your Nationwide Warranty cover?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>All repairs are backed by our signature 90-Day Nationwide Service Warranty. This covers any performance defects or component malfunctions of the replaced part. It does not cover subsequent physical or liquid damage.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">Is my personal data safe during the repair?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>Absolutely. We follow strict privacy protocols. We do not require your password/passcode unless it is absolutely necessary for hardware test validation, and our technicians never access your files, media, or accounts.</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">Do I need to book an appointment beforehand?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>While we happily accept walk-ins at our flagship branch, booking an appointment online guarantees your parts are reserved in stock and your technician is allocated to begin work the moment you arrive.</p>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">What brand devices do you repair?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>We offer extensive out-of-warranty hardware and software repairs for all major manufacturers, including Apple (iPhones, iPads, MacBooks), Samsung (Galaxy phones & tablets), Google Pixel, Xiaomi, Oppo, Asus, and Huawei.</p>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">What payment options do you support?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>We support all major payment types at our service desk, including Cash, GCash, PayMaya, Bank Transfers (BDO, BPI), and credit/debit cards.</p>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div x-data="{ open: false }" 
                     class="bg-white/[0.03] backdrop-blur-md rounded-2xl border border-white/10 overflow-hidden shadow-2xl transition-all duration-300"
                     :class="open ? 'border-white/20' : ''">
                    <button @click="open = !open" 
                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-white hover:bg-white/5 transition-colors gap-4">
                        <span class="text-base md:text-lg">How do you calculate repair costs?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-300 select-none"
                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                    </button>
                    <div x-show="open" 
                         x-collapse
                         class="px-6 pb-6 pt-1 text-sm text-gray-300 leading-relaxed border-t border-white/5 bg-white/[0.01] text-left">
                        <p>Our pricing is completely transparent and consists of direct parts cost + standard service labor. We never charge hidden diagnostic fees or add surprise surcharges. You will receive an exact invoice itemization before we begin.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('help.faqs') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-bold transition-colors text-sm">
                    <span>View all frequently asked questions</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </section>

    </main>
</x-layouts.landing>
