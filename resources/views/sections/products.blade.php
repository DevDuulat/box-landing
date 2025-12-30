<style>
    [x-cloak] { display: none !important; }
</style>

<script>
    window.productsListData = @json($productsData);
</script>

<div class="p-8 pt-16 scroll-mt-20" id="products" x-cloak>
    <div class="max-w-6xl mx-auto">

        <div class="mb-10 border-l-4 border-orange-500 pl-6">
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight text-gray-900" x-text="activeTab"></h2>
            <p class="text-gray-400 mt-1 font-medium text-sm uppercase tracking-wider">Выберите товары из категории</p>
        </div>

        <div class="flex flex-wrap -m-3">
            <template x-for="product in filteredProducts" :key="product.key">
                <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-3">
                    <div @click="openModal(product)"
                         class="cursor-pointer bg-[#f2f2f2] rounded-3xl p-6 flex flex-col items-center hover:shadow-xl h-full">
                        <div class="h-40 flex items-center justify-center mb-6 w-full">
                            <img :src="product.image" class="mix-blend-multiply max-h-full object-contain" :alt="product.title">
                        </div>
                        <h3 class="font-bold text-center text-gray-800" x-text="product.title"></h3>
                    </div>
                </div>
            </template>

            <template x-if="filteredProducts.length === 0">
                <div class="w-full flex items-center justify-center py-20">
                    <p class="text-gray-400 italic">В этой категории пока нет товаров</p>
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