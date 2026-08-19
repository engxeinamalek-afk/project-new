@props(['variant' => 'blue'])

@php
    $baseClasses = 'inline-flex items-center justify-center text-xs font-semibold transition-all duration-300';

    $variants = [
        'blue' => 'px-4 py-2 border border-blue-600/20 rounded-xl text-blue-600 bg-blue-50/50 hover:bg-blue-600 hover:text-white',
        'white' => 'px-5 py-2.5 border-2 border-white text-white font-black text-sm tracking-wider rounded-xl backdrop-blur-md hover:bg-white hover:text-black transition-all duration-200 shadow-sm',
        'red' => 'w-full font-bold py-2.5 bg-red-600 px-4 rounded-xl text-sm shadow-md active:scale-[0.98] transition-all justify-center text-white'
    ];

    $selectedClass = $baseClasses . ' ' . ($variants[$variant] ?? $variants['blue']);
@endphp

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => $selectedClass]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $selectedClass]) }}>
        {{ $slot }}
    </button>
@endif
