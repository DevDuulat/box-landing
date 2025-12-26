<div id="contacts" class="p-4 md:p-8 pb-12 md:pb-24 bg-white">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-6 md:gap-8 items-stretch">

        <div class="bg-[#1a1a1a] text-white rounded-[30px] md:rounded-[40px] p-6 md:p-10 md:w-1/3 flex flex-col justify-between">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-orange-500 leading-tight mb-6 md:mb-8">
                    {!! __('messages.contacts.factory_name') !!}
                </h2>
                <p class="text-base md:text-lg text-gray-300 leading-relaxed mb-8 md:mb-12">
                    {{ __('messages.contacts.country') }}
                    <br>
                    {{ __('messages.contacts.region') }}
                    <br>
                    {{ __('messages.contacts.address') }}
                </p>
            </div>

            <div class="space-y-4">
                <a href="tel:84957408966" class="flex items-center gap-3 md:gap-4 text-lg md:text-xl font-medium hover:text-orange-400 transition break-all">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-orange-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    8-495-740-89-66
                </a>
                <a href="mailto:gofra-box@list.ru" class="flex items-center gap-3 md:gap-4 text-lg md:text-xl font-medium hover:text-orange-400 transition break-all">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-orange-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    gofra-box@list.ru
                </a>
            </div>
        </div>

        <div class="h-[300px] md:h-auto md:flex-1 rounded-[30px] md:rounded-[40px] overflow-hidden grayscale contrast-125 border border-gray-300 shadow-sm relative">
            <div class="absolute inset-0 z-10 md:hidden pointer-events-none bg-transparent"></div>

            <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2923.868779836361!2d74.1234567!3d42.8765432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDLCsDUyJzM1LjYiTiA3NMKwMDcnMjQuNCJF!5e0!3m2!1sru!2skg!4v1234567890"
                    class="w-full h-full border-0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>