<div x-data="{ 
    isOpen: false, 
    activeTab: 'home',
    searchQuery: '',
    userInput: '',
    isLoading: false,
    sessionId: localStorage.getItem('chatbot_session_id') || (() => {
        const id = 'sess_' + Math.random().toString(36).substring(2, 15);
        localStorage.setItem('chatbot_session_id', id);
        return id;
    })(),
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
    async triggerQuickQuestion(questionText) {
        this.activeTab = 'chat';
        this.userInput = questionText;
        await this.$nextTick();
        this.sendMessage();
    },
    async sendMessage() {
        if (!this.userInput.trim() || this.isLoading) return;
        
        const userMsg = this.userInput;
        this.messages.push({ role: 'user', content: userMsg });
        this.userInput = '';
        this.isLoading = true;
        this.scrollToBottom();

        const trackingRegex = /^RM-\d{5}$/i;
        if (trackingRegex.test(userMsg.trim())) {
            try {
                const response = await fetch('/api/chatbot/track', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                    },
                    body: JSON.stringify({ tracking_code: userMsg.trim().toUpperCase() })
                });

                const data = await response.json();
                this.messages.push({ role: 'bot', content: data.reply || 'Sorry, I couldn\'t track that ticket.' });
                this.scrollToBottom();
            } catch (error) {
                this.messages.push({ role: 'bot', content: 'System error while tracking ticket. Please try again.' });
                this.scrollToBottom();
            } finally {
                this.isLoading = false;
            }
            return;
        }

        try {
            const response = await fetch('/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                },
                body: JSON.stringify({ message: userMsg, session_id: this.sessionId })
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
}" @open-chat.window="isOpen = true; activeTab = 'chat'; scrollToBottom()" id="chatbot-container" class="fixed bottom-6 right-6 z-50 flex flex-col items-end font-sans">

    <!-- Larger Chat Window with Brand Deep Charcoal Theme -->
    <div x-show="isOpen"
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        id="chat-window"
        style="display: none;"
        class="w-[calc(100vw-32px)] sm:w-[420px] h-[660px] max-h-[calc(100vh-120px)] max-sm:fixed max-sm:inset-0 max-sm:w-full max-sm:h-full max-sm:max-h-full max-sm:rounded-none max-sm:mb-0 max-sm:z-[60] bg-white border border-gray-100 rounded-[2.2rem] shadow-[0_16px_48px_rgba(0,0,0,0.12)] mb-4 overflow-hidden flex flex-col transition-all duration-300">

        <!-- Tab 1: Home View -->
        <div x-show="activeTab === 'home'" class="flex-1 flex flex-col overflow-y-auto bg-gray-50 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
            <!-- Premium White & Subtle Light Blue Header -->
            <div class="bg-gradient-to-b from-blue-50/20 to-white px-7 pt-9 pb-12 rounded-b-[2.5rem] relative shadow-xs border-b border-gray-100 flex flex-col gap-3">
                <div class="flex items-center justify-between">
                    <span class="material-symbols-outlined text-blue-600 text-2xl bg-blue-50 p-2 rounded-xl border border-blue-100/50">smart_toy</span>
                    <button @click="isOpen = false" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">close</span>
                    </button>
                </div>
                <div class="flex flex-col gap-1 mt-2">
                    <h2 class="text-3xl font-extrabold leading-tight">
                        <span class="bg-clip-text text-transparent bg-linear-to-r from-indigo-600 via-blue-600 to-cyan-600">Hi there!</span> 👋
                    </h2>
                    <p class="text-gray-500 text-xs font-semibold leading-relaxed max-w-[90%]">
                        AI chat powered by Repairmax - how can we help you today?
                    </p>
                </div>
            </div>

            <!-- Overlapping Floating Card Layout -->
            <div class="px-6 mt-6 flex flex-col gap-4 mb-6">
                
                <!-- Quick Actions List Card -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] overflow-hidden">
                    <div class="divide-y divide-gray-100">
                        <div @click="triggerQuickQuestion('What is Repairmax?')" class="flex justify-between items-center p-4.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">What is Repairmax?</span>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>
                        
                        <div @click="triggerQuickQuestion('How do I book a repair?')" class="flex justify-between items-center p-4.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">How do I book a repair?</span>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>
                        
                        <div @click="activeTab = 'help'" class="flex justify-between items-center p-4.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">FAQs & Help Center</span>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>
                    </div>
                </div>

                <!-- Main CTA Chat with Maxie Card -->
                <div @click="activeTab = 'chat'; scrollToBottom();" class="bg-white border border-gray-100 rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] p-5 flex items-center justify-between hover:shadow-[0_8px_32px_rgba(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300 cursor-pointer group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xs font-extrabold text-gray-900 group-hover:text-[#0f172a] transition-colors">Chat with Maxie</h3>
                        <p class="text-[10px] text-gray-400 font-bold">Have questions? Maxie is here to assist you</p>
                    </div>
                    <div class="bg-[#0f172a] text-white w-9 h-9 rounded-full flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-lg leading-none" style="transform: rotate(-30deg); margin-left: 2px;">send</span>
                    </div>
                </div>

                <!-- Quick Booking Link Card -->
                <a href="/booking" class="bg-white border border-gray-100 rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] p-5 flex items-center justify-between hover:shadow-[0_8px_32px_rgba(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300 no-underline group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xs font-extrabold text-gray-900 group-hover:text-[#0f172a] transition-colors">Book a Repair</h3>
                        <p class="text-[10px] text-gray-400 font-bold">Setup a diagnostic and repair reservation</p>
                    </div>
                    <div class="bg-gray-100 text-gray-700 w-9 h-9 rounded-full flex items-center justify-center group-hover:bg-[#0f172a] group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined text-lg leading-none">calendar_month</span>
                    </div>
                </a>

            </div>
        </div>

        <!-- Tab 2: Chat View -->
        <div x-show="activeTab === 'chat'" class="flex-1 flex flex-col overflow-hidden bg-gray-50">
            <!-- Slim Header with Light Theme -->
            <div class="bg-white border-b border-gray-100 p-4.5 flex items-center gap-3 relative shadow-xs">
                <button @click="activeTab = 'home'" class="bg-transparent! border-none! shadow-none! p-0! text-gray-500 hover:text-gray-800 transition-colors cursor-pointer flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">arrow_back</span>
                </button>
                <div class="flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-blue-600 text-lg bg-blue-50 p-1.5 rounded-lg border border-blue-100/50">smart_toy</span>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-sm leading-tight text-gray-900">Maxie</span>
                        <span class="text-[9px] text-blue-600 font-extrabold uppercase tracking-wider">Online | Assistant</span>
                    </div>
                </div>
                <button @click="isOpen = false" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer absolute right-4 flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- Scrollable Messages Container -->
            <div id="chat-messages-container" class="flex-1 p-5 overflow-y-auto bg-gray-50 flex flex-col gap-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'bot' ? 'self-start' : 'self-end'" class="max-w-[85%] flex flex-col gap-1">
                        <div :class="msg.role === 'bot' ? 'bg-white border border-gray-100 text-gray-800 rounded-2xl rounded-tl-none shadow-sm' : 'bg-[#0f172a] text-white rounded-2xl rounded-tr-none shadow-md'"
                            class="px-4 py-3 text-xs leading-relaxed font-semibold whitespace-pre-wrap"
                            x-text="msg.content">
                        </div>
                    </div>
                </template>
                
                <!-- Bouncing Three-Dot Loader -->
                <div x-show="isLoading" class="self-start bg-white border border-gray-100 text-gray-800 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm flex gap-1.5 items-center">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                </div>
            </div>

            <!-- Input Form -->
            <div class="p-3.5 border-t border-gray-100 bg-white">
                <div class="flex items-center gap-2 bg-gray-50 rounded-full px-4 py-1.5 border border-transparent focus-within:border-gray-200 focus-within:bg-white transition-all shadow-inner">
                    <input type="text" 
                        x-model="userInput" 
                        @keydown.enter="sendMessage()"
                        placeholder="Ask Maxie anything..." 
                        class="flex-1 bg-transparent border-none text-xs focus:outline-none focus:ring-0 py-2.5 font-semibold text-gray-700 placeholder-gray-400">
                    <button @click="sendMessage()"
                        :disabled="isLoading || !userInput.trim()"
                        class="bg-transparent! border-none! shadow-none! p-0! text-[#0f172a] disabled:text-gray-300 transition-colors flex items-center justify-center focus:outline-none cursor-pointer">
                        <span class="material-symbols-outlined text-2xl">send</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tab 3: Help View -->
        <div x-show="activeTab === 'help'" class="flex-1 flex flex-col overflow-hidden bg-gray-50">
            <!-- Slim Header -->
            <div class="bg-white border-b border-gray-100 p-4.5 flex items-center gap-3 relative shadow-xs">
                <button @click="activeTab = 'home'" class="bg-transparent! border-none! shadow-none! p-0! text-gray-500 hover:text-gray-800 transition-colors cursor-pointer flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">arrow_back</span>
                </button>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-600 text-lg bg-blue-50 p-1.5 rounded-lg border border-blue-100/50">help</span>
                    <span class="font-extrabold text-sm text-gray-900">Help Center</span>
                </div>
                <button @click="isOpen = false" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer absolute right-4 flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <!-- FAQ Search Box and Accordions -->
            <div class="flex-1 p-5 overflow-y-auto flex flex-col gap-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
                <!-- Premium Search Box -->
                <div class="bg-white rounded-2xl p-2 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-gray-400 text-lg pl-1.5">search</span>
                    <input type="text" 
                        x-model="searchQuery" 
                        placeholder="Search FAQs..." 
                        class="flex-1 bg-transparent border-none text-xs focus:outline-none focus:ring-0 p-0 text-gray-700 py-1.5 font-semibold placeholder-gray-400">
                    <button x-show="searchQuery" @click="searchQuery = ''" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer pr-1 flex items-center justify-center">
                        <span class="material-symbols-outlined text-base">close</span>
                    </button>
                </div>

                <!-- List of FAQ Cards -->
                <div class="flex flex-col gap-2.5">
                    <template x-for="(faq, index) in filteredFaqs" :key="index">
                        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-all">
                            <button @click="faq.open = !faq.open" 
                                class="w-full text-left p-4 flex justify-between items-center gap-3 transition-colors hover:bg-gray-50 bg-transparent! border-none! shadow-none! focus:outline-none cursor-pointer">
                                <span class="text-xs font-bold text-gray-800" x-text="faq.q"></span>
                                <span class="material-symbols-outlined text-gray-400 text-lg transition-transform duration-200" 
                                    :class="faq.open ? 'rotate-180' : ''">expand_more</span>
                            </button>
                            <div x-show="faq.open" x-transition
                                class="px-4 pb-4 text-xs font-semibold text-gray-500 border-t border-gray-50 pt-2 leading-relaxed whitespace-normal"
                                x-text="faq.a">
                            </div>
                        </div>
                    </template>
                    
                    <div x-show="filteredFaqs.length === 0" class="text-center py-8 text-gray-400 text-xs font-bold bg-white rounded-2xl border border-gray-100 shadow-sm">
                        No matching results found
                    </div>
                </div>
            </div>
        </div>

        <!-- Persistent Bottom Tab Bar (Deep Charcoal Accents) -->
        <div class="bg-white border-t border-gray-100 py-3 px-8 flex justify-around items-center shadow-inner">
            <button @click="activeTab = 'home'" 
                class="flex flex-col items-center gap-1 bg-transparent! border-none! shadow-none! p-0! cursor-pointer focus:outline-none transition-all duration-200"
                :class="activeTab === 'home' || activeTab === 'help' ? 'text-[#0f172a] font-semibold' : 'text-gray-400 hover:text-gray-600'">
                <span class="material-symbols-outlined text-2xl">home</span>
                <span class="text-[10px] uppercase tracking-wider font-semibold">Home</span>
            </button>
            
            <button @click="activeTab = 'chat'; scrollToBottom();" 
                class="flex flex-col items-center gap-1 bg-transparent! border-none! shadow-none! p-0! cursor-pointer focus:outline-none transition-all duration-200"
                :class="activeTab === 'chat' ? 'text-[#0f172a] font-semibold' : 'text-gray-400 hover:text-gray-600'">
                <span class="material-symbols-outlined text-2xl">chat</span>
                <span class="text-[10px] uppercase tracking-wider font-semibold">Chat</span>
            </button>
        </div>
        
        <!-- Subtle Branding -->
        <div class="bg-white text-center pb-2 pt-0.5 text-[8px] font-bold text-gray-300 uppercase tracking-widest select-none">
            Powered by Repairmax AI Agent
        </div>

    </div>

    <!-- Floating Toggle Button (Deep Charcoal) -->
    <button @click="isOpen = !isOpen; if(isOpen && activeTab === 'chat') scrollToBottom();"
        id="chat-toggle"
        class="bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_4px_20px_rgba(37,99,235,0.35)] transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none cursor-pointer"
        :class="isOpen ? 'rotate-90' : ''">
        <span class="material-symbols-outlined text-2xl" x-text="isOpen ? 'close' : 'chat'">chat</span>
    </button>
</div>