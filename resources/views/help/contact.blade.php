<x-layouts.landing title="Contact Support Center | Repairmax">
    <main class="pt-32 lg:pt-40 pb-24 md:pb-32 bg-[#F9FAFB]">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Contact Us</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Need customized support? Speak directly to our technicians, find our flagship service branch, or submit an enquiry online.
            </p>
        </section>

        <!-- Main Layout Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                <!-- Left: Branch details & Map -->
                <div class="lg:col-span-5 bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-200 text-left space-y-8">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest bg-blue-50 text-blue-600 px-3 py-1 rounded-full inline-block mb-3">Flagship Store</span>
                        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Repairmax Service Desk</h3>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center border border-gray-150 shrink-0 text-gray-900">
                                <span class="material-symbols-outlined text-[20px] font-bold">location_on</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Store Address</p>
                                <p class="text-xs md:text-sm text-gray-600 leading-relaxed mt-1">
                                    Commonwealth Ave. Cor. IBP Road (Litex Junction),<br>
                                    Brgy. Payatas, Quezon City, 1119<br>
                                    Metro Manila, Philippines
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center border border-gray-150 shrink-0 text-gray-900">
                                <span class="material-symbols-outlined text-[20px] font-bold">schedule</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Operating Hours</p>
                                <p class="text-xs md:text-sm text-gray-600 leading-relaxed mt-1">
                                    Monday – Saturday: 9:00 AM – 6:00 PM<br>
                                    Sunday: Closed (Main Store Maintenance)
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center border border-gray-150 shrink-0 text-gray-900">
                                <span class="material-symbols-outlined text-[20px] font-bold">call</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm">Phone Line</p>
                                <p class="text-xs md:text-sm text-gray-600 leading-relaxed mt-1">+63 912 345 6789</p>
                            </div>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="rounded-2xl overflow-hidden h-64 border border-gray-200 shadow-inner relative group">
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

                <!-- Right: Enquiry Form -->
                <div class="lg:col-span-7 bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-200 text-left">
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Send an Enquiry</h3>
                        <p class="text-sm text-gray-500 mt-1">Fill out the form below and our hardware team will reach out within 24 hours.</p>
                    </div>

                    @if (session('success'))
                    <div x-data="{ showBanner: true }"
                        x-show="showBanner"
                        x-init="setTimeout(() => showBanner = false, 6000)"
                        x-transition:leave="transition ease-in duration-300 transform"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-4"
                        class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-start gap-3 shadow-sm">
                        <span class="material-symbols-outlined shrink-0 text-green-600" style="font-size: 24px;">check_circle</span>
                        <span class="font-medium text-sm leading-relaxed mt-0.5">{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="/contact/send" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Recipient Department</label>
                                <input type="text" value="Repairmax Technical Support Desk" disabled
                                    class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Your Email Address</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400 group-focus-within:text-gray-900 transition-colors">mail</span>
                                    </div>
                                    <input type="email" name="from_email" placeholder="hello@example.com" required
                                        class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all text-sm shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Enquiry Subject</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400 group-focus-within:text-gray-900 transition-colors">description</span>
                                </div>
                                <input type="text" name="subject" placeholder="e.g. Samsung Screen Replacement Quote Request" required
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all text-sm shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Detailed Message</label>
                            <textarea name="message" rows="5" placeholder="Specify your exact device model, serial number (if any), and symptoms..." required
                                class="w-full px-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all resize-none text-sm shadow-sm"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-all flex items-center justify-center gap-2 shadow-lg hover:-translate-y-0.5 duration-200">
                            <span class="material-symbols-outlined text-lg">send</span>
                            Submit Enquiry Form
                        </button>
                    </form>
                </div>

            </div>
        </section>

    </main>
</x-layouts.landing>
