<x-layouts.landing title="24/7 AI Diagnostic Support | Repairmax">
    <main class="pt-32 lg:pt-40 pb-24 md:pb-32 bg-[#F9FAFB]">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <span class="text-xs font-black uppercase tracking-widest bg-blue-50 text-blue-600 px-3.5 py-1.5 rounded-full inline-block mb-4 shadow-sm">
                24/7 Virtual Diagnostic Agent
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 tracking-tight">
                AI Diagnostic Support
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Troubleshoot hardware errors, diagnose device symptoms, estimate costs, and track appointments in real-time with our advanced AI diagnostic companion.
            </p>
        </section>

        <!-- Main Promotional Panel -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded-[3rem] p-8 md:p-16 border border-gray-800 text-white shadow-2xl relative overflow-hidden text-left">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(59,130,246,0.06),transparent)]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_80%,rgba(99,102,241,0.06),transparent)]"></div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    
                    <!-- Left Copy & CTAs -->
                    <div>
                        <div class="w-14 h-14 bg-white/10 text-white rounded-2xl flex items-center justify-center mb-8 border border-white/10 shadow-lg shadow-blue-500/5">
                            <span class="material-symbols-outlined text-2xl font-black">smart_toy</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6 tracking-tight leading-tight">
                            Experience next-gen automated device repair help.
                        </h2>
                        <p class="text-gray-400 mb-8 leading-relaxed text-sm md:text-base">
                            Why wait on hold? Our AI Assistant connects directly to our inventory database and tracking systems. It is trained on thousands of hardware manuals to pinpoint hardware faults and estimate repair times within seconds.
                        </p>
                        
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('login') }}" class="px-8 py-4 text-sm font-bold text-gray-900 bg-white hover:bg-gray-100 rounded-2xl transition-all duration-300 shadow-md active:scale-95">
                                Log In to Chat
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-4 text-sm font-bold text-white border border-white/20 hover:bg-white/5 rounded-2xl transition-all duration-300">
                                Create Free Account
                            </a>
                        </div>
                    </div>

                    <!-- Right Capabilities Grid -->
                    <div class="bg-white/5 rounded-[2rem] border border-white/10 p-6 md:p-10 backdrop-blur-md space-y-6">
                        <h4 class="font-extrabold text-xl mb-2 text-white tracking-tight">AI Agent Capabilities</h4>
                        
                        <ul class="space-y-6">
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[16px] font-black">check</span>
                                </div>
                                <div>
                                    <strong class="text-white block text-sm">Real-time status updates</strong>
                                    <span class="text-xs text-gray-400 leading-relaxed mt-0.5 block">
                                        Input your tracking code inside the chat window to get precise stages, technician diagnostics, and repair timelines immediately.
                                    </span>
                                </div>
                            </li>

                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[16px] font-black">check</span>
                                </div>
                                <div>
                                    <strong class="text-white block text-sm">Hardware Symptom Diagnosis</strong>
                                    <span class="text-xs text-gray-400 leading-relaxed mt-0.5 block">
                                        Describe what is wrong with your phone or laptop (e.g. boot loops, black screens, static audio) and get an analysis of the component responsible.
                                    </span>
                                </div>
                            </li>

                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[16px] font-black">check</span>
                                </div>
                                <div>
                                    <strong class="text-white block text-sm">Immediate Booking & Reservation</strong>
                                    <span class="text-xs text-gray-400 leading-relaxed mt-0.5 block">
                                        Reserve hardware parts in stock or lock in immediate physical queuing tickets to bypass standard desk wait times.
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>

    </main>
</x-layouts.landing>
