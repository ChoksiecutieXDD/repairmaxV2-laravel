<div class="w-full" x-data="{ openModal: @entangle('isEditMode') }">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Announcements</h1>
            <p class="text-gray-500 mt-1">Manage public notices, alert banners, and updates shown on the booking pages.</p>
        </div>
        <!-- Add Button -->
        <button wire:click="$set('isEditMode', true)" 
            class="bg-gray-900 text-white px-8 h-[52px] rounded-full font-black text-sm flex items-center justify-center gap-2 hover:bg-blue-600 transition-all shadow-md active:scale-95 group whitespace-nowrap shrink-0 border-none outline-none">
            <span class="material-symbols-outlined text-[20px]">add</span>
            New Announcement
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-bold text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('message') }}
        </div>
    @endif

    <!-- Announcements List -->
    <div class="bg-white rounded-[1.25rem] border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Message Notice</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest w-32">Style Type</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-32">Active Status</th>
                    <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-32">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($announcements as $announcement)
                    <tr class="hover:bg-gray-50/50 transition-all group">
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $announcement->content }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1.5 font-mono">Created: {{ $announcement->created_at->format('M d, Y h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm
                                @if($announcement->style === 'warning') bg-amber-50 text-amber-700 border border-amber-200
                                @elseif($announcement->style === 'success') bg-emerald-50 text-emerald-700 border border-emerald-200
                                @elseif($announcement->style === 'danger') bg-red-50 text-red-700 border border-red-200
                                @else bg-blue-50 text-blue-700 border border-blue-200
                                @endif bg-white">
                                <span class="w-1.5 h-1.5 rounded-full 
                                    @if($announcement->style === 'warning') bg-amber-500
                                    @elseif($announcement->style === 'success') bg-emerald-500
                                    @elseif($announcement->style === 'danger') bg-red-500
                                    @else bg-blue-500
                                    @endif"></span>
                                {{ $announcement->style }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button wire:click="toggleStatus({{ $announcement->id }})" 
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border transition-all cursor-pointer bg-white shadow-sm
                                {{ $announcement->is_active ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $announcement->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button wire:click="edit({{ $announcement->id }})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </button>
                                <button wire:click="confirmDelete({{ $announcement->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all border-none bg-transparent cursor-pointer">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic text-sm">No announcements configured yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="laravel-pagination px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $announcements->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- Edit/Create Modal -->
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center" x-cloak>
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-md" @click="$wire.resetFields()"></div>

        <!-- Modal Container -->
        <div x-show="openModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative bg-white modal-content rounded-[2.5rem] shadow-2xl w-full max-w-lg transform transition-all overflow-hidden flex flex-col z-10">
            
            <div class="flex justify-between items-center px-10 pt-10 pb-6 border-b border-gray-100">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">{{ $editingAnnouncementId ? 'edit' : 'campaign' }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">{{ $editingAnnouncementId ? 'Edit' : 'Create' }} Announcement</h2>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Alert Broadcasts</p>
                    </div>
                </div>
                <button type="button" wire:click="resetFields" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-all border-none bg-transparent cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>

            <form wire:submit.prevent="save" class="flex flex-col">
                <div class="p-10 space-y-6">
                    <!-- Message Content -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Announcement Message Notice</label>
                        <textarea wire:model="content" placeholder="Type notice banner message here..." rows="4" class="w-full px-5 py-4 border border-gray-200 rounded-[1.25rem] bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none text-sm font-bold text-gray-900 resize-none" required></textarea>
                        @error('content') <span class="text-xs text-red-500 mt-1 block ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Style Class -->
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Banner Color Accent Style</label>
                        <div class="relative w-full">
                            <select wire:model="style" class="w-full pl-6 pr-12 py-4 bg-gray-50 border border-gray-200 rounded-[1.25rem] focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-400 transition-all text-sm font-bold text-gray-900 outline-none appearance-none cursor-pointer">
                                <option value="info">Info (Blue)</option>
                                <option value="warning">Warning (Amber/Yellow)</option>
                                <option value="success">Success (Green)</option>
                                <option value="danger">Danger (Red)</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">unfold_more</span>
                        </div>
                    </div>

                    <!-- Status Toggle -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-[1.25rem] border border-gray-100">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-800">Show Immediately</span>
                            <span class="text-xs text-gray-400">Make this active and render on booking forms</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="is_active" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>

                <div class="px-10 py-6 border-t border-gray-100 bg-gray-50/50 flex justify-end gap-3 rounded-b-[2.5rem]">
                    <button type="button" wire:click="resetFields" class="px-6 py-3.5 border border-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Cancel</button>
                    <button type="submit" class="px-8 py-3.5 bg-gray-900 hover:bg-blue-600 text-white font-bold rounded-full transition-all shadow-md active:scale-95 text-xs border-none cursor-pointer">
                        {{ $editingAnnouncementId ? 'Save Changes' : 'Broadcast Notice' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    @if($confirmingDeletionId)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md">
        <div class="bg-white modal-content rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl border border-gray-100 animate-scale-in">
            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-[36px]">delete_forever</span>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-2">Delete Announcement?</h3>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">This action cannot be undone. The announcement will be permanently removed.</p>
            <div class="flex gap-3 justify-center">
                <button wire:click="cancelDelete" class="px-6 py-3 border border-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-100 transition-all text-xs bg-white cursor-pointer shadow-sm">Keep it</button>
                <button wire:click="delete" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full transition-all text-xs border-none cursor-pointer shadow-md">Delete</button>
            </div>
        </div>
    </div>
    @endif
</div>
