<div>
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Set new password</h2>
        <p class="text-gray-600 mt-2">Please enter your new password below.</p>
    </div>

    <form wire:submit="updatePassword" class="space-y-6">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" wire:model="email" readonly
                class="w-full bg-gray-200 border border-gray-300 text-gray-500 rounded-md px-4 py-3 cursor-not-allowed focus:outline-none">
            @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div x-data="{
            show1: false,
            show2: false,
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
        }" class="space-y-6">

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                <div class="relative">
                    <input :type="show1 ? 'text' : 'password'" id="password" wire:model="password" @input="pwd = $event.target.value" required
                        class="w-full bg-gray-100 border border-gray-400 text-gray-900 rounded-md px-4 py-3 pr-12 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">

                    <button type="button" @click="show1 = !show1"
                        class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-gray-600 cursor-pointer">
                        <span class="material-symbols-outlined select-none text-2xl" x-text="show1 ? 'visibility' : 'visibility_off'">
                            visibility_off
                        </span>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="text-sm text-gray-500"
                x-cloak
                x-show="pwd.length > 0"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                style="display: none;">

                <div class="mb-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-medium text-gray-700">Password Strength:</span>
                        <span class="font-bold transition-colors duration-300"
                            :class="{ 'text-red-500': score <= 1, 'text-yellow-600': score > 1 && score <= 3, 'text-green-500': score === 4 }"
                            x-text="strengthLabel"></span>
                    </div>
                    <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full transition-all duration-300 rounded-full" :class="meterColor" :style="`width: ${meterWidth}`"></div>
                    </div>
                </div>

                <p class="mb-3 font-medium text-gray-700">Requirements:</p>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-4">
                    <li class="flex items-center gap-2 transition-colors duration-300" :class="pwd.length >= 8 ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="pwd.length >= 8 ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="truncate">At least 8 characters</span>
                    </li>

                    <li class="flex items-center gap-2 transition-colors duration-300" :class="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="truncate">Upper & lowercase letters</span>
                    </li>

                    <li class="flex items-center gap-2 transition-colors duration-300" :class="/[0-9]/.test(pwd) ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="/[0-9]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="truncate">At least one number</span>
                    </li>

                    <li class="flex items-center gap-2 transition-colors duration-300" :class="/[\W_]/.test(pwd) ? 'text-green-600' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[18px] select-none" x-text="/[\W_]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="truncate">At least one symbol (!@#$%)</span>
                    </li>
                </ul>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <input :type="show2 ? 'text' : 'password'" id="password_confirmation" wire:model="password_confirmation" required
                        class="w-full bg-gray-100 border border-gray-400 text-gray-900 rounded-md px-4 py-3 pr-12 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">

                    <button type="button" @click="show2 = !show2"
                        class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-gray-600 cursor-pointer">
                        <span class="material-symbols-outlined select-none text-2xl" x-text="show2 ? 'visibility' : 'visibility_off'">
                            visibility_off
                        </span>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    :disabled="score < 2"
                    :class="score < 2 ? 'opacity-50 cursor-not-allowed bg-gray-600' : 'bg-gray-900 hover:bg-gray-800'"
                    class="w-full text-gray-100 font-medium rounded-md px-4 py-3 transition-colors shadow-sm relative flex justify-center items-center gap-2"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="updatePassword">Reset Password</span>
                    <span wire:loading wire:target="updatePassword">Saving...</span>
                </button>
            </div>

        </div>

    </form>

    <div class="mt-8 text-center text-sm text-gray-600">
        <a href="/login" class="inline-flex items-center justify-center gap-1 font-semibold text-gray-900 hover:text-gray-700 transition-colors">
            <span class="underline underline-offset-4">Back to log in</span>
        </a>
    </div>
</div>