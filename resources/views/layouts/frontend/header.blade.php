<header class="bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-4">

        <div class="flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-bold">
                MyStore
            </a>

            <!-- Search -->
            <div class="hidden md:block w-1/3">
                <input
                    type="text"
                    placeholder="Search for products..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-6">

                @auth
                    <a href="{{ route('profile.edit') }}" class="hover:text-blue-400 transition">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class='inline m-0 p-0 align-middle'>
                        @csrf
                        <x-primary-button class="text-xs">
                            logout
                        </x-primary-button>
                    </form>
                    

                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-400 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}">
                        <x-primary-button class="text-xs">
                            Register
                        </x-primary-button>
                    </a>
                @endauth

            </div>

        </div>

    </div>
</header>