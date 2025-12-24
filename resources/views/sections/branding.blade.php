<div id="branding" class="relative bg-white py-24 px-8 overflow-hidden" x-data="{
    activeSlide: 0,
    slides: [
        'https://placehold.co/600x400?text=Брендирование+1',
        'https://placehold.co/600x400?text=Брендирование+2',
        'https://placehold.co/600x400?text=Брендирование+3'
    ],
    next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
    prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
}">

    <div class="absolute inset-0 pointer-events-none z-0 flex items-center justify-between px-4">
        <img src="img/Illustration1.png" alt="" class="w-32 md:w-72 transform -translate-x-10">

        <div class="flex gap-12 md:gap-48 transform translate-y-10">
            <img src="img/Illustration2.png" alt="" class="w-28 md:w-64">
            <img src="img/Illustration2.png" alt="" class="w-28 md:w-64">
        </div>

        <img src="img/Illustration1.png" alt="" class="w-32 md:w-72 transform translate-x-10">
    </div>

    <div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
        <h2 class="text-3xl md:text-4xl font-bold text-orange-500 mb-12 text-center uppercase tracking-wide">
            Брендирование
        </h2>

        <div class="relative w-full max-w-2xl flex items-center justify-center mb-12">
            <button @click="prev()" class="absolute left-[-40px] md:left-[-100px] p-2 text-gray-800 hover:text-orange-500 transition-colors z-20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <div class="w-full overflow-hidden rounded-2xl shadow-sm border border-gray-100 bg-white">
                <template x-for="(slide, index) in slides" :key="index">
                    <img x-show="activeSlide === index"
                         :src="slide"
                         x-transition:enter="transition opacity duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="w-full h-auto object-cover mx-auto"
                         style="display: none;">
                </template>
            </div>

            <button @click="next()" class="absolute right-[-40px] md:right-[-100px] p-2 text-gray-800 hover:text-orange-500 transition-colors z-20">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <div class="text-center max-w-3xl space-y-6">
            <p class="text-gray-700 leading-relaxed text-lg">
                Компания <span class="text-orange-400 font-semibold">«Я — картон»</span> — это не только широкий ассортимент высококачественной продукции, но и сопутствующие услуги. У нас можно заказать такие необходимые для любого предприятия услуги, как:
            </p>
            <div class="flex flex-col items-center text-gray-600 space-y-2">
                <span class="flex items-start gap-2 italic">
                    <span class="text-orange-500 leading-none">•</span> разработка фирменного дизайн-макета упаковки;
                </span>
                <span class="flex items-start gap-2 italic text-center">
                    <span class="text-orange-500 leading-none">•</span> высококачественную печать на упаковке на флексографическом оборудовании.
                </span>
            </div>
            <p class="text-gray-800 font-bold text-xl pt-4">
                Наши специалисты знают, как сделать упаковку для Вашей продукции хорошо узнаваемой!
            </p>
        </div>
    </div>
    </div>