<x-frontend-app-layout>

<div class="w-full bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- عنوان الصفحة -->
        <h1 class="text-3xl font-black text-gray-900 mb-8 tracking-tight">Shopping Cart</h1>

        @if($products->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- 1. عمود المنتجات (يأخذ ثلثي المساحة) -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($products as $product)
                        <div class="group relative bg-white border border-gray-100 rounded-2xl shadow-sm p-4 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-6 transition-all duration-200 hover:shadow-md">
                            
                            <!-- تفاصيل المنتج والصورة -->
                            <div class="flex flex-col sm:flex-row items-center gap-5 w-full sm:w-auto">
                                <!-- حاوية الصورة زجاجية حديثة -->
                                <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden border border-gray-100 p-2 flex items-center justify-center flex-shrink-0">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain max-h-full max-w-full group-hover:scale-105 transition-transform duration-300">
                                </div>
                                
                                <!-- النصوص -->
                                <div class="text-center sm:text-left">
                                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">{{$product->category->name}}</span>
                                    <h3 class="text-md font-bold text-gray-900 mt-0.5 line-clamp-2 hover:text-blue-600 transition-colors">
                                        <a href="{{route('product_details',$product)}}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-xs font-medium text-gray-400 mt-1">Unit Price: {{ number_format($product->price, 2) }} $</p>
                                </div>
                            </div>

                            <!-- التحكم بالكمية، السعر الفرعي، والحذف -->
                            <div class="flex items-center justify-between sm:justify-end gap-8 w-full sm:w-auto border-t sm:border-t-0 pt-4 sm:pt-0 border-gray-100">
                                <!-- الإجمالي الفرعي للمنتج -->
                                <div class="text-right min-w-[80px]">
                                    <span class="text-lg font-black text-gray-900">{{ number_format($product->price * $product->quantity, 2) }} $</span>
                                </div>

                                <!-- زر حذف أيقوني ناعم -->
                                <button class="p-2 text-gray-400 hover:text-red-500 bg-gray-50 hover:bg-red-50 rounded-xl transition-all duration-200">
                                    <svg xmlns="http://w3.org" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- 2. عمود ملخص الطلب (يأخذ ثلث المساحة ويبقى ثابتاً عند السكرول) -->
                <div class="lg:sticky lg:top-6 bg-white border border-gray-100 p-6 rounded-2xl shadow-sm space-y-6">
                    <h2 class="text-xl font-black text-gray-900 tracking-tight">Order Summary</h2>
                    
                    <!-- الحسابات الفرعية والضرائب والخصومات إن وجدت -->
                    <div class="space-y-3 border-b border-gray-100 pb-4 text-sm font-medium">
                        <div class="flex justify-between text-gray-500">
                            <span>Subtotal</span>
                            <span class="text-gray-900">{{ number_format($totalPrice, 2) }} $</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Shipping</span>
                            <span class="text-green-600 font-bold">Free</span>
                        </div>
                    </div>

                    <!-- الحساب الإجمالي الكلي ببنط عريض ولون متميز -->
                    <div class="flex justify-between items-center">
                        <span class="text-base font-bold text-gray-900">Estimated Total</span>
                        <span class="text-2xl font-black text-blue-600">{{ number_format($totalPrice, 2) }} $</span>
                    </div>
                    <form id="checkout-form" action="{{route('order_store')}}" method="POST">
                        @csrf
                        <button type='submit' id="checkout-btn" class="btn checkout-btn block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-200 transform active:scale-[0.98] shadow-lg shadow-blue-600/10">
                            Proceed to Checkout
                        </button>
                    </form>

                    <p class="text-xs text-center text-gray-400 font-medium">Secure Checkout • Satisfaction Guaranteed</p>
                </div>

            </div>
        @else
            <!-- حالة السلة الفارغة بتصميم رسومي بسيط ومبهج -->
            <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm max-w-2xl mx-auto px-6">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://w3.org" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Your cart is feeling a bit light</h2>
                <p class="text-gray-500 mb-8 max-w-sm mx-auto text-sm leading-relaxed">Looks like you haven't added any premium products to your cart yet.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-blue-600 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/10 transition-all duration-200">
                    Explore Products
                </a>
            </div>
        @endif
    </div>
</div>
@vite('resources/js/frontend/cart.js')

</x-frontend-app-layout>


