<div>
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-semibold text-gray-900">Log in to your account</h2>
        <p class="text-gray-600 mt-2">Welcome back! Please enter your details.</p>
    </div>

    <form wire:submit="login" class="space-y-6">

        @if (session()->has('error'))
        <x-ui.alert type="error">{{ session('error') }}</x-ui.alert>
        @endif

        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" wire:model="email" required
                class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-[1.25rem] px-4 py-3 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">
            @error('email') <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span> @enderror
        </div>

        <div class="relative mt-6" x-data="{ show: false }">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <a href="/forgot-password" class="text-sm font-medium text-gray-900 hover:text-gray-700 underline underline-offset-4 transition-colors">Forgot password?</a>
            </div>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" wire:model="password" required
                    class="w-full bg-gray-100 border border-gray-300 text-gray-900 rounded-[1.25rem] px-4 py-3 pr-12 focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition-colors">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <span class="material-symbols-outlined select-none text-2xl" x-text="show ? 'visibility' : 'visibility_off'">
                        visibility_off
                    </span>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center pt-2">
            <input type="checkbox" id="remember" wire:model="remember"
                class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900">
            <label for="remember" class="ml-2 block text-sm text-gray-700">
                Remember me for 30 days
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gray-900 text-white hover:bg-gray-800 font-medium rounded-[1.25rem] px-4 py-3 transition-colors shadow-sm relative flex justify-center items-center">
                <span wire:loading.remove wire:target="login">Sign In</span>
                <span wire:loading wire:target="login">Signing in...</span>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-gray-900 hover:text-gray-700 underline underline-offset-4 transition-colors">
            Register here
        </a>
    </div>

    <div x-data="{ open: false, title: '', message: '' }"
        x-on:open-modal.window="open = true; title = $event.detail.title; message = $event.detail.message"
        x-show="open"
        class="relative z-50"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
        x-cloak
        style="display: none;">

        <div x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">

                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <span class="material-symbols-outlined text-red-600">error</span>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title" x-text="title"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500" x-text="message"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" @click="open = false" class="inline-flex w-full justify-center rounded-[1.25rem] bg-gray-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 sm:w-auto">
                            Try Again
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ open: false, url: '' }"
        x-on:login-success.window="open = true; url = $event.detail.url; setTimeout(() => window.location.href = url, 1500)"
        x-show="open"
        class="relative z-50"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
        x-cloak
        style="display: none;">

        <div x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="fixed inset-0 bg-gray-900 bg-opacity-80 transition-opacity backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="open"
                    x-transition:enter="ease-out duration-300 delay-100"
                    x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-90"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    class="relative transform overflow-hidden rounded-xl bg-white p-8 text-center shadow-2xl transition-all sm:w-full sm:max-w-sm">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 mb-6">
                        <span class="material-symbols-outlined text-4xl text-green-600">check_circle</span>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Login Successful!</h3>
                    <p class="text-gray-500 mb-8">Welcome back. We are preparing your dashboard...</p>

                    <div class="flex justify-center">
                        <svg class="animate-spin h-8 w-8 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>