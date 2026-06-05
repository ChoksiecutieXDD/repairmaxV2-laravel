<div>
    <div class="mb-10 text-center sm:text-left">
        <h2 class="text-2xl font-bold text-white">Log in to your account</h2>
        <p class="text-gray-400 mt-2">Welcome back! Please enter your details.</p>
    </div>

    <form wire:submit="login" class="space-y-6">

        @if (session()->has('error'))
        <x-ui.alert type="error">{{ session('error') }}</x-ui.alert>
        @endif

        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
            <input type="email" id="email" wire:model="email" required
                class="w-full bg-white/5 border border-white/10 text-white rounded-[1.25rem] px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition-colors placeholder-gray-500">
            @error('email') <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span> @enderror
        </div>

        <div class="relative mt-6" x-data="{ show: false }">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <a href="/forgot-password" class="text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors">Forgot password?</a>
            </div>

            <div class="relative">
                <input :type="show ? 'text' : 'password'" id="password" wire:model="password" required
                    class="w-full bg-white/5 border border-white/10 text-white rounded-[1.25rem] px-4 py-3 pr-12 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition-colors placeholder-gray-500">

                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 py-0 flex items-center bg-transparent border-none shadow-none focus:ring-0 outline-none hover:bg-transparent hover:shadow-none hover:translate-y-0 text-gray-400 hover:text-white cursor-pointer">
                    <span class="material-symbols-outlined select-none text-2xl" x-text="show ? 'visibility' : 'visibility_off'">
                        visibility_off
                    </span>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-xs absolute -bottom-5 left-0">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center pt-2">
            <input type="checkbox" id="remember" wire:model="remember"
                class="h-4 w-4 rounded border-white/10 bg-white/5 text-blue-600 focus:ring-blue-500 focus:ring-offset-[#020617]">
            <label for="remember" class="ml-2 block text-sm text-gray-300">
                Remember me for 30 days
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white hover:bg-blue-500 font-bold rounded-[1.25rem] px-4 py-3 transition-all shadow-lg hover:-translate-y-0.5 duration-200 relative flex justify-center items-center">
                <span wire:loading.remove wire:target="login">Sign In</span>
                <span wire:loading wire:target="login">Signing in...</span>
            </button>
        </div>
    </form>

    <div class="mt-8 text-center text-sm text-gray-400">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-blue-400 hover:text-blue-300 transition-colors">
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
            class="fixed inset-0 bg-gray-950 bg-opacity-75 transition-opacity backdrop-blur-sm"></div>

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
                    class="relative transform overflow-hidden rounded-2xl bg-slate-900/95 border border-white/10 backdrop-blur-xl text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md">

                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-500/10 sm:mx-0 sm:h-10 sm:w-10">
                                <span class="material-symbols-outlined text-red-550">error</span>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-white" id="modal-title" x-text="title"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-400" x-text="message"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" @click="open = false" class="inline-flex w-full justify-center rounded-[1.25rem] bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:w-auto">
                            Try Again
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>