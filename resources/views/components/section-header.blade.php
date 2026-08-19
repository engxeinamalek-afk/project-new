@props(['text1','text2'])
<div class="text-center mb-12 mt-7">
    <span class="relative inline-block p-[1px] rounded-full bg-gradient-to-r from-blue-500 via-cyan-400 to-indigo-500 shadow-sm hover:shadow-md hover:from-indigo-500 hover:to-blue-500 transition-all duration-300">
        <span class="block bg-white text-blue-600 text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full">
            {{$text1}}
        </span>
    </span>
    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mt-3 font-sans">{{$text2}}</h2>
</div>
