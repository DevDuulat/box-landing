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
<body x-data="productsComponent()" class="antialiased font-montserrat bg-[#121212]">
@include('partials.header')

<main>
    @yield('content')
</main>

<div
        x-show="isOrderModalOpen"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        x-cloak
>
    <div
            x-show="isOrderModalOpen"
            x-transition:enter="transition opacity-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            @click="closeModal()"
            class="fixed inset-0 bg-black/80 backdrop-blur-md"
    ></div>

    <div
            x-show="isOrderModalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative bg-[#1a1a1a] border border-gray-800 w-full max-w-lg rounded-3xl p-8 z-[101]"
    >
        <button @click="closeModal()" class="absolute top-6 right-6 text-gray-500 hover:text-white">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <h3 class="text-2xl font-black text-white uppercase mb-6">Оставить <span class="text-[#FFA500]">заявку</span></h3>

        <form action="{{ route('order.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ваше имя"
                       class="w-full bg-[#111] border @error('name') border-red-500 @else border-gray-800 @enderror rounded-xl px-5 py-4 text-white focus:border-[#FFA500] outline-none">
                @error('name') <span class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Телефон"
                       class="w-full bg-[#111] border @error('phone') border-red-500 @else border-gray-800 @enderror rounded-xl px-5 py-4 text-white focus:border-[#FFA500] outline-none">
                @error('phone') <span class="text-red-500 text-xs mt-1 ml-2">{{ $message }}</span> @enderror
            </div>

            <div>
        <textarea name="message" placeholder="Ваше сообщение (необязательно)"
                  class="w-full bg-[#111] border border-gray-800 rounded-xl px-5 py-4 text-white focus:border-[#FFA500] outline-none h-24">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-[#FFA500] text-white font-bold py-4 rounded-xl hover:bg-orange-500 transition-all active:scale-95">
                Отправить данные
            </button>
        </form>
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

            init() {
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
            }
        }));
    });
</script>
</body>
</html>
