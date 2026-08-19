@props([
    'products',
    'title' => 'Pick up where you left off' 
])
<div class="mt-16 pt-8 border-t border-gray-100" dir="ltr">
        
        <div class="flex items-center gap-3 mb-6">
            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
            <h2 class="text-lg font-extrabold text-gray-900 tracking-tight">{{ $title }}</h2>
        </div>

        <!-- قائمة أفقية مرنة تتنقل بسلاسة على الهواتف وتبدأ من اليسار -->
        <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-none snap-x snap-mandatory">
            @foreach($products as $viewedProduct)
                <div class="flex-none w-[290px] snap-start bg-gray-50/60 hover:bg-white border border-gray-100 rounded-2xl p-2.5 transition-all duration-300 hover:shadow-md hover:border-blue-100 group flex items-center gap-3">
                    
                    <!-- صورة المنتج المدمجة -->
                    <a href="#" class="w-20 h-20 flex-shrink-0 bg-white rounded-xl overflow-hidden border border-gray-100 block">
                        <img src="{{ asset('storage/' . $viewedProduct->image) }}" 
                             alt="{{ $viewedProduct->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </a>

                    <div class="flex-1 min-w-0 flex flex-col justify-between h-20 py-0.5 text-left">
                        <div>
                            <a href="#" class="block">
                                <h3 class="font-bold text-xs text-gray-800 line-clamp-2 leading-relaxed hover:text-blue-600 transition">
                                    {{ $viewedProduct->name }}
                                </h3>
                            </a>
                        </div>
                        
                        <!-- السعر وزر الإضافة السريع -->
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm font-black text-blue-600">{{ $viewedProduct->price }} $</span>
                            
                            <!-- زر أيقونة مدمج للإجراء السريع -->
                            <a href="{{route('product_details',$viewedProduct)}}" class="p-1.5 bg-white border border-gray-200 text-gray-600 hover:text-white hover:bg-blue-600 hover:border-blue-600 rounded-lg transition shadow-sm" title="Add to Cart">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>