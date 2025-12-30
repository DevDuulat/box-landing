<div class="flex flex-col w-full h-full bg-[#111111] text-white border-r border-white/5 font-montserrat">
    <div class="h-[1px] w-full bg-white/5 flex-shrink-0"></div>

    <nav class="flex-1 w-full px-2 pt-4 overflow-y-auto space-y-1 custom-scrollbar">
        @foreach($categories as $category)
            @php $catSlug = mb_strtolower($category->name); @endphp

            <div class="flex flex-col">
                <button
                        @click="setTab('{{ $catSlug }}')"
                        class="flex items-center justify-between w-full group transition-all duration-300 relative min-h-[50px] py-3 px-4 rounded-xl hover:bg-white/5"
                        :class="activeTab === '{{ $catSlug }}' ? 'bg-white/5 text-white' : 'text-gray-500 hover:text-gray-200'">

                    <span class="text-[13px] font-black uppercase tracking-[0.05em] transition-all leading-tight text-left max-w-[80%]"
                          :class="activeTab === '{{ $catSlug }}' ? 'text-[#FFA500]' : ''">
                        {{ $category->name }}
                    </span>

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4 transition-transform duration-300"
                         :class="activeTab === '{{ $catSlug }}' ? 'rotate-180 text-[#FFA500]' : 'text-gray-600'"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="activeTab === '{{ $catSlug }}'"
                     x-collapse
                     x-cloak
                     class="flex flex-col pl-6 pr-2 py-2 space-y-1">

                    <template x-for="product in filteredProducts" :key="product.key">
                        <button @click="openModal(product)"
                                class="text-left py-2 px-3 rounded-lg text-[12px] font-medium text-gray-400 hover:text-[#FFA500] hover:bg-white/5 transition-all flex items-center gap-2">
                            <span class="w-1 h-1 bg-[#FFA500] rounded-full opacity-50"></span>
                            <span x-text="product.title"></span>
                        </button>
                    </template>

                    <template x-if="filteredProducts.length === 0">
                        <span class="text-[11px] text-gray-600 italic pl-3">Нет товаров</span>
                    </template>
                </div>
            </div>
        @endforeach
    </nav>

    <div class="flex-shrink-0 p-6 border-t border-white/5 bg-[#111111]">
        <div class="flex flex-col gap-1">
            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Связь с нами</span>
            <a href="tel:+74957408966" class="text-base font-black hover:text-[#FFA500] transition-colors whitespace-nowrap">
                8 (495) 740-89-66
            </a>
        </div>
    </div>
</div>