<div id="branding" class="relative bg-white py-12 md:py-24 px-4 md:px-8 overflow-hidden"
     x-data="{
        activeSlide: 0,
        slides: {{ json_encode($brandingSlides) }},
        next() {
            if(this.slides.length > 0) {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length
            }
        },
        prev() {
            if(this.slides.length > 0) {
                this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length
            }
        }
    }">

    <div class="absolute inset-0 pointer-events-none z-0 flex items-center justify-between px-2 opacity-20 md:opacity-100">
        <img src="{{ asset('img/Illustration1.png') }}" alt="" class="w-20 md:w-72 transform -translate-x-6 md:-translate-x-10">
        <div class="hidden md:flex gap-48 transform translate-y-10">
            <img src="{{ asset('img/Illustration2.png') }}" alt="" class="w-64">
            <img src="{{ asset('img/Illustration2.png') }}" alt="" class="w-64">
        </div>
        <img src="{{ asset('img/Illustration1.png') }}" alt="" class="w-20 md:w-72 transform translate-x-6 md:translate-x-10">
    </div>

    <div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
        <h2 class="text-2xl md:text-4xl font-bold text-orange-500 mb-8 md:mb-12 text-center uppercase tracking-wide">
            {{ __('messages.branding.title') }}
        </h2>

        <div class="relative w-full max-w-2xl flex items-center justify-center mb-8 md:mb-12">

            <button x-show="slides.length > 1" @click="prev()"
                    class="absolute left-0 md:left-[-80px] p-2 text-gray-800 hover:text-orange-500 transition-colors z-20 bg-white/50 md:bg-transparent rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 md:w-12 md:h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <div class="w-full overflow-hidden flex items-center justify-center bg-transparent">
                <template x-for="(slide, index) in slides" :key="index">
                    <img x-show="activeSlide === index"
                         :src="slide"
                         x-transition:enter="transition opacity duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                    /* object-contain гарантирует, что логотип/картинка влезет целиком */
                    class="max-w-full max-h-[300px] md:max-h-[450px] object-contain mx-auto">
                </template>

                <div x-show="slides.length === 0" class="w-full aspect-[3/2] bg-gray-100 flex items-center justify-center text-gray-400">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <button x-show="slides.length > 1" @click="next()"
                    class="absolute right-0 md:right-[-80px] p-2 text-gray-800 hover:text-orange-500 transition-colors z-20 bg-white/50 md:bg-transparent rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 md:w-12 md:h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <div class="text-center max-w-3xl space-y-4 md:space-y-6">
            <p class="text-gray-700 leading-relaxed text-base md:text-lg px-2">
                {!! __('messages.branding.main_text') !!}
            </p>

            <div class="flex flex-col items-center text-gray-600 space-y-3 px-2">
                <span class="flex items-start gap-2 italic text-sm md:text-base">
                    <span class="text-orange-500">•</span> {{ __('messages.branding.service_1') }}
                </span>
                <span class="flex items-start gap-2 italic text-sm md:text-base">
                    <span class="text-orange-500">•</span> {{ __('messages.branding.service_2') }}
                </span>
            </div>

            <p class="text-gray-800 font-bold text-lg md:text-xl pt-4">
                {{ __('messages.branding.footer') }}
            </p>
        </div>
    </div>
</div>