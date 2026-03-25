<div class="w-full">

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
                <button class="text-blue-600 hover:bg-blue-50 p-1.5 rounded-lg transition-colors focus:outline-none" title="New Chat">
                    <span class="material-symbols-outlined text-[20px]">add_box</span>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-3 space-y-2 bg-gray-50/50 rounded-b-2xl">
                <div class="p-3 bg-white border border-blue-200 shadow-sm rounded-xl cursor-pointer group flex items-start justify-between relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
                    <div class="flex-1 min-w-0 pl-2 pr-2">
                        <p class="text-sm font-bold text-gray-900 truncate">iPhone Screen Inquiry</p>
                        <p class="text-xs text-blue-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">confirmation_number</span>
                            Ticket #TKT-1045
                        </p>
                    </div>
                    <button class="text-gray-400 hover:text-red-500 bg-transparent border-none p-1 rounded transition-colors opacity-100 lg:opacity-0 group-hover:opacity-100 focus:outline-none" title="Delete chat">
                        <span class="material-symbols-outlined text-[18px] block">delete</span>
                    </button>
                </div>

                <div class="p-3 hover:bg-white border border-transparent hover:border-gray-200 hover:shadow-sm rounded-xl cursor-pointer transition-all group flex items-start justify-between pl-4">
                    <div class="flex-1 min-w-0 pr-2">
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-gray-900 truncate">Battery Replacement</p>
                        <p class="text-xs text-gray-500 mt-1">Yesterday</p>
                    </div>
                    <button class="text-gray-400 hover:text-red-500 bg-transparent border-none p-1 rounded transition-colors opacity-100 lg:opacity-0 group-hover:opacity-100 focus:outline-none" title="Delete chat">
                        <span class="material-symbols-outlined text-[18px] block">delete</span>
                    </button>
                </div>

                <div class="p-3 hover:bg-white border border-transparent hover:border-gray-200 hover:shadow-sm rounded-xl cursor-pointer transition-all group flex items-start justify-between pl-4">
                    <div class="flex-1 min-w-0 pr-2">
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-gray-900 truncate">Water Damage Diagnostic</p>
                        <p class="text-xs text-green-600 mt-1 flex items-center gap-1 font-medium">
                            <span class="material-symbols-outlined text-[14px]">check_circle</span>
                            Resolved
                        </p>
                    </div>
                    <button class="text-gray-400 hover:text-red-500 bg-transparent border-none p-1 rounded transition-colors opacity-100 lg:opacity-0 group-hover:opacity-100 focus:outline-none" title="Delete chat">
                        <span class="material-symbols-outlined text-[18px] block">delete</span>
                    </button>
                </div>
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
                        <h3 class="font-bold text-gray-900 text-sm">RepairBot</h3>
                        <p class="text-xs text-green-600 font-medium">Online & Ready</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-full border border-blue-100">
                    Active Session
                </span>
            </div>

            <div class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-6 bg-gray-50/30">
                @foreach($this->messages as $message)
                @if($message['role'] === 'assistant')

                @if($message['is_ticket'])
                <div class="flex gap-3 sm:gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-white text-[18px]">confirmation_number</span>
                        </div>
                    </div>
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl rounded-tl-sm p-4 max-w-lg w-full">
                        <div class="flex items-center gap-2 mb-2 text-blue-800">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                            <span class="font-bold text-sm">Support Ticket Created</span>
                        </div>
                        <div class="bg-white rounded-lg p-3 border border-blue-50 mb-3 shadow-sm">
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Ticket ID</p>
                            <p class="text-sm font-bold text-gray-900 mb-2">#TKT-{{ rand(1000, 9999) }}</p>
                        </div>
                        <p class="text-sm text-blue-900 mb-3">{{ $message['content'] }}</p>
                        <a href="{{ route('user.book-appointment') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition-colors shadow-sm">
                            Book Drop-off Time
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                        <p class="text-[11px] text-blue-400 mt-3 font-medium">{{ $message['time'] }}</p>
                    </div>
                </div>
                @else
                <div class="flex gap-3 sm:gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center shadow-sm">
                            <span class="material-symbols-outlined text-white text-[18px]">smart_toy</span>
                        </div>
                    </div>
                    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl rounded-tl-sm p-3 sm:p-4 max-w-[85%] sm:max-w-lg">
                        <p class="text-sm text-gray-800">{{ $message['content'] }}</p>
                        <p class="text-[11px] text-gray-400 mt-2 font-medium">{{ $message['time'] }}</p>
                    </div>
                </div>
                @endif

                @else
                <div class="flex gap-3 sm:gap-4 justify-end">
                    <div class="bg-gray-900 text-white shadow-sm rounded-2xl rounded-tr-sm p-3 sm:p-4 max-w-[85%] sm:max-w-lg">
                        <p class="text-sm">{{ $message['content'] }}</p>
                        <p class="text-[11px] text-gray-300 mt-2 font-medium text-right">{{ $message['time'] }}</p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="p-4 bg-white border-t border-gray-100 shrink-0 rounded-b-2xl">
                <form wire:submit="sendMessage" class="flex items-center gap-2">
                    <button type="button" class="p-2.5 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors focus:outline-none" title="Attach image">
                        <span class="material-symbols-outlined text-[22px]">attach_file</span>
                    </button>

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
</div>