<style>
    /* Скрываем скроллбар, сохраняя функционал */
    .custom-scrollbar-hide::-webkit-scrollbar { display: none; }
    .custom-scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="md:hidden sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="flex overflow-x-auto custom-scrollbar-hide py-4 px-4 space-x-2 scroll-smooth">
        @foreach($categories as $category)
            @php $catSlug = mb_strtolower($category->name); @endphp
            <button
                    @click="setTab('{{ $catSlug }}'); $el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });"
                    class="whitespace-nowrap px-5 py-2.5 rounded-full text-[11px] font-black uppercase tracking-widest transition-all duration-300 border flex-shrink-0"
                    :class="activeTab === '{{ $catSlug }}'
                        ? 'bg-[#FFA500] border-[#FFA500] text-white shadow-[0_4px_12px_rgba(255,165,0,0.3)]'
                        : 'bg-gray-50 border-gray-200 text-gray-500 hover:bg-gray-100'">
                {{ $category->name }}
            </button>
        @endforeach
    </div>
</div>