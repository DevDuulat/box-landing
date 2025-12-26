<style>
    [x-cloak] { display: none !important; }
</style>

<script>
    // Passing the pre-processed data to the window object
    window.productsListData = @json($productsData);
</script>

<div class="p-8 pt-16" id="products" x-data="productsComponent()" x-cloak>
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

    @include('partials.product-modal')
</div>

<script>
    function productsComponent() {
        return {
            activeTab: '{{ $firstTab }}',
            isOpen: false,
            selected: null,
            products: window.productsListData,

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