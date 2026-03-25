<x-layouts.landing title="Contact Us | Andoy Cellphone Repair Service">
    <main class="pt-32 lg:pt-40 pb-16 md:pb-24">

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                    Get in Touch
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Visit our flagship branch or send us an enquiry online. Our expert technicians are ready to help.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 italic">Andoy Cellphone Repair Service</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-gray-900 mt-1">location_on</span>
                            <div>
                                <p class="font-bold text-gray-900">Flagship Branch</p>
                                <p class="text-gray-600 leading-relaxed">
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
                                <p class="text-gray-600">+63 912 345 6789</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 rounded-2xl overflow-hidden h-64 border border-gray-300">
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

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Enquire Us</h2>

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
                                <input type="text" value="Andoy Repair Support" disabled
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">From (Your Email)</label>
                                <input type="email" name="from_email" placeholder="juan@example.com" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <input type="text" name="subject" placeholder="e.g., Samsung LCD Replacement Quote" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" rows="5" placeholder="Tell us about your device issue..." required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-all flex items-center justify-center gap-2 shadow-lg">
                            <span class="material-symbols-outlined">send</span>
                            Send Enquiry
                        </button>
                    </form>
                </div>

            </div>
        </section>

        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 md:mt-28">
            <div class="bg-gray-900 rounded-3xl p-8 md:p-12 text-center shadow-xl border border-gray-800">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-100 mb-4">No Wait. No Hassle</h2>
                <p class="text-gray-400 mb-8 max-w-2xl mx-auto text-base md:text-lg">
                    We believe in total transparency from the first click. Choose your preferred time slot now and experience a smarter way to handle device repair.
                </p>
                <a href="/booking" class="inline-flex items-center justify-center px-8 py-3.5 text-base md:text-lg font-bold text-gray-900 bg-gray-100 hover:bg-gray-300 rounded-full transition-all duration-300 shadow-lg hover:-translate-y-1">
                    <span class="material-symbols-outlined mr-2">calendar_month</span>
                    Book an Appointment
                </a>
            </div>
        </section>

    </main>
</x-layouts.landing>