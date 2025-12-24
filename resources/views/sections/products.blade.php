<div id="products" class="p-8 pt-16" x-data="{
    activeTab: 'короб',
    products: [
        /* КАТЕГОРИЯ: КОРОБ (8 товаров) */
        { cat: 'короб', title: '4-х клапанный стандарт' },
        { cat: 'короб', title: 'Ласточкин хвост' },
        { cat: 'короб', title: 'Короб с ушками' },
        { cat: 'короб', title: 'Крышка-дно' },
        { cat: 'короб', title: 'Чемодан с ручкой' },
        { cat: 'короб', title: 'Архивный короб' },
        { cat: 'короб', title: 'Шоу-бокс открытый' },
        { cat: 'короб', title: 'Гардеробный короб' },

        /* КАТЕГОРИЯ: ПИЦЦА (7 товаров) */
        { cat: 'пицца', title: 'Для пиццы 25 см' },
        { cat: 'пицца', title: 'Для пиццы 30 см' },
        { cat: 'пицца', title: 'Для пиццы 35 см' },
        { cat: 'пицца', title: 'Для пиццы 40 см' },
        { cat: 'пицца', title: 'Треугольный сегмент' },
        { cat: 'пицца', title: 'Для кальцоне' },
        { cat: 'пицца', title: 'Премиум черная' },

        /* КАТЕГОРИЯ: ЛОТОК (7 товаров) */
        { cat: 'лоток', title: 'Овощной лоток' },
        { cat: 'лоток', title: 'Кондитерский телевизор' },
        { cat: 'лоток', title: 'Лоток для ягод' },
        { cat: 'лоток', title: 'Мясной лоток' },
        { cat: 'лоток', title: 'Низкий лоток для яиц' },
        { cat: 'лоток', title: 'Лоток под запайку' },
        { cat: 'лоток', title: 'Усиленный лоток' },

        /* КАТЕГОРИЯ: ЭЛЕМЕНТЫ (7 товаров) */
        { cat: 'элементы', title: 'Защитный уголок' },
        { cat: 'элементы', title: 'Решетка-разделитель' },
        { cat: 'элементы', title: 'Прокладка картонная' },
        { cat: 'элементы', title: 'Обечайка' },
        { cat: 'элементы', title: 'Ложемент' },
        { cat: 'элементы', title: 'Вкладыш усиления' },
        { cat: 'элементы', title: 'Скотч брендированный' }
    ]
}">
    <div class="max-w-6xl mx-auto">

        <nav class="flex gap-8 border-b border-gray-200 mb-12 overflow-x-auto">
            <template x-for="tab in ['короб', 'пицца', 'лоток', 'элементы']">
                <button
                        @click="activeTab = tab"
                        :class="activeTab === tab ? 'text-orange-500 border-orange-500' : 'text-gray-400 border-transparent'"
                        class="pb-4 px-2 border-b-2 font-medium whitespace-nowrap transition-all duration-300 capitalize"
                        x-text="tab === 'короб' ? 'Короб' : tab === 'пицца' ? 'Короб для пиццы' : tab === 'лоток' ? 'Лоток' : 'Элементы'">
                </button>
            </template>
        </nav>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <template x-for="(product, index) in products" :key="index">
                <div x-show="activeTab === product.cat"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-cloak
                     class="bg-[#f2f2f2] rounded-3xl p-6 flex flex-col items-center">

                    <div class="h-40 flex items-center justify-center mb-6 w-full">
                        <img :src="'https://placehold.co/400x300/e5e7eb/6b7280?text=' + product.title.replace(/ /g, '+')"
                             :alt="product.title"
                             class="mix-blend-multiply max-h-full object-contain">
                    </div>

                    <h3 class="text-gray-900 font-bold text-center leading-tight" x-text="product.title"></h3>
                </div>
            </template>

        </div>
    </div>
</div>