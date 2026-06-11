{{-- Alpine.js Chatbot Component Data (extracted to avoid large inline x-data parse errors) --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('chatbot', () => ({
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
            { role: 'bot', content: "Hi! I'm Maxie, your Repairmax AI assistant. What kind of device issue are you experiencing today? I can help you diagnose it and set up a repair ticket." }
        ],
        faqs: [
            { q: 'How long does a repair take?', a: 'Most screen and battery repairs are completed within 1-2 hours. More complex repairs can take 1-3 business days.', open: false },
            { q: 'Do you offer a warranty?', a: 'Yes! We offer a 90-day premium warranty on all parts and labor used during our repairs.', open: false },
            { q: 'Can I get a price estimate?', a: 'Yes, you can use our Chatbot for a free diagnosis and rough estimate, or visit our booking page to view standard prices.', open: false },
            { q: 'What brands do you repair?', a: 'We repair Apple (iPhone, iPad, Mac), Samsung, Google, Asus, Lenovo, HP, Dell, and many more.', open: false },
            { q: 'How do I track my repair?', a: 'You can track your repair in two ways: (1) Log in to your Repairmax account and go to "My Bookings", or (2) Ask Maxie by typing your Booking Reference code (e.g. RX-XXXXXX) directly in the chat.', open: false },
            { q: 'What payment methods do you accept?', a: 'We accept cash, GCash, PayMaya, credit/debit cards, and bank transfers. Payment is collected upon device pick-up after repair is complete.', open: false },
            { q: 'Can I cancel or reschedule my appointment?', a: 'Yes! You can cancel or reschedule up to 2 hours before your appointment. Log in and go to "My Bookings", then select your booking to manage it.', open: false },
            { q: 'Where are you located?', a: 'We are located at Commonwealth Ave. Cor. IBP Road (Litex Junction), Brgy. Payatas, Quezon City, 1119. Open Mon–Fri 8AM–6PM, Sat 9AM–4PM.', open: false },
            { q: 'What if my device cannot be repaired?', a: 'If we determine your device is beyond repair, we will notify you immediately with a full diagnostic report. You will only be charged a minimal diagnostic fee.', open: false }
        ],
        get filteredFaqs() {
            if (!this.searchQuery.trim()) return this.faqs;
            const q = this.searchQuery.toLowerCase();
            return this.faqs.filter(f => f.q.toLowerCase().includes(q) || f.a.toLowerCase().includes(q));
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const el = document.getElementById('chat-messages-container');
                if (el) el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' });
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

            const trackingRegex = /^RX-[A-Z0-9]{5,8}$/i;
            if (trackingRegex.test(userMsg.trim())) {
                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch('/api/chatbot/track', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                        body: JSON.stringify({ tracking_code: userMsg.trim().toUpperCase() })
                    });
                    const data = await response.json();
                    this.messages.push({ role: 'bot', content: data.reply || "Sorry, I couldn't track that ticket." });
                } catch (error) {
                    this.messages.push({ role: 'bot', content: 'System error while tracking ticket. Please try again.' });
                } finally {
                    this.isLoading = false;
                    this.scrollToBottom();
                }
                return;
            }

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('/api/chatbot', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ message: userMsg, session_id: this.sessionId })
                });
                const data = await response.json();
                this.messages.push({ role: 'bot', content: data.reply || data.output || "Sorry, I didn't catch that." });
            } catch (error) {
                this.messages.push({ role: 'bot', content: 'System error. Please try again.' });
            } finally {
                this.isLoading = false;
                this.scrollToBottom();
            }
        }
    }));
});
</script>

{{-- Chatbot Widget HTML --}}
<div x-data="chatbot()"
    @open-chat.window="isOpen = true; activeTab = 'chat'; scrollToBottom()"
    id="chatbot-container"
    class="fixed bottom-6 right-6 z-50 flex flex-col items-end font-sans">

    <!-- Chat Window -->
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

        <!-- ═══════════════════════════════════════ -->
        <!-- TAB 1: HOME                             -->
        <!-- ═══════════════════════════════════════ -->
        <div x-show="activeTab === 'home'" class="flex-1 flex flex-col overflow-y-auto bg-gray-50 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
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
                        AI chat powered by Repairmax — how can we help you today?
                    </p>
                </div>
            </div>

            <div class="px-6 mt-6 flex flex-col gap-4 mb-6">

                <!-- Quick Actions List -->
                <div class="bg-white border border-gray-100 rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] overflow-hidden">
                    <div class="divide-y divide-gray-100">

                        <div @click="triggerQuickQuestion('What is Repairmax?')" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-blue-500 text-base bg-blue-50 p-1.5 rounded-lg">info</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">What is Repairmax?</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>

                        <div @click="triggerQuickQuestion('How do I track my repair booking?')" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-emerald-500 text-base bg-emerald-50 p-1.5 rounded-lg">manage_search</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">How to track my repair?</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>

                        <div @click="triggerQuickQuestion('How do I book a repair?')" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-violet-500 text-base bg-violet-50 p-1.5 rounded-lg">event_available</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">How do I book a repair?</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>

                        <div @click="triggerQuickQuestion('What are your repair prices?')" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-500 text-base bg-amber-50 p-1.5 rounded-lg">payments</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">What are your repair prices?</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>

                        <div @click="triggerQuickQuestion('What is your repair warranty policy?')" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-cyan-500 text-base bg-cyan-50 p-1.5 rounded-lg">verified_user</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">Repair warranty policy</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>

                        <div @click="triggerQuickQuestion('Where are you located and what are your contact details?')" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-rose-500 text-base bg-rose-50 p-1.5 rounded-lg">location_on</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">Contact &amp; Location</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>


                        <div @click="activeTab = 'help'" class="flex justify-between items-center px-4 py-3.5 hover:bg-gray-50 cursor-pointer transition-all duration-200 group">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-gray-500 text-base bg-gray-100 p-1.5 rounded-lg">help_center</span>
                                <span class="text-xs font-bold text-gray-800 group-hover:text-[#0f172a] transition-colors">FAQs &amp; Help Center</span>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 group-hover:text-[#0f172a] text-base transition-all duration-200 group-hover:translate-x-0.5">chevron_right</span>
                        </div>

                    </div>
                </div>

                <!-- Chat with Maxie CTA -->
                <div @click="activeTab = 'chat'; scrollToBottom();" class="bg-white border border-gray-100 rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] p-5 flex items-center justify-between hover:shadow-[0_8px_32px_rgba(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300 cursor-pointer group">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xs font-extrabold text-gray-900 group-hover:text-[#0f172a] transition-colors">Chat with Maxie</h3>
                        <p class="text-[10px] text-gray-400 font-bold">Have questions? Maxie is here to assist you</p>
                    </div>
                    <div class="bg-[#0f172a] text-white w-9 h-9 rounded-full flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-lg leading-none" style="transform: rotate(-30deg); margin-left: 2px;">send</span>
                    </div>
                </div>

                <!-- Book a Repair CTA -->
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

        <!-- ═══════════════════════════════════════ -->
        <!-- TAB 2: CHAT                             -->
        <!-- ═══════════════════════════════════════ -->
        <div x-show="activeTab === 'chat'" class="flex-1 flex flex-col overflow-hidden bg-gray-50">
            <div class="bg-white border-b border-gray-100 px-4 py-3 flex items-center gap-3 relative shadow-xs">
                <button @click="activeTab = 'home'" class="bg-transparent! border-none! shadow-none! p-0! text-gray-500 hover:text-gray-800 transition-colors cursor-pointer flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">arrow_back</span>
                </button>
                <div class="flex items-center gap-2.5 flex-1">
                    <span class="material-symbols-outlined text-blue-600 text-lg bg-blue-50 p-1.5 rounded-lg border border-blue-100/50">smart_toy</span>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-sm leading-tight text-gray-900">Maxie</span>
                        <span class="text-[9px] text-blue-600 font-extrabold uppercase tracking-wider">Online | AI Assistant</span>
                    </div>
                </div>
                <button @click="isOpen = false" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer absolute right-4 flex items-center justify-center">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>

            <div id="chat-messages-container" class="flex-1 p-5 overflow-y-auto bg-gray-50 flex flex-col gap-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.role === 'bot' ? 'self-start' : 'self-end'" class="max-w-[85%] flex flex-col gap-1">
                        <div :class="msg.role === 'bot' ? 'bg-white border border-gray-100 text-gray-800 rounded-2xl rounded-tl-none shadow-sm' : 'bg-[#0f172a] text-white rounded-2xl rounded-tr-none shadow-md'"
                            class="px-4 py-3 text-xs leading-relaxed font-semibold whitespace-pre-wrap"
                            x-text="msg.content">
                        </div>
                    </div>
                </template>
                <div x-show="isLoading" class="self-start bg-white border border-gray-100 text-gray-800 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm flex gap-1.5 items-center">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                </div>
            </div>

            <div class="p-3.5 border-t border-gray-100 bg-white">
                <div class="flex items-center gap-2 bg-gray-50 rounded-full px-4 py-1.5 border border-transparent focus-within:border-gray-200 focus-within:bg-white transition-all shadow-inner">
                    <input type="text"
                        x-model="userInput"
                        @keydown.enter="sendMessage()"
                        placeholder="Ask Maxie anything..."
                        class="flex-1 bg-transparent border-none text-xs py-2.5 font-semibold text-gray-700 placeholder-gray-400"
                        style="outline: none !important; box-shadow: none !important; border: none !important; caret-color: #0f172a !important;">
                    <button @click="sendMessage()"
                        :disabled="isLoading || !userInput.trim()"
                        class="bg-transparent! border-none! shadow-none! p-0! text-[#0f172a] disabled:text-gray-300 transition-colors flex items-center justify-center focus:outline-none cursor-pointer">
                        <span class="material-symbols-outlined text-2xl">send</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════════ -->
        <!-- TAB 3: HELP / FAQ                       -->
        <!-- ═══════════════════════════════════════ -->
        <div x-show="activeTab === 'help'" class="flex-1 flex flex-col overflow-hidden bg-gray-50">
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
            <div class="flex-1 p-5 overflow-y-auto flex flex-col gap-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
                <div class="bg-white rounded-2xl p-2 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] flex items-center gap-2.5">
                    <span class="material-symbols-outlined text-gray-400 text-lg pl-1.5">search</span>
                    <input type="text" x-model="searchQuery" placeholder="Search FAQs..."
                        class="flex-1 bg-transparent border-none text-xs p-0 text-gray-700 py-1.5 font-semibold placeholder-gray-400"
                        style="outline: none !important; box-shadow: none !important; border: none !important; caret-color: #0f172a !important;">
                    <button x-show="searchQuery" @click="searchQuery = ''" class="bg-transparent! border-none! shadow-none! p-0! text-gray-400 hover:text-gray-600 transition-colors cursor-pointer pr-1 flex items-center justify-center">
                        <span class="material-symbols-outlined text-base">close</span>
                    </button>
                </div>
                <div class="flex flex-col gap-2.5">
                    <template x-for="(faq, index) in filteredFaqs" :key="index">
                        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-all">
                            <button @click="faq.open = !faq.open"
                                class="w-full text-left p-4 flex justify-between items-center gap-3 transition-colors hover:bg-gray-50 bg-transparent! border-none! shadow-none! focus:outline-none cursor-pointer">
                                <span class="text-xs font-bold text-gray-800" x-text="faq.q"></span>
                                <span class="material-symbols-outlined text-gray-400 text-lg transition-transform duration-200" :class="faq.open ? 'rotate-180' : ''">expand_more</span>
                            </button>
                            <div x-show="faq.open" x-transition class="px-4 pb-4 text-xs font-semibold text-gray-500 border-t border-gray-50 pt-2 leading-relaxed whitespace-normal" x-text="faq.a"></div>
                        </div>
                    </template>
                    <div x-show="filteredFaqs.length === 0" class="text-center py-8 text-gray-400 text-xs font-bold bg-white rounded-2xl border border-gray-100 shadow-sm">
                        No matching results found
                    </div>
                </div>
            </div>
        </div>


        <!-- ═══════════════════════════════════════ -->
        <!-- BOTTOM TAB BAR                          -->
        <!-- ═══════════════════════════════════════ -->
        <div class="bg-white border-t border-gray-100 py-2.5 px-4 flex justify-around items-center shadow-inner">

            <button @click="activeTab = 'home'"
                class="flex flex-col items-center gap-0.5 bg-transparent! border-none! shadow-none! p-0! cursor-pointer focus:outline-none transition-all duration-200"
                :class="activeTab === 'home' ? 'text-[#0f172a]' : 'text-gray-400 hover:text-gray-600'">
                <span class="material-symbols-outlined text-xl">home</span>
                <span class="text-[9px] uppercase tracking-wider font-extrabold">Home</span>
            </button>

            <button @click="activeTab = 'chat'; scrollToBottom();"
                class="flex flex-col items-center gap-0.5 bg-transparent! border-none! shadow-none! p-0! cursor-pointer focus:outline-none transition-all duration-200"
                :class="activeTab === 'chat' ? 'text-[#0f172a]' : 'text-gray-400 hover:text-gray-600'">
                <span class="material-symbols-outlined text-xl">chat</span>
                <span class="text-[9px] uppercase tracking-wider font-extrabold">Chat</span>
            </button>

            <button @click="activeTab = 'help'"
                class="flex flex-col items-center gap-0.5 bg-transparent! border-none! shadow-none! p-0! cursor-pointer focus:outline-none transition-all duration-200"
                :class="activeTab === 'help' ? 'text-[#0f172a]' : 'text-gray-400 hover:text-gray-600'">
                <span class="material-symbols-outlined text-xl">help</span>
                <span class="text-[9px] uppercase tracking-wider font-extrabold">FAQs</span>
            </button>


        </div>

        <!-- Branding -->
        <div class="bg-white text-center pb-2 pt-0.5 text-[8px] font-bold text-gray-300 uppercase tracking-widest select-none">
            Powered by Repairmax AI Agent
        </div>

    </div>

    <!-- Floating Toggle Button -->
    <button @click="isOpen = !isOpen; if(isOpen && activeTab === 'chat') scrollToBottom();"
        id="chat-toggle"
        class="bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_4px_20px_rgba(37,99,235,0.35)] transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none cursor-pointer"
        :class="isOpen ? 'rotate-90' : ''">
        <span class="material-symbols-outlined text-2xl" x-text="isOpen ? 'close' : 'chat'">chat</span>
    </button>

</div>