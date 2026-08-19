<meta name="csrf-token" content="{{ csrf_token() }}">
<x-frontend-app-layout>
<div class="bg-gray-50 min-h-screen py-12" dir="rtl">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">        
        <!-- بطاقة المنتج الرئيسية -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-8">                
                <!-- 1. قسم صور المنتج (الجانب الأيمن) -->
                <div class="space-y-4">
                    <!-- الصورة الرئيسية الكبيرة -->
                    <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden group border border-gray-200">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                </div>

                <!-- 2. قسم معلومات المنتج (الجانب الأيسر) -->
                <div class="flex flex-col justify-between space-y-6">
                    <div>
                        <!-- تصنيف المنتج الصغير فوق العنوان -->
                        <x-badge text="{{ $product->category->name }}" />
                        
                        <!-- اسم المنتج -->
                        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mt-3 mb-2">
                            {{ $product->name }}
                        </h1>

                        <!-- السعر الأساسي والخصم -->
                        <div class="flex items-baseline gap-3 border-b border-gray-100 pb-5 mb-5">
                            <span class="text-3xl font-black text-blue-600">{{ $product->price }} $</span>
                            @isset($product->oldPrice)
                            <span class="text-sm text-red-400 line-through">{{ $product->oldPrice }} $</span>
                            @endisset
                        </div>

                        <!-- وصف تفصيلي للمنتج -->
                        <div class="space-y-2">
                            <h3 class="text-sm font-bold text-gray-800">Description</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                {{ $product->description }}
                        </div>
                    </div>

                    <!-- 3. خيارات الشراء والكمية -->
                    <div class="space-y-4 pt-4 border-t border-gray-100">
                        <form onsubmit="addToCart(event, this)" action="{{ route('add_to_cart', $product) }}" method="POST">
                            @csrf  
                            <div class="flex items-center gap-4 mb-4">
                                <label for="quantity" class="text-sm font-bold text-gray-700">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="99" 
                                       class="w-20 px-3 py-1.5 text-center text-sm font-bold text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm transition-all outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 hover:border-gray-300">
                            </div>

                            <div class="grid grid-cols-4 sm:grid-cols-4 gap-3">
                                <div class="col-span-3">
                                    <x-action_button type="submit" variant="blue" class="w-full">Add to the Cart</x-action_button>
                                </div>
                                <div class="col-span-1 flex items-center justify-center">
                                    <button type="button" class="favorite-btn flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors duration-200 focus:outline-none" 
                                            data-url="{{ route('favorite_product', $product) }}">
                                        <svg class="w-6 h-6 favorite-icon stroke-red-500" 
                                             fill="{{ $product->is_favorite ? '#ef4444' : 'transparent' }}" 
                                             stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5 c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>

</x-frontend-app-layout>
@vite('resources/js/frontend/favorite_product.js')
@vite('resources/js/frontend/product_details.js')

