<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Messages</h1>
            <p class="text-gray-500 mt-1">View and respond to customer inquiries.</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <input 
            type="text" 
            placeholder="Search messages..." 
            wire:model.live="searchTerm"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Messages List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Customer Messages ({{ $messages->total() }})</h2>
                </div>
                <div class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto">
                    @forelse($messages as $message)
                        <div 
                            wire:click="selectMessage({{ $message->id }})"
                            class="px-6 py-4 hover:bg-blue-50 transition-colors cursor-pointer {{ $selectedMessage?->id === $message->id ? 'bg-blue-100' : '' }} {{ !$message->admin_read ? 'bg-yellow-50' : '' }}"
                        >
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-bold text-gray-900">{{ $message->user->first_name }} {{ $message->user->last_name }}</h3>
                                        @if(!$message->admin_read)
                                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">New</span>
                                        @endif
                                    </div>
                                    <p class="text-sm font-semibold text-gray-700 mt-1">{{ $message->subject }}</p>
                                    <p class="text-sm text-gray-500 mt-1 truncate">{{ \Illuminate\Support\Str::limit($message->message, 60) }}</p>
                                </div>
                                <span class="text-xs text-gray-500 whitespace-nowrap ml-4">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center">
                            <p class="text-gray-500">No messages found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($messages->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Message Detail Panel -->
        <div class="lg:col-span-1">
            @if($selectedMessage)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden sticky top-6">
                    <!-- Header -->
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $selectedMessage->user->first_name }} {{ $selectedMessage->user->last_name }}</h3>
                            <p class="text-sm text-gray-500">{{ $selectedMessage->user->email }}</p>
                        </div>
                        <button 
                            wire:click="closeMessage"
                            class="text-gray-400 hover:text-gray-600"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Message Content -->
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h4 class="font-bold text-gray-900 mb-2">{{ $selectedMessage->subject }}</h4>
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $selectedMessage->message }}</p>
                        <p class="text-xs text-gray-500 mt-4">{{ $selectedMessage->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>

                    <!-- Reply Form -->
                    <div class="px-6 py-5 bg-gray-50">
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Send Reply</label>
                        <textarea 
                            wire:model="replyMessage"
                            placeholder="Type your response..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                            rows="4"
                        ></textarea>
                        <div class="flex gap-2 mt-4">
                            <button 
                                wire:click="sendReply"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors"
                            >
                                Send Reply
                            </button>
                            <button 
                                wire:click="deleteMessage({{ $selectedMessage->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm h-full flex items-center justify-center min-h-[400px]">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500">Select a message to view details</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

