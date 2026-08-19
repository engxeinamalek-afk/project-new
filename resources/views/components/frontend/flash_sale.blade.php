@props([
    'products'
])
@foreach($products as $product)
<div class="min-w-[290px] sm:min-w-[320px] md:w-[calc(25%-18px)] flex-shrink-0 bg-white border border-gray-100 rounded-2xl p-5 shadow-md snap-start relative">
    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-black px-2.5 py-1 rounded-md z-10">{{$product->discount_percentage}}% OFF</div>
    <div class="w-full h-44 bg-gray-50 rounded-xl flex items-center justify-center mb-4">
        <img src="{{ asset('storage/' . $product->image) }}"
         alt="{{ $product->name }}"
         class="object-contain max-h-full">
    </div>
    <div class="flex flex-wrap items-center gap-3 my-3 justify-start font-sans">
        <span class="text-red-600 font-black text-2xl tracking-tight">{{$product->price}}$</span>

        <div class="flex flex-col justify-center leading-none">
            <span class="text-gray-700 line-through text-sm mb-1">{{$product->oldPrice}}$</span>
        
            <span class="bg-red-100 text-red-700 text-[10px] font-bold px-1.5 py-0.5 rounded">OFF {{$product->discount_percentage}}%</span>
        </div>
    </div>

    <div class="my-4">
        <div class="flex justify-between text-[11px] text-gray-600 mb-1">
            <span>Items Sold {{ $product->total_sold }}</span>
            <span class="text-red-600 font-bold">Available Now</span>
        </div>
        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
            <div class="bg-red-500 h-full rounded-full" style="width: {{ $product->total_sold }}%;"></div>
        </div>
    </div>
    <x-action_button href="{{route('product_details',$product)}}" variant="red">View Details</x-action_button>

</div>
@endforeach