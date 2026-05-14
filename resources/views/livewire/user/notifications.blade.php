<div class="w-full">

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-[32px] text-gray-400">notifications</span>
                Notifications
                @if($unreadCount > 0)
                    <span class="ml-2 inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full">{{ $unreadCount }}</span>
                @endif
            </h1>
            <p class="text-gray-500 mt-1">Stay updated on your repair status, appointments, and messages.</p>
        </div>

        <div class="flex gap-2">
            <select wire:model.live="filterRead" class="px-4 py-2 border border-gray-200 text-gray-700 rounded-lg font-bold shadow-sm hover:bg-gray-50">
                <option value="all">All Notifications</option>
                <option value="unread">Unread</option>
                <option value="read">Read</option>
            </select>
            <button wire:click="markAllAsRead" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg font-bold shadow-sm transition-colors shrink-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">done_all</span>
                Mark All Read
            </button>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="divide-y divide-gray-100">
            @forelse($notifications as $notification)
            <div class="p-5 sm:p-6 hover:bg-gray-50 transition-colors flex gap-4 {{ !$notification->is_read ? 'bg-blue-50/30' : '' }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0 {{ !$notification->is_read ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-500' }}">
                    <span class="material-symbols-outlined text-[24px]">{{ $this->getIconForNotification($notification) }}</span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                        <h3 class="text-base font-bold text-gray-900 leading-tight">{{ $notification->title }}</h3>
                        <span class="text-xs text-gray-400 font-medium whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    @if(!$notification->is_read)
                        <button wire:click="markAsRead({{ $notification->id }})" title="Mark as read">
                            <div class="w-2.5 h-2.5 bg-blue-600 rounded-full"></div>
                        </button>
                    @endif
                    <button wire:click="deleteNotification({{ $notification->id }})" class="text-gray-400 hover:text-red-600 transition-colors" title="Delete">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="p-12 text-center text-gray-500">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                    <span class="material-symbols-outlined text-4xl text-gray-300">notifications_paused</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">You're all caught up!</h3>
                <p class="text-sm mt-1">Check back later for updates on your repairs.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>