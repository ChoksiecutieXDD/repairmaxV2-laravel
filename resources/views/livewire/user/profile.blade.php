<div class="w-full">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Account Settings</h1>
        <p class="text-gray-500 mt-1">Manage your personal information, address, and security preferences.</p>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">

        @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-10">

            <div class="lg:w-1/4 flex flex-col items-center text-center shrink-0">
                <div class="relative group cursor-pointer mb-5">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=f3f4f6&color=374151&bold=true&size=200"
                        alt="Profile Photo"
                        class="w-40 h-40 rounded-full border-4 border-white shadow-md object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">

                    <div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="material-symbols-outlined text-white text-3xl">photo_camera</span>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-900">{{ $first_name }} {{ $last_name }}</h3>
                <p class="text-sm text-gray-500 font-medium mb-4 capitalize">{{ $user->role ?? 'User' }}</p>

                <button class="flex items-center justify-center gap-2 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900 w-full py-2.5 rounded-lg font-semibold transition-colors border border-gray-200">
                    <span class="material-symbols-outlined text-[20px]">upload</span>
                    Change Photo
                </button>
            </div>

            <div class="lg:w-3/4">
                <form wire:submit="updateProfile" class="space-y-6">

                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400">person</span>
                        Personal Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                            <input type="text" id="first_name" wire:model="first_name" required class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                            <input type="text" id="last_name" wire:model="last_name" required class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" wire:model="email" required class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm disabled:bg-gray-50 disabled:text-gray-500" disabled>
                            <span class="text-xs text-gray-400 mt-1 block">Email address cannot be changed.</span>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                            <input type="text" id="phone" wire:model="phone" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="age" class="block text-sm font-bold text-gray-700 mb-2">Age</label>
                            <input type="number" id="age" wire:model="age" min="13" max="120" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                            <select id="gender" wire:model="gender" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                                <option value="" disabled>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other / Prefer not to say</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-2 mt-10 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-400">location_on</span>
                        Location
                    </h3>

                    <div>
                        <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Street Address</label>
                        <textarea id="address" wire:model="address" rows="2" placeholder="123 Main St, Unit 4B" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="city" class="block text-sm font-bold text-gray-700 mb-2">City</label>
                            <input type="text" id="city" wire:model="city" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                        <div>
                            <label for="province" class="block text-sm font-bold text-gray-700 mb-2">Province / State</label>
                            <input type="text" id="province" wire:model="province" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-bold text-gray-700 mb-2">Country</label>
                            <select id="country" wire:model="country" class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                                <option value="PH">Philippines</option>
                                <option value="US">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="CA">Canada</option>
                                <option value="AU">Australia</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="flex items-center justify-center gap-2 bg-gray-900 text-white hover:bg-gray-800 w-full sm:w-auto px-10 py-3 rounded-lg font-semibold transition-colors shadow-md">
                            <span class="material-symbols-outlined text-[20px]" wire:loading.remove wire:target="updateProfile">save</span>
                            <span class="material-symbols-outlined text-[20px] animate-spin" wire:loading wire:target="updateProfile">progress_activity</span>
                            Save Profile
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">
        <div class="flex flex-col sm:flex-row gap-8 items-start">

            <div class="sm:w-1/3">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 shrink-0">
                        <span class="material-symbols-outlined text-2xl">lock</span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Security</h2>
                </div>
                <p class="text-sm text-gray-500">Update your password to keep your account secure.</p>
            </div>

            <div class="sm:w-2/3 w-full">
                @if (session()->has('password_success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                    <span class="font-semibold text-sm">{{ session('password_success') }}</span>
                </div>
                @endif

                <form wire:submit="updatePassword" class="space-y-6">
                    <div>
                        <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                        <input type="password" id="current_password" wire:model="current_password" placeholder="••••••••" required class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="new_password" class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                            <input type="password" id="new_password" wire:model="new_password" placeholder="••••••••" required class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                        <div>
                            <label for="confirm_password" class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" id="confirm_password" wire:model="confirm_password" placeholder="••••••••" required class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-100 transition-all text-sm">
                        </div>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="bg-gray-100 text-gray-900 hover:bg-gray-200 border border-gray-200 px-6 py-2.5 rounded-lg font-semibold transition-colors shadow-sm text-sm">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="bg-red-50/50 border border-red-100 shadow-sm rounded-2xl p-6 md:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <h3 class="text-lg font-bold text-red-800 mb-1 flex items-center gap-2">
                    <span class="material-symbols-outlined">warning</span>
                    Delete Account
                </h3>
                <p class="text-sm text-red-600">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
            <button class="bg-white text-red-600 border border-red-200 hover:bg-red-50 hover:text-red-700 px-6 py-2.5 rounded-lg font-semibold transition-colors shadow-sm text-sm whitespace-nowrap">
                Delete Account
            </button>
        </div>
    </div>

</div>