<x-layouts.landing title="Repairmax | Home">

    <section id="intro" class="relative w-full min-h-[90vh] flex items-center overflow-hidden pt-28 pb-20 md:pb-28">
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('video/commercial-repairing-scene.mp4') }}" type="video/mp4">
        </video>

        <div class="absolute inset-0 bg-gray-900/85 z-10"></div>

        <div class="relative z-20 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <div class="col-span-1 lg:col-span-7 fade-in-element">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-5 tracking-tight drop-shadow-lg leading-tight">
                        Next-Generation Device Repair
                    </h2>
                    <p class="text-lg md:text-xl text-gray-300 mb-6 lg:mb-8 font-medium leading-relaxed">
                        Fast, transparent, and seamless. We are bringing device repair into the 21st century.
                    </p>

                    <div class="space-y-4 mb-8 lg:mb-10 text-base md:text-lg text-gray-400 leading-relaxed font-light pr-0 lg:pr-8">
                        <h3 class="text-xl md:text-2xl font-semibold text-gray-100 mb-3">Don't Let a Broken Device Slow You Down</h3>
                        <p>We know how critical your smartphone is to your daily routine. Traditional repair shops leave you in the dark with fragmented communication, lost paperwork, and unpredictable wait times. Repairmax was built to eliminate that frustration entirely.</p>
                        <p>We operate on a cutting-edge, digital-first platform. Book your appointment 24/7 through our intelligent AI assistant, skip the line, and drop off your device with confidence.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 flex-wrap">
                        <a href="/booking" class="inline-flex items-center justify-center px-6 md:px-8 py-3 text-base font-bold text-gray-900 bg-gray-100 hover:bg-gray-300 rounded-full transition-all duration-300 shadow-lg hover:-translate-y-1">
                            <span class="material-symbols-outlined mr-2">bolt</span>
                            Start Your Repair
                        </a>
                        <a href="/track-status" class="inline-flex items-center justify-center px-6 md:px-8 py-3 text-base font-bold text-gray-100 bg-transparent border-2 border-gray-500 hover:bg-gray-800 hover:border-gray-400 rounded-full transition-all duration-300">
                            <span class="material-symbols-outlined mr-2">search</span>
                            Track Status
                        </a>
                    </div>
                </div>

                <div class="col-span-1 lg:col-span-5 flex flex-col gap-4 fade-in-element">
                    <div class="bg-gray-900/60 backdrop-blur-md border border-gray-700 p-5 sm:p-6 rounded-2xl flex items-start gap-4 hover:bg-gray-800/80 transition-colors duration-300">
                        <div class="bg-gray-800 p-2.5 rounded-xl border border-gray-600">
                            <span class="material-symbols-outlined text-gray-100 text-2xl">verified</span>
                        </div>
                        <div>
                            <h4 class="text-gray-100 font-bold text-base sm:text-lg mb-1">Certified Techs</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Every technician undergoes rigorous micro-soldering and OEM hardware training.</p>
                        </div>
                    </div>

                    <div class="bg-gray-900/60 backdrop-blur-md border border-gray-700 p-5 sm:p-6 rounded-2xl flex items-start gap-4 hover:bg-gray-800/80 transition-colors duration-300">
                        <div class="bg-gray-800 p-2.5 rounded-xl border border-gray-600">
                            <span class="material-symbols-outlined text-gray-100 text-2xl">timer</span>
                        </div>
                        <div>
                            <h4 class="text-gray-100 font-bold text-base sm:text-lg mb-1">Fast Turnaround</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Most standard repairs are completed in under 2 hours, letting you get back to your life.</p>
                        </div>
                    </div>

                    <div class="bg-gray-900/60 backdrop-blur-md border border-gray-700 p-5 sm:p-6 rounded-2xl flex items-start gap-4 hover:bg-gray-800/80 transition-colors duration-300">
                        <div class="bg-gray-800 p-2.5 rounded-xl border border-gray-600">
                            <span class="material-symbols-outlined text-gray-100 text-2xl">shield</span>
                        </div>
                        <div>
                            <h4 class="text-gray-100 font-bold text-base sm:text-lg mb-1">90-Day Warranty</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">We stand by our work. All replacement parts are covered by our comprehensive guarantee.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-gray-900 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-8 text-center divide-y sm:divide-y-0 sm:divide-x divide-gray-700 fade-in-element">
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

    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16 fade-in-element">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">A Seamless Digital Process</h2>
                <p class="text-base md:text-lg text-gray-600 leading-relaxed">We have eliminated the waiting rooms and confusing paperwork. Our streamlined process gets your device back in your hands faster.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 md:gap-8 fade-in-element">
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

    <section id="services" class="py-20 md:py-28 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 md:mb-16 max-w-3xl mx-auto text-center fade-in-element">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Digital Platform Modules</h2>
                <p class="text-base md:text-lg text-gray-600 leading-relaxed">We leverage custom-built tools designed to optimize your scheduling and the entire repair lifecycle.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 md:gap-8 fade-in-element">
                <article class="sm:col-span-6 lg:col-span-4 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-300 hover:shadow-lg hover:border-gray-500 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-900 text-2xl md:text-3xl" aria-hidden="true">confirmation_number</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Advanced Ticketing</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Every device receives a secure, unique ticket. We track detailed hardware diagnostics, repair milestones, and final quality checks.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-300 hover:shadow-lg hover:border-gray-500 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-900 text-2xl md:text-3xl" aria-hidden="true">smart_toy</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">AI Chatbot Scheduling</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Our automated 24/7 digital assistant fields FAQs, captures your device symptoms, and secures a slot for your drop-off instantly.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-300 hover:shadow-lg hover:border-gray-500 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-900 text-2xl md:text-3xl" aria-hidden="true">analytics</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Management Dashboard</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">A comprehensive backend view for our administrators to oversee technician workloads, track repair times, and ensure strict quality.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-300 hover:shadow-lg hover:border-gray-500 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-900 text-2xl md:text-3xl" aria-hidden="true">notifications_active</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Automated Notifications</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">No more guessing. Our system automatically pushes SMS and email updates directly to your phone the moment your status changes.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-300 hover:shadow-lg hover:border-gray-500 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-900 text-2xl md:text-3xl" aria-hidden="true">inventory_2</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Live Inventory Tracking</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Integrated directly into our ticketing system, we monitor our stock of screens and batteries in real-time so we never delay a repair.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-300 hover:shadow-lg hover:border-gray-500 transition-all duration-300">
                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-gray-900 text-2xl md:text-3xl" aria-hidden="true">receipt_long</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Digital Invoicing</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Generate detailed digital invoices instantly. View warranty details and securely pay online via a unique link before you arrive.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16 fade-in-element">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">The Repairmax Advantage</h2>
                <p class="text-base md:text-lg text-gray-600 leading-relaxed">We don't just replace parts; we restore your device to its optimal factory condition using industry-leading standards.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 md:gap-8 fade-in-element">
                <div class="sm:col-span-6 lg:col-span-4 p-6 md:p-8 border border-gray-200 rounded-2xl bg-gray-50">
                    <span class="material-symbols-outlined text-4xl text-gray-900 mb-5 block">memory</span>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Micro-Soldering Experts</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Not all damage is surface level. Our technicians are trained in complex motherboard diagnostics and micro-component replacement.</p>
                </div>

                <div class="sm:col-span-6 lg:col-span-4 p-6 md:p-8 border border-gray-200 rounded-2xl bg-gray-50">
                    <span class="material-symbols-outlined text-4xl text-gray-900 mb-5 block">precision_manufacturing</span>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Diagnostic Precision</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">We utilize advanced voltage meters and ultrasonic cleaning to identify shorts and liquid damage that other shops completely miss.</p>
                </div>

                <div class="sm:col-span-6 lg:col-span-4 p-6 md:p-8 border border-gray-200 rounded-2xl bg-gray-50">
                    <span class="material-symbols-outlined text-4xl text-gray-900 mb-5 block">fact_check</span>
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3">Rigorous Quality Control</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">Before any device is returned, it undergoes a strict 24-point post-repair inspection to ensure cameras, sensors, and touch screens are flawless.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="repairs" class="py-20 md:py-28 bg-gray-900 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 md:mb-16 max-w-3xl fade-in-element">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-100 mb-4">What We Can Repair</h2>
                <p class="text-base md:text-lg text-gray-400 leading-relaxed">Our expert technicians are trained to handle a wide variety of complex hardware and software issues.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 md:gap-8 fade-in-element">
                <article class="sm:col-span-6 lg:col-span-4 flex flex-col p-6 md:p-8 bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-500 hover:bg-gray-700 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-gray-300 text-3xl" aria-hidden="true">smartphone</span>
                        <h4 class="text-lg md:text-xl font-bold text-gray-100">Screen Replacements</h4>
                    </div>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">We replace cracked, shattered, or unresponsive screens, restoring true-tone color accuracy and perfect touch responsiveness.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 flex flex-col p-6 md:p-8 bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-500 hover:bg-gray-700 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-gray-300 text-3xl" aria-hidden="true">battery_charging_full</span>
                        <h4 class="text-lg md:text-xl font-bold text-gray-100">Battery Issues</h4>
                    </div>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">OEM-quality replacements for degraded batteries that drain too quickly, fail to hold a charge, or cause unexpected shutdowns.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 flex flex-col p-6 md:p-8 bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-500 hover:bg-gray-700 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-gray-300 text-3xl" aria-hidden="true">usb</span>
                        <h4 class="text-lg md:text-xl font-bold text-gray-100">Charging Port</h4>
                    </div>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">Cleaning out micro-debris or completely replacing damaged charging port modules so your device charges securely every time.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 flex flex-col p-6 md:p-8 bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-500 hover:bg-gray-700 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-gray-300 text-3xl" aria-hidden="true">water_drop</span>
                        <h4 class="text-lg md:text-xl font-bold text-gray-100">Water Damage</h4>
                    </div>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">Comprehensive ultrasonic cleaning and motherboard testing to assess short circuits and attempt data recovery from liquid exposure.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 flex flex-col p-6 md:p-8 bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-500 hover:bg-gray-700 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-gray-300 text-3xl" aria-hidden="true">photo_camera</span>
                        <h4 class="text-lg md:text-xl font-bold text-gray-100">Camera & Lens</h4>
                    </div>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">Fixing shattered external camera glass, autofocus issues, or completely replacing modules that produce blurry or blank images.</p>
                </article>

                <article class="sm:col-span-6 lg:col-span-4 flex flex-col p-6 md:p-8 bg-gray-800 rounded-2xl border border-gray-700 hover:border-gray-500 hover:bg-gray-700 transition-colors duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-gray-300 text-3xl" aria-hidden="true">volume_up</span>
                        <h4 class="text-lg md:text-xl font-bold text-gray-100">Audio & Speaker</h4>
                    </div>
                    <p class="text-gray-400 text-sm md:text-base leading-relaxed">Resolving muffled earpieces, blown-out bottom speakers, and failing microphones so your calls and media sound crystal clear again.</p>
                </article>
            </div>
        </div>
    </section>

    <section id="faq" class="py-20 md:py-28 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 md:mb-16 text-center max-w-3xl mx-auto fade-in-element">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-base md:text-lg text-gray-600 leading-relaxed">Comprehensive answers regarding our digital platform, repair processes, and policies.</p>
            </div>

            <div class="max-w-4xl mx-auto flex flex-col gap-8 fade-in-element">

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">schedule</span>
                            Appointment Scheduling
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">Our AI-driven chatbot acts as a smart digital receptionist. It collects preliminary data about your device model, the symptoms you are experiencing, and cross-references our live technician calendar. You can view available slots, confirm an appointment, and receive a digital ticket code entirely on your own—24 hours a day, 7 days a week.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">sync</span>
                            Real-Time Tracking
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">Yes. Once your device is logged into our system at drop-off, a unique digital ticket ID is generated. You can enter this ID on our tracking portal. As our technicians update the diagnostic, parts-ordering, or repair stages on their backend dashboard, the system immediately pushes the status live, ensuring you are never left in the dark.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">timer</span>
                            Typical Repair Times
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">Most standard repairs, such as battery replacements and screen swaps, are completed within 1 to 2 hours of your scheduled appointment time. Complex issues like motherboard diagnostics or severe water damage may require 24 to 48 hours for thorough testing.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">verified</span>
                            Parts Warranty
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">Absolutely. We stand by the quality of our work. All screen, battery, and standard hardware replacements come with a 90-day limited warranty covering manufacturer defects and installation errors. This warranty does not cover future accidental drops or new liquid damage.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">security</span>
                            Data Security & Privacy
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">Data privacy is our top priority. For the device itself, we only request your passcode if post-repair testing requires it (e.g., testing the camera or speakers), and we never browse, copy, or back up your personal files without explicit, signed consent.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">cloud_upload</span>
                            Do I need to back up my device?
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">While we take every precaution to ensure your data is safe, we highly recommend backing up your device to iCloud, Google Drive, or a physical computer before bringing it in. Hardware repairs can occasionally cause unexpected software resets, and we want to ensure your data is 100% secure.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">directions_walk</span>
                            Do you accept walk-ins?
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">While we do accept walk-ins, we highly recommend booking an appointment through our AI chatbot. Booking ahead allows you to skip the queue and ensures we have the necessary parts in stock and set aside for your specific device model before you arrive.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">water_damage</span>
                            What if my phone has water damage?
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">Turn off your device immediately and do not attempt to charge it. Bring it in as soon as possible. Our technicians will completely disassemble the unit and utilize specialized ultrasonic cleaning tanks to remove corrosive minerals from the motherboard before attempting a safe boot.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">build_circle</span>
                            Do you use original (OEM) parts?
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">We strictly prioritize using original equipment manufacturer (OEM) or premium factory-grade parts. This guarantees that vital elements like screen color accuracy, True Tone capability, and battery power cycle capacity perform exactly to the original manufacturer's specifications.</p>
                    </div>
                </details>

                <details class="group border border-gray-300 bg-white hover:border-gray-400 rounded-2xl shadow-sm transition-all duration-300 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between p-5 md:p-6 cursor-pointer text-base md:text-lg font-semibold text-gray-900">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-gray-500 group-open:text-gray-900 transition-colors duration-300" aria-hidden="true">payment</span>
                            How do I pay for my repair?
                        </div>
                        <span class="material-symbols-outlined text-gray-400 transition duration-300 group-open:rotate-180">expand_more</span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 text-gray-600 text-sm md:text-base leading-relaxed pt-1 border-t border-gray-100 mt-2">
                        <p class="pt-3">We offer a completely seamless digital invoicing process. Once your repair is complete, you will receive a secure payment link via SMS or email. You can pay online using major credit cards or mobile wallets before picking up your device, or you can choose to pay in-store.</p>
                    </div>
                </details>

            </div>
        </div>
    </section>
</x-layouts.landing>