<div class="w-full">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Support Tickets</h1>
            <p class="text-gray-500 mt-1">Manage customer support tickets and issues.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900">Open Tickets</h2>
            <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm">
                <option>All Tickets</option>
                <option>Open</option>
                <option>In Progress</option>
                <option>Resolved</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4"><span class="font-medium text-gray-900">#TKT-{{ str_pad($ticket->id, 3, '0', STR_PAD_LEFT) }}</span></td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-900 font-medium">{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</span>
                                    <span class="text-gray-500 text-xs">{{ $ticket->user->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><span class="text-gray-600">{{ $ticket->subject }}</span></td>
                            <td class="px-6 py-4">
                                @if(!$ticket->admin_read)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-xs font-bold">New</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-50 text-gray-700 border border-gray-100 rounded-lg text-xs font-bold">Read</span>
                                @endif
                            </td>
                            <td class="px-6 py-4"><span class="text-gray-500 text-sm">{{ $ticket->created_at->format('M d, Y') }}</span></td>
                            <td class="px-6 py-4">
                                <button wire:click="viewMessage({{ $ticket->id }})" class="text-blue-600 hover:text-blue-800 font-bold text-sm">View</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">No support tickets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- View Message Modal -->
    <x-ui.modal name="view-message" maxWidth="2xl">
        @if($selectedMessage)
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $selectedMessage->subject }}</h3>
                        <p class="text-gray-500 mt-1">Ticket #TKT-{{ str_pad($selectedMessage->id, 3, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <div class="flex items-center gap-4 mb-8 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold text-lg overflow-hidden">
                        @if($selectedMessage->user->profile_picture)
                            <img src="{{ Storage::url($selectedMessage->user->profile_picture) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($selectedMessage->user->first_name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900">{{ $selectedMessage->user->first_name }} {{ $selectedMessage->user->last_name }}</span>
                            <span class="text-xs text-gray-500">{{ $selectedMessage->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <span class="text-sm text-gray-500">{{ $selectedMessage->user->email }}</span>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                    {!! nl2br(e($selectedMessage->message)) !!}
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <button @click="show = false" class="px-6 py-2 text-gray-700 font-bold hover:bg-gray-100 rounded-full transition-colors">Close</button>
                    <button class="px-6 py-2 bg-gray-900 text-white font-bold rounded-full hover:bg-black transition-all shadow-lg">Reply</button>
                </div>
            </div>
        @endif
    </x-ui.modal>
</div>
