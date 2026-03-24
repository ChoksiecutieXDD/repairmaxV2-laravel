<x-layouts.landing title="Legal & Policies | Repairmax">
    <main class="pt-32 lg:pt-40 pb-16 md:pb-24 min-h-[80vh]">

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 fade-in-element text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                    Legal & Policies
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Everything you need to know about how we protect your data, our terms of service, and our repair guarantees.
                </p>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in-element">
            <div class="flex flex-col lg:flex-row gap-10"
                x-data="{ activeTab: window.location.hash || '#privacy' }"
                @hashchange.window="activeTab = window.location.hash || '#privacy'">

                <aside class="lg:w-1/4">
                    <div class="sticky top-32 bg-white rounded-3xl p-6 shadow-sm border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Policies</h3>
                        <nav class="flex flex-col space-y-3">
                            <a href="#privacy"
                                @click="activeTab = '#privacy'"
                                class="flex items-center transition-colors"
                                :class="activeTab === '#privacy' ? 'text-gray-900 font-bold bg-gray-50 p-2 rounded-lg' : 'text-gray-600 hover:text-gray-900 font-medium'">
                                <span class="material-symbols-outlined text-lg mr-2">shield</span>
                                Privacy Policy
                            </a>
                            <a href="#terms"
                                @click="activeTab = '#terms'"
                                class="flex items-center transition-colors"
                                :class="activeTab === '#terms' ? 'text-gray-900 font-bold bg-gray-50 p-2 rounded-lg' : 'text-gray-600 hover:text-gray-900 font-medium'">
                                <span class="material-symbols-outlined text-lg mr-2">gavel</span>
                                Terms of Service
                            </a>
                            <a href="#refund"
                                @click="activeTab = '#refund'"
                                class="flex items-center transition-colors"
                                :class="activeTab === '#refund' ? 'text-gray-900 font-bold bg-gray-50 p-2 rounded-lg' : 'text-gray-600 hover:text-gray-900 font-medium'">
                                <span class="material-symbols-outlined text-lg mr-2">currency_exchange</span>
                                Refund Policy
                            </a>
                            <a href="#warranty"
                                @click="activeTab = '#warranty'"
                                class="flex items-center transition-colors"
                                :class="activeTab === '#warranty' ? 'text-gray-900 font-bold bg-gray-50 p-2 rounded-lg' : 'text-gray-600 hover:text-gray-900 font-medium'">
                                <span class="material-symbols-outlined text-lg mr-2">verified</span>
                                Warranty Info
                            </a>
                        </nav>
                    </div>
                </aside>

                <div class="lg:w-3/4">

                    <div x-show="activeTab === '#privacy'" x-cloak style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                            <span class="material-symbols-outlined text-3xl mr-3 text-gray-700">shield</span>
                            Privacy Policy
                        </h2>
                        <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                            <p>At Repairmax, your privacy is our priority. We only collect information necessary to complete your repair and keep you updated on its status.</p>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Data Protection on Devices</h3>
                            <p>Our technicians will never access your personal files, photos, or messages unless explicitly required to test a specific function.</p>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Information We Collect</h3>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Contact information (Name, Email, Phone Number) for repair updates.</li>
                                <li>Device passcodes (only if required for post-repair diagnostic testing).</li>
                                <li>Payment information processed securely through our third-party payment gateways.</li>
                            </ul>
                        </div>
                    </div>

                    <div x-show="activeTab === '#terms'" x-cloak style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                            <span class="material-symbols-outlined text-3xl mr-3 text-gray-700">gavel</span>
                            Terms of Service
                        </h2>
                        <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                            <p>By using Repairmax services, you agree to the following terms and conditions regarding the repair of your electronic devices.</p>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Abandoned Devices</h3>
                            <p>Devices left at our facility for more than <strong>60 days</strong> after the repair completion notification has been sent will be considered abandoned. Repairmax reserves the right to recycle or sell abandoned devices.</p>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Pre-existing Conditions</h3>
                            <p>Repairmax is not responsible for pre-existing issues or damage not related to the specific repair requested. We will halt the repair and contact you with an updated quote before proceeding if new issues arise.</p>
                        </div>
                    </div>

                    <div x-show="activeTab === '#refund'" x-cloak style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                            <span class="material-symbols-outlined text-3xl mr-3 text-gray-700">currency_exchange</span>
                            Refund Policy
                        </h2>
                        <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                            <p>We strive to ensure every customer is satisfied with their repair, but we understand that issues can occasionally arise.</p>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Labor and Diagnostic Fees</h3>
                            <p>Diagnostic fees and labor charges are <strong>strictly non-refundable</strong> once the service has been performed, as these cover the technician's time and expertise.</p>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Parts Refunds</h3>
                            <p>If you wish to return a part installed by us, you have 7 days to request a reversal. A restocking fee of 15% will apply, and the labor fee will not be refunded.</p>
                        </div>
                    </div>

                    <div x-show="activeTab === '#warranty'" x-cloak style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-200">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                            <span class="material-symbols-outlined text-3xl mr-3 text-gray-700">verified</span>
                            Warranty Information
                        </h2>
                        <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                            <p>We stand by the quality of our OEM-grade parts and the expertise of our certified technicians.</p>
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 my-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">The Repairmax 90-Day Guarantee</h3>
                                <p class="text-sm">All standard repairs come with a comprehensive 90-day warranty against manufacturer defects in the replacement parts.</p>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">What is NOT Covered:</h3>
                            <ul class="list-disc pl-5 space-y-2">
                                <li><strong>Subsequent Accidental Damage:</strong> Cracking your new screen or dropping the device.</li>
                                <li><strong>Liquid Damage:</strong> Exposure to water or moisture after the repair.</li>
                                <li><strong>Software Issues:</strong> Operating system glitches or third-party app crashes.</li>
                                <li><strong>Tampering:</strong> If the device is opened by another repair shop or the user after our repair, the warranty is instantly voided.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
</x-layouts.landing>