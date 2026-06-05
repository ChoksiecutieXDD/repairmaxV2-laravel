<x-layouts.landing title="Contact Support Center | Repairmax">
    <main class="relative pt-32 lg:pt-40 pb-24 md:pb-32 overflow-hidden bg-[#020617]">
        <!-- Glow Effects -->
        <div class="absolute top-1/4 left-1/4 w-[500px] h-[500px] bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Contact Us</h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed font-medium">
                Need customized support? Speak directly to our technicians, find our flagship service branch, or submit an enquiry online.
            </p>
        </section>

        <!-- Main Layout Stack -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="space-y-10">
                
                <!-- Top: Branch details & Map -->
                <div class="bg-white/[0.03] backdrop-blur-md p-8 md:p-10 rounded-[2.5rem] border border-white/10 shadow-2xl text-left space-y-8">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full inline-block mb-3">Flagship Store</span>
                        <h3 class="text-2xl font-bold text-white tracking-tight">Repairmax Service Desk</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 border-b border-white/5 pb-8">
                        <!-- Store Address -->
                        <div class="space-y-3 text-left">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center border border-white/10 shrink-0 text-white">
                                    <span class="material-symbols-outlined text-[20px]">location_on</span>
                                </div>
                                <h4 class="font-bold text-white text-sm mb-0">Store Address</h4>
                            </div>
                            <p class="text-xs md:text-sm text-gray-400 leading-relaxed pl-13 mb-0">
                                Commonwealth Ave. Cor. IBP Road (Litex Junction),<br>
                                Brgy. Payatas, Quezon City, 1119<br>
                                Metro Manila, Philippines
                            </p>
                        </div>

                        <!-- Operating Hours -->
                        <div class="space-y-3 text-left">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center border border-white/10 shrink-0 text-white">
                                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                                </div>
                                <h4 class="font-bold text-white text-sm mb-0">Operating Hours</h4>
                            </div>
                            <p class="text-xs md:text-sm text-gray-400 leading-relaxed pl-13 mb-0">
                                Monday – Saturday: 9:00 AM – 6:00 PM<br>
                                Sunday: Closed (Main Store Maintenance)
                            </p>
                        </div>

                        <!-- Phone Line -->
                        <div class="space-y-3 text-left">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center border border-white/10 shrink-0 text-white">
                                    <span class="material-symbols-outlined text-[20px]">call</span>
                                </div>
                                <h4 class="font-bold text-white text-sm mb-0">Phone Line</h4>
                            </div>
                            <p class="text-xs md:text-sm text-gray-400 leading-relaxed pl-13 mb-0">
                                +63 912 345 6789
                            </p>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="rounded-2xl overflow-hidden h-80 border border-white/10 shadow-inner relative group">
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

                <!-- Bottom: Enquiry Form -->
                <div class="bg-white/[0.03] backdrop-blur-md p-8 md:p-10 rounded-[2.5rem] border border-white/10 shadow-2xl text-left">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-white tracking-tight">Send an Enquiry</h3>
                        <p class="text-sm text-gray-400 mt-1">Fill out the form below and our hardware team will reach out within 24 hours.</p>
                    </div>

                    @if (session('success'))
                    <div x-data="{ showBanner: true }"
                        x-show="showBanner"
                        x-init="setTimeout(() => showBanner = false, 6000)"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-4"
                        class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-xl flex items-start gap-3 shadow-sm">
                        <span class="material-symbols-outlined shrink-0 text-green-400" style="font-size: 24px;">check_circle</span>
                        <span class="font-medium text-sm leading-relaxed mt-0.5">{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="/contact/send" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2 ml-1">Recipient Department</label>
                                <input type="text" value="Repairmax Technical Support Desk" disabled
                                    class="w-full px-4 py-3.5 bg-white/5 border border-white/10 rounded-xl text-gray-400 cursor-not-allowed text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2 ml-1">Your Email Address</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400 group-focus-within:text-white transition-colors">mail</span>
                                    </div>
                                    <input type="email" name="from_email" placeholder="hello@example.com" required
                                        class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 text-white rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm shadow-sm placeholder-gray-500">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2 ml-1">Enquiry Subject</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-white transition-colors">description</span>
                                </div>
                                <input type="text" name="subject" placeholder="e.g. Samsung Screen Replacement Quote Request" required
                                    class="w-full pl-12 pr-4 py-3.5 bg-white/5 border border-white/10 text-white rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm shadow-sm placeholder-gray-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-400 mb-2 ml-1">Detailed Message</label>
                            <textarea name="message" rows="5" placeholder="Specify your exact device model, serial number (if any), and symptoms..." required
                                class="w-full px-4 py-3.5 bg-white/5 border border-white/10 text-white rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all resize-none text-sm shadow-sm placeholder-gray-500"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg hover:-translate-y-0.5 duration-200">
                            <span class="material-symbols-outlined text-lg">send</span>
                            Submit Enquiry Form
                        </button>
                    </form>
                </div>

            </div>
        </section>

    </main>
</x-layouts.landing>
