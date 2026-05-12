<div x-data="{ 
    isOpen: false, 
    userInput: '',
    isLoading: false,
    messages: [
        { role: 'bot', content: 'Hi! I\'m Maxie, your Repairmax AI assistant. What kind of device issue are you experiencing today? I can help you diagnose it and set up a repair ticket.' }
    ],
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
        class="w-[90vw] sm:w-96 h-[500px] bg-white border border-gray-300 rounded-2xl shadow-2xl mb-4 overflow-hidden flex flex-col transition-all duration-300">

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
                <button @click="isOpen = false" id="close-chat" class="!bg-transparent !border-none !shadow-none !p-0 text-white transition-colors focus:outline-none">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
        </div>

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
                    class="!bg-transparent !border-none !shadow-none !p-0 text-gray-900 disabled:text-gray-300 transition-colors flex items-center justify-center focus:outline-none">
                    <span class="material-symbols-outlined text-2xl" style="color: #101828">send</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Toggle Button -->
    <button @click="isOpen = !isOpen; if(isOpen) scrollToBottom();"
        id="chat-toggle"
        class="bg-gray-900 hover:bg-black text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl transition-all duration-300 hover:scale-110 active:scale-95 focus:outline-none"
        :class="isOpen ? 'rotate-90' : ''">
        <span class="material-symbols-outlined text-2xl" x-text="isOpen ? 'close' : 'chat'">chat</span>
    </button>
</div>