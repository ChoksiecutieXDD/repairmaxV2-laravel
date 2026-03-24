<div x-data="{ 
        show: false, 
        title: '', 
        message: '', 
        confirmMethod: '', 
        confirmText: 'Confirm' 
     }"
    x-on:confirm-action.window="
        show = true; 
        title = $event.detail.title;
        message = $event.detail.message;
        confirmMethod = $event.detail.method;
        confirmText = $event.detail.buttonText || 'Confirm';
     "
    style="display: none;"
    x-show="show"
    class="fixed inset-0 z-50 overflow-y-auto">

    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>

    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div x-show="show"
            x-on:click.away="show = false"
            x-transition
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md p-6">

            <div class="flex items-center gap-4 mb-4">
                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900" x-text="title"></h3>
            </div>

            <p class="text-sm text-gray-600 mb-6" x-text="message"></p>

            <div class="flex gap-3 justify-end">
                <button @click="show = false" class="px-4 py-2 bg-white text-gray-700 font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button @click="$wire.call(confirmMethod); show = false"
                    class="px-4 py-2 bg-gray-900 text-white font-medium rounded-md hover:bg-gray-800 transition-colors"
                    x-text="confirmText">
                </button>
            </div>
        </div>
    </div>
</div>