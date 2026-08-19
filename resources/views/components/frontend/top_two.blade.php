@props(['product', 'rank'])

<!-- تم تقليل الارتفاع الأدنى والحشوة الداخلية -->
<div class="{{ $rank == 1 ? 'group relative w-full bg-gradient-to-br from-[#fffdf0] to-[#fff9d6] border-y border-[#d4af37] rounded-none shadow-sm p-4 flex flex-col justify-between transition-all duration-300 hover:shadow-[0_10px_25px_rgba(212,175,55,0.15)] min-h-[380px]' : 'group relative w-full bg-gradient-to-br from-[#f8f9fa] to-[#e9ecef] border-y border-[#bfc1c2] rounded-none shadow-sm p-4 flex flex-col justify-between transition-all duration-300 hover:shadow-[0_10px_25px_rgba(191,193,194,0.2)] min-h-[380px]' }}">
    
    <!-- الشارة العلوية (تم تصغير الخط والبادينج) -->
    <div class="absolute top-4 right-4 z-10">
        <span class="{{ $rank == 1 ? 'bg-[#d4af37] text-white text-xs font-black px-3 py-1.5 rounded-full border border-[#fff3b3] shadow-md' : 'bg-[#bfc1c2] text-gray-900 text-xs font-black px-3 py-1.5 rounded-full border border-white shadow-md' }}">
            {{ $rank == 1 ? 'Most Popular' : 'Great Value' }}
        </span>
    </div>

    <!-- صورة المنتج (تم تقليل الارتفاع إلى h-44 والتصغير) -->
    <div class="relative w-full h-44 bg-white/60 backdrop-blur-sm rounded-xl overflow-hidden mb-4 flex items-center justify-center border border-[#f5e3a3]">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain h-full w-full transition-transform duration-500 group-hover:scale-105">
    </div>

    <!-- تفاصيل المنتج -->
    <div class="flex-grow flex flex-col justify-between">
        <div>
            <!-- الفئة -->
            <p class="text-xs text-amber-800 font-semibold mb-0.5">{{ $product->category->name ?? 'Category' }}</p>
            <!-- اسم المنتج (تم تصغير الخط إلى text-lg والارتفاع الأدنى) -->
            <h3 class="text-base font-bold text-gray-900 line-clamp-2 min-h-[2.5rem] leading-snug group-hover:text-[#aa8c2c] transition-colors duration-200">
                <a href="{{ route('product_details', $product) }}">{{ $product->name }}</a>
            </h3>
        </div>

        <!-- السعر والزر (تم تقليل المساحة العلوية وحجم الخط) -->
        <div class="mt-4 pt-3 border-t border-[#f5e3a3] flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-xl font-black text-amber-700">{{ number_format($product->price, 2) }} $</span>
            </div>
            <x-action_button href="{{route('product_details',$product)}}" variant="blue">View Details</x-action_button>
        </div>
    </div>
</div>
