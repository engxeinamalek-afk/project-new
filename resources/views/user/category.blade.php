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





</x-frontend-app-layout>
@vite('resources/js/frontend/pagination.js')
@vite('resources/js/frontend/filter.js')

