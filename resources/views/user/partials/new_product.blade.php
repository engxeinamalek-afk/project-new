<div class="mt-7 max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="products">
        @foreach($new_product as $product)
            <x-frontend.card :product="$product" />
        @endforeach
</div>
        <div class="mt-12 max-w-5xl mx-auto">
            {{ $new_product->links() }}
        </div>
    