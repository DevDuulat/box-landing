<style>
    [x-cloak] { display: none !important; }
</style>

<script>
    window.productsListData = @json($productsData);
</script>

<div class="p-8 pt-16 scroll-mt-20" id="products" x-cloak>
    <div class="max-w-6xl mx-auto">

        @foreach($categories as $category)
            @php $catSlug = mb_strtolower($category->name); @endphp

            <div class="mb-10 border-l-4 border-orange-500 pl-6 mt-16" id="cat-{{ $catSlug }}">
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight text-gray-900">
                    {{ $category->name }}
                </h2>
            </div>

            <div class="flex flex-wrap -m-3 mb-20">
                <template x-for="product in products.filter(p => p.cat === '{{ $catSlug }}')" :key="product.key">
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3" :id="'product-' + product.key">
                        <div @click="openModal(product)"
                             class="cursor-pointer bg-[#f2f2f2] rounded-3xl p-6 flex flex-col items-center hover:shadow-xl transition-all h-full">
                            <div class="h-40 flex items-center justify-center mb-6 w-full">
                                <img :src="product.image" class="mix-blend-multiply max-h-full object-contain" :alt="product.title">
                            </div>
                            <h3 class="font-bold text-center text-gray-800" x-text="product.title"></h3>
                        </div>
                    </div>
                </template>
            </div>
        @endforeach

    </div>

    @include('partials.product-modal')
</div>
