@props(['category'])

<section class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
    <!-- صورة الخلفية -->
    <img
        src="{{ asset('storage/' . $category->image) }}"
        alt=""
        class="absolute inset-0 w-full h-full object-cover">

    <!-- طبقة داكنة -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/20"></div>

    <div class="absolute top-5 left-5 md:top-8 md:left-8 z-10">
        <x-badge text="!Discover {{$category->name}}" />
    </div>

    <!-- المحتوى -->
    <div class="relative z-10 flex items-center h-full max-w-7xl mx-auto px-6 lg:px-10">
        <div class="max-w-2xl text-white">

        <h2 class="text-2xl md:text-4xl font-black mb-3 leading-tight text-white drop-shadow-md">{{$category->name}}</h2>
        <p class="text-xs md:text-sm text-gray-300 mb-6 leading-relaxed max-w-md">{{$category->description}}</p>
        <x-action_button href="#products" variant="white">Shop now</x-action_button>

        </div>
    </div>
</section> 