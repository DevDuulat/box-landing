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
                        <div class="p-6 flex flex-col items-center transition-all h-full">
                            <h3 class="font-bold text-center text-gray-800 mb-4" x-text="product.title"></h3>
                            <div @click="openModal(product)" class="cursor-pointer h-40 flex items-center justify-center mb-6 w-full">
                                <img
                                        :src="product.image"
                                        :alt="product.title"
                                        class="
                                            mix-blend-multiply
                                            max-h-full
                                            object-contain
                                            duration-300
                                            hover:drop-shadow-[0_12px_25px_rgba(0,0,0,0.3)]
                                        ">
                            </div>



                            <div class="flex gap-3 mt-auto pt-2">
                                <template x-if="product.photo_brown">
                                    <div
                                            @click="product.image = product.photo_brown"
                                            :class="{'ring-2 ring-orange-500 ring-offset-2 scale-110': product.image === product.photo_brown}"
                                            class="w-6 h-6 rounded-lg bg-[#D9A66B] border border-orange-400 cursor-pointer hover:scale-110 transition-all shadow-sm"
                                    ></div>
                                </template>

                                <template x-if="product.photo_white">
                                    <div
                                            @click="product.image = product.photo_white"
                                            :class="{'ring-2 ring-orange-500 ring-offset-2 scale-110': product.image === product.photo_white}"
                                            class="w-6 h-6 rounded-lg bg-white border border-gray-200 cursor-pointer hover:scale-110 transition-all shadow-sm"
                                    ></div>
                                </template>
                            </div>

                        </div>
                    </div>
                </template>
            </div>
        @endforeach

    </div>

    @include('partials.product-modal')
</div>
