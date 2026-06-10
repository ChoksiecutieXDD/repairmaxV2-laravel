<div class="flex flex-col h-screen bg-gray-50 rounded-lg overflow-hidden shadow-lg" wire:poll-5000ms="loadSessions">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                <path d="M6 11a1 1 0 11-2 0 1 1 0 012 0zM12 11a1 1 0 11-2 0 1 1 0 012 0zM16 11a1 1 0 11-2 0 1 1 0 012 0z"></path>
            </svg>
            <div>
                <h2 class="text-lg font-bold">RepairMax Bot</h2>
                <p class="text-xs text-blue-100">Powered by n8n</p>
            </div>
        </div>
        <button wire:click="toggleHistory" class="p-2 hover:bg-blue-500 rounded-full transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar with session history -->
        @if($showHistory)
        <div class="w-64 bg-gray-900 text-white border-r border-gray-700 flex flex-col p-4 overflow-hidden">
            <button 
                wire:click="createSession" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-full mb-4 flex items-center justify-center gap-2 transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Chat
            </button>

            <div class="flex-1 overflow-y-auto space-y-2">
                @forelse($sessions as $session)
                <div class="group">
                    <button 
                        wire:click="selectSession({{ $session['id'] }})"
                        class="w-full text-left p-3 rounded-full hover:bg-gray-800 transition {{ $currentSession === $session['id'] ? 'bg-gray-800 border-l-2 border-blue-500' : '' }}"
                    >
                        <p class="text-sm font-medium truncate">{{ $session['title'] }}</p>
                        <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($session['created_at'])->diffForHumans() }}</p>
                    </button>
                    <button 
                        wire:click="deleteSession({{ $session['id'] }})"
                        wire:confirm="Delete this conversation?"
                        class="hidden group-hover:block text-xs text-red-400 hover:text-red-300 ml-3 mt-1 transition"
                    >
                        Delete
                    </button>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-4">No conversations yet</p>
                @endforelse
            </div>
        </div>
        @endif

        <!-- Messages Area -->
        <div class="flex-1 flex flex-col">
            <!-- Messages Container -->
            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gradient-to-b from-white to-gray-50">
                @if(!$currentSession)
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">Start a new conversation</h3>
                        <button 
                            wire:click="createSession" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition"
                        >
                            New Chat
                        </button>
                    </div>
                </div>
                @else
                @forelse($messages as $message)
                <div class="flex gap-3 {{ $message['is_user'] ? 'justify-end' : 'justify-start' }}">
                    @if(!$message['is_user'])
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-600">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.835l.74 4.435a1 1 0 01-.54 1.06l-1.894.894c.159.635.738 1.702 1.894 2.858 1.156 1.156 2.223 1.735 2.858 1.894l.894-1.894a1 1 0 011.06-.54l4.435.74a1 1 0 01.835.986V17a1 1 0 01-1 1h-2.694a7.001 7.001 0 01-6.992-7.293A6.988 6.988 0 012 3z"></path>
                            </svg>
                        </div>
                    </div>
                    @endif

                    <div class="max-w-xs lg:max-w-md">
                        <div class="rounded-lg px-4 py-3 {{ $message['is_user'] 
                            ? 'bg-blue-600 text-white rounded-br-none' 
                            : 'bg-gray-200 text-gray-900 rounded-bl-none' }}">
                            <p class="text-sm">{{ $message['message'] }}</p>
                            @if(!empty($message['metadata']))
                            <div class="text-xs mt-2 opacity-75">
                                @if(isset($message['metadata']['action']))
                                <span class="inline-block bg-opacity-50 px-2 py-1 rounded">
                                    {{ ucfirst(str_replace('_', ' ', $message['metadata']['action'])) }}
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ $message['created_at'] }}</p>
                    </div>
                </div>
                @empty
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">Start chatting with our bot...</p>
                </div>
                @endforelse
                @endif
            </div>

            <!-- Input Area -->
            <div class="bg-white border-t border-gray-200 p-4 shadow-lg">
                <form wire:submit="sendMessage" class="flex gap-3">
                    <input 
                        type="text"
                        wire:model="newMessage"
                        placeholder="Ask me about repairs, bookings, appointments..."
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        @if($isLoading) disabled @endif
                    />
                    <button 
                        type="submit"
                        @if($isLoading) disabled @endif
                        class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white px-6 py-3 rounded-full transition flex items-center gap-2"
                    >
                        @if($isLoading)
                            <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending...
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Send
                        @endif
                    </button>
                </form>
                <p class="text-xs text-gray-500 mt-2">💡 Ask about repairs, check booking status, or schedule appointments</p>
            </div>
        </div>
    </div>
</div>
