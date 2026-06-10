<div x-data="{ 
        showConsent: false,
        acceptCookies() {
            // Set cookie for 365 days
            const d = new Date();
            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
            let expires = 'expires=' + d.toUTCString();
            document.cookie = 'cookie_consent_accepted=true;' + expires + ';path=/;SameSite=Lax';
            this.showConsent = false;
        },
        checkConsent() {
            const cookies = document.cookie.split(';');
            let accepted = false;
            for (let i = 0; i < cookies.length; i++) {
                let c = cookies[i].trim();
                if (c.indexOf('cookie_consent_accepted=') === 0) {
                    accepted = true;
                    break;
                }
            }
            this.showConsent = !accepted;
        }
     }"
     x-init="checkConsent()"
     x-show="showConsent"
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 translate-y-10"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-10"
     class="fixed bottom-0 left-0 right-0 z-[9999] bg-[#020617]/95 backdrop-blur-md text-gray-200 py-4 px-6 md:px-8 shadow-2xl flex flex-col sm:flex-row items-center justify-center gap-4 text-center sm:text-left"
     x-cloak>
    
    <div class="max-w-7xl w-full flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-xs md:text-[13px] text-gray-300 font-medium leading-relaxed max-w-4xl">
            We use cookies to make your experience of our websites better. By using and further navigating this website you accept this. Detailed information about the use of cookies on this website is available by clicking on 
            <a href="{{ route('legal') }}#privacy" class="underline text-blue-400 hover:text-blue-300 transition-colors font-semibold">more information</a>.
        </p>
        
        <button @click="acceptCookies()" 
                class="shrink-0 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/50 active:scale-95 select-none">
            Accept and Close
        </button>
    </div>
</div>
