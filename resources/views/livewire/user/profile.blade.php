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
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Account Settings</h1>
            <p class="text-gray-500 mt-1">Manage your personal information and profile photo.</p>
        </div>

        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 md:p-10 mb-8">
            <div class="flex flex-col lg:flex-row gap-10">

                <div class="lg:w-1/4 flex flex-col items-center shrink-0 lg:pt-10">
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

                    <div class="mb-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 truncate w-full px-2">{{ $first_name }} {{ $last_name }}</h3>
                        <p class="text-sm text-gray-500 font-medium capitalize">{{ $user->role ?? 'User' }}</p>
                    </div>

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
                        class="flex items-center justify-center gap-2 bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900 w-full max-w-[200px] py-2.5 rounded-xl font-semibold transition-colors border border-gray-200 text-sm">
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
                                    <input type="text" id="first_name_input" wire:model.live="first_name" wire:key="first_name_input" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    @error('first_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="last_name_input" class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                                    <input type="text" id="last_name_input" wire:model.live="last_name" wire:key="last_name_input" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
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
                                    <input type="text" id="phone_input" wire:model.blur="phone" wire:key="phone_input" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="birthdate_input" class="block text-sm font-bold text-gray-700 mb-2">Birthdate</label>
                                    <input type="date" id="birthdate_input" wire:model.live="birthdate" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white transition-all text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
                                    @error('birthdate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="age_display" class="block text-sm font-bold text-gray-700 mb-2">Age</label>
                                        <input type="text" id="age_display" value="{{ $age }}" readonly class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-100 text-gray-500 text-sm outline-none cursor-not-allowed">
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
                                        <option value="">Select Country</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="CV">Cabo Verde</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo (Brazzaville)</option>
                                        <option value="CD">Congo (Kinshasa)</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CW">Curaçao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czechia</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="SZ">Eswatini</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GU">Guam</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="CI">Ivory Coast</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macau</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar (Burma)</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="KP">North Korea</option>
                                        <option value="MK">North Macedonia</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PW">Palau</option>
                                        <option value="PS">Palestine</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn Islands</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RE">Réunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="WS">Samoa</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">São Tomé and Príncipe</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SX">Sint Maarten</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia & South Sandwich Islands</option>
                                        <option value="KR">South Korea</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="BL">St. Barthélemy</option>
                                        <option value="KN">St. Kitts and Nevis</option>
                                        <option value="LC">St. Lucia</option>
                                        <option value="MF">St. Martin</option>
                                        <option value="PM">St. Pierre and Miquelon</option>
                                        <option value="VC">St. Vincent and Grenadines</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syria</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="VI">U.S. Virgin Islands</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican City</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
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

            <form wire:submit="updatePassword" class="space-y-6 w-full">
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
</div>