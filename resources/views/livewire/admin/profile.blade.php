<div class="w-full" x-data="{ 
    deleteModal: false, 
    cropperModal: false,
    imageSource: null,
    cropper: null,
    
    initCropper() {
        const image = document.getElementById('cropper-image');
        if (!image) return;
        
        this.destroyCropper();

        // Wait for image to load before initializing cropper
        if (!image.complete) {
            image.onload = () => {
                this.createCropper(image);
            };
        } else {
            this.createCropper(image);
        }
    },

    createCropper(image) {
        try {
            if (typeof Cropper === 'undefined') {
                console.error('Cropper.js library not loaded');
                return;
            }
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
        } catch (error) {
            console.error('Error initializing cropper:', error);
        }
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
    }
}"
    @open-cropper-modal.window="cropperModal = true; imageSource = $event.detail.url; $nextTick(() => initCropper())"
>

    <!-- Delete Account Modal -->
    <div x-show="deleteModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        style="background-color: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px);"
        x-cloak
        x-transition>

        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" @click.outside="deleteModal = false">
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
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-8"
        style="background-color: rgba(15, 23, 42, 0.85); backdrop-filter: blur(12px);"
        x-cloak
        x-transition
        @keydown.escape.window="cropperModal = false; destroyCropper()">

        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full my-auto overflow-hidden flex flex-col max-h-[90vh]" @click.outside="cropperModal = false; destroyCropper()">
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

            <div class="px-6 py-4 border-t border-gray-100 bg-white flex gap-3 justify-end shrink-0">
                <button @click="cropperModal = false; destroyCropper()" class="px-4 py-2 text-gray-700 font-bold hover:bg-gray-100 rounded-lg transition-colors">
                    Cancel
                </button>
                <button @click="saveCrop()" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors">
                    Crop & Save
                </button>
            </div>
        </div>
    </div>

    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Profile</h1>
            <p class="text-gray-500 mt-1">Manage your profile and account settings.</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
        <!-- Profile Picture Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sticky top-6">
                <div class="text-center mb-6">
                    @if($current_profile_picture)
                        <img src="{{ asset('storage/' . $current_profile_picture) }}?t={{ time() }}" 
                             alt="Profile" 
                             class="w-28 h-28 rounded-full mx-auto mb-4 border-4 border-blue-500 object-cover"
                             loading="eager">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->getFullName()) }}&background=2563eb&color=ffffff&bold=true&size=120" 
                             alt="Profile" 
                             class="w-28 h-28 rounded-full mx-auto mb-4 border-4 border-gray-300">
                    @endif
                    <h2 class="text-xl font-bold text-gray-900">{{ auth()->user()->getFullName() }}</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ $job_title ?? 'Administrator' }}</p>
                </div>

                <div class="space-y-3 border-t border-gray-100 pt-6 mb-6">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Email:</span>
                        <span class="text-sm font-medium text-gray-900 truncate ml-2">{{ $email }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Role:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 bg-blue-50 text-blue-700 border border-blue-100 rounded-lg text-xs font-bold">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center gap-1 text-sm font-medium {{ auth()->user()->is_active ? 'text-green-600' : 'text-red-600' }}">
                            <span class="w-2 h-2 rounded-full {{ auth()->user()->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                            {{ auth()->user()->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Joined:</span>
                        <span class="text-sm font-medium text-gray-900">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <!-- Photo Upload Actions -->
                <div class="space-y-2">
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
                                // Wait for DOM to update and image to load
                                setTimeout(() => initCropper(), 100);
                            };
                            reader.readAsDataURL(file);
                        }
                    ">
                    <button type="button" @click="$refs.fileInput.click()" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                        Change Photo
                    </button>
                    @if($current_profile_picture)
                        <button type="button" wire:click="deleteProfilePicture" class="w-full px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-lg transition-colors text-sm border border-red-200 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                            Remove Photo
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Basic Information</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                            <input wire:model="first_name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('first_name') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                            <input wire:model="last_name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('last_name') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input wire:model="email" type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        @error('email') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input wire:model="phone" type="tel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        @error('phone') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Department</label>
                            <input wire:model="department" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Tech Support"/>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Job Title</label>
                            <input wire:model="job_title" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Manager"/>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                        <textarea wire:model="bio" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent h-24 resize-none" placeholder="Tell us about yourself..."></textarea>
                        @error('bio') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                        <button wire:click="saveChanges" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">save</span>
                            Save Changes
                        </button>
                        <button wire:click="$refresh" class="px-6 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg font-bold hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Password Management -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Security</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                        <input wire:model="currentPassword" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        @error('currentPassword') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                            <input wire:model="newPassword" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('newPassword') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                            <input wire:model="confirmPassword" type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('confirmPassword') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                        <button wire:click="updatePassword" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">lock</span>
                            Update Password
                        </button>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-2xl border border-red-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-red-100 bg-red-50">
                    <h2 class="text-lg font-bold text-red-900">Danger Zone</h2>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-4">Permanently delete your account and all associated data. This action cannot be undone.</p>
                    <button @click="deleteModal = true" class="px-6 py-2 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">delete_forever</span>
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropper JS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
</div>
</div>
