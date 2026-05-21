<div class="w-full">
    <!-- Header Section -->
    <div class="mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-[36px] text-blue-600">notifications</span>
                Notifications
                @if($unreadCount > 0)
                <span class="ml-2 inline-flex items-center justify-center px-2.5 py-1 text-xs font-black text-white bg-red-500 rounded-full animate-pulse">{{ $unreadCount }} Unread</span>
                @endif
            </h1>
            <p class="text-gray-500 mt-1">Review status updates, appointment confirmations, and support messages in your inbox.</p>
        </div>

        <div class="flex flex-wrap gap-3 w-full lg:w-auto">
            <button wire:click="markAllAsRead"
                class="flex-1 lg:flex-none justify-center bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-5 py-3 rounded-xl font-bold shadow-sm transition-all duration-200 flex items-center gap-2 text-sm shrink-0">
                <span class="material-symbols-outlined text-[20px] text-green-500">done_all</span>
                Mark All Read
            </button>
            <button wire:click="deleteAllNotifications"
                onclick="return confirm('Are you sure you want to delete all notifications? This action cannot be undone.')"
                class="flex-1 lg:flex-none justify-center bg-red-50 border border-red-200 text-red-700 hover:bg-red-100 px-5 py-3 rounded-xl font-bold shadow-sm transition-all duration-200 flex items-center gap-2 text-sm shrink-0">
                <span class="material-symbols-outlined text-[20px]">delete_sweep</span>
                Delete All
            </button>
        </div>
    </div>

    @if (session()->has('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2">
        <span class="material-symbols-outlined text-green-600 text-lg">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <!-- Inbox Container -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Left Panel: Sidebar Notification List -->
        <div class="col-span-1 lg:col-span-5 xl:col-span-4 bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col h-[75vh] overflow-hidden">

            <!-- Sidebar Controls -->
            <div class="p-4 border-b border-gray-100 bg-gray-50/60 shrink-0 space-y-3">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-xl">search</span>
                    <input type="text" wire:model.live="search" placeholder="Search in notifications..."
                        class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all" />
                </div>

                <div class="flex gap-2">
                    <button wire:click="$set('filterRead', 'all')"
                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-bold transition-all border {{ $filterRead === 'all' ? 'bg-blue-600 text-white border-blue-600 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                        All
                    </button>
                    <button wire:click="$set('filterRead', 'unread')"
                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-bold transition-all border {{ $filterRead === 'unread' ? 'bg-blue-600 text-white border-blue-600 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                        Unread
                    </button>
                    <button wire:click="$set('filterRead', 'read')"
                        class="flex-1 py-1.5 px-3 rounded-lg text-xs font-bold transition-all border {{ $filterRead === 'read' ? 'bg-blue-600 text-white border-blue-600 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                        Read
                    </button>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="flex-1 overflow-y-auto divide-y divide-gray-100">
                @forelse($notifications as $notification)
                @php
                $isSelected = $selectedNotificationId == $notification->id;
                $isUnread = !$notification->is_read;
                $icon = $this->getIconForNotification($notification);

                // Custom styles based on notification type
                $iconColorClass = match(true) {
                str_contains(strtolower($notification->title), 'appointment') => 'bg-blue-50 text-blue-600 border border-blue-100',
                str_contains(strtolower($notification->title), 'completed') => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
                str_contains(strtolower($notification->title), 'message') || str_contains(strtolower($notification->title), 'inquiry') => 'bg-indigo-50 text-indigo-600 border border-indigo-100',
                default => 'bg-gray-50 text-gray-600 border border-gray-150'
                };
                @endphp
                <div
                    wire:click="selectNotification({{ $notification->id }})"
                    class="p-4 hover:bg-gray-50/80 cursor-pointer flex gap-3 transition-all duration-200 group relative {{ $isSelected ? 'bg-blue-50/40 border-l-4 border-l-blue-600 pl-3' : '' }}">
                    <!-- Unread Dot Indicator -->
                    @if($isUnread)
                    <span class="absolute top-4 right-4 w-2.5 h-2.5 bg-blue-600 rounded-full ring-4 ring-blue-50"></span>
                    @endif

                    <!-- Icon Container -->
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm {{ $iconColorClass }}">
                        <span class="material-symbols-outlined text-[20px]">{{ $icon }}</span>
                    </div>

                    <!-- Content Details -->
                    <div class="flex-1 min-w-0 pr-2">
                        <div class="flex justify-between items-start gap-1">
                            <h3 class="text-xs uppercase font-mono font-bold tracking-wide {{ $isUnread ? 'text-blue-700' : 'text-gray-500' }}">
                                {{ $notification->type ? str_replace('_', ' ', $notification->type) : 'Notification' }}
                            </h3>
                        </div>
                        <h4 class="text-sm leading-snug truncate mt-0.5 {{ $isUnread ? 'font-black text-gray-900' : 'font-medium text-gray-750' }}">
                            {{ $notification->title }}
                        </h4>
                        <p class="text-xs text-gray-500 truncate mt-0.5 leading-relaxed">
                            {{ $notification->message }}
                        </p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span class="material-symbols-outlined text-[12px] text-gray-400">schedule</span>
                            <span class="text-[10px] text-gray-400 font-bold">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Item Delete Trigger -->
                    <div class="shrink-0 flex items-center self-center opacity-0 group-hover:opacity-100 transition-opacity" @click.stop>
                        <button wire:click.stop="deleteNotification({{ $notification->id }})"
                            class="p-1 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete Notification">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center text-gray-500 my-auto">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-gray-100">
                        <span class="material-symbols-outlined text-3xl text-gray-300">notifications_paused</span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">All caught up!</h3>
                    <p class="text-xs text-gray-500 mt-1">No active notifications match the criteria.</p>
                </div>
                @endforelse
            </div>

            <!-- Sidebar Footer Pagination -->
            @if($notifications->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50/50 shrink-0">
                {{ $notifications->links() }}
            </div>
            @endif
        </div>

        <!-- Right Panel: Notification Details Drawer -->
        <div class="col-span-1 lg:col-span-7 xl:col-span-8 bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col h-[75vh] overflow-hidden">
            @if($selectedNotification)
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/40 flex justify-between items-center shrink-0">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400 bg-white p-2 rounded-xl border border-gray-150">info</span>
                    <div>
                        <h2 class="text-base font-bold text-gray-900 leading-snug">{{ $selectedNotification->title }}</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Received {{ $selectedNotification->created_at->format('M d, Y \a\t h:i A') }} ({{ $selectedNotification->created_at->diffForHumans() }})</p>
                    </div>
                </div>

                <button wire:click="deleteNotification({{ $selectedNotification->id }})"
                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all flex items-center gap-1.5 text-xs font-bold" title="Delete this notification">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Delete Alert
                </button>
            </div>

            <!-- Body Scroll Area -->
            <div class="p-6 md:p-8 overflow-y-auto space-y-6 flex-1">
                <!-- Notification Text Bubble -->
                <div class="bg-blue-50/30 border border-blue-100 rounded-2xl p-5 md:p-6 shadow-sm">
                    <p class="text-sm font-semibold text-blue-800 uppercase tracking-widest text-[10px] font-mono mb-2">Message Alert</p>
                    <p class="text-gray-800 leading-relaxed text-sm whitespace-pre-wrap font-medium">{{ trim($selectedNotification->message) }}</p>
                </div>

                <!-- Related Instance Data Card -->
                @if($relatedDetails)
                <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm">

                    <!-- Appointment Entity Details -->
                    @if(strtolower($selectedNotification->related_model) === 'appointment')
                    <div class="px-5 py-4 bg-blue-600 text-white flex justify-between items-center">
                        <h3 class="font-bold flex items-center gap-2 text-sm text-white">
                            <span class="material-symbols-outlined text-white">build_circle</span>
                            Linked Appointment Sheet
                        </h3>
                        <span class="font-mono text-xs bg-white/20 px-3 py-1 rounded-lg font-bold border border-white/15 text-white">
                            {{ $relatedDetails->tracking_code }}
                        </span>
                    </div>
                    <div class="p-5 md:p-6 bg-white space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Device Item</span>
                                <span class="font-bold text-gray-900 mt-1 block">{{ $relatedDetails->device_brand }} - {{ $relatedDetails->device_model }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Fault Type</span>
                                <span class="font-bold text-gray-900 mt-1 block">{{ $relatedDetails->fault_category }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Appointment Schedule</span>
                                <span class="font-bold text-gray-900 mt-1 block">{{ $relatedDetails->pref_date?->format('M d, Y') ?? 'N/A' }} @ {{ date('h:i A', strtotime($relatedDetails->pref_time)) }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Current Status</span>
                                @php
                                $statusColor = match($relatedDetails->status) {
                                'Completed' => 'green',
                                'In Progress' => 'orange',
                                'Ready for Pickup' => 'blue',
                                'Scheduled' => 'indigo',
                                'Pending' => 'yellow',
                                'Cancelled' => 'red',
                                default => 'gray'
                                };
                                $statusBgClass = "bg-{$statusColor}-100 text-{$statusColor}-700 border border-{$statusColor}-200";
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 mt-1 {{ $statusBgClass }} rounded-lg text-xs font-black capitalize">
                                    {{ $relatedDetails->status }}
                                </span>
                            </div>
                            <hr class="md:col-span-2 border-gray-100 my-1">
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Device Password / PIN</span>
                                <span class="font-mono font-bold text-gray-900 mt-1 block">{{ $relatedDetails->device_password ?? 'None provided' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Estimated Quote</span>
                                <span class="font-bold text-green-600 mt-1 block">₱{{ number_format($relatedDetails->quote ?? 0, 2) }}</span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end">
                            <a href="{{ route('user.upcoming-appointments') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-750 text-white rounded-xl text-xs font-black transition-all shadow-md shadow-blue-100 tracking-wider uppercase">
                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                View My Appointments
                            </a>
                        </div>
                    </div>

                    <!-- Support Messages Entity Details -->
                    @elseif(strtolower($selectedNotification->related_model) === 'message')
                    <div class="px-5 py-4 bg-indigo-600 text-white flex justify-between items-center">
                        <h3 class="font-bold flex items-center gap-2 text-sm text-white">
                            <span class="material-symbols-outlined text-white">mail</span>
                            User Inquiry Message
                        </h3>
                        <span class="text-xs bg-white/20 px-3 py-1 rounded-lg font-bold border border-white/15 text-white">
                            ID #{{ $relatedDetails->id }}
                        </span>
                    </div>
                    <div class="p-5 md:p-6 bg-white space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="md:col-span-2">
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider">Inquiry Subject</span>
                                <span class="font-bold text-gray-900 mt-1 block">{{ $relatedDetails->subject }}</span>
                            </div>
                            <div class="md:col-span-2 bg-gray-50 border border-gray-150 rounded-xl p-4 mt-2">
                                <span class="text-[10px] uppercase font-mono font-bold text-gray-400 block tracking-wider mb-2">Message Body</span>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-sm">{{ $relatedDetails->message }}</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end">
                            <a href="{{ route('user.support-message') }}"
                                class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-750 text-white rounded-xl text-xs font-black transition-all shadow-md shadow-indigo-100 tracking-wider uppercase">
                                <span class="material-symbols-outlined text-[16px]">reply</span>
                                Open Support Hub
                            </a>
                        </div>
                    </div>
                    @endif

                </div>
                @else
                <!-- Fallback message if related model deleted/not matching -->
                @if($selectedNotification->related_model)
                <div class="border border-dashed border-gray-200 bg-gray-50/50 rounded-2xl p-6 text-center text-gray-500">
                    <span class="material-symbols-outlined text-4xl text-gray-300">link_off</span>
                    <h4 class="text-sm font-bold text-gray-800 mt-2">Linked detail sheet unavailable</h4>
                    <p class="text-xs text-gray-500 mt-1">
                        The related {{ strtolower(str_replace('_', ' ', $selectedNotification->related_model)) }} record may have been completed, archived, or is inaccessible.
                    </p>
                </div>
                @endif
                @endif
            </div>
            @else
            <!-- No Notification Selected Empty State -->
            <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-gray-500">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 border border-gray-100">
                    <span class="material-symbols-outlined text-4xl text-gray-300">inbox</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Select a notification</h3>
                <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                    Click on any notification in the inbox list to review its complete details and launch associated sheets.
                </p>
            </div>
            @endif
        </div>

    </div>
</div>