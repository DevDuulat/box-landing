<div class="hidden md:flex flex-col w-full h-full px-4 bg-[#111111] text-white border-r border-white/5 font-montserrat">
    <div class="mb-6 pt-10 px-4 flex-shrink-0">
        <h2 class="text-[10px] font-black tracking-[0.3em] text-[#FFA500] uppercase opacity-80">Каталог</h2>
        <div class="h-[1px] bg-gradient-to-r from-[#FFA500] to-transparent w-12 mt-2"></div>
    </div>

    <nav class="flex-1 w-full overflow-y-auto pr-2 space-y-2 custom-scrollbar uppercase tracking-[0.05em]">
        @foreach($categories as $category)
            @php $catSlug = mb_strtolower($category->name); @endphp
            <button
                    @click="setTab('{{ $catSlug }}'); document.getElementById('products').scrollIntoView({ behavior: 'smooth' });"
                    class="flex items-center justify-between w-full group transition-all duration-300 relative min-h-[65px] py-4 px-4 rounded-xl hover:bg-white/5"
                    :class="activeTab === '{{ $catSlug }}' ? 'bg-white/5 text-white' : 'text-gray-500 hover:text-gray-200'">

                <span class="text-[14px] font-black transition-all leading-tight text-left max-w-[80%]"
                      :class="activeTab === '{{ $catSlug }}' ? 'translate-x-2 text-[#FFA500]' : 'group-hover:translate-x-1'">
                    {{ $category->name }}
                </span>

                <div x-show="activeTab === '{{ $catSlug }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-0"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="w-2 h-2 bg-[#FFA500] rounded-full shadow-[0_0_12px_#FFA500] flex-shrink-0 ml-4"></div>
            </button>
        @endforeach
    </nav>

    <div class="mt-auto pt-6 pb-10 border-t border-white/5 space-y-8 px-4 flex-shrink-0">
        <div class="flex flex-col items-start">
            <a href="tel:+74957408966" class="text-[18px] font-black tracking-tight hover:text-[#FFA500] transition-colors whitespace-nowrap">
                8 (495) 740-89-66
            </a>
            <button @click="isOrderModalOpen = true" class="text-[9px] uppercase font-black tracking-[0.2em] mt-3 text-[#FFA500] hover:text-white transition-colors border-b border-[#FFA500]/30 hover:border-white">
                ЗАКАЗАТЬ ЗВОНОК
            </button>
        </div>

        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-2">
                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_#22c55e]"></div>
                <span class="text-[11px] font-black tracking-[0.1em] text-gray-500 uppercase opacity-60">11:00 — 21:00</span>
            </div>
        </div>
    </div>
</div>