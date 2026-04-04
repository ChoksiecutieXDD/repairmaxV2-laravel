<div class="w-full" x-data="{ 
    deleteModal: false, 
    cropperModal: false,
    imageSource: null,
    cropper: null,
    
    initCropper() {
        const image = document.getElementById('cropper-image');
        if (!image) return;
        
        this.destroyCropper();

        this.cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            dragMode: 'move',
            background: false,
            responsive: true,
            checkOrientation: true,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
            minContainerWidth: 300,
            minContainerHeight: 300
        });
    },

    saveCrop() {
        if (!this.cropper) return;
        const canvas = this.cropper.getCroppedCanvas({
            width: 400,
            height: 400,
            imageSmoothingQuality: 'high'
        });
        const base64 = canvas.toDataURL('image/jpeg', 0.8);
        
        // FIXED: Use $wire instead of @this inside Alpine objects
        $wire.handleCroppedImage(base64);
        
        this.cropperModal = false;
        this.destroyCropper();
    },

    destroyCropper() {
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }
    }
}">

    <div x-show="deleteModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        style="background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px);"
        x-cloak
        x-transition>

        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" @click.away="deleteModal = false">
            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-3xl">warning</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Delete Account?</h2>
            <p class="text-gray-500 mb-8 text-sm leading-relaxed">
                This action is permanent and cannot be undone.
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <button @click="deleteModal = false" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button wire:click="deleteAccount" class="flex-1 px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-colors shadow-lg shadow-red-200">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div x-show="cropperModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-8"
        style="background-color: rgba(15, 23, 42, 0.85); backdrop-filter: blur(12px);"
        x-cloak
        x-transition
        @keydown.escape.window="cropperModal = false; destroyCropper()">

        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full my-auto overflow-hidden flex flex-col max-h-[90vh]" @click.away="cropperModal = false; destroyCropper()">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between shrink-0 bg-white">
                <h3 class="text-lg font-bold text-gray-900">Crop Profile Photo</h3>
                <button @click="cropperModal = false; destroyCropper()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="bg-gray-50 flex-1 flex items-center justify-center overflow-hidden min-h-[300px] sm:min-h-[400px] relative">
                <div class="w-full h-full flex items-center justify-center p-1">
                    <img id="cropper-image" :src="imageSource" class="max-w-full block">
                </div>
            </div>

            <div class="px-6 py-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3 shrink-0 bg-white">
                <button @click="cropperModal = false; destroyCropper()" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button @click="saveCrop()" class="flex-1 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200">
                    Apply Crop
                </button>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Account Settings</h1>
        <p class="text-gray-500 mt-1">Manage your personal information and profile photo.</p>
    </div>

    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">
        <div class="flex flex-col lg:flex-row gap-10">

            <div class="lg:w-1/4 flex flex-col items-center text-center shrink-0">
                <div class="relative group cursor-pointer mb-5"
                    @click="$refs.fileInput.click()">

                    @if($cropped_image)
                    <img src="{{ $cropped_image }}"
                        class="w-40 h-40 rounded-3xl border-4 border-blue-500 shadow-lg object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">
                    @elseif($current_profile_picture)
                    <img src="{{ asset('storage/' . $current_profile_picture) }}"
                        class="w-40 h-40 rounded-3xl border-4 border-white shadow-md object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($first_name . ' ' . $last_name) }}&background=f3f4f6&color=374151&bold=true&size=200"
                        class="w-40 h-40 rounded-3xl border-4 border-white shadow-md object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">
                    @endif

                    <div class="absolute inset-0 bg-black/40 rounded-3xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="material-symbols-outlined text-white text-3xl">add_a_photo</span>
                    </div>
                </div>

                <h3 class="text-xl font-bold text-gray-900 truncate w-full">{{ $first_name }} {{ $last_name }}</h3>
                <p class="text-sm text-gray-500 font-medium mb-4 capitalize">{{ $user->role ?? 'User' }}</p>

                <input type="file" x-ref="fileInput" class="hidden" accept="image/*"
                    @change="
                        const file = $event.target.files[0];
                        if (file) {
                            if (file.size > 1024 * 1024) {
                                window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Image must be under 1MB', type: 'error' } }));
                                return;
                            }
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                imageSource = e.target.result;
                                cropperModal = true;
                                $nextTick(() => initCropper());
                            };
                            reader.readAsDataURL(file);
                        }
                    ">

                <button type="button" @click="$refs.fileInput.click()"
                    class="flex items-center justify-center gap-2 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900 w-full py-2.5 rounded-xl font-semibold transition-colors border border-gray-200 text-sm">
                    <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                    Change Photo
                </button>
            </div>

            <div class="lg:w-3/4">
                <form wire:submit="updateProfile" class="space-y-8">

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-gray-400">person</span>
                            Personal Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name_input" class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                                <input type="text" id="first_name_input" wire:model="first_name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                @error('first_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="last_name_input" class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                                <input type="text" id="last_name_input" wire:model="last_name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                @error('last_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="email_input" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email_input" value="{{ $email }}" readonly class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-100 text-gray-500 text-sm outline-none cursor-not-allowed">
                                <p class="text-[10px] text-gray-400 mt-1">Contact support to update your email.</p>
                            </div>
                            <div>
                                <label for="phone_input" class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" id="phone_input" wire:model="phone" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="age_input" class="block text-sm font-bold text-gray-700 mb-2">Age</label>
                                <input type="number" id="age_input" wire:model="age" min="13" max="120" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                @error('age') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="gender_input" class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                                <select id="gender_input" wire:model="gender" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="bio_input" class="block text-sm font-bold text-gray-700 mb-2">Short Bio</label>
                            <textarea id="bio_input" wire:model="bio" rows="3" placeholder="Tell us about yourself..." class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 resize-none"></textarea>
                            @error('bio') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2 pt-6">
                            <span class="material-symbols-outlined text-gray-400">location_on</span>
                            Location
                        </h3>

                        <div class="mb-6">
                            <label for="address_input" class="block text-sm font-bold text-gray-700 mb-2">Street Address</label>
                            <input type="text" id="address_input" wire:model="address" placeholder="123 Main St" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                            @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="city_input" class="block text-sm font-bold text-gray-700 mb-2">City</label>
                                <input type="text" id="city_input" wire:model="city" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                @error('city') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="province_input" class="block text-sm font-bold text-gray-700 mb-2">Province</label>
                                <input type="text" id="province_input" wire:model="province" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                @error('province') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="country_input" class="block text-sm font-bold text-gray-700 mb-2">Country</label>
                                <select id="country_input" wire:model="country" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    <option value="PH">Philippines</option>
                                    <option value="US">United States</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="CA">Canada</option>
                                </select>
                                @error('country') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-8">
                        <button type="submit" class="flex items-center justify-center gap-2 bg-gray-900 text-white hover:bg-black w-full sm:w-auto px-10 py-4 rounded-xl font-bold transition-all shadow-xl hover:shadow-gray-200 transform hover:-translate-y-0.5 active:translate-y-0">
                            <span class="material-symbols-outlined text-[20px]" wire:loading.remove wire:target="updateProfile">check_circle</span>
                            <span class="material-symbols-outlined text-[20px] animate-spin" wire:loading wire:target="updateProfile">progress_activity</span>
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Password Update Section -->
    <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">
        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-gray-400">lock</span>
            Security & Password
        </h3>

        <form wire:submit="updatePassword" class="space-y-6 lg:w-3/4 lg:ml-auto">
            <div>
                <label for="current_password_input" class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                <input type="password" id="current_password_input" wire:model="current_password" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="new_password_input" class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                    <input type="password" id="new_password_input" wire:model="new_password" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                    @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="confirm_password_input" class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" id="confirm_password_input" wire:model="confirm_password" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                    @error('confirm_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="flex items-center justify-center gap-2 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900 px-6 py-3 rounded-xl font-bold transition-all border border-gray-200 text-sm">
                    <span class="material-symbols-outlined text-[18px]" wire:loading.remove wire:target="updatePassword">key</span>
                    <span class="material-symbols-outlined text-[18px] animate-spin" wire:loading wire:target="updatePassword">progress_activity</span>
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <div class="bg-red-50 border border-red-100 rounded-2xl p-8 md:p-10 mb-12 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div>
            <h3 class="text-xl font-bold text-red-800 mb-2 flex items-center gap-2 font-sans">
                <span class="material-symbols-outlined text-2xl">dangerous</span>
                Permanently Delete Account
            </h3>
            <p class="text-sm text-red-600/80 font-medium">This will erase all your history and records. This cannot be undone.</p>
        </div>
        <button @click="deleteModal = true" class="bg-red-600 text-white hover:bg-red-700 px-8 py-3 rounded-xl font-bold transition-all shadow-md active:scale-95 whitespace-nowrap text-sm">
            Destroy Account
        </button>
    </div>

</div>