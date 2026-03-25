<div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col h-[600px]">
        <div class="p-6 border-b border-gray-200">
            <h2 class="font-bold text-gray-900">Messages</h2>
        </div>

        <div class="p-4 border-b border-gray-200">
            <input 
                type="text" 
                wire:model.live="searchTerm"
                placeholder="Search messages..." 
                class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm"
            >
        </div>

        <div class="flex-1 overflow-y-auto divide-y divide-gray-100 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @forelse($messages as $message)
                <button 
                    wire:click="selectMessage({{ $message['id'] }})"
                    :class="{ 'bg-blue-50 border-l-4 border-l-blue-600': selectedMessage === {{ $message['id'] }} }"
                    class="w-full p-4 text-left hover:bg-gray-50 transition-colors border-l-4 border-l-transparent"
                >
                    <div class="flex items-start gap-2 mb-1">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900 text-sm">{{ $message['from'] }}</p>
                            <p class="text-xs text-gray-500">{{ $message['email'] }}</p>
                        </div>
                        @if(!$message['read'])
                            <span class="w-2 h-2 rounded-full bg-blue-500 mt-1 flex-shrink-0"></span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 truncate">{{ $message['preview'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $message['date'] }} {{ $message['time'] }}</p>
                </button>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <p class="text-sm">No messages</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col">
        @if($selectedMessage)
            @php $currentMessage = array_filter($messages, fn($m) => $m['id'] === $selectedMessage)[0] ?? null; @endphp
            @if($currentMessage)
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $currentMessage['subject'] }}</h3>
                            <p class="text-sm text-gray-600 mt-1">From: <span class="font-semibold">{{ $currentMessage['from'] }}</span> ({{ $currentMessage['email'] }})</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $currentMessage['date'] }} at {{ $currentMessage['time'] }}</p>
                        </div>
                        <button class="p-2 hover:bg-red-50 text-red-600 rounded-lg transition-colors" title="Delete">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                    </div>
                </div>

                <div class="p-6 flex-1 overflow-y-auto">
                    <p class="text-gray-700 leading-relaxed">{{ $currentMessage['preview'] }}</p>
                </div>

                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <textarea placeholder="Type your reply..." rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"></textarea>
                    <div class="mt-3 flex justify-end gap-2">
                        <button class="px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">Cancel</button>
                        <button class="px-4 py-2 text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition-colors text-sm font-medium">Send Reply</button>
                    </div>
                </div>
            @endif
        @else
            <div class="flex-1 flex items-center justify-center text-gray-500">
                <div class="text-center">
                    <span class="material-symbols-outlined text-[48px] text-gray-300">mail</span>
                    <p class="mt-2 text-sm">Select a message to view</p>
                </div>
            </div>
        @endif
    </div>
</div>
