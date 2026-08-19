@inject('categoryModel', 'App\Models\Category')

<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">

                <!-- Home Link -->
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-blue-600 font-bold' : 'text-black hover:text-blue-500 font-medium' }} transition-colors">
                    Home
                </a>

                <!-- Categories Dropdown -->
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="{{ request()->routeIs('viewCategory') ? 'text-blue-600 font-bold' : 'text-black hover:text-blue-500 font-medium' }} transition-colors">
                            <span>Categories</span>
                        </button>
                    </x-slot>

                    <!-- المحتوى الداخلي للقائمة المنسدلة -->
                    <x-slot name="content">
                        @forelse($categoryModel::all() as $category)
                            <x-dropdown-link href="{{route('viewCategory',$category)}}" 
                                             class="hover:bg-blue-50 hover:text-blue-600 transition duration-150 ease-in-out font-medium text-right">
                                {{ $category->name }}
                            </x-dropdown-link>
                        @empty
                            <div class="px-4 py-2 text-xs text-gray-400 text-center">No Categories</div>
                        @endforelse
                    </x-slot>

                </x-dropdown>

                <!-- My Order Link -->
                @auth
                <a href="{{route('ordersView')}}"
                   class="{{ request()->routeIs('ordersView') ? 'text-blue-600 font-bold' : 'text-black hover:text-blue-500 font-medium' }} transition-colors">
                    My Order
                </a>
                @endauth

            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Cart -->
                <a href="{{route('cartView')}}" class="text-gray-700 hover:text-blue-600">
                    🛒
                </a>
            </div>

        </div>
    </div>
</nav>
