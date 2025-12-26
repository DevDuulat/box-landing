<style>
    [x-cloak] { display: none !important; }
</style>
@php
    use App\Enums\CardboardType;

    $productsData = [];

    foreach ($categories as $category) {
        foreach ($category->products as $product) {
            $productsData[] = [
                'key' => $product->id,
                'cat' => mb_strtolower($category->name),
                'title' => $product->name,
                'image' => $product->photo
                    ? asset('storage/' . $product->photo)
                    : 'https://placehold.co/400x300',

                'color' => $product->color_type,
                'print' => $product->print_colors_count,
                'dimensions' => $product->dimensions,
                'gost' => (bool) $product->complies_with_gost_fefco,

               'specs' => collect($product->specs ?? [])->mapWithKeys(function ($s) {
    $key = match ((string)$s['type']) {
        '1' => 'micro',
        '2' => 'threeLayer',
        '3' => 'fiveLayer',
        default => $s['type'],
    };

    return [$key => [
        'profile' => implode(', ', $s['profiles'] ?? []),
        'grades' => implode(', ', $s['grades'] ?? []),
    ]];
})->toArray(),
            ];
        }
    }
@endphp
<script>
    window.productsListData = @json($productsData);
</script>
<div class="p-8 pt-16" id="products" x-cloak>
    <div class="max-w-6xl mx-auto">
        <nav class="flex gap-8 border-b border-gray-200 mb-12 overflow-x-auto">
            @foreach($categories as $category)
                @php $catLower = mb_strtolower($category->name); @endphp
                <button
                        @click="setTab('{{ $catLower }}')"
                        :class="activeTab === '{{ $catLower }}' ? 'text-orange-500 border-orange-500' : 'text-gray-400 border-transparent'"
                        class="pb-4 px-2 border-b-2 font-medium whitespace-nowrap transition-all">
                    {{ $category->name }}
                </button>
            @endforeach
        </nav>

        <div class="flex flex-wrap -m-3">
            <template x-for="product in filteredProducts" :key="product.key">
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3">
                    <div @click="openModal(product)"
                         class="cursor-pointer bg-[#f2f2f2] rounded-3xl p-6 flex flex-col items-center hover:shadow-lg transition">
                        <div class="h-40 flex items-center justify-center mb-6 w-full">
                            <img :src="product.image" class="mix-blend-multiply max-h-full object-contain">
                        </div>
                        <h3 class="font-bold text-center" x-text="product.title"></h3>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
    <div
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="closeModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4"
            style="display: none;"
    >
        <div
                @click.outside="closeModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="relative w-full max-w-4xl bg-white rounded-[32px] md:rounded-[40px] shadow-2xl overflow-hidden max-h-[95vh] overflow-y-auto"
        >
            <button @click="closeModal" class="absolute top-6 right-6 text-gray-400 hover:text-orange-500 transition-colors z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>

            <template x-if="selected">
                <div class="p-8 md:p-12 flex flex-col md:flex-row gap-10">

                    <div class="w-full md:w-2/5 flex flex-col">
                        <h2 class="text-3xl md:text-4xl font-black text-orange-500 uppercase mb-8 leading-tight" x-text="selected.title"></h2>

                        <div class="mb-8 flex justify-center bg-gray-50 rounded-2xl p-4">
                            <img :src="selected.image" :alt="selected.title" class="max-w-full h-auto object-contain mix-blend-multiply">
                        </div>

                        <div class="flex gap-3 justify-start">
                            <template x-for="(thumb, index) in (selected.thumbnails || [selected.image])" :key="index">
                                <div class="border-b-2 border-orange-400 pb-1 cursor-pointer">
                                    <img :src="thumb" class="w-16 h-12 bg-gray-100 rounded object-cover shadow-sm">
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="w-full md:w-3/5">
                        <div class="space-y-5 text-sm md:text-base">

                            <div class="grid grid-cols-4 font-bold text-[10px] md:text-xs uppercase tracking-wider text-gray-400 mb-2">
                                <div></div>
                                <div class="text-center">Микро</div>
                                <div class="text-center">3-слойный</div>
                                <div class="text-right md:text-left md:pl-4">5-слойный</div>
                            </div>

                            <hr class="border-gray-100">

                            <div class="grid grid-cols-4 items-baseline">
                                <div class="font-bold text-gray-800">Профиль</div>
                                <div class="text-gray-500 text-center" x-text="selected.specs.micro?.profile || '—'"></div>
                                <div class="text-gray-500 text-center" x-text="selected.specs.threeLayer?.profile || '—'"></div>
                                <div class="text-gray-500 text-right md:text-left md:pl-4" x-text="selected.specs.fiveLayer?.profile || '—'"></div>
                            </div>

                            <div class="grid grid-cols-4 items-baseline">
                                <div class="font-bold text-gray-800">Марки</div>
                                <div class="text-gray-400 text-[10px] text-center" x-text="selected.specs.micro?.grades || '—'"></div>
                                <div class="text-gray-400 text-[10px] text-center" x-text="selected.specs.threeLayer?.grades || '—'"></div>
                                <div class="text-gray-400 text-[10px] text-right md:text-left md:pl-4" x-text="selected.specs.fiveLayer?.grades || '—'"></div>
                            </div>

                            <hr class="border-gray-50">

                            <div class="grid grid-cols-4 py-1">
                                <div class="font-bold text-gray-800">Цвет</div>
                                <div class="col-span-3 text-center text-gray-500" x-text="selected.color"></div>
                            </div>

                            <div class="grid grid-cols-4 py-1">
                                <div class="font-bold text-gray-800">Печать</div>
                                <div class="col-span-3 text-center text-gray-500" x-text="selected.print"></div>
                            </div>

                            <div class="grid grid-cols-4 py-1">
                                <div class="font-bold text-gray-800">Размер</div>
                                <div class="col-span-3 text-center text-gray-500" x-text="selected.dimensions"></div>
                            </div>

                            <div class="flex gap-4 pt-4">
                                <div class="w-10 h-10 rounded-xl bg-[#D9A66B] border-2 border-orange-400 cursor-pointer hover:scale-110 transition-transform shadow-sm"></div>
                                <div class="w-10 h-10 rounded-xl bg-white border border-gray-200 cursor-pointer hover:scale-110 transition-transform shadow-sm"></div>
                            </div>
                        </div>

                        <p class="mt-10 text-[10px] text-gray-400 italic leading-relaxed">
                            * Вся продукция изготавливается в соответствии с ГОСТ и каталогом FEFCO.
                            Возможна разработка индивидуальных конструкций.
                        </p>
                    </div>

                </div>
            </template>
        </div>
    </div>

</div>
<script>
    function productsComponent() {
        return {
            activeTab: '{{ mb_strtolower($categories->first()->name ?? '') }}',
            isOpen: false,
            selected: null,

            products: @json($productsData),

            get filteredProducts() {
                return this.products.filter(p => p.cat === this.activeTab)
            },

            setTab(tab) {
                this.activeTab = tab
            },

            openModal(product) {
                this.selected = product
                this.isOpen = true
                document.body.classList.add('overflow-hidden')
            },

            closeModal() {
                this.isOpen = false
                this.selected = null
                document.body.classList.remove('overflow-hidden')
            }
        }
    }
</script>

