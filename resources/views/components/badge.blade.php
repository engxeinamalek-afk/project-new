@props(['text'])

<span class="relative inline-block p-[1px] rounded-full bg-gradient-to-r from-blue-500 via-cyan-400 to-indigo-500 shadow-sm hover:shadow-md hover:from-indigo-500 hover:to-blue-500 transition-all duration-300">
    <span class="block bg-white text-blue-600 text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full">
        {{$text}}
    </span>
</span>

