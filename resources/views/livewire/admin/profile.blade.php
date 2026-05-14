<div>
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
        
        this.$wire.handleCroppedImage(base64);
        
        this.cropperModal = false;
        this.destroyCropper();
    },

    destroyCropper() {
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }
        if (this.$refs.fileInput) {
            this.$refs.fileInput.value = '';
        }
    }
}">

        <!-- Delete Account Modal -->
        <div x-show="deleteModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-md w-full p-10 text-center transform transition-all" 
                @click.outside="deleteModal = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">
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

        <!-- Image Cropper Modal -->
        <div x-show="cropperModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-8 bg-gray-900/60 backdrop-blur-md"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="cropperModal = false; destroyCropper()">

            <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-2xl w-full my-auto overflow-hidden flex flex-col max-h-[90vh] transform transition-all" 
                @click.outside="cropperModal = false; destroyCropper()"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-10"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-10">
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
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Profile</h1>
            <p class="text-gray-500 mt-1">Manage your professional information and account security.</p>
        </div>

        <!-- Success/Error Alerts -->
        @if (session()->has('success'))
            <div class="mb-8 p-5 rounded-2xl bg-green-50 border border-green-100 flex items-center gap-4 text-green-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
                <span class="material-symbols-outlined text-2xl text-green-500">check_circle</span>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-8 p-5 rounded-2xl bg-red-50 border border-red-100 flex items-center gap-4 text-red-800 shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
                <span class="material-symbols-outlined text-2xl text-red-500">error</span>
                <span class="font-bold text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">
            <div class="flex flex-col lg:flex-row gap-10">

                <!-- Left Column: Profile Card -->
                <div class="lg:w-1/4 flex flex-col items-center shrink-0 lg:pt-10">
                    <div class="relative group cursor-pointer mb-5"
                        @click="$refs.fileInput.click()">

                        @if($cropped_image)
                        <img src="{{ $cropped_image }}"
                            class="w-40 h-40 rounded-3xl border-4 border-blue-500 shadow-lg object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">
                        @elseif($current_profile_picture)
                        <img src="{{ asset('storage/' . $current_profile_picture) }}?t={{ time() }}"
                            class="w-40 h-40 rounded-3xl border-4 border-white shadow-md object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($first_name . ' ' . $last_name) }}&background=2563eb&color=ffffff&bold=true&size=200"
                            class="w-40 h-40 rounded-3xl border-4 border-white shadow-md object-cover bg-gray-100 transition-transform duration-300 group-hover:scale-105">
                        @endif

                        <div class="absolute inset-0 bg-black/40 rounded-3xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="material-symbols-outlined text-white text-3xl">add_a_photo</span>
                        </div>
                    </div>

                    <div class="mb-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 truncate w-full px-2">{{ $first_name }} {{ $last_name }}</h3>
                        <p class="text-sm text-blue-600 font-bold uppercase tracking-wider">{{ auth()->user()->role ?? 'Admin' }}</p>
                    </div>

                    <input type="file" x-ref="fileInput" class="hidden" accept="image/*"
                        @change="
                        const file = $event.target.files[0];
                        if (file) {
                            if (file.size > 2 * 1024 * 1024) {
                                window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Image must be under 2MB', type: 'error' } }));
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

                    <div class="mt-4 flex flex-col items-center gap-2 w-full">
                        <button type="button" @click="$refs.fileInput.click()"
                            class="flex items-center justify-center gap-2 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900 w-full max-w-[200px] py-2.5 rounded-xl font-semibold transition-colors border border-gray-200 text-sm">
                            <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                            Change Photo
                        </button>
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Max Size: 2MB</span>
                    </div>
                    
                    @if($current_profile_picture)
                    <button type="button" wire:click="deleteProfilePicture" wire:loading.attr="disabled" wire:target="deleteProfilePicture"
                        class="mt-3 flex items-center justify-center gap-2 text-red-500 hover:text-red-700 text-xs font-bold transition-colors disabled:opacity-50">
                        <span class="material-symbols-outlined text-[16px]" wire:loading.remove wire:target="deleteProfilePicture">delete</span>
                        <span class="material-symbols-outlined text-[16px] animate-spin" wire:loading wire:target="deleteProfilePicture">progress_activity</span>
                        <span wire:loading.remove wire:target="deleteProfilePicture">Remove Photo</span>
                        <span wire:loading wire:target="deleteProfilePicture">Removing...</span>
                    </button>
                    @endif
                </div>

                <!-- Right Column: Form -->
                <div class="lg:w-3/4">
                    <form wire:submit="saveChanges" class="space-y-8">

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-gray-400">person</span>
                                Professional Details
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                                    <input type="text" wire:model.live="first_name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    @error('first_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                                    <input type="text" wire:model.live="last_name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    @error('last_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                    <input type="email" wire:model="email" readonly class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-100/50 text-gray-500 cursor-not-allowed transition-all text-sm outline-none">
                                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                                    <input type="text" wire:model="phone" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Department</label>
                                    <input type="text" wire:model="department" placeholder="e.g., Tech Support" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                                    <input type="text" wire:model="job_title" placeholder="e.g., Manager" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Short Bio</label>
                                <textarea wire:model="bio" rows="3" placeholder="Tell us about your professional background..." class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 resize-none"></textarea>
                                @error('bio') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end pt-8">
                            <button type="submit" class="flex items-center justify-center gap-2 bg-gray-900 text-white hover:bg-black w-full sm:w-auto px-10 py-4 rounded-xl font-bold transition-all shadow-xl hover:shadow-gray-200 transform hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                                <span class="material-symbols-outlined text-[20px]" wire:loading.remove wire:target="saveChanges">check_circle</span>
                                <span class="material-symbols-outlined text-[20px] animate-spin" wire:loading wire:target="saveChanges">progress_activity</span>
                                <span wire:loading.remove wire:target="saveChanges">Save Changes</span>
                                <span wire:loading wire:target="saveChanges">Saving...</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Security Section -->
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8"
            x-data="{ 
                showCurrent: false,
                showNew: false,
                showConfirm: false,
                pwd: '',
                get score() {
                    let s = 0;
                    if (this.pwd.length >= 8) s++;
                    if (/[A-Z]/.test(this.pwd) && /[a-z]/.test(this.pwd)) s++;
                    if (/[0-9]/.test(this.pwd)) s++;
                    if (/[\W_]/.test(this.pwd)) s++;
                    return s;
                },
                get strengthLabel() {
                    if (this.score === 0) return '';
                    if (this.score === 1) return 'Weak';
                    if (this.score === 2 || this.score === 3) return 'Medium';
                    if (this.score === 4) return 'Strong';
                },
                get meterColor() {
                    if (this.score <= 1) return 'bg-red-500';
                    if (this.score <= 3) return 'bg-yellow-500';
                    return 'bg-green-500';
                },
                get meterWidth() {
                    if (this.score === 0) return '0%';
                    if (this.score === 1) return '25%';
                    if (this.score === 2) return '50%';
                    if (this.score === 3) return '75%';
                    return '100%';
                }
            }"
            @password-updated.window="pwd = ''">
            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-gray-400">lock</span>
                Security & Password
            </h3>

            <form wire:submit="updatePassword" class="space-y-6 w-full">
                <div class="relative">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                    <div class="relative">
                        <input :type="showCurrent ? 'text' : 'password'" wire:model="currentPassword" class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                        <button type="button" @click="showCurrent = !showCurrent" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600 bg-transparent border-none shadow-none">
                            <span class="material-symbols-outlined select-none text-xl" x-text="showCurrent ? 'visibility' : 'visibility_off'">visibility_off</span>
                        </button>
                    </div>
                    @error('currentPassword') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="relative">
                        <label class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                        <div class="relative">
                            <input :type="showNew ? 'text' : 'password'" wire:model="newPassword" @input="pwd = $event.target.value" class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                            <button type="button" @click="showNew = !showNew" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600 bg-transparent border-none shadow-none">
                                <span class="material-symbols-outlined select-none text-xl" x-text="showNew ? 'visibility' : 'visibility_off'">visibility_off</span>
                            </button>
                        </div>
                        @error('newPassword') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'" wire:model="confirmPassword" class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                            <button type="button" @click="showConfirm = !showConfirm" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600 bg-transparent border-none shadow-none">
                                <span class="material-symbols-outlined select-none text-xl" x-text="showConfirm ? 'visibility' : 'visibility_off'">visibility_off</span>
                            </button>
                        </div>
                        @error('confirmPassword') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Password Criteria -->
                <div class="mt-4 text-sm text-gray-500 p-6 bg-gray-50 rounded-2xl border border-gray-100"
                    x-cloak x-show="pwd.length > 0" x-transition>

                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-bold text-gray-700 text-xs uppercase tracking-wider">Password Strength:</span>
                            <span class="font-bold transition-colors duration-300 text-xs uppercase"
                                :class="{ 'text-red-500': score <= 1, 'text-yellow-600': score > 1 && score <= 3, 'text-green-500': score === 4 }"
                                x-text="strengthLabel"></span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full transition-all duration-300 rounded-full" :class="meterColor" :style="`width: ${meterWidth}`"></div>
                        </div>
                    </div>

                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        <li class="flex items-center gap-2 transition-colors duration-300" :class="pwd.length >= 8 ? 'text-green-600' : 'text-gray-400'">
                            <span class="material-symbols-outlined text-[18px]" x-text="pwd.length >= 8 ? 'check_circle' : 'radio_button_unchecked'">radio_button_unchecked</span>
                            <span class="text-xs font-medium">8+ characters</span>
                        </li>
                        <li class="flex items-center gap-2 transition-colors duration-300" :class="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'text-green-600' : 'text-gray-400'">
                            <span class="material-symbols-outlined text-[18px]" x-text="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'check_circle' : 'radio_button_unchecked'">radio_button_unchecked</span>
                            <span class="text-xs font-medium">Upper & lowercase</span>
                        </li>
                        <li class="flex items-center gap-2 transition-colors duration-300" :class="/[0-9]/.test(pwd) ? 'text-green-600' : 'text-gray-400'">
                            <span class="material-symbols-outlined text-[18px]" x-text="/[0-9]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">radio_button_unchecked</span>
                            <span class="text-xs font-medium">At least one number</span>
                        </li>
                        <li class="flex items-center gap-2 transition-colors duration-300" :class="/[\W_]/.test(pwd) ? 'text-green-600' : 'text-gray-400'">
                            <span class="material-symbols-outlined text-[18px]" x-text="/[\W_]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">radio_button_unchecked</span>
                            <span class="text-xs font-medium">At least one symbol</span>
                        </li>
                    </ul>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" 
                        :disabled="pwd.length > 0 && score < 2"
                        :class="pwd.length > 0 && score < 2 ? 'opacity-50 cursor-not-allowed bg-gray-400' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900'"
                        class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-bold transition-all border border-gray-200 text-sm disabled:opacity-70 disabled:cursor-not-allowed"
                        wire:loading.attr="disabled">
                        <span class="material-symbols-outlined text-[18px]" wire:loading.remove wire:target="updatePassword">key</span>
                        <span class="material-symbols-outlined text-[18px] animate-spin" wire:loading wire:target="updatePassword">progress_activity</span>
                        <span wire:loading.remove wire:target="updatePassword">Update Password</span>
                        <span wire:loading wire:target="updatePassword">Processing...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="bg-red-50 border border-red-100 rounded-2xl p-8 md:p-10 mb-12 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-bold text-red-800 mb-2 flex items-center gap-2 font-sans">
                    <span class="material-symbols-outlined text-2xl">dangerous</span>
                    Permanently Delete Account
                </h3>
                <p class="text-sm text-red-600/80 font-medium">This will erase all your history and records. This action cannot be undone.</p>
            </div>
            <button @click="deleteModal = true" class="bg-red-600 text-white hover:bg-red-700 px-8 py-3 rounded-xl font-bold transition-all shadow-md active:scale-95 whitespace-nowrap text-sm">
                Destroy Account
            </button>
        </div>

    </div>
</div>
