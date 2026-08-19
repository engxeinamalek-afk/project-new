<footer class="bg-slate-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Store -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4">
                    MyStore
                </h3>

                <p class="text-sm">
                    Your trusted online store for quality products at the best prices.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-semibold mb-4">
                    Quick Links
                </h4>

                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('category') }}" class="hover:text-white">
                            Categories
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('product') }}" class="hover:text-white">
                            Products
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-white font-semibold mb-4">
                    Customer Service
                </h4>

                <ul class="space-y-2">
                    <li>
                        <a href="#" class="hover:text-white">
                            Contact Us
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white">
                            Terms & Conditions
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-semibold mb-4">
                    Contact
                </h4>

                <p>Email: info@mystore.com</p>
                <p>Phone: +963 999 999 999</p>
                <p>Damascus, Syria</p>
            </div>

        </div>

        <hr class="border-slate-700 my-8">

        <div class="text-center text-sm text-gray-400">
            © {{ date('Y') }} MyStore. All rights reserved.
        </div>

    </div>
</footer>