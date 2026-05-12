<div class="w-full" x-data="{ deleteModal: false }">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
            <span class="material-symbols-outlined text-[32px] text-gray-400">settings</span>
            System Settings
        </h1>
        <p class="text-gray-500 mt-1">Manage your notifications, security preferences, and privacy.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Notifications (Large Box) -->
        <div class="lg:col-span-2 lg:row-span-2 bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-10 flex flex-col transition-all hover:shadow-md">
            <h3 class="text-xl font-black text-gray-900 mb-10 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">notifications_active</span>
                </div>
                Notifications
            </h3>

            <div class="space-y-8 flex-1">
                <div class="flex items-center justify-between group p-4 rounded-2xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                    <div class="flex gap-4 items-center">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:text-blue-500 transition-colors">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800">Email Updates</p>
                            <p class="text-sm text-gray-500">Receive emails regarding appointment status.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="email_updates" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between group p-4 rounded-2xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                    <div class="flex gap-4 items-center">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:text-blue-500 transition-colors">
                            <span class="material-symbols-outlined">sms</span>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800">SMS Notifications</p>
                            <p class="text-sm text-gray-500">Get text alerts when repairs are completed.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="sms_notifications" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between group p-4 rounded-2xl hover:bg-gray-50 transition-all border border-transparent hover:border-gray-100">
                    <div class="flex gap-4 items-center">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 group-hover:text-blue-500 transition-colors">
                            <span class="material-symbols-outlined">sell</span>
                        </div>
                        <div>
                            <p class="text-base font-bold text-gray-800">Marketing & Offers</p>
                            <p class="text-sm text-gray-500">Receive promotional emails and discounts.</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model="marketing_offers" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400 font-medium">
                <p>Last updated: Today at 2:30 PM</p>
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Live Sync Enabled
                </div>
            </div>
        </div>

        <!-- Security (Square Box) -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-10 transition-all hover:shadow-md flex flex-col">
            <h3 class="text-xl font-black text-gray-900 mb-8 flex items-center gap-4">
                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">security</span>
                </div>
                Security
            </h3>
            
            <div class="space-y-6">
                <div>
                    <p class="text-sm font-bold text-gray-800 mb-3">Password</p>
                    <a href="{{ route('user.profile') }}" class="flex items-center justify-between w-full p-3 bg-gray-50 hover:bg-gray-100 rounded-xl transition-all border border-gray-100 group">
                        <span class="text-xs font-bold text-gray-500">Change Password</span>
                        <span class="material-symbols-outlined text-[18px] text-gray-400 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                </div>

                <div class="pt-6 border-t border-gray-100">
                    <p class="text-sm font-bold text-gray-800 mb-1">2FA Security</p>
                    <p class="text-xs text-gray-500 mb-4">Add an extra layer of protection.</p>
                    <button class="w-full py-3 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-black transition-all shadow-lg shadow-gray-200">
                        Enable 2FA
                    </button>
                </div>
            </div>
        </div>

        <!-- Account (Square Box) -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-10 transition-all hover:shadow-md flex flex-col">
            <h3 class="text-xl font-black text-gray-900 mb-8 flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">account_circle</span>
                </div>
                Account
            </h3>
            
            <div class="space-y-6">
                <a href="{{ route('user.profile') }}" class="block p-4 rounded-2xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-sm transition-all group">
                    <p class="text-sm font-bold text-gray-800 flex items-center justify-between">
                        Profile Info
                        <span class="material-symbols-outlined text-[16px] text-blue-500 opacity-0 group-hover:opacity-100 transition-opacity">edit</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Update your personal details.</p>
                </a>

                <div class="pt-6 border-t border-gray-100 flex flex-col items-center text-center">
                    <p class="text-sm font-bold text-red-600 mb-3">Danger Zone</p>
                    <button @click="deleteModal = true" class="w-full py-3 bg-red-50 text-red-600 text-xs font-bold rounded-xl hover:bg-red-600 hover:text-white transition-all border border-red-100">
                        Delete Account Permanently
                    </button>
                </div>
            </div>
        </div>

        <!-- Privacy (Bottom Wide Box) -->
        <div class="lg:col-span-3 bg-gray-900 rounded-3xl shadow-xl p-8 md:p-10 text-white flex flex-col md:flex-row items-center justify-between gap-8 overflow-hidden relative group">
            <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-all duration-700"></div>
            
            <div class="relative z-10 text-center md:text-left">
                <h3 class="text-2xl font-black mb-3 flex items-center justify-center md:justify-start gap-4 text-white">
                    <span class="material-symbols-outlined text-blue-400 text-[28px]">privacy_tip</span>
                    Data & Privacy Control
                </h3>
                <p class="text-gray-300 text-sm max-w-md">Your data privacy is our priority. Control how your repair history and diagnostic data are used.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-6 relative z-10 w-full md:w-auto">
                <div class="flex items-center gap-4 p-5 bg-white/5 rounded-2xl border border-white/10 flex-1 sm:flex-none group">
                    <div>
                        <p class="text-sm font-bold text-white transition-colors">Share History</p>
                        <p class="text-[11px] text-gray-400">For faster diagnostics</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer ml-auto">
                        <input type="checkbox" wire:model="share_history" class="sr-only peer">
                        <div class="w-11 h-6 bg-white/20 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>
                
                <div class="flex items-center gap-4 p-5 bg-white/5 rounded-2xl border border-white/10 flex-1 sm:flex-none group">
                    <div>
                        <p class="text-sm font-bold text-white transition-colors">Analytics</p>
                        <p class="text-[10px] text-gray-400 font-medium">Service improvements</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer ml-auto">
                        <input type="checkbox" wire:model="analytics_tracking" class="sr-only peer">
                        <div class="w-11 h-6 bg-white/20 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gray-900"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== DELETE ACCOUNT MODAL ===== -->
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
                    <span class="material-symbols-outlined text-[32px] leading-none">warning</span>
                </div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Delete Account?</h3>
                <p class="text-sm text-gray-400 font-medium mt-2">This action is irreversible. You will lose access to all your repair history, invoices, and profile data.</p>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-100 flex gap-3">
                <button type="button" @click="deleteModal = false" 
                    class="flex-1 py-4 bg-white text-gray-700 font-bold rounded-2xl border border-gray-200 hover:bg-gray-100 transition-all">
                    Cancel
                </button>
                <button type="button" wire:click="deleteAccount" 
                    class="flex-1 py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all shadow-lg shadow-red-200">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>