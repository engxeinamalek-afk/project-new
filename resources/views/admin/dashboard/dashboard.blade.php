<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

                <x-dashboard.card title="إجمالي المبيعات" value="${{ number_format($totalSales, 2) }}" bgIcon="bg-green-50" textIcon="text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-dashboard.card>

                <x-dashboard.card title="إجمالي الطلبات" value="{{ $ordersCount }}" bgIcon="bg-blue-50" textIcon="text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </x-dashboard.card>

                <x-dashboard.card title="إجمالي المنتجات" value="{{ $productsCount }}" bgIcon="bg-amber-50" textIcon="text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </x-dashboard.card>

                <x-dashboard.card title="الزبائن المسجلين" value="{{ $usersCount }}" bgIcon="bg-purple-50" textIcon="text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <x-slot name="subInfo">
                        <span class="text-xs text-purple-500 font-medium flex items-center">
                            +{{ $newUsersToday }} <span class="text-gray-400 mr-1">سجلوا اليوم</span>
                        </span>
                    </x-slot>
                </x-dashboard.card>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <x-dashboard.card title="إجمالي المبيعات اليوم" value="${{ number_format($totalSalestoday, 2) }}" bgIcon="bg-green-50" textIcon="text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-dashboard.card>

                <x-dashboard.card title="إجمالي طلبات اليوم" value="{{ $newOrderToday }} طلب" bgIcon="bg-blue-50" textIcon="text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </x-dashboard.card>

                <x-dashboard.card title="الطلبات قيد التوصيل اليوم" value="{{ $todayShippedOrders }} طلب" textValue="text-amber-600" bgIcon="bg-green-50" textIcon="text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-dashboard.card>

                <x-dashboard.card title="الطلبات المكتملة اليوم-تم توصيلها بنجاح!" value="{{ $todayCompletedOrders }} طلب" textValue="text-green-600" bgIcon="bg-green-50" textIcon="text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-dashboard.card>
            </div>

        @if($lastUsers->isNotEmpty())
            <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                @php
                    $userHeaders = ['ID', 'Name', 'Email', 'Joined at'];
                @endphp
                <x-dashboard.table :headers="$userHeaders">
                    @foreach($latestUser as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <x-dashboard.td bold>{{ $user->id }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $user->name }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $user->email }}</x-dashboard.td>           
                            <x-dashboard.td bold>{{ $user->created_at->format('Y-m-d') }}</x-dashboard.td>
                        </tr>
                    @endforeach
                </x-dashboard.table>

             @if ($lastUsers->hasPages())
                <div class="mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
                        {{ $lastUsers->links() }}
                </div>
             @endif
            </div>
        @endif
        
        </div>
    </div>
</x-app-layout>
