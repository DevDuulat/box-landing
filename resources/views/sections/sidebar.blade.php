<div class="flex flex-col w-full h-full bg-[#111111] text-white border-r border-white/5 font-montserrat">

    <div class="h-[1px] w-full bg-white/5 flex-shrink-0"></div>

    <nav class="flex-1 w-full px-2 pt-4 overflow-y-auto space-y-1 uppercase tracking-[0.05em] custom-scrollbar">
        @foreach($categories as $category)
            @php $catSlug = mb_strtolower($category->name); @endphp
            <button
                    @click="setTab('{{ $catSlug }}'); document.getElementById('products').scrollIntoView({ behavior: 'smooth' });"
                    class="flex items-center justify-between w-full group transition-all duration-300 relative min-h-[55px] py-3 px-4 rounded-xl hover:bg-white/5"
                    :class="activeTab === '{{ $catSlug }}' ? 'bg-white/5 text-white' : 'text-gray-500 hover:text-gray-200'">

                <span class="text-[13px] font-black transition-all leading-tight text-left max-w-[80%]"
                      :class="activeTab === '{{ $catSlug }}' ? 'translate-x-1 text-[#FFA500]' : 'group-hover:translate-x-1'">
                    {{ $category->name }}
                </span>

                <div x-show="activeTab === '{{ $catSlug }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-0"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="w-1.5 h-1.5 bg-[#FFA500] rounded-full shadow-[0_0_10px_#FFA500] flex-shrink-0"></div>
            </button>
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