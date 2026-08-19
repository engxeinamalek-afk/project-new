<x-frontend-app-layout>
    
    <!--العنصر يلي بيطلع اول شي -->
    @if($featured_product)
        <x-frontend.head_banner :product="$featured_product"/>
    @endif
    
    @include('user.partials.selling_points')

    @if($new_product->isNotEmpty())
        <x-section-header text1="New Arrivals!" text2="Explore The New Collection!" />
        <div id="pagination">
            @include('user.partials.new_product')
        </div>
    @endif

    @if($best_sellers->isNotEmpty())
        <x-section-header text1="Everyone's Favorites!" text2="Top Selling This Week!" />
        <div class="mt-7 max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($best_sellers as $index => $product)
                <x-frontend.best_saller :product="$product" :rank="$index + 1" />
            @endforeach
        </div>
    @endif


    @isset($category)
     <x-frontend.promo_banner :category="$category"  />
    @endisset

    @if($favoriteProducts?->isNotEmpty())
        <x-section-header text1="Make it official. Add to cart!" text2="Your favorites are missing you!" />
        <x-frontend.horizontal_carousel :products="$favoriteProducts" />
    @endif

    @if($onSale->isNotEmpty())
        <x-section-header text1="Shop smart, save big!" text2="Don't save for a rainy day—spend on what makes you better today!" />
        <!-- استدعاء الحاوية الخارجية وتمرير المنتجات إليها -->
        <x-frontend.carousel :products="$onSale" />
    @endif

    <!-- العناصر التي تمت مشاهدتها  -->
    @if($viewedProducts?->isNotEmpty())
        <x-section-header text1="Your Browsing History!" text2="Inspired by your recent history!" />
        <x-frontend.horizontal_carousel :products="$viewedProducts" />
    @endif












    
</x-frontend-app-layout>
@vite('resources/js/frontend/pagination.js')

