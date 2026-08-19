@props([
    'options' => [],       // مصفوفة الخيارات المتاحة
    'selected' => null,     // القيمة المحددة حالياً
    'onChange' => null      // كود الجافاسكربت المراد تنفيذه عند التغيير
])

<select 
    @if($onChange) onchange="{{ $onChange }}" @endif
    {{ $attributes->merge([
        'class' => 'block w-full px-2 py-1 text-sm rounded-md bg-blue-50 text-blue-800 border-none font-semibold focus:ring-2 focus:ring-blue-500 cursor-pointer transition-colors'
    ]) }}
>
    @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
