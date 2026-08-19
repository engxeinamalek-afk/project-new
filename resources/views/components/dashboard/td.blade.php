@props(['bold' => false])

<td {{ $attributes->merge([
    'class' => 'px-4 py-3 border-b text-gray-600 ' . ($bold ? 'text-gray-900 font-medium' : '')
]) }}>
    {{ $slot }}
</td>
