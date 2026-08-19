@props(['product'])
<div class="group relative bg-white rounded-xl shadow-sm border border-gray-100 p-3.5 flex flex-col justify-between transition-all duration-300 hover:shadow-md hover:-translate-y-1">
 
    <div class="absolute top-5 right-5 z-10">
        <span class="bg-blue-50 text-blue-600 text-base font-black px-4 py-2 rounded-full border-2 border-blue-100 shadow">
            {{ $product->created_at->diffForHumans() }}
        </span>
    </div>
    <!-- صورة المنتج -->
    <div class="relative w-full h-40 bg-gray-50 rounded-lg overflow-hidden mb-3 flex items-center justify-center">
        <img src="{{ asset('storage/' . $product->image) }}" 
             alt="{{ $product->name }}" 
             class="object-contain h-full w-full transition-transform duration-500 group-hover:scale-105">
    </div>

    <!-- تفاصيل المنتج -->
    <div class="flex-grow flex flex-col justify-between">
        <div>
            <!--الفئة -->
            <p class="text-xs text-gray-500 font-medium">{{ $product->category->name ?? 'Category' }}</p>
            
            <!-- اسم المنتج -->
            <h class="text-lg font-bold text-black-800 line-clamp-2 min-h-[2.5rem] leading-relaxed group-hover:text-blue-600 transition-colors duration-200">
                <a href="#">{{ $product->name }}</a>
            </h>
        </div>

        <!-- السعر والزر -->
        <div class="mt-4 pt-3 border-t border-gray-50 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-lg font-extrabold text-blue-600">{{ number_format($product->price, 2) }} $</span>
            </div>

            <x-action_button href="{{route('product_details',$product)}}" variant="blue">View Details</x-action_button>
        </div>
    </div>

</div>