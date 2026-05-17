<x-layouts.landing title="Help & Support Center | Repairmax">
    <main class="pt-32 lg:pt-40 py-16 md:py-24 !pt-40 bg-[#F9FAFB]">


        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 fade-in-element text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Help & Support Center
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Everything you need to track your ticket, contact our team, resolve issues, or chat with our automated systems.
            </p>
        </section>

        <!-- Section 1: Track Status -->
        <section id="track" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 md:mb-32 scroll-mt-36">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-200">
                <div class="text-center max-w-2xl mx-auto mb-10">
                    <div class="w-12 h-12 bg-gray-900 text-white rounded-xl flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-2xl">track_changes</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-3">Track Your Repair</h2>
                    <p class="text-sm md:text-base text-gray-500">Enter your repair ticket ID and email to get real-time updates on your device status.</p>
                </div>

                <form action="/track-status" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Repair Ticket ID</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-gray-900 transition-colors">tag</span>
                                </div>
                                <input type="text" name="ticket_id" placeholder="e.g. RPR-664654F7" required 
                                    class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-gray-900 transition-colors">mail</span>
                                </div>
                                <input type="email" name="email" placeholder="hello@example.com" required 
                                    class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all text-sm">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gray-900 text-white font-bold rounded-xl transition-all shadow-md hover:bg-gray-800 text-base">
                        Check Status
                    </button>
                </form>
            </div>
        </section>

        <!-- Section 2: Contact Us -->
        <section id="contact" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 md:mb-32 scroll-mt-36">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="w-12 h-12 bg-gray-900 text-white rounded-xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-2xl">support_agent</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Get in Touch</h2>
                <p class="text-base md:text-lg text-gray-600">Visit our flagship branch or send us an enquiry online. Our expert technicians are ready to help.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <!-- Location details & Map -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200 h-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 italic text-center md:text-left">Repairmax Service Center</h3>

                    <div class="space-y-6 mb-8">
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-gray-900 mt-1">location_on</span>
                            <div>
                                <p class="font-bold text-gray-900">Flagship Branch</p>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Commonwealth Ave. Cor. IBP Road (Litex Junction),<br>
                                    Brgy. Payatas, Quezon City, 1119<br>
                                    Metro Manila, Philippines
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-900">call</span>
                            <div>
                                <p class="font-bold text-gray-900">Contact Number</p>
                                <p class="text-sm text-gray-600">+63 912 345 6789</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl overflow-hidden h-64 border border-gray-200 shadow-inner">
                        <iframe
                            src="https://maps.google.com/maps?q=Commonwealth+Ave.+Cor.+IBP+Road,+Quezon+City&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>

                <!-- Enquiry Form -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Send an Enquiry</h3>

                    @if (session('success'))
                    <div x-data="{ showBanner: true }"
                        x-show="showBanner"
                        x-init="setTimeout(() => showBanner = false, 5000)"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-4"
                        class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-start gap-3 shadow-sm">
                        <span class="material-symbols-outlined shrink-0 text-green-600" style="font-size: 24px;">check_circle</span>
                        <span class="font-medium text-sm leading-relaxed mt-0.5">{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="/contact/send" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">To</label>
                                <input type="text" value="Repairmax Support" disabled
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">From (Your Email)</label>
                                <input type="email" name="from_email" placeholder="juan@example.com" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <input type="text" name="subject" placeholder="e.g., Samsung LCD Replacement Quote" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" rows="4" placeholder="Tell us about your device issue..." required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all resize-none text-sm"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-all flex items-center justify-center gap-2 shadow-lg">
                            <span class="material-symbols-outlined text-lg">send</span>
                            Send Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Section 3: FAQs -->
        <section id="faqs" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 md:mb-32 scroll-mt-36">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="w-12 h-12 bg-gray-900 text-white rounded-xl flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-2xl">quiz</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Frequently Asked Questions</h2>
                <p class="text-base md:text-lg text-gray-600">Everything you need to know about our process, pricing, and how we handle your tech.</p>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-2.5 flex items-center">
                        <span class="material-symbols-outlined mr-3 text-gray-500">history</span>
                        How long does a typical repair take?
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed pl-9">
                        Most screen and battery replacements are completed within 1-2 hours. More complex motherboard or water damage repairs typically take 3-5 business days depending on parts availability.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-2.5 flex items-center">
                        <span class="material-symbols-outlined mr-3 text-gray-500">security</span>
                        Is my data safe during the repair?
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed pl-9">
                        Absolutely. We follow a strict privacy-first protocol. We do not require your passcode unless it's necessary for hardware testing, and we never access your personal files or photos.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-2.5 flex items-center">
                        <span class="material-symbols-outlined mr-3 text-gray-500">payments</span>
                        Do you provide a warranty?
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed pl-9">
                        Yes, all Repairmax repairs come with a 90-day warranty on both parts and labor. If the original issue persists or a part fails, we'll make it right at no extra cost.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 transition-all duration-300 hover:shadow-md">
                    <h3 class="text-lg font-bold text-gray-900 mb-2.5 flex items-center">
                        <span class="material-symbols-outlined mr-3 text-gray-500">smart_toy</span>
                        How do I track my repair status?
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed pl-9">
                        Once you drop off your device, you'll receive a unique tracking link. You can also chat with our AI assistant 24/7 to get real-time updates on your repair stage.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 4: AI Support -->
        <section id="ai-support" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 scroll-mt-36">
            <div class="bg-gray-900 rounded-[2.5rem] p-8 md:p-16 border border-gray-800 text-white shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.03),transparent)]"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="w-12 h-12 bg-white/10 text-white rounded-xl flex items-center justify-center mb-6 border border-white/10">
                            <span class="material-symbols-outlined text-2xl">smart_toy</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6 tracking-tight">AI diagnostic & Support</h2>
                        <p class="text-gray-400 mb-8 leading-relaxed">
                            Need help troubleshooting a glitch, estimating diagnostic steps, or tracking status on the go?
                            Our advanced AI Assistant is available 24/7 to diagnose device symptoms, estimate costs, and track appointments in real-time.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('login') }}" class="px-8 py-3.5 text-sm font-bold text-gray-900 bg-white hover:bg-gray-100 rounded-full transition-all duration-300 shadow-md">
                                Log In to Chat
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3.5 text-sm font-bold text-white border border-white/20 hover:bg-white/5 rounded-full transition-all duration-300">
                                Create Free Account
                            </a>
                        </div>
                    </div>

                    <div class="bg-white/5 rounded-3xl border border-white/10 p-6 md:p-8 backdrop-blur-md">
                        <h4 class="font-bold text-lg mb-4 text-white">What can the AI do?</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <span class="material-symbols-outlined text-green-400 mt-0.5">check_circle</span>
                                <div>
                                    <strong class="text-white block">Real-time status updates</strong>
                                    Input your tracking code to get details instantly.
                                </div>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <span class="material-symbols-outlined text-green-400 mt-0.5">check_circle</span>
                                <div>
                                    <strong class="text-white block">Device Diagnostics</strong>
                                    Describe hardware errors to understand potential solutions.
                                </div>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <span class="material-symbols-outlined text-green-400 mt-0.5">check_circle</span>
                                <div>
                                    <strong class="text-white block">Immediate Queue Booking</strong>
                                    Seamless integration to reserve physical queue tickets.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </main>
</x-layouts.landing>
