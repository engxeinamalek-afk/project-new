<x-frontend-app-layout>
    <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">My Orders</h1>

    <!-- التحقق من وجود طلبات للمستخدم -->
    @if($orders->isEmpty())
        <!-- حالة عدم وجود طلبات (Empty State) -->
        <div class="text-center py-12 bg-white rounded-lg shadow">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No order history</h3>
            <p class="mt-1 text-sm text-gray-500">You haven't placed any orders yet</p>
            <div class="mt-6">
                <a href="{{route('home')}}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Shop now
                </a>
            </div>
        </div>
    @else
        <!-- قائمة الطلبات -->
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    
                    <!-- رأس بطاقة الطلب (Order Header) -->
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 flex flex-wrap justify-between items-center gap-4 border-b border-gray-200">
                        <div class="flex space-x-6 space-x-reverse gap-x-12 text-sm text-gray-600">
                            <div>
                                <p class="text-xs text-gray-400 uppercase">Order Id</p>
                                <p class="font-semibold text-gray-800">#{{ $order->id }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase">Created at</p>
                                <p class="font-medium">{{ $order->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase">Total Amount</p>
                                <p class="font-semibold text-blue-600">{{ number_format($order->total_price, 2) }}$</p>
                            </div>
                        </div>

                        <!-- حالة الطلب ملونة ديناميكياً -->
                        <div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                @if($order->status == 'delivered') bg-green-100 text-green-800
                                @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'shipped') bg-blue-100 text-blue-800
                                @endif">
                                {{ __($order->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- محتويات الطلب (Order Items) -->
                    <div class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                        
                            <div class="p-4 sm:p-6 flex items-center justify-between">
                                <div class="flex items-center gap-x-6">
                                    <!-- صورة المنتج -->
                                    <img src="{{ asset('storage/' . $item->productImage) }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-cover rounded-md border border-gray-200 flex-shrink-0">
                                    
                                    <!-- تفاصيل المنتج -->
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                        <p class="mt-1 text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                
                                <!-- سعر المنتج في الطلب -->
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($item->unit_price * $item->quantity, 2) }}$
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endforeach
        </div>

        <!-- روابط التنقل بين الصفحات (Pagination Links) -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>

</x-frontend-app-layout>