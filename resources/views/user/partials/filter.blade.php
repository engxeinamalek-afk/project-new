<div class="bg-white rounded-xl shadow-sm border p-5">

    <h3 class="font-semibold text-lg mb-4">
        Price
    </h3>

    <form id="price-filter-form">

        <div class="flex items-center gap-3">

            <input
                id="min_price"
                type="number"
                name="min_price"
                placeholder="Min"
                class="w-full rounded-lg border-gray-300"
            >

            <span class="text-gray-400">—</span>

            <input
                id="max_price"
                type="number"
                name="max_price"
                placeholder="Max"
                class="w-full rounded-lg border-gray-300"
            >

        </div>

        <button
            type="submit"
            class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
        >
            Apply Filter
        </button>

    </form>

</div>