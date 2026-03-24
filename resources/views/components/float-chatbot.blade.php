<div x-data="{ isOpen: false }" id="chatbot-container" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">

    <div x-show="isOpen"
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        id="chat-window"
        style="display: none;"
        class="w-[90vw] sm:w-96 bg-white border border-gray-300 rounded-2xl shadow-2xl mb-4 overflow-hidden flex flex-col">

        <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-xl">smart_toy</span>
                <h3 class="font-bold text-base">Repairmax AI</h3>
            </div>
            <button @click="isOpen = false" id="close-chat" class="text-gray-400 hover:text-white transition-colors focus:outline-none">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div class="p-4 h-72 overflow-y-auto bg-gray-50 flex flex-col gap-3">
            <div class="self-start bg-gray-200 text-gray-800 p-3 rounded-2xl rounded-tl-none max-w-[85%] text-sm leading-relaxed">
                Hi! I'm your Repairmax AI assistant. What kind of device issue are you experiencing today? I can help you diagnose it and set up a repair ticket.
            </div>
        </div>

        <div class="p-3 border-t border-gray-200 bg-white flex items-center gap-2">
            <input type="text" placeholder="Type your message..." class="flex-1 bg-gray-100 border-none rounded-full px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 transition-shadow">
            <button class="bg-gray-900 text-white w-10 h-10 rounded-full hover:bg-gray-700 transition-colors flex items-center justify-center focus:outline-none">
                <span class="material-symbols-outlined text-[20px] ml-1">send</span>
            </button>
        </div>
    </div>

    <button @click="isOpen = !isOpen"
        id="chat-toggle"
        class="bg-gray-900 hover:bg-gray-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-105 duration-300 focus:outline-none"
        :class="isOpen ? 'scale-90' : ''">
        <span class="material-symbols-outlined text-2xl" x-text="isOpen ? 'keyboard_arrow_down' : 'chat'">chat</span>
    </button>
</div>