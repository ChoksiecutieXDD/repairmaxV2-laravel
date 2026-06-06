<x-layouts.landing :title="$article['title'] . ' | Repairmax Help Center'">
    <main class="relative pt-32 lg:pt-40 pb-24 md:pb-32 overflow-hidden bg-[#020617]">
        <!-- Glow Effects -->
        <div class="absolute top-1/4 left-1/4 w-125 h-125 bg-blue-900/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-125 h-125 bg-indigo-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs / Back navigation -->
            <div class="mb-8 text-left">
                <a href="{{ route('help') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm font-semibold">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Back to Help Center
                </a>
            </div>

            <!-- Main Article Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start text-left">
                <!-- Left Sidebar: Category Navigation -->
                <aside class="lg:col-span-4 bg-white/[0.03] backdrop-blur-md p-6 rounded-3xl border border-white/10 space-y-6">
                    <h3 class="text-sm font-black uppercase tracking-widest text-blue-400">Articles in this category</h3>
                    <ul class="space-y-4 text-sm">
                        @if($article['category'] === 'Getting Started & Guides')
                            <li>
                                <a href="/help/article/prepare-phone-repair" class="block transition-colors font-medium {{ request()->is('*/prepare-phone-repair') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">How to prepare your phone for repair</a>
                            </li>
                            <li>
                                <a href="/help/article/diagnostics-report" class="block transition-colors font-medium {{ request()->is('*/diagnostics-report') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">Understanding the diagnostics report</a>
                            </li>
                            <li>
                                <a href="/help/article/liquid-damage" class="block transition-colors font-medium {{ request()->is('*/liquid-damage') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">What to do if your phone is liquid damaged</a>
                            </li>
                        @elseif($article['category'] === 'Warranty & Policies')
                            <li>
                                <a href="/help/article/warranty-policy" class="block transition-colors font-medium {{ request()->is('*/warranty-policy') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">How the 90-Day Warranty works</a>
                            </li>
                            <li>
                                <a href="/help/faqs" class="block text-gray-400 hover:text-white transition-colors font-medium">Frequently Asked Questions (FAQ)</a>
                            </li>
                        @elseif($article['category'] === 'Accounts & Payments')
                            <li>
                                <a href="/help/article/payment-methods" class="block transition-colors font-medium {{ request()->is('*/payment-methods') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">How to pay using GCash / Maya online</a>
                            </li>
                            <li>
                                <a href="/help/article/receipt-details" class="block transition-colors font-medium {{ request()->is('*/receipt-details') ? 'text-white font-bold' : 'text-gray-400 hover:text-white' }}">Getting a physical corporate receipt</a>
                            </li>
                        @endif
                    </ul>
                </aside>

                <!-- Right Content: The Article -->
                <article class="lg:col-span-8 bg-white/[0.03] backdrop-blur-md p-8 md:p-12 rounded-[2.5rem] border border-white/10 shadow-2xl space-y-6">
                    <div>
                        <span class="text-xs font-black uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full inline-block mb-4">
                            {{ $article['category'] }}
                        </span>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">
                            {{ $article['title'] }}
                        </h1>
                    </div>

                    <div class="text-gray-300 leading-relaxed text-base md:text-lg border-t border-white/5 pt-6 space-y-4">
                        {!! $article['content'] !!}
                    </div>

                    <!-- Was this article helpful? feedback section -->
                    <div class="border-t border-white/5 pt-8 mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-400">
                        <span>Was this article helpful?</span>
                        <div class="flex gap-3">
                            <button class="px-4 py-2 bg-white/5 hover:bg-green-500/20 hover:text-green-400 border border-white/10 rounded-xl transition-all duration-200 flex items-center gap-1.5 cursor-pointer">
                                <span class="material-symbols-outlined text-base">thumb_up</span>
                                Yes
                            </button>
                            <button class="px-4 py-2 bg-white/5 hover:bg-red-500/20 hover:text-red-400 border border-white/10 rounded-xl transition-all duration-200 flex items-center gap-1.5 cursor-pointer">
                                <span class="material-symbols-outlined text-base">thumb_down</span>
                                No
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>
</x-layouts.landing>
