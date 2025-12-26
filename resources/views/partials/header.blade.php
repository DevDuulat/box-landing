<header id="main-header" x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 w-full z-50 bg-[#111111] transition-colors duration-300 font-montserrat">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20 md:h-24">
            <div class="flex-shrink-0">
                <div class="flex flex-col leading-none">
                    <span class="text-[#FFA500] font-black text-xl md:text-2xl tracking-tighter uppercase">Ya</span>
                    <span class="text-[#FFA500] font-black text-lg md:text-xl tracking-[0.25em] -mt-1 uppercase">Carton</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center ml-[80px] space-x-10">
                <a href="#products" class="text-gray-400 hover:text-white transition-colors text-[18px] font-semibold">{{ __('messages.nav_products') }}</a>
                <a href="#branding" class="text-gray-400 hover:text-white transition-colors text-[18px] font-semibold">{{ __('messages.nav_branding') }}</a>
                <a href="#contacts" class="text-gray-400 hover:text-white transition-colors text-[18px] font-semibold">{{ __('messages.nav_contacts') }}</a>
            </nav>

            <div class="flex items-center space-x-2 md:space-x-8">
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
                    <button @click="open = !open" class="flex items-center space-x-2 bg-[#1a1a1a]/80 md:bg-[#1a1a1a] px-3 py-2 rounded-xl border border-transparent active:scale-95">
                        <img :src="currentFlag" :alt="currentLang" class="w-6 md:w-8 h-auto rounded-sm">
                        <span class="text-white font-bold text-sm md:text-lg uppercase" x-text="currentLang"></span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute right-0 mt-2 w-32 bg-[#1a1a1a] rounded-xl shadow-2xl z-50 border border-gray-800 overflow-hidden">
                        <template x-for="(lang, key) in languages" :key="key">
                            <a :href="'/lang/' + key" class="flex items-center space-x-3 w-full px-4 py-3 hover:bg-[#333] group">
                                <img :src="lang.flag" class="w-6 h-auto rounded-sm">
                                <span class="text-gray-400 group-hover:text-white font-bold text-sm uppercase" x-text="lang.code"></span>
                            </a>
                        </template>
                    </div>
                </div>

                <button @click="openOrderModal()" class="hidden sm:block bg-[#FFA500] hover:bg-orange-500 text-white px-6 py-3 rounded-lg text-[16px] font-normal transition-all whitespace-nowrap">
                    {{ __('messages.order_title') }}
                </button>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-white p-2">
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="lg:hidden bg-[#1a1a1a] border-t border-gray-800 px-4 py-6 space-y-4 shadow-xl" x-cloak>
        <nav class="flex flex-col space-y-4">
            <a href="#products" @click="mobileMenuOpen = false" class="text-gray-300 text-lg font-semibold">{{ __('messages.nav_products') }}</a>
            <a href="#branding" @click="mobileMenuOpen = false" class="text-gray-300 text-lg font-semibold">{{ __('messages.nav_branding') }}</a>
            <a href="#contacts" @click="mobileMenuOpen = false" class="text-gray-300 text-lg font-semibold">{{ __('messages.nav_contacts') }}</a>
        </nav>
        <button @click="isOrderModalOpen = true; mobileMenuOpen = false" class="w-full bg-[#FFA500] text-white py-4 rounded-xl font-bold">
            {{ __('messages.order_title') }}
        </button>
    </div>
</header>

<div x-show="isOrderModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
    <div x-show="isOrderModalOpen" x-transition:enter="transition opacity-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" @click="closeModal()" class="fixed inset-0 bg-black/80 backdrop-blur-md"></div>

    <div x-show="isOrderModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="relative bg-[#1a1a1a] border border-gray-800 w-full max-w-lg rounded-3xl p-8 z-[101]">
        <button @click="closeModal()" class="absolute top-6 right-6 text-gray-500 hover:text-white">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <h3 class="text-2xl font-black text-white uppercase mb-6">
            {{ __('messages.modal_title_part1') }} <span class="text-[#FFA500]">{{ __('messages.modal_title_part2') }}</span>
        </h3>

        <form action="{{ route('order.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('messages.name_label') }}"
                       class="w-full bg-[#111] border @error('name') border-red-500 @else border-gray-800 @enderror rounded-xl px-5 py-4 text-white focus:border-[#FFA500] outline-none">
                @error('name') <span class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="{{ __('messages.phone_label') }}"
                       class="w-full bg-[#111] border @error('phone') border-red-500 @else border-gray-800 @enderror rounded-xl px-5 py-4 text-white focus:border-[#FFA500] outline-none">
                @error('phone') <span class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</span> @enderror
            </div>

            <div>
                <textarea name="message" placeholder="{{ __('messages.message_label') }}"
                          class="w-full bg-[#111] border border-gray-800 rounded-xl px-5 py-4 text-white focus:border-[#FFA500] outline-none h-24">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-[#FFA500] text-white font-bold py-4 rounded-xl hover:bg-orange-500 transition-all active:scale-95">
                {{ __('messages.submit_btn') }}
            </button>
        </form>
    </div>
</div>