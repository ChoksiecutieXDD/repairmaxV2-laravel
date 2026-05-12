<div class="w-full" x-data="{ deleteModal: false, sessionToDelete: null }">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                AI Support Assistant
            </h1>
            <p class="text-gray-500 mt-1">Get instant answers, troubleshoot issues, or create support tickets.</p>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full lg:w-1/3 xl:w-1/4 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[300px] lg:h-[700px] transition-shadow hover:shadow-md duration-300">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-white shrink-0 rounded-t-2xl">
                <h2 class="font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-gray-400">forum</span>
                    History
                </h2>
                <button wire:click="startNewChat" class="bg-gray-900 text-white p-1.5 rounded-lg hover:bg-gray-800 transition-all flex items-center justify-center focus:outline-none shadow-sm" title="New Chat">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-3 space-y-2 bg-gray-50/50 rounded-b-2xl">
                @forelse($history as $session)
                <div wire:click="loadSession({{ $session->id }})" 
                    class="p-3 bg-white border @if($currentSessionId == $session->id) border-blue-200 shadow-sm @else border-transparent hover:border-gray-200 @endif rounded-xl cursor-pointer group flex items-start justify-between relative overflow-hidden transition-all">
                    
                    @if($currentSessionId == $session->id)
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
                    @endif

                    <div class="flex-1 min-w-0 @if($currentSessionId == $session->id) pl-2 @endif pr-2">
                        <p class="text-sm font-semibold text-gray-700 @if($currentSessionId == $session->id) text-gray-900 @endif truncate">{{ $session->title }}</p>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold tracking-tighter">{{ $session->created_at->diffForHumans() }}</p>
                    </div>

                    <button @click.stop="deleteModal = true; sessionToDelete = {{ $session->id }}"
                        class="text-gray-300 hover:text-red-500 bg-transparent border-none p-1 rounded transition-colors opacity-100 lg:opacity-0 group-hover:opacity-100 focus:outline-none" title="Delete chat">
                        <span class="material-symbols-outlined text-[18px] block">delete</span>
                    </button>
                </div>
                @empty
                <div class="p-8 text-center">
                    <p class="text-sm text-gray-400">No chat history yet.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="flex-1 bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col h-[600px] lg:h-[700px] transition-shadow hover:shadow-md duration-300">

            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between bg-white shrink-0 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center shadow-sm border border-gray-200 shrink-0">
                            <span class="material-symbols-outlined text-white">smart_toy</span>
                        </div>
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm">Maxie</h3>
                        <p class="text-xs text-green-600 font-medium tracking-tight">Repairmax Assistant</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full border border-blue-100">
                    Active Session
                </span>
            </div>

            <div id="chat-messages-container" class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-6 bg-gray-50/30 scroll-smooth">
                @foreach($messages as $message)
                @if($message['role'] === 'assistant')
                <div class="flex gap-3 sm:gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-white text-[18px]">smart_toy</span>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl rounded-tl-sm p-3 sm:p-4 max-w-[85%] sm:max-w-lg">
                        <p class="text-sm text-gray-800 whitespace-pre-wrap">{{ $message['content'] }}</p>
                        <p class="text-[11px] text-gray-400 mt-2 font-medium">{{ $message['time'] }}</p>
                    </div>
                </div>
                @else
                <div class="flex gap-3 sm:gap-4 justify-end">
                    <div class="bg-gray-900 text-white shadow-sm rounded-2xl rounded-tr-sm p-3 sm:p-4 max-w-[85%] sm:max-w-lg">
                        <p class="text-sm whitespace-pre-wrap text-white">{{ $message['content'] }}</p>
                        <p class="text-[11px] text-gray-300 mt-2 font-medium text-right">{{ $message['time'] }}</p>
                    </div>
                </div>
                @endif
                @endforeach

                @if($isTyping)
                <div class="flex gap-3 sm:gap-4 animate-pulse">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-white text-[18px]">smart_toy</span>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl rounded-tl-sm p-3 px-4 flex gap-1 items-center">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                    </div>
                </div>
                @endif
            </div>

            <div class="p-4 bg-white border-t border-gray-100 shrink-0 rounded-b-2xl">
                <form wire:submit="sendMessage" class="flex items-center gap-2">
                    <input type="text"
                        wire:model="newMessage"
                        placeholder="Type your message..."
                        class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-500/10 transition-all text-sm"
                        required>

                    <button type="submit" class="p-3 bg-gray-900 text-white rounded-xl hover:bg-gray-800 hover:shadow-md transition-all flex items-center justify-center focus:outline-none">
                        <span class="material-symbols-outlined text-[20px]">send</span>
                    </button>
                </form>
                <p class="text-center text-[11px] text-gray-400 mt-3">AI-generated responses. Please do not share sensitive passwords.</p>
            </div>

        </div>

    </div>

    @script
    <script>
        $wire.on('scroll-to-bottom', () => {
            const el = document.getElementById('chat-messages-container');
            if (el) {
                setTimeout(() => {
                    el.scrollTo({
                        top: el.scrollHeight,
                        behavior: 'smooth'
                    });
                }, 100);
            }
        });

        // Also scroll on load
        window.addEventListener('load', () => {
            const el = document.getElementById('chat-messages-container');
            if (el) el.scrollTop = el.scrollHeight;
        });
    </script>
    @endscript

    <!-- ===== DELETE CONFIRMATION MODAL ===== -->
    <div x-show="deleteModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-gray-900/60 backdrop-blur-md"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="fixed inset-0" @click="deleteModal = false"></div>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-md w-full relative overflow-hidden flex flex-col transform transition-all"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <div class="px-8 pt-10 pb-6 flex flex-col items-center text-center bg-white relative">
                <div class="w-16 h-16 bg-red-50 text-red-600 rounded-[1.5rem] flex items-center justify-center mb-5 shadow-sm border border-red-100/50">
                    <span class="material-symbols-outlined text-[32px] leading-none">delete_forever</span>
                </div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Delete Conversation?</h3>
                <p class="text-sm text-gray-400 font-medium mt-2">This action cannot be undone. All messages in this session will be permanently removed.</p>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-100 flex gap-3">
                <button type="button" @click="deleteModal = false" 
                    class="flex-1 py-4 bg-white text-gray-700 font-bold rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">
                    Cancel
                </button>
                <button type="button" @click="$wire.deleteSession(sessionToDelete); deleteModal = false" 
                    class="flex-1 py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all shadow-lg shadow-red-200">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>