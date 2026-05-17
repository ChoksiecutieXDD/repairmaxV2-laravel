<x-layouts.landing title="About Us | Repairmax">
    <main class="pt-32 lg:pt-40 py-16 md:py-24 !pt-40">

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24 fade-in-element">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                    Redefining Device Repair
                </h1>
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    We started Repairmax because we were tired of the standard repair shop experience. Long waits, hidden fees, and zero transparency shouldn't be the norm when your digital life is on the line.
                </p>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 md:mb-28">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center fade-in-element">
                <div class="relative rounded-3xl h-80 md:h-[500px] w-full flex items-center justify-center overflow-hidden shadow-2xl group">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.05),transparent)] opacity-50"></div>
                    <div class="relative z-10 flex flex-col items-center gap-4">
                        <div class="w-24 h-24 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-700">
                            <span class="material-symbols-outlined text-6xl text-white/80">engineering</span>
                        </div>
                        <div class="h-1 w-20 bg-gradient-to-r from-transparent via-white/20 to-transparent rounded-full"></div>
                    </div>

                    <!-- Floating Badges -->
                    <div class="absolute top-10 left-10 bg-white/10 backdrop-blur-md border border-white/10 px-4 py-2 rounded-full flex items-center gap-2 shadow-xl animate-bounce-slow">
                        <span class="material-symbols-outlined text-green-400 text-sm">verified</span>
                        <span class="text-white text-xs font-bold uppercase tracking-wider">100% Guarantee</span>
                    </div>

                    <div class="absolute bottom-12 right-8 bg-white/10 backdrop-blur-md border border-white/10 px-4 py-2 rounded-xl flex items-center gap-2 shadow-xl animate-float">
                        <span class="material-symbols-outlined text-blue-400 text-sm">workspace_premium</span>
                        <span class="text-white text-xs font-bold">Premium OEM Parts</span>
                    </div>

                    <style>
                        @keyframes bounce-slow {
                            0%, 100% { transform: translateY(0); }
                            50% { transform: translateY(-10px); }
                        }
                        @keyframes float {
                            0%, 100% { transform: translate(0, 0); }
                            50% { transform: translate(-5px, -15px); }
                        }
                        .animate-bounce-slow { animation: bounce-slow 4s ease-in-out infinite; }
                        .animate-float { animation: float 6s ease-in-out infinite; }
                    </style>
                </div>

                <div class="flex flex-col justify-center text-center lg:text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Built on Transparency and Tech</h2>
                    <p class="text-base md:text-lg text-gray-600 mb-5 leading-relaxed">
                        Traditional repair shops operate in a black box. You hand over your expensive device and hope for the best. At Repairmax, we realized that the solution wasn't just hiring better technicians—it was building better technology to manage the process.
                    </p>
                    <p class="text-base md:text-lg text-gray-600 mb-8 leading-relaxed">
                        By integrating AI chatbots for scheduling, live tracking dashboards, and strict quality control protocols, we've created a digital-first ecosystem. Our certified micro-soldering experts focus on fixing your hardware, while our software keeps you informed every step of the way.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="flex flex-col items-center text-center lg:items-start lg:text-left gap-3">
                            <span class="material-symbols-outlined text-gray-900 text-3xl">verified_user</span>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Absolute Privacy</h4>
                                <p class="text-sm text-gray-600">Your data remains yours. We never wipe or browse devices without consent.</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center text-center lg:items-start lg:text-left gap-3">
                            <span class="material-symbols-outlined text-gray-900 text-3xl">recycling</span>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">E-Waste Conscious</h4>
                                <p class="text-sm text-gray-600">We responsibly recycle all damaged lithium batteries and shattered LCDs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- What We Repair Section -->
        <section id="what-we-repair" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 md:mb-24 fade-in-element">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">
                    What We Repair
                </h2>
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    From cracked screens to complex logic board failures, we provide factory-grade repairs using precision instrumentation and OEM-quality components.
                </p>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 md:mb-28">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 fade-in-element flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <span class="material-symbols-outlined text-3xl">screenshot</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Display Restoration</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">Complete assembly replacement for OLED and LCD panels. We prioritize True Tone retention and 3D touch calibration.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-green-600">check_circle</span> Glass & Digitizer</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-green-600">check_circle</span> Backlight Repair</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 fade-in-element flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <span class="material-symbols-outlined text-3xl">memory</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Micro-Soldering</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">Advanced motherboard repair including IC chip replacement, FPC connector repair, and trace reconstruction under high magnification.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-green-600">check_circle</span> Short Circuit Detection</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-green-600">check_circle</span> Audio IC & Charge Port IC</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 fade-in-element flex flex-col items-center text-center">
                    <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <span class="material-symbols-outlined text-3xl">battery_charging_full</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Power Optimization</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">Replacement of degraded lithium cells. We use high-cycle capacity batteries that meet or exceed original manufacturer specs.</p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-green-600">check_circle</span> Cycle Count Reset</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-sm text-green-600">check_circle</span> Thermal Management Testing</li>
                    </ul>
                </div>

            </div>
        </section>

        <!-- Our Technical Standards Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 md:mb-28">
            <div class="bg-white rounded-[2.5rem] p-8 md:p-16 border border-gray-200 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-in-element">
                <div class="text-center lg:text-left">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Technical Standards</h3>
                    <div class="space-y-10">
                        <div class="flex flex-col items-center text-center lg:items-start lg:text-left gap-4">
                            <div class="bg-gray-100 p-3 rounded-2xl text-gray-900 shadow-sm">
                                <span class="material-symbols-outlined text-3xl">precision_manufacturing</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Ultrasonic Cleaning</h4>
                                <p class="text-gray-600">For water-damaged units, we utilize specialized ultrasonic tanks to strip corrosion from hidden logic board layers.</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center text-center lg:items-start lg:text-left gap-4">
                            <div class="bg-gray-100 p-3 rounded-2xl text-gray-900 shadow-sm">
                                <span class="material-symbols-outlined text-3xl">fact_check</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">24-Point Inspection</h4>
                                <p class="text-gray-600">Every device undergoes automated hardware testing post-repair to ensure FaceID, haptics, and sensors are 100% functional.</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center text-center lg:items-start lg:text-left gap-4">
                            <div class="bg-gray-100 p-3 rounded-2xl text-gray-900 shadow-sm">
                                <span class="material-symbols-outlined text-3xl">history_edu</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Digital Service Records</h4>
                                <p class="text-gray-600">Your repair history is logged securely, providing a digital paper trail for future resale or warranty claims.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div class="relative rounded-[2.5rem] h-[450px] w-full flex items-center justify-center overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-gray-950"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.03),transparent)]"></div>
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="p-8 rounded-[3rem] bg-white/5 backdrop-blur-3xl border border-white/10 shadow-2xl group-hover:scale-105 transition-all duration-500">
                                <span class="material-symbols-outlined text-[6rem] text-white/70">biotech</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute bottom-6 right-6 bg-white p-4 md:p-6 rounded-2xl shadow-lg border border-gray-100">
                        <p class="text-xl md:text-2xl font-bold text-gray-900">99.2%</p>
                        <p class="text-[10px] md:text-xs text-gray-500 uppercase tracking-wider">Success Rate</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in-element">
            <div class="bg-gray-900 rounded-3xl p-8 md:p-12 text-center shadow-xl border border-gray-800">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-100 mb-4">Experience the Difference Today</h2>
                <p class="text-gray-400 mb-8 max-w-2xl mx-auto text-base md:text-lg">
                    Ready to get your device back to factory condition? Let our automated system find the perfect time slot for you.
                </p>
                <a href="/booking" class="inline-flex items-center justify-center px-8 py-3.5 text-base md:text-lg font-bold text-gray-900 bg-gray-100 hover:bg-gray-300 rounded-full transition-all duration-300 shadow-lg hover:-translate-y-1">
                    <span class="material-symbols-outlined mr-2">calendar_month</span>
                    Book an Appointment
                </a>
            </div>
        </section>

    </main>
</x-layouts.landing>