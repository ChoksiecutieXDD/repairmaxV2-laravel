<div>
    @if($isReset)
    <div class="flex flex-col items-center text-center mt-8"
        x-data="{ showSuccess: false }"
        x-init="setTimeout(() => showSuccess = true, 50)">

        <div x-show="showSuccess"
            x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-start="opacity-0 translate-y-6"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="flex flex-col items-center"
            x-cloak style="display: none;">

            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-6 border border-white/10">
                <span class="material-symbols-outlined text-3xl text-white">check_circle</span>
            </div>

            <h2 class="text-2xl font-bold text-white mb-2">Password reset complete</h2>

            <p class="text-gray-400 mb-8 max-w-sm">
                Your password has been successfully updated. You can now log in to your Repairmax account with your new credentials.
            </p>

            <a href="/login" wire:navigate class="w-full bg-blue-600 text-white font-bold rounded-[1.25rem] px-4 py-3 hover:bg-blue-500 transition-all shadow-lg hover:-translate-y-0.5 duration-200 block text-center">
                Return to Log in
            </a>
        </div>
    </div>
    @else
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-bold text-white">Set new password</h2>
        <p class="text-gray-400 mt-2">Please enter your new password below.</p>
    </div>

    @if($errors->has('email'))
    <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-md text-sm">
        {{ $errors->first('email') }}
    </div>
    @endif

    <form wire:submit="updatePassword" class="space-y-6">

        <div x-data="{ 
                show: false, 
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
            }">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-300">New Password</label>
            </div>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password"
                    wire:model="password" @input="pwd = $event.target.value" required
                    class="w-full bg-white/5 border border-white/10 text-white rounded-[1.25rem] px-4 py-3 pr-12 outline-none focus:outline-none focus:ring-0 focus:border-blue-500 transition-colors placeholder-gray-500">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-white cursor-pointer">
                    <span class="material-symbols-outlined select-none text-2xl" x-text="show ? 'visibility' : 'visibility_off'">
                        visibility_off
                    </span>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

            <div class="mt-4 text-sm text-gray-400"
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
                        <span class="font-medium text-gray-300">Password Strength:</span>
                        <span class="font-bold transition-colors duration-300"
                            :class="{ 'text-red-500': score <= 1, 'text-yellow-600': score > 1 && score <= 3, 'text-green-500': score === 4 }"
                            x-text="strengthLabel"></span>
                    </div>
                    <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full transition-all duration-300 rounded-full" :class="meterColor" :style="`width: ${meterWidth}`"></div>
                    </div>
                </div>

                <p class="mb-3 font-medium text-gray-400 text-xs">Requirements:</p>
                <ul class="grid grid-cols-2 gap-x-4 gap-y-2">
                    <li class="flex items-center gap-1.5 transition-colors duration-300 text-xs" :class="pwd.length >= 8 ? 'text-green-500' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[16px] select-none shrink-0" x-text="pwd.length >= 8 ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="translate-y-[1px]">At least 8 characters</span>
                    </li>
                    <li class="flex items-center gap-1.5 transition-colors duration-300 text-xs" :class="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'text-green-500' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[16px] select-none shrink-0" x-text="(/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="translate-y-[1px]">Upper & lowercase</span>
                    </li>
                    <li class="flex items-center gap-1.5 transition-colors duration-300 text-xs" :class="/[0-9]/.test(pwd) ? 'text-green-500' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[16px] select-none shrink-0" x-text="/[0-9]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="translate-y-[1px]">At least one number</span>
                    </li>
                    <li class="flex items-center gap-1.5 transition-colors duration-300 text-xs" :class="/[\W_]/.test(pwd) ? 'text-green-500' : 'text-gray-500'">
                        <span class="material-symbols-outlined text-[16px] select-none shrink-0" x-text="/[\W_]/.test(pwd) ? 'check_circle' : 'radio_button_unchecked'">
                            radio_button_unchecked
                        </span>
                        <span class="translate-y-[1px]">At least one symbol</span>
                    </li>
                </ul>
            </div>
        </div>

        <div x-data="{ showConfirm: false }" class="mt-4">
            <div class="flex items-center justify-between mb-2">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
            </div>

            <div class="relative">
                <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation"
                    wire:model="password_confirmation" required
                    class="w-full bg-white/5 border border-white/10 text-white rounded-[1.25rem] px-4 py-3 pr-12 outline-none focus:outline-none focus:ring-0 focus:border-blue-500 transition-colors placeholder-gray-500">

                <button type="button" @click="showConfirm = !showConfirm"
                    class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-white cursor-pointer">
                    <span class="material-symbols-outlined select-none text-2xl" x-text="showConfirm ? 'visibility' : 'visibility_off'">
                        visibility_off
                    </span>
                </button>
            </div>
        </div>

        <div class="pt-6">
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-[1.25rem] px-4 py-3 transition-all shadow-lg hover:-translate-y-0.5 duration-200 relative flex justify-center items-center"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Reset Password</span>
                <span wire:loading>Updating...</span>
            </button>
        </div>

    </form>
    @endif
</div>