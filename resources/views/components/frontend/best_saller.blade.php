@props(['product', 'rank'])

<div class="group relative bg-white rounded-xl border border-gray-100 p-3.5 flex flex-col justify-between transition-all duration-300 hover:shadow-xl hover:border-blue-500/20">
<!-- وسام الترتيب -->
    <div class="absolute -top-4 -right-3 z-10 shadow-md">
        <span class="flex items-center justify-center w-10 h-10 rounded-xl text-white font-extrabold text-lg
            {{ $rank == 1 ? 'bg-gradient-to-br from-amber-400 to-amber-600 ring-4 ring-amber-100' : 'bg-gradient-to-br from-blue-500 to-blue-700 ring-4 ring-blue-100' }}">
            #{{ $rank }}
        </span>
    </div>

    <!-- صورة المنتج -->
    <div class="relative w-full h-44 bg-gray-50 rounded-xl overflow-hidden mb-5 flex items-center justify-center border border-gray-50">
        <img src="{{ asset('storage/' . $product->image) }}" 
             alt="{{ $product->name }}" 
             class="object-contain h-32 w-32 transition-transform duration-500 group-hover:scale-110">
    </div>

    <!-- تفاصيل المنتج -->
    <div class="flex-grow flex flex-col justify-between">
        <div>
            <!-- اسم القسم -->
            <span class="text-xs text-gray-700 mb-1">
                {{ $product->category->name ?? 'Category' }}
            </span>
            
            <!-- اسم المنتج -->
            <h class="text-lg font-bold text-black-800 line-clamp-2 min-h-[2.5rem] leading-relaxed group-hover:text-blue-600 transition-colors duration-200">
                <a href="#">{{ $product->name }}</a>
            </h>

            <!--Progress Bar-->
            <div class="mt-4 bg-gray-100 rounded-full h-1.5 w-full relative overflow-hidden">
                <div class="bg-gradient-to-l from-blue-600 to-cyan-400 h-full rounded-full transition-all duration-500" 
                     style="width: {{ min(($product->total_sold ?? 10) * 2, 100) }}%"></div>
            </div>
            <div class="flex justify-between items-center mt-1 text-[11px] text-gray-400 font-medium">
                <span>Trending!</span>
                <span class="text-green-600 font-bold">{{ $product->total_sold ?? rand(40,90) }} Items Sold</span>
            </div>
        </div>

        <!-- السعر وزرالتقاصيل -->
        <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-xl font-extrabold text-gray-900">{{ number_format($product->price, 2) }} $</span>
                @if($product->old_price)
                    <span class="text-xs text-gray-400 line-through">{{ number_format($product->old_price, 2) }} $</span>
                @endif
            </div>

            <x-action_button href="{{route('product_details',$product)}}" variant="blue">View Details</x-action_button>
        </div>
    </div>
</div>
