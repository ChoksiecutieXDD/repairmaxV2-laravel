<x-layouts.landing title="Help & Support Center | Repairmax">
    <main class="pt-32 lg:pt-40 pb-24 md:pb-32 bg-[#F9FAFB]">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <span class="text-xs font-black uppercase tracking-widest bg-blue-50 text-blue-600 px-3.5 py-1.5 rounded-full inline-block mb-4 shadow-sm">
                How can we help you today?
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                Help & Support Center
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Choose a channel below to track your ticket, read our frequently asked questions, get in touch with our branch, or chat with our automated systems.
            </p>
        </section>

        <!-- Help Center Dashboard / Hub Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                
                <!-- Card 1: Track Repair -->
                <div class="bg-white rounded-[2rem] border border-gray-200 p-8 md:p-10 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-2xl font-black">track_changes</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 mb-3 tracking-tight">Track Your Repair</h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">
                            Get real-time live updates on your repair stage, technician assignment, diagnostic notes, and estimated pickup times using your unique ticket ID.
                        </p>
                    </div>
                    <a href="{{ route('help.track') }}" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full md:w-fit">
                        <span>Track Repair Status</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 2: FAQs -->
                <div class="bg-white rounded-[2rem] border border-gray-200 p-8 md:p-10 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-2xl font-black">quiz</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 mb-3 tracking-tight">Frequently Asked Questions</h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">
                            Got questions about warranty coverage, standard turnaround times, repair rates, parts quality, or data privacy? Browse our interactive knowledge base.
                        </p>
                    </div>
                    <a href="{{ route('help.faqs') }}" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full md:w-fit">
                        <span>Browse FAQs</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 3: Contact Us -->
                <div class="bg-white rounded-[2rem] border border-gray-200 p-8 md:p-10 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-2xl font-black">support_agent</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 mb-3 tracking-tight">Get in Touch</h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">
                            Locate our flagship service branch in Quezon City, check operating hours, dial our direct phone line, or send us an online enquiry form.
                        </p>
                    </div>
                    <a href="{{ route('help.contact') }}" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full md:w-fit">
                        <span>Contact Support</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <!-- Card 4: AI Diagnostic Support -->
                <div class="bg-white rounded-[2rem] border border-gray-200 p-8 md:p-10 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex flex-col justify-between group">
                    <div>
                        <div class="w-14 h-14 bg-gray-900 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-2xl font-black">smart_toy</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 mb-3 tracking-tight">AI Diagnostic Support</h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">
                            Troubleshoot device glitches, run instant symptom diagnostics, calculate price estimates, or reserve quick-pass queue tickets 24/7.
                        </p>
                    </div>
                    <a href="{{ route('help.ai-support') }}" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-xl transition-all shadow-md text-sm w-full md:w-fit">
                        <span>Launch AI Support</span>
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

            </div>
        </section>

    </main>
</x-layouts.landing>
