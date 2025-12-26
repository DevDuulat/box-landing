<section class="min-h-[85vh] md:min-h-screen relative text-white overflow-hidden flex flex-col items-center pt-20 md:pt-24 bg-[#111111]
                bg-none md:bg-[url('/img/background2.webp')] md:bg-[length:100%] md:bg-bottom md:bg-no-repeat">

    <div class="bg-mask absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-[#111111] to-transparent z-20"></div>

    <div class="container mx-auto px-6 lg:px-8 relative z-30">
        <div class="flex flex-col items-center text-center">

            <div class="inline-block px-4 py-1.5 rounded-full border border-white/10 bg-white/5 mb-6">
                <span class="text-[#FFA500] text-[10px] md:text-sm font-black tracking-[0.2em] uppercase">
                    {{ __('messages.hero_badge') }}
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight tracking-tight px-2">
                {{ __('messages.hero_title_1') }}
                <span class="md:block md:mt-2">{{ __('messages.hero_title_2') }}</span>
            </h1>

            <p class="text-gray-400 text-sm md:text-lg max-w-[280px] sm:max-w-md md:max-w-xl leading-relaxed font-normal">
                {{ __('messages.hero_desc_1') }}
                <span class="text-white font-semibold">{{ __('messages.hero_desc_year') }}</span>.
                <span class="block mt-2">{{ __('messages.hero_desc_2') }}</span>
            </p>
        </div>
    </div>


    <div class="boxes-layer hidden md:block relative w-full h-full">
        <img src="/img/1.png" class="box-anim d-1" alt="box">
        <img src="/img/1b.png" class="box-anim d-2" alt="box">
        <img src="/img/1w.png" class="box-anim d-3" alt="box">
        <img src="/img/2.png" class="box-anim d-4" alt="box">
        <img src="/img/2b.png" class="box-anim d-5" alt="box">
        <img src="/img/2w.png" class="box-anim d-6" alt="box">
        <img src="/img/3w.png" class="box-anim d-7" alt="box">
        <img src="/img/4b.png" class="box-anim d-8" alt="box">
    </div>
    <div class="absolute hidden md:block bottom-0 left-0 w-full max-w-[400px] md:max-w-[600px] lg:max-w-[800px] pointer-events-none z-10 animate-drive">
        <img src="/img/car.png" alt="{{ __('messages.alt_delivery') }}" class="w-full h-auto object-contain relative z-10">
        <div class="absolute bottom-4 left-0 flex space-x-[-10px] opacity-0 animate-dust-cloud dust-particle">
            <div class="w-8 h-8 bg-gray-400/40 rounded-full blur-md"></div>
            <div class="w-12 h-10 bg-gray-500/30 rounded-full blur-lg"></div>
            <div class="w-10 h-8 bg-gray-300/20 rounded-full blur-md"></div>
        </div>
    </div>
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce opacity-30 z-20 hidden sm:block">
        <svg width="24" height="40" viewBox="0 0 24 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 20L12 25L17 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7 28L12 33L17 28" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</section>