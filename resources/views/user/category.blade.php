<x-frontend-app-layout>
    <x-frontend.category_head_banner :category="$category" />

    <div class="flex gap-6">
        {{-- الفلتر --}}
        <aside class="w-64 mt-8">
            @include('user.partials.filter')
        </aside>
        {{-- المنتجات --}}
        <section class="flex-1">
            <div id="pagination">
                @include('user.partials.new_product')
            </div>
        </section>
    </div>

    @isset($category)
        <x-frontend.promo_banner :category="$category" text="Limited time offer!" route="onSale" />
    @endisset

    @if($onSale->isNotEmpty())
        <x-frontend.carousel :products="$onSale" />
    @endif


    @if($top_2->isNotEmpty())
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-0 px-0 md:px-0 py-6 my-6">
        @foreach($top_2 as $index => $product)
            <x-frontend.top_two :product="$product" :rank="$index + 1" />
        @endforeach
    </div>
    @endif



</x-frontend-app-layout>
@vite('resources/js/frontend/pagination.js')
@vite('resources/js/frontend/filter.js')

