@props(['category',
'text'=>'! Browse Full Collection',
'route'=>'category'])
<!-- حاوية البانر الرئيسية - نستخدم معرف معرف فريد للتحكم عبر الجافاسكريبت -->
<section id="category-dynamic-banner" class="relative overflow-hidden rounded-2xl h-[320px] md:h-[400px] flex items-center shadow-xl group my-8 max-w-7xl mx-auto mx-4 md:mx-8" dir="rtl">
    
    <!-- منطقة خلفية الصور المتبادلة ديناميكياً -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        
        @foreach($category->products->take(3) as $index => $product)
         @isset($product)
            <img src="{{ asset('storage/' . $product->image) }}" 
                alt="{{ $product->name }}" 
                class="banner-slide absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-1000 transform group-hover:scale-105 transition-transform duration-[5000ms] {{ $index == 0 ? 'opacity-100' : 'opacity-0' }}">
         @endisset
        @endforeach

        <div class="absolute inset-0 bg-gradient-to-l from-black/85 via-black/60 to-black/30"></div>
    </div>

    <div class="absolute top-5 left-5 md:top-8 md:left-8 z-10">
        <x-badge :text="$text" />
    </div>

    <div class="relative z-10 p-8 md:p-16 flex flex-col justify-center text-right text-white max-w-xl">
        <h2 class="text-2xl md:text-4xl font-black mb-3 leading-tight text-white drop-shadow-md">{{$category->name}}</h2>
        <p class="text-xs md:text-sm text-gray-300 mb-6 leading-relaxed max-w-md">{{$category->description}}</p>
        <!-- زر التوجيه للفئة -->
        <x-action_button href="{{ $route === 'onSale' ? '#onSale' : route('viewCategory',$category)}}" variant="white">{{ $route === 'onSale' ? 'Browse Offers' : 'View Details' }}</x-action_button>

    </div>

    <!-- مؤشرات النقاط الصغيرة أسفل اليسار لتوضيح الانتقال التلقائي للعميل -->
    <div class="absolute bottom-4 left-6 z-10 flex gap-1.5" dir="ltr">
        <span class="banner-dot w-6 h-1.5 rounded-full bg-white transition-all duration-300"></span>
        <span class="banner-dot w-2 h-1.5 rounded-full bg-white/40 transition-all duration-300"></span>
        <span class="banner-dot w-2 h-1.5 rounded-full bg-white/40 transition-all duration-300"></span>
    </div>
</section>
@vite('resources/js/frontend/promo_banner.js')

