<footer class="bg-gradient-to-b from-[#0f172a] to-[#020617] text-gray-400 py-12 md:py-24 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $footerServices = \App\Models\FaultType::orderBy('name', 'asc')->get();
            $screenServices = $footerServices->where('category', 'screen');
            $powerServices = $footerServices->where('category', 'power');
            $audioServices = $footerServices->where('category', 'audio');
            $softwareServices = $footerServices->where('category', 'software');
            $hardwareServices = $footerServices->where('category', 'hardware');
        @endphp
        <!-- Top Services Section -->
        <div class="mb-16">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <!-- Screen & Display -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase mb-4">Screen & Display</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach($screenServices as $service)
                            <li>
                                <a href="/services/{{ $service->id }}" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Power & Battery -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase mb-4">Power & Battery</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach($powerServices as $service)
                            <li>
                                <a href="/services/{{ $service->id }}" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Audio & Sound -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase mb-4">Audio & Sound</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach($audioServices as $service)
                            <li>
                                <a href="/services/{{ $service->id }}" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Software & OS -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase mb-4">Software & OS</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach($softwareServices as $service)
                            <li>
                                <a href="/services/{{ $service->id }}" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Hardware & Modules -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase mb-4">Hardware & Modules</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach($hardwareServices as $service)
                            <li>
                                <a href="/services/{{ $service->id }}" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center md:items-start gap-8 mb-12">
            <div class="max-w-md text-center md:text-left">
                <a href="/" class="transition-colors duration-300 hover:opacity-80 flex items-center justify-center md:justify-start gap-2.5 mb-4" aria-label="Repairmax Home">
                    <img src="{{ asset('img/logo-r-white.png') }}" alt="Repairmax Logo" class="h-8 w-auto">
                    <span class="font-[Montserrat] text-2xl font-bold tracking-tight text-white">Repairmax</span>
                </a>
                <p class="text-sm leading-relaxed">
                    Fast, transparent, and seamless. We are bringing device repair into the 21st century with our digital-first platform.
                </p>
            </div>
            <div class="flex flex-col items-center md:items-end gap-4">
                <div class="flex items-center gap-4">
                    <a href="#" class="text-gray-500 hover:text-gray-100 transition-colors duration-300">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-100 transition-colors duration-300">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3+1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-100 transition-colors duration-300">
                        <span class="sr-only">X (Twitter)</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                </div>
                
                <div class="flex flex-wrap items-center justify-center md:justify-end gap-x-6 gap-y-2 text-xs xl:text-sm text-gray-400">
                    <a href="mailto:repairmaxsample@gmail.com" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-blue-400">mail</span>
                        <span class="truncate">repairmaxsample@gmail.com</span>
                    </a>
                    <a href="tel:+639123456789" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-blue-400">call</span>
                        <span>+63 912 345 6789</span>
                    </a>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span class="material-symbols-outlined text-[16px] text-blue-400">location_on</span>
                        <span>Manila, Philippines</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col gap-6">
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-x-6 gap-y-3 text-sm text-gray-400">
                <a href="/about-us" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">About Us</a>
                <a href="/services" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Our Services</a>
                <a href="/booking" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Book a Repair</a>
                
                <span class="text-gray-700 hidden md:inline">&bull;</span>
                
                <a href="/help/faqs" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">FAQ</a>
                <a href="/help/track" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Track Status</a>
                <a href="/help/contact" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Contact Us</a>
                <a href="/help/ai-support" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">AI Support</a>
                
                <span class="text-gray-700 hidden md:inline">&bull;</span>
                
                <a href="/legal-policy#privacy" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Privacy Policy</a>
                <a href="/legal-policy#terms" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Terms of Service</a>
                <a href="/legal-policy#refund" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Refund Policy</a>
                <a href="/legal-policy#warranty" class="hover:text-gray-100 hover:underline underline-offset-4 transition-all duration-300">Warranty Info</a>
            </div>

            <div class="pt-6 border-t border-gray-800/40 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Repairmax All rights reserved.
                </p>
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <span>Made with</span>
                    <span class="material-symbols-outlined text-sm text-gray-400">favorite</span>
                    <span>in Manila</span>
                </div>
            </div>
        </div>
    </div>
</footer>