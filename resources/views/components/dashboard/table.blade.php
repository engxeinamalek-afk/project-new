@props(['headers'])

<div class="overflow-x-auto w-full rounded-lg border border-gray-200 shadow-sm">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        
        {{-- رأس الجدول --}}
        <thead class="bg-gray-100">
            <tr>
                @foreach($headers as $header)
                    <th class="px-4 py-3 text-left border-b font-medium text-gray-700">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>

        {{-- جسم الجدول الممرر من الخارج بالكامل --}}
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            {{ $slot }}
        </tbody>

    </table>
</div>
