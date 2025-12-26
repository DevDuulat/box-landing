<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Лендинг')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;900&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @vite('resources/js/app.js')

</head>
<body
        x-data="productsComponent()"
        @open-lead-modal.window="openOrderModal()"
        @close-lead-modal.window="closeModal()"
        class="antialiased">
@include('partials.header')
<main>
    @yield('content')
</main>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productsComponent', () => ({
            isOrderModalOpen: false,
            mobileMenuOpen: false,
            isOpen: false,
            selected: null,
            activeTab: '',
            products: window.productsListData || [],

            init() {
                @if($errors->any())
                    this.openOrderModal();
                @endif

                if (this.products.length > 0 && !this.activeTab) {
                    this.activeTab = this.products[0].cat;
                }
            },

            openOrderModal() {
                this.isOrderModalOpen = true;
                this.mobileMenuOpen = false;
                document.body.classList.add('overflow-hidden');
            },

            closeModal() {
                this.isOpen = false;
                this.isOrderModalOpen = false;
                this.selected = null;
                document.body.classList.remove('overflow-hidden');
            },

            setTab(tab) {
                this.activeTab = tab;
            },

            openModal(product) {
                this.selected = product;
                this.isOpen = true;
                document.body.classList.add('overflow-hidden');
            },

            get filteredProducts() {
                return this.products.filter(p => p.cat === this.activeTab);
            }
        }));
    });
</script>
</body>
</html>
