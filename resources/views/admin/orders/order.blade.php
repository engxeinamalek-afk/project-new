<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Orders
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-700">
                            Orders List
                        </h3>
                    </div>

                    @php
                        $orderHeaders = ['ID', 'User Id', 'Total Price', 'Payment Status', 'Status', 'Created At', 'Action'];
                    @endphp
                    <x-dashboard.table :headers="$orderHeaders">
    
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <x-dashboard.td bold>{{ $order->id }}</x-dashboard.td>
                                <x-dashboard.td bold>{{ $order->user_id }}</x-dashboard.td>
                                <x-dashboard.td bold>{{ $order->total_price }}</x-dashboard.td>
                                <x-dashboard.td bold>{{ $order->payment_status }}</x-dashboard.td>

                                <x-dashboard.td class="w-44">
                                    @php
                                        $orderOptions = $order->payment_status == 'unpaid' 
                                        ? ['pending' => 'Pending'] 
                                        : ['processing' => 'Processing',
                                            'shipped' => 'Shipped',
                                            'delivered' => 'Delivered'];
                                    @endphp
                                    <x-dashboard.select :options="$orderOptions" 
                                                     :selected="$order->status" 
                                                     onChange="updateOrderStatus(this, {{ $order->id }})" />
                                </x-dashboard.td>

                                <x-dashboard.td bold>
                                    {{ empty($order->created_at) ? 'Unknown' : $order->created_at->format('Y-m-d') }}
                                </x-dashboard.td>
            
                                <x-dashboard.td bold>
                                    <x-secondary-button onclick="toggleDetails({{ $order->id }})" >View Products</x-secondary-button>
                                </x-dashboard.td>
                            </tr>
        
                            <x-dashboard.hidden_row id="details-{{ $order->id }}" colspan="7">   
                                <h4 class="font-bold text-gray-700 mb-2 text-sm">               
                                    Requested Products for Order {{ $order->id }}:
                                </h4>

                                @if($order->items->isEmpty())               
                                     <p class="text-sm text-gray-500 py-2">There are no registered products for this order!</p>
                                @else
                                    <ul class="divide-y divide-gray-100 text-sm text-gray-600">
                                        @foreach($order->items as $item)
                                            <li class="py-2 flex justify-between items-center">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-medium text-gray-800">{{ $item->product->name ?? 'Product' }}</span>
                                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">Quantity: {{ $item->quantity }}</span>
                                                </div>
                                                <span class="font-semibold text-gray-900">{{ number_format(($item->unit_price ?? 0) * $item->quantity, 2) }}$</span>
                                            </li>
                                        @endforeach
                                        <!-- //حاليا رح اتجاهل التكرار بالمنتجات المتشابهة لانو اصلا ما رح يكون في تكرار عند الطلب النظامي  -->
                                    </ul>
                                @endif
                            </x-dashboard.hidden_row>

                        @endforeach

                    </x-dashboard.table>

                    @if ($orders->hasPages())
                        <div class="mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
@vite('resources/js/dashboard/order.js')
