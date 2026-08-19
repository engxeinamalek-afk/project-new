<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Add Category
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-sm rounded-lg p-6">

            <form action="{{ route('categories_store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <!-- Category Name -->
                <div class="mb-4">
                    <label for="name"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Category Name
                    </label>

                    <!-- تم إضافة border border-solid لتوضيح الحدود -->
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           class="w-full border border-solid border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Enter category name">
                    @error('name')
                        <p class="text-sm text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <!-- تم إضافة border border-solid لتوضيح الحدود و p-2 للمساحة الداخلية -->
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full border border-solid border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Enter category description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label for="image"
                           class="block text-sm font-medium text-gray-700 mb-2">
                        Category Image
                    </label>

                    <input type="file"
                           name="image"
                           id="file-upload"
                           class="w-full border border-solid border-gray-300 rounded-md p-2">
                    @error('image')
                        <p class="text-sm text-red-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-md">
                        Save Category
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
</x-app-layout>
