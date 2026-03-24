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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">

                <div class="space-y-8">
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
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Enquire Us</h2>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-start gap-3">
                            <span class="material-symbols-outlined text-green-600 flex-shrink-0">check_circle</span>
                            <div>
                                <p class="font-semibold">{{ session('success') }}</p>
                                @if (session('success_message'))
                                    <p class="text-sm mt-1">{{ session('success_message') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-start gap-3">
                            <span class="material-symbols-outlined text-red-600 flex-shrink-0">error</span>
                            <div>
                                <p class="font-semibold">{{ session('error') }}</p>
                                @if (session('error_details'))
                                    <p class="text-sm mt-1">{{ session('error_details') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl">
                            <p class="font-semibold mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-yellow-600">warning</span>
                                Please fix the following errors:
                            </p>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/contact/send" method="POST" class="space-y-5">
                        @csrf <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">To</label>
                                <input type="text" value="Andoy Repair Support" disabled
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">From (Your Email)</label>
                                <input type="email" name="from_email" placeholder="juan@example.com" required
                                    value="{{ old('from_email') }}"
                                    class="w-full px-4 py-3 border @if($errors->has('from_email')) border-red-500 @else border-gray-200 @endif rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all">
                                @error('from_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                            <input type="text" name="subject" placeholder="e.g., Samsung LCD Replacement Quote" required
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 border @if($errors->has('subject')) border-red-500 @else border-gray-200 @endif rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea name="message" rows="5" placeholder="Tell us about your device issue..." required
                                class="w-full px-4 py-3 border @if($errors->has('message')) border-red-500 @else border-gray-200 @endif rounded-xl focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none transition-all resize-none">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition-all flex items-center justify-center gap-2 shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                            <span class="material-symbols-outlined">send</span>
                            Send Enquiry
                        </button>

                    </form>
                </div>

            </div>
        </section>

        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 md:mt-28 fade-in-element">
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