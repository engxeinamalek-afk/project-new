@props(['product'])

<div class="w-full mt-0">
    
    <div class="relative overflow-hidden bg-gray-900 shadow-xl group max-h-[350px]">
        
        <img src="{{ asset('storage/' . $product->image) }}"
             class="w-full h-64 md:h-80 object-cover object-center brightness-50 transition-transform duration-500 group-hover:scale-103"
             alt="{{ $product->name }}">

        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent p-6 sm:px-12 flex flex-col justify-end">
      
            <div class="max-w-3xl mb-4">
                <h2 class="text-2xl font-extrabold text-white tracking-tight md:text-3xl mb-1">
                    {{ $product->name }}
                </h2>
                
                <div class="text-xl font-bold text-blue-600 md:text-2xl">
                    ${{ $product->price }}
                </div>
                <span class="text-sm font-medium text-gray-400 line-through">${{ $product->oldPrice }}</span>
            </div>

            <div class="flex items-center gap-3"> 
                <x-action_button href="{{route('product_details',$product)}}" variant="white">View Details</x-action_button>
            </div>

        </div>
    </div>
</div>
