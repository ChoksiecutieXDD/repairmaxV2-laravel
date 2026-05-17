<x-layouts.landing title="Frequently Asked Questions | Repairmax">
    <main class="pt-32 lg:pt-40 pb-24 md:pb-32 bg-[#F9FAFB]">

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Frequently Asked Questions</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Quick answers to common questions about our repair workflow, pricing systems, warranty, and how we handle your tech.
            </p>
        </section>

        <!-- FAQs Portal with Real-Time Alpine Search -->
        <section x-data="{
            searchQuery: '',
            categories: [
                {
                    name: 'General & Service',
                    icon: 'build',
                    faqs: [
                        {
                            q: 'How long does a typical repair take?',
                            a: 'Most screen replacements, battery replacements, and modular component repairs are completed within 1-2 hours of drop-off. More complex operations like motherboard repairs or water damage treatments typically require 3-5 business days.'
                        },
                        {
                            q: 'Do I need to book an appointment beforehand?',
                            a: 'While we happily accept walk-ins at our flagship Quezon City branch, booking an appointment online guarantees your parts are reserved in stock and your technician is allocated to begin work the moment you arrive.'
                        },
                        {
                            q: 'What brand devices do you repair?',
                            a: 'We offer extensive out-of-warranty hardware and software repairs for all major manufacturers, including Apple (iPhones, iPads, MacBooks), Samsung (Galaxy phones & tablets), Google Pixel, Xiaomi, Oppo, Asus, and Huawei.'
                        }
                    ]
                },
                {
                    name: 'Pricing & Warranty',
                    icon: 'payments',
                    faqs: [
                        {
                            q: 'How do you calculate repair costs?',
                            a: 'Our pricing is completely transparent and consists of direct parts cost + standard service labor. We never charge hidden diagnostic fees or add surprise surcharges. You will receive an exact invoice itemization before we begin.'
                        },
                        {
                            q: 'What does your Nationwide Warranty cover?',
                            a: 'All repairs are backed by our signature 90-Day Nationwide Service Warranty. This covers any performance defects or component malfunctions of the replaced part. It does not cover subsequent physical or liquid damage.'
                        },
                        {
                            q: 'What payment options do you support?',
                            a: 'We support all major payment types at our service desk, including Cash, G-Cash, PayMaya, Bank Transfers (BDO, BPI), and credit/debit cards.'
                        }
                    ]
                },
                {
                    name: 'Data & Device Security',
                    icon: 'security',
                    faqs: [
                        {
                            q: 'Is my personal data safe during the repair?',
                            a: 'Absolutely. We follow strict privacy protocols. We do not require your password/passcode unless it is absolutely necessary for hardware test validation, and our technicians never access your files, media, or accounts.'
                        },
                        {
                            q: 'Should I back up my device before bringing it in?',
                            a: 'We always recommend backing up your data to iCloud or Google Drive prior to any hardware repair as an industry best practice, even though data loss during our standard screen or battery replacement is extremely rare.'
                        }
                    ]
                }
            ],
            matches(faq) {
                if (!this.searchQuery) return true;
                const query = this.searchQuery.toLowerCase();
                return faq.q.toLowerCase().includes(query) || faq.a.toLowerCase().includes(query);
            },
            hasMatches(category) {
                return category.faqs.some(faq => this.matches(faq));
            }
        }" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search Box -->
            <div class="mb-12 relative max-w-xl mx-auto">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">search</span>
                </div>
                <input x-model="searchQuery" type="text" placeholder="Search FAQ database (e.g. warranty, time)..."
                    class="w-full pl-14 pr-5 py-4 bg-white border border-gray-200 rounded-2xl outline-none focus:ring-4 focus:ring-gray-900/5 focus:border-gray-900 transition-all text-base shadow-sm">
            </div>

            <!-- Categories and Accordions -->
            <div class="space-y-12">
                <template x-for="cat in categories" :key="cat.name">
                    <div x-show="hasMatches(cat)" x-transition class="space-y-6 text-left">
                        
                        <div class="flex items-center gap-3 border-b border-gray-200 pb-3">
                            <span class="material-symbols-outlined text-gray-500 text-xl" x-text="cat.icon"></span>
                            <h3 class="text-sm font-black uppercase tracking-widest text-gray-400" x-text="cat.name"></h3>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(faq, idx) in cat.faqs" :key="faq.q">
                                <div x-show="matches(faq)" 
                                     x-data="{ open: false }" 
                                     class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm transition-all duration-300"
                                     :class="open ? 'shadow-md border-gray-300' : ''">
                                    
                                    <!-- Accordion Header -->
                                    <button @click="open = !open" 
                                            class="w-full px-6 py-5 flex items-center justify-between text-left font-bold text-gray-900 hover:bg-gray-50 transition-colors gap-4">
                                        <span class="text-base md:text-lg" x-text="faq.q"></span>
                                        <span class="material-symbols-outlined text-gray-500 transition-transform duration-300 select-none"
                                              :class="open ? 'rotate-180' : ''">keyboard_arrow_down</span>
                                    </button>

                                    <!-- Accordion Content -->
                                    <div x-show="open" 
                                         x-collapse
                                         x-transition:enter="transition ease-out duration-250"
                                         x-transition:enter-start="opacity-0 max-h-0"
                                         x-transition:enter-end="opacity-100 max-h-screen"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100 max-h-screen"
                                         x-transition:leave-end="opacity-0 max-h-0"
                                         class="px-6 pb-6 pt-1 text-sm text-gray-600 leading-relaxed border-t border-gray-100 bg-gray-50/50">
                                        <p x-text="faq.a"></p>
                                    </div>

                                </div>
                            </template>
                        </div>

                    </div>
                </template>

                <!-- No Results Notice -->
                <div x-show="categories.every(cat => !hasMatches(cat))" x-transition 
                     class="bg-white rounded-3xl p-12 border border-gray-200 text-center max-w-xl mx-auto shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-gray-400 mb-4 block">search_off</span>
                    <h4 class="text-lg font-bold text-gray-900 mb-2">No matching questions found</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">We couldn't find any results matching your search terms. Try using simpler words or browse our full Help Center.</p>
                </div>
            </div>

        </section>

    </main>
</x-layouts.landing>
