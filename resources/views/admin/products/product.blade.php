<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Productes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6"><div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Productes List
                    </h3>

                    <a href="{{ route('product_create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Add Product
                    </a>
                </div>

                @php
                    $productHeaders = ['ID', 'Product Name', 'Category', 'Description', 'Image', 'Price', 'Old Price', 'Actions', 'Is Featured?', 'Apply Discount'];
                @endphp

                <x-dashboard.table :headers="$productHeaders">
    
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <x-dashboard.td bold>{{ $product->id }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $product->name }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $product->category->name ?? 'No Category' }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $product->description }}</x-dashboard.td>
            
                            {{-- عمود الصورة --}}
                            <x-dashboard.td class="text-center align-middle w-44 p-2">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     class="w-32 h-32 object-contain rounded-md shadow-sm mx-auto">
                            </x-dashboard.td>

                            <x-dashboard.td bold id="current-price-{{ $product->id }}">{{ $product->price }}</x-dashboard.td>
                            <x-dashboard.td bold id="old-price-{{ $product->id }}">{{ $product->oldPrice }}</x-dashboard.td>

                            {{-- عمود الأزرار --}}
                            <x-dashboard.td class="!border-b-0 !p-0 !align-middle min-w-[150px]">
                                <div class="flex gap-2 items-center justify-start py-3 px-4">
                                    <a href="{{ route('productes_edit', $product) }}" class="bg-yellow-500 text-white px-4 py-2 rounded text-sm font-medium ">
                                        Edit
                                    </a>
                                    <form action="{{ route('productes_destroy', $product) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <x-danger-button type="submit">Delete</x-danger-button>
                                    </form>
                               </div>
                            </x-dashboard.td>
                            <!-- منتج مميز -->
                            <x-dashboard.td class="text-center align-middle w-36">
                                <x-secondary-button 
                                    data-id="{{ $product->id }}"
                                    data-url="{{ route('featured', $product) }}"
                                    class="featured-btn justify-center w-28 text-xs transition-all duration-200
                                    {{ $product->is_featured ? '!bg-slate-900 !text-white !border-slate-900 font-bold' : 'bg-transparent text-slate-950 hover:bg-slate-100' }}"
                                >
                                <span class="btn-text">
                                    {{ $product->is_featured ? 'Featured' : 'Not Featured' }}
                                </span>
                                </x-secondary-button>
                            </x-dashboard.td>
                            <!-- زر العرض -->
                            <x-dashboard.td class="text-center align-middle w-36">
                                <x-secondary-button 
                                    data-id="{{ $product->id }}"
                                    data-url="{{ route('applyDiscount', $product) }}"
                                    class="toggle-discount-btn justify-center w-28 text-xs transition-all duration-200
                                    {{ $product->is_flash_sale ? '!bg-slate-900 !text-white !border-slate-900 font-bold' : 'bg-transparent text-slate-950 hover:bg-slate-100' }}">
                                <span class="btn-text">
                                    {{ $product->is_flash_sale ? 'On Sale' : 'Full Price' }}
                                </span>
                                </x-secondary-button>
                            </x-dashboard.td>
                        </tr>
                        <!-- //السطر المخفي -->
                        <x-dashboard.hidden_row id="discount-row-{{ $product->id }}" colspan="10">
                            <div class="flex items-center justify-between gap-3 w-full">
                             <div class="flex items-center gap-3">
                                <span class="text-xs font-semibold text-slate-700">Set product discount percentage:</span>
        
                                <div class="relative w-24">
                                    <input type="number" 
                                        id="input-discount-{{ $product->id }}"
                                        min="1" 
                                        max="100" 
                                        placeholder="20"
                                        value="{{ $product->discount_percentage }}"
                                        class="w-full text-xs px-2 py-1.5 border border-slate-300 rounded focus:outline-none focus:ring-1 focus:ring-slate-900 pr-5" >
                                    <span class="absolute right-2 top-1.5 text-xs text-slate-400">%</span>
                                </div>
                             </div>

                             <div class="flex items-center gap-3">
                                <button data-id="{{ $product->id }}"
                                    data-url="{{ route('applyDiscount', $product) }}" 
                                    class="save-discount-btn bg-slate-900 text-white text-xs px-3 py-1.5 rounded hover:bg-slate-800 transition">Apply Discount</button>

                                <button data-id="{{ $product->id }}"
                                    class="cancel-discount-btn border border-slate-300 text-slate-600 text-xs px-3 py-1.5 rounded hover:bg-slate-100 transition">Cancel</button>
                             </div>

                            </div>
                        </x-dashboard.hidden_row>
                    @endforeach
                </x-dashboard.table>

                @if ($products->hasPages())
                    <div class="mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
                            {{ $products->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>
@vite('resources/js/dashboard/product.js')


