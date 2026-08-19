@props([
    'products'
])
<!-- الحاوية الخارجية تأخذ عرض الشاشة بالكامل w-full مع خلفية خفيفة -->
<div class=" w-full my-8 py-6 relative" dir="rtl" id="onSale">

    <!-- منطقة دولاب العرض مع أسهم التحكم السابحة -->
    <div class="relative w-full max-w-[100vw] overflow-hidden px-4 md:px-12">
        
        <!-- سهم التنقل الأيمن (للخلف/السابق في الـ RTL) -->
        <button id="prev-btn" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-20 bg-white hover:bg-gray-100 text-gray-800 p-3 rounded-full shadow-lg border border-gray-200 transition-all active:scale-95 focus:outline-none hidden md:flex items-center justify-center">
            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        <!-- سهم التنقل الأيسر (للأمام/التالي في الـ RTL) -->
        <button id="next-btn" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-20 bg-white hover:bg-gray-100 text-gray-800 p-3 rounded-full shadow-lg border border-gray-200 transition-all active:scale-95 focus:outline-none hidden md:flex items-center justify-center">
            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>

        <!-- حاوية البطاقات: ممتدة على كامل العرض ومخفية التمرير اليدوي على المكتبي -->
        <div id="carousel-container" class="flex gap-6 overflow-x-auto md:overflow-x-hidden snap-x snap-mandatory scroll-smooth pb-4 scrollbar-hide select-none px-4">
           <x-frontend.flash_sale :products="$products" />
        </div>
    </div>
</div>
@vite('resources/js/frontend/carousel.js')
