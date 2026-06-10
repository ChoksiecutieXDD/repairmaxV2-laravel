<div class="w-full max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-[Montserrat] font-extrabold text-gray-900 dark:text-white tracking-tight">Send Support Message</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">Contact our support team directly with any questions or issues.</p>
    </div>
    <!-- Send Message Form -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Create New Support Message</h2>
        
        <form wire:submit="sendMessage" class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Subject</label>
                <input 
                    type="text" 
                    wire:model="subject" 
                    placeholder="What is your issue about?" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25 transition-all focus:outline-none"
                >
                @error('subject') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Message</label>
                <textarea 
                    wire:model="message" 
                    placeholder="Please describe your issue in detail..." 
                    rows="6"
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-500/15 dark:focus:!border-blue-500 dark:focus:!ring-4 dark:focus:!ring-blue-500/25 transition-all focus:outline-none resize-none"
                ></textarea>
                @error('message') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full transition-colors flex items-center gap-2"
                >
                    <span class="material-symbols-outlined text-[20px]">send</span>
                    Send Message
                </button>
                <button 
                    type="reset" 
                    wire:click="$set('subject', '');$set('message', '')"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-3 px-6 rounded-full transition-colors"
                >
                    Clear
                </button>
            </div>
        </form>
    </div>

    <!-- Message History -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900">Message History</h2>
        </div>

        @if(count($messages) > 0)
            <div class="divide-y divide-gray-100">
                @foreach($messages as $msg)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-base font-bold text-gray-900">{{ $msg['subject'] }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($msg['created_at'])->diffForHumans() }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                @if(!$msg['admin_read'])
                                    <span class="inline-flex items-center px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-full text-xs font-bold">Waiting for Response</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-700 border border-green-100 rounded-full text-xs font-bold">Read</span>
                                @endif
                                <button 
                                    wire:click="deleteMessage({{ $msg['id'] }})"
                                    class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded transition-colors"
                                >
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm">{{ substr($msg['message'], 0, 200) }}{{ strlen($msg['message']) > 200 ? '...' : '' }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center">
                <span class="material-symbols-outlined text-5xl text-gray-400 mx-auto mb-3 block">mail</span>
                <p class="text-gray-500 text-sm">No messages yet. Send your first support message!</p>
            </div>
        @endif
    </div>
</div>
