<header id="main-header" x-data="{ mobileMenuOpen: false }"
        class="fixed top-0 left-0 w-full z-50 bg-[#111111] border-b border-white/5 transition-colors duration-300 font-montserrat">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20 md:h-24">

            <div class="flex items-center">
                <a href="/" class="text-2xl md:text-3xl font-black tracking-tighter uppercase text-white">
                    BOX<span class="text-[#FFA500]">.</span>
                </a>
            </div>

            <nav class="hidden lg:flex items-center space-x-10 uppercase tracking-[0.1em]">
                <a href="#products" class="text-gray-400 hover:text-[#FFA500] transition-colors text-[14px] font-black">
                    {{ __('messages.nav_products') }}
                </a>
                <a href="#branding" class="text-gray-400 hover:text-[#FFA500] transition-colors text-[14px] font-black">
                    {{ __('messages.nav_branding') }}
                </a>
                <a href="#contacts" class="text-gray-400 hover:text-[#FFA500] transition-colors text-[14px] font-black">
                    {{ __('messages.nav_contacts') }}
                </a>
            </nav>

            <div class="flex items-center space-x-3 md:space-x-8">

                <div x-data="{
                            open: false,
                            locale: '{{ app()->getLocale() }}',
                            languages: {
                                ru: { code: 'RU', flag: 'https://flagcdn.com/w40/ru.png' },
                                kg: { code: 'KG', flag: 'https://flagcdn.com/w40/kg.png' }
                            },
                            get currentLang() { return this.languages[this.locale]?.code ?? 'RU' },
                            get currentFlag() { return this.languages[this.locale]?.flag ?? this.languages.ru.flag }
                        }" class="relative inline-block text-left">
                    <button @click="open = !open"
                            class="flex items-center space-x-2 bg-[#1a1a1a] hover:bg-[#222] px-3 py-2 rounded-xl border border-white/5 transition active:scale-95">
                        <img :src="currentFlag" :alt="currentLang" class="w-6 md:w-7 h-auto rounded-sm grayscale-[0.5] group-hover:grayscale-0">
                        <span class="text-white font-black text-sm md:text-base uppercase tracking-tighter" x-text="currentLang"></span>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-cloak
                         class="absolute right-0 mt-2 w-32 bg-[#1a1a1a] rounded-xl shadow-2xl z-50 border border-white/10 overflow-hidden">
                        <template x-for="(lang, key) in languages" :key="key">
                            <a :href="'/lang/' + key" class="flex items-center space-x-3 w-full px-4 py-3 hover:bg-[#FFA500]/10 group transition-colors">
                                <img :src="lang.flag" class="w-6 h-auto rounded-sm transition group-hover:scale-110">
                                <span class="text-gray-400 group-hover:text-white font-black text-xs uppercase" x-text="lang.code"></span>
                            </a>
                        </template>
                    </div>
                </div>

                <button @click="isOrderModalOpen = true"
                        class="hidden sm:block bg-[#FFA500] hover:bg-orange-500 text-white px-7 py-3.5 rounded-xl text-[14px] font-black uppercase tracking-tight transition-all active:scale-95 shadow-lg shadow-orange-500/20">
                    {{ __('messages.order_title') }}
                </button>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-white p-2">
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FFA500]" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden bg-[#1a1a1a] border-t border-white/5 px-6 py-8 space-y-6 shadow-2xl" x-cloak>
        <nav class="flex flex-col space-y-4">
            <a href="#products" @click="mobileMenuOpen = false" class="text-white text-xl font-black uppercase tracking-widest">{{ __('messages.nav_products') }}</a>
            <a href="#branding" @click="mobileMenuOpen = false" class="text-white text-xl font-black uppercase tracking-widest">{{ __('messages.nav_branding') }}</a>
            <a href="#contacts" @click="mobileMenuOpen = false" class="text-white text-xl font-black uppercase tracking-widest">{{ __('messages.nav_contacts') }}</a>
        </nav>
        <button @click="isOrderModalOpen = true; mobileMenuOpen = false"
                class="w-full bg-[#FFA500] text-white py-4 rounded-xl font-black uppercase tracking-widest shadow-lg">
            {{ __('messages.order_title') }}
        </button>
    </div>
</header>