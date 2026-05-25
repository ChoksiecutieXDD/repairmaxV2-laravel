<div x-data="{ 
    isOpen: false, 
    activeTab: 'chat',
    searchQuery: '',
    userInput: '',
    isLoading: false,
    messages: [
        { role: 'bot', content: 'Hi! I\'m Maxie, your Repairmax AI assistant. What kind of device issue are you experiencing today? I can help you diagnose it and set up a repair ticket.' }
    ],
    faqs: [
        { q: 'How long does a repair take?', a: 'Most screen and battery repairs are completed within 1-2 hours. More complex repairs can take 1-3 business days.', open: false },
        { q: 'Do you offer a warranty?', a: 'Yes! We offer a 90-day premium warranty on all parts and labor used during our repairs.', open: false },
        { q: 'Can I get a price estimate?', a: 'Yes, you can use our Chatbot for a free diagnosis and rough estimate, or visit our booking page to view standard prices.', open: false },
        { q: 'What brands do you repair?', a: 'We repair Apple (iPhone, iPad, Mac), Samsung, Google, Asus, Lenovo, HP, Dell, and many more.', open: false }
    ],
    get filteredFaqs() {
        if (!this.searchQuery.trim()) return this.faqs;
        const q = this.searchQuery.toLowerCase();
        return this.faqs.filter(f => f.q.toLowerCase().includes(q) || f.a.toLowerCase().includes(q));
    },
    scrollToBottom() {
        this.$nextTick(() => {
            const el = document.getElementById('chat-messages-container');
            if (el) {
                el.scrollTo({
                    top: el.scrollHeight,
                    behavior: 'smooth'
                });
            }
        });
    },
    async sendMessage() {
        if (!this.userInput.trim() || this.isLoading) return;
        
        const userMsg = this.userInput;
        this.messages.push({ role: 'user', content: userMsg });
        this.userInput = '';
        this.isLoading = true;
        this.scrollToBottom();

        try {
            const response = await fetch('/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                },
                body: JSON.stringify({ message: userMsg })
            });

            const data = await response.json();
            this.messages.push({ role: 'bot', content: data.reply || data.output || 'Sorry, I didn\'t catch that.' });
            this.scrollToBottom();
        } catch (error) {
            this.messages.push({ role: 'bot', content: 'System error. Please try again.' });
            this.scrollToBottom();
        } finally {
            this.isLoading = false;
        }
    }
}" id="chatbot-container" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

    <div x-show="isOpen"
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        id="chat-window"
        style="display: none;"
        class="w-[90vw] sm:w-96 h-130 bg-white border border-gray-300 rounded-2xl shadow-2xl mb-4 overflow-hidden flex flex-col transition-all duration-300">

        <!-- Header -->
        <div class="bg-gray-900 text-white p-4 flex justify-between items-center shadow-lg">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-white text-2xl">smart_toy</span>
                <div class="flex flex-col">
                    <span class="font-bold text-lg text-white leading-tight">Maxie</span>
                    <span class="text-gray-400 text-xs font-medium uppercase tracking-wider">Repairmax Assistant</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="isOpen = false" id="close-chat" class="bg-transparent! border-none! shadow-none! p-0! text-white transition-colors focus:outline-none">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="px-4 py-2.5 bg-white border-b border-gray-100 flex justify-center">
            <div class="flex p-1 bg-gray-100 rounded-xl w-full">
                <button @click="activeTab = 'chat'; scrollToBottom();" 
                    :class="activeTab === 'chat' ? 'bg-white! text-gray-900 font-bold rounded-lg! shadow-sm!' : 'bg-transparent! text-gray-500 hover:text-gray-900 font-medium rounded-lg!'"
                    class="flex-1 py-2 text-center text-xs transition-all duration-200 flex items-center justify-center gap-2 border-none! p-0! focus:outline-none cursor-pointer">
                    <span class="material-symbols-outlined text-base">smart_toy</span>
                    Chatbot
                </button>
                <button @click="activeTab = 'help'" 
                    :class="activeTab === 'help' ? 'bg-white! text-gray-900 font-bold rounded-lg! shadow-sm!' : 'bg-transparent! text-gray-500 hover:text-gray-900 font-medium rounded-lg!'"
                    class="flex-1 py-2 text-center text-xs transition-all duration-200 flex items-center justify-center gap-2 border-none! p-0! focus:outline-none cursor-pointer">
                    <span class="material-symbols-outlined text-base">help</span>
                    Help Center
                </button>
            </div>
        </div>

        <!-- Chatbot Tab Content -->
        <div x-show="activeTab === 'chat'" class="flex-1 flex flex-col overflow-hidden">
            <!-- Messages -->
            <div id="chat-messages-container" class="p-4 flex-1 overflow-y-auto bg-gray-50 flex flex-col gap-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent">
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'bot' ? 'self-start' : 'self-end'" class="max-w-[85%] flex flex-col gap-1">
                        <div :class="msg.role === 'bot' ? 'bg-white border border-gray-200 text-gray-800 rounded-tl-none shadow-sm' : 'bg-gray-900 text-white rounded-tr-none'"
                            class="p-3.5 rounded-2xl text-sm leading-relaxed whitespace-pre-wrap"
                            x-text="msg.content">
                        </div>
                    </div>
                </template>
                <div x-show="isLoading" class="self-start bg-white border border-gray-200 text-gray-800 p-3 rounded-2xl rounded-tl-none shadow-sm flex gap-1.5 items-center">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                </div>
            </div>

            <!-- Input -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center gap-2 bg-gray-100 rounded-full px-4 py-1.5 border border-transparent focus-within:border-gray-300 transition-all">
                    <input type="text" 
                        x-model="userInput" 
                        @keydown.enter="sendMessage()"
                        placeholder="Ask Maxie anything..." 
                        class="flex-1 bg-transparent border-none text-sm focus:ring-0 py-2">
                    <button @click="sendMessage()"
                        :disabled="isLoading"
                        class="bg-transparent! border-none! shadow-none! p-0! text-gray-900 disabled:text-gray-300 transition-colors flex items-center justify-center focus:outline-none cursor-pointer">
                        <span class="material-symbols-outlined text-2xl" style="color: #101828">send</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Help Center Tab Content -->
        <div x-show="activeTab === 'help'" class="flex-1 overflow-y-auto p-4 bg-gray-50 flex flex-col gap-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent">
            <!-- Search Bar -->
            <div class="px-0.5">
                <div class="flex items-center gap-2 bg-white rounded-xl px-3 py-2 border border-gray-200 focus-within:border-gray-400 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-gray-400 text-lg">search</span>
                    <input type="text" 
                        x-model="searchQuery" 
                        placeholder="Search help articles..." 
                        class="flex-1 bg-transparent border-none text-xs focus:ring-0 p-0 text-gray-700 py-1">
                    <button x-show="searchQuery" @click="searchQuery = ''" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-col gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 px-0.5">Quick Actions</span>
                <div class="grid grid-cols-2 gap-2">
                    <a href="/booking" class="bg-white border border-gray-200 hover:border-gray-900 rounded-xl p-3 flex flex-col items-center justify-center text-center gap-1.5 transition-all shadow-sm hover:shadow-md group no-underline">
                        <span class="material-symbols-outlined text-gray-700 group-hover:text-black text-xl">calendar_month</span>
                        <span class="text-xs font-bold text-gray-800 group-hover:text-black">Book Repair</span>
                    </a>
                    <a href="/help/track" class="bg-white border border-gray-200 hover:border-gray-900 rounded-xl p-3 flex flex-col items-center justify-center text-center gap-1.5 transition-all shadow-sm hover:shadow-md group no-underline">
                        <span class="material-symbols-outlined text-gray-700 group-hover:text-black text-xl">travel_explore</span>
                        <span class="text-xs font-bold text-gray-800 group-hover:text-black">Track Status</span>
                    </a>
                    <a href="/help/contact" class="bg-white border border-gray-200 hover:border-gray-900 rounded-xl p-3 flex flex-col items-center justify-center text-center gap-1.5 transition-all shadow-sm hover:shadow-md group no-underline">
                        <span class="material-symbols-outlined text-gray-700 group-hover:text-black text-xl">mail</span>
                        <span class="text-xs font-bold text-gray-800 group-hover:text-black">Contact Us</span>
                    </a>
                    <a href="/help/faqs" class="bg-white border border-gray-200 hover:border-gray-900 rounded-xl p-3 flex flex-col items-center justify-center text-center gap-1.5 transition-all shadow-sm hover:shadow-md group no-underline">
                        <span class="material-symbols-outlined text-gray-700 group-hover:text-black text-xl">help_outline</span>
                        <span class="text-xs font-bold text-gray-800 group-hover:text-black">FAQ Page</span>
                    </a>
                </div>
            </div>

            <!-- FAQs Accordion -->
            <div class="flex flex-col gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 px-0.5">Common Questions</span>
                <div class="flex flex-col gap-2">
                    <template x-for="(faq, index) in filteredFaqs" :key="index">
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm transition-all">
                            <button @click="faq.open = !faq.open" 
                                class="w-full text-left p-3 flex justify-between items-center gap-3 transition-colors hover:bg-gray-50 bg-transparent! border-none! shadow-none! focus:outline-none cursor-pointer">
                                <span class="text-xs font-semibold text-gray-800" x-text="faq.q"></span>
                                <span class="material-symbols-outlined text-gray-500 text-lg transition-transform duration-200" 
                                    :class="faq.open ? 'rotate-180' : ''">expand_more</span>
                            </button>
                            <div x-show="faq.open" x-transition
                                class="px-3 pb-3 text-xs text-gray-600 border-t border-gray-100 pt-2 leading-relaxed whitespace-normal"
                                x-text="faq.a">
                            </div>
                        </div>
                    </template>
                    <div x-show="filteredFaqs.length === 0" class="text-center py-6 text-gray-400 text-xs bg-white rounded-xl border border-gray-200 shadow-sm">
                        No results found for "<span x-text="searchQuery" class="font-semibold text-gray-600"></span>"
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Button -->
    <button @click="isOpen = !isOpen; if(isOpen && activeTab === 'chat') scrollToBottom();"
        id="chat-toggle"
        class="bg-gray-900 hover:bg-black text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none cursor-pointer"
        :class="isOpen ? 'rotate-90' : ''">
        <span class="material-symbols-outlined text-2xl" x-text="isOpen ? 'close' : 'chat'">chat</span>
    </button>
</div>