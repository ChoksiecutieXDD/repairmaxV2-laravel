<div>
    @if($isSent)
    <div x-data="{ showSuccess: false }" x-init="setTimeout(() => showSuccess = true, 50)">

        <div x-show="showSuccess"
            x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-start="opacity-0 translate-y-6"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-cloak style="display: none;">

            <div class="flex flex-col items-center sm:items-start text-center sm:text-left mb-10">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-3xl text-gray-700">mail</span>
                </div>
                <h2 class="text-2xl font-semibold text-gray-900">Check your email</h2>
                <p class="text-gray-600 mt-2">
                    We've sent a password reset link to <span class="font-medium text-gray-900">{{ $email }}</span>.
                </p>
            </div>

            <div class="pt-4 space-y-4">
                <a href="/login" wire:navigate class="block w-full text-center bg-gray-900 text-gray-100 hover:bg-gray-800 font-medium rounded-[1.25rem] px-4 py-3 transition-colors shadow-sm">
                    Return to Log in
                </a>
            </div>

        </div>
    </div>
    @else
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Forgot password?</h2>
        <p class="text-gray-600 mt-2">Enter your email and we'll send you a link to reset your password.</p>
    </div>

    @if($errorMessage)
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-[1.25rem] text-sm">
        {{ $errorMessage }}
    </div>
    @endif

    <form wire:submit="sendResetLink" class="space-y-6">
        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" wire:model="email" required
                class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-[1.25rem] px-4 py-3 outline-none focus:outline-none focus:ring-0 focus:border-gray-800 transition-colors">
            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-gray-900 hover:bg-gray-800 text-gray-100 font-medium rounded-[1.25rem] px-4 py-3 transition-colors shadow-sm relative flex justify-center items-center"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Send password reset link</span>
                <span wire:loading>Sending link...</span>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-gray-600">
        Remembered your password?
        <a href="/login" wire:navigate class="font-semibold text-gray-900 hover:text-gray-700 underline underline-offset-4 transition-colors">
            Log in here
        </a>
    </div>
    @endif
</div>