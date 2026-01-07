<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
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
        x-data="productsComponent"
        x-init="init()"
        @open-lead-modal.window="openOrderModal()"
        @close-lead-modal.window="closeModal()"
        class="antialiased"
>
@include('partials.header')
<main>
    @yield('content')
</main>
<div x-data="{
    showSuccess: false,
    loading: false,
    sendForm() {
        this.loading = true;
        fetch('{{ route('order.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: this.$refs.name.value,
                phone: this.$refs.phone.value,
                message: this.$refs.message.value
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                this.showSuccess = true;
                this.closeModal();
                this.$refs.name.value = '';
                this.$refs.phone.value = '';
                this.$refs.message.value = '';
            }
        })
        .finally(() => this.loading = false);
    }
}">
    <div x-show="showSuccess" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4">
        <div x-transition.opacity @click="showSuccess = false" class="fixed inset-0 bg-black/90 backdrop-blur-sm"></div>
        <div x-transition:enter="transition ease-out duration-300 scale-90" x-transition:enter-end="scale-100"
             class="relative bg-[#1a1a1a] border border-gray-800 w-full max-w-sm rounded-[40px] p-10 z-[201] text-center">
            <div class="w-20 h-20 bg-green-500/10 border border-green-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-white uppercase mb-2">
                {{ __('messages.success_title_part1') }} <span class="text-green-500">{{ __('messages.success_title_part2') }}</span>
            </h3>
            <p class="text-gray-400 mb-8">{{ __('messages.success_message') }}</p>
            <button @click="showSuccess = false" class="w-full bg-white text-black font-bold py-4 rounded-2xl">
                {{ __('messages.success_btn') }}
            </button>
        </div>
    </div>

    <div x-show="isOrderModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        <div x-show="isOrderModalOpen" x-transition.opacity @click="closeModal()" class="fixed inset-0 bg-black/80 backdrop-blur-md"></div>

        <div x-show="isOrderModalOpen" x-transition:enter="transition ease-out duration-300 scale-95"
             class="relative bg-[#1a1a1a] border border-gray-800 w-full max-w-lg rounded-3xl p-8 z-[101]">

            <button @click="closeModal()" class="absolute top-6 right-6 text-gray-500 hover:text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg>
            </button>

            <h3 class="text-2xl font-black text-white uppercase mb-6">
                {{ __('messages.modal_title_part1') }} <span class="text-[#FFA500]">{{ __('messages.modal_title_part2') }}</span>
            </h3>

            <form @submit.prevent="sendForm()" class="space-y-4">
                <input type="text" x-ref="name" placeholder="{{ __('messages.name_label') }}" required
                       class="w-full bg-[#111] border border-gray-800 rounded-xl px-5 py-4 text-white outline-none focus:border-[#FFA500]">

                <input type="tel" x-ref="phone" placeholder="{{ __('messages.phone_label') }}" required
                       class="w-full bg-[#111] border border-gray-800 rounded-xl px-5 py-4 text-white outline-none focus:border-[#FFA500]">

                <textarea x-ref="message" placeholder="{{ __('messages.message_label') }}"
                          class="w-full bg-[#111] border border-gray-800 rounded-xl px-5 py-4 text-white outline-none focus:border-[#FFA500] h-24"></textarea>

                <button type="submit" :disabled="loading" class="w-full bg-[#FFA500] text-white font-bold py-4 rounded-xl hover:bg-orange-500 transition-all disabled:opacity-50">
                    <span x-show="!loading">{{ __('messages.submit_btn') }}</span>
                    <span x-show="loading">{{ __('messages.sending_btn') }}</span>
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productsComponent', () => ({
            isOrderModalOpen: false,
            mobileMenuOpen: false,
            isOpen: false,
            selected: null,
            activeTab: '',
            products: window.productsListData || [],

            scrollToProduct(key) {
                const targetId = 'product-' + key;
                const element = document.getElementById(targetId);

                if (element) {
                    const offset = 200;
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = element.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            },

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
