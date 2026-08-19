<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6"><div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Categories List
                    </h3>

                    <a href="{{ route('category_create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Add Category
                    </a>
                </div>
                
                @php
                    $categoryHeaders = ['ID', 'Category Name', 'Description', 'Image', 'Created at', 'Actions', 'Promo Banner'];
                @endphp
                <x-dashboard.table :headers="$categoryHeaders">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <x-dashboard.td bold>{{ $category->id }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $category->name }}</x-dashboard.td>
                            <x-dashboard.td bold>{{ $category->description }}</x-dashboard.td>

                            <x-dashboard.td class="text-center align-middle w-44 p-2">
                                <img src="{{ asset('storage/' . $category->image) }}" 
                                     class="w-32 h-32 object-contain rounded-md shadow-sm mx-auto">
                            </x-dashboard.td>

                            <x-dashboard.td bold>{{ $category->created_at }}</x-dashboard.td>
                            <!-- الازرار -->
                            <x-dashboard.td class="!border-b-0 !p-0 !align-middle min-w-[150px]">
                                <div class="flex gap-2 items-center justify-start py-3 px-4">
                                    <a href="{{ route('categories_edit', $category) }}" class="bg-yellow-500 text-white px-4 py-2 rounded text-sm font-medium">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories_destroy', $category) }}" method="POST"  class="delete-category-form">
                                        @csrf 
                                        @method('DELETE')
                                        <x-danger-button type="submit">Delete</x-danger-button>
                                    </form>
                               </div>
                            </x-dashboard.td>
                            <!-- فئة مميزة -->
                            <x-dashboard.td class="text-center align-middle w-36">
                                <x-secondary-button 
                                    data-id="{{ $category->id }}"
                                    data-url="{{ route('featuredCategory', $category) }}"
                                    class="featured-btn justify-center w-28 text-xs transition-all duration-200
                                    {{ $category->is_featured ? '!bg-slate-900 !text-white !border-slate-900 font-bold' : 'bg-transparent text-slate-950 hover:bg-slate-100' }}"
                                >
                                <span class="btn-text">
                                    {{ $category->is_featured ? 'Featured' : 'Not Featured' }}
                                </span>
                                </x-secondary-button>
                            </x-dashboard.td>
                        </tr>
                    @endforeach
                </x-dashboard.table>

                @if ($categories->hasPages())
                <div class="mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
                        {{ $categories->links() }}
                </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>
@vite('resources/js/dashboard/category.js')

