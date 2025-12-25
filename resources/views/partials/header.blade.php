<header class="absolute top-0 left-0 w-full z-50 bg-transparent font-montserrat">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center h-24">
            <div class="flex-shrink-0">
                <div class="flex flex-col leading-none">
                    <span class="text-[#FFA500] font-black text-2xl tracking-tighter uppercase">Ya</span>
                    <span class="text-[#FFA500] font-black text-xl tracking-[0.25em] -mt-1 uppercase">Carton</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center ml-[80px] space-x-10">
                <a href="#products" class="text-gray-400 hover:text-white transition-colors text-[18px] font-semibold leading-none">Продукция</a>
                <a href="#branding" class="text-gray-400 hover:text-white transition-colors text-[18px] font-semibold leading-none">Брендирование</a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors text-[18px] font-semibold leading-none">Контакты</a>
            </nav>

            <div class="ml-auto flex items-center space-x-8">
                <div x-data="{
        open: false,
        currentLang: 'RU',
        currentFlag: 'https://flagcdn.com/w40/ru.png',
        languages: [
            { code: 'RU', name: 'Ru', flag: 'https://flagcdn.com/w40/ru.png' },
            { code: 'KG', name: 'Kg', flag: 'https://flagcdn.com/w40/kg.png' }
        ]
     }"
                     class="relative inline-block text-left">

                    <button @click="open = !open"
                            class="flex items-center space-x-3 bg-[#1a1a1a] hover:bg-[#262626] px-4 py-2 rounded-xl transition-all border border-transparent active:scale-95">
                        <img :src="currentFlag" :alt="currentLang" class="w-8 h-auto rounded-md shadow-sm">
                        <span class="text-white font-bold text-lg uppercase tracking-wide" x-text="currentLang"></span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         class="absolute left-0 mt-2 w-full min-w-[120px] bg-[#1a1a1a] rounded-xl shadow-2xl z-50 overflow-hidden border border-gray-800">

                        <template x-for="lang in languages" :key="lang.code">
                            <button @click="currentLang = lang.code; currentFlag = lang.flag; open = false;"
                                    class="flex items-center space-x-3 w-full px-4 py-3 hover:bg-[#333] transition-colors group">
                                <img :src="lang.flag" :alt="lang.code" class="w-8 h-auto rounded-md opacity-80 group-hover:opacity-100">
                                <span class="text-gray-400 group-hover:text-white font-bold text-lg uppercase" x-text="lang.code"></span>
                            </button>
                        </template>
                    </div>
                </div>
                <a href="#" class="bg-[#FFA500] hover:bg-orange-500 text-white px-6 py-3 rounded-lg text-[16px] font-normal flex items-center transition-all whitespace-nowrap">
                    Оставить заявку
                </a>
            </div>
        </div>
    </div>
</header>