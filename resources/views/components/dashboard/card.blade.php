@props([
    'title',
    'value',
    'bgIcon' => 'bg-green-50',
    'textIcon' => 'text-green-600'
])

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
    <div>
        <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
        <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $value }}</h3>
        @isset($subInfo)
            <div class="mt-2">
                {{ $subInfo }}
            </div>
        @endisset
    </div>
    <div class="p-3 {{ $bgIcon }} {{ $textIcon }} rounded-lg">
        {{ $slot }}
    </div>
</div>
