@props([
    'id',           // الأيدي الفريد للسطر للتحكم بالإخفاء والظهور
    'colspan' => 7  // عدد الأعمدة المدمجة لملء الجدول
])
<tr id="{{ $id }}" {{ $attributes->merge(['class' => 'hidden bg-gray-50 transition-all duration-200']) }}>
    <td colspan="{{ $colspan }}" class="px-6 py-4 border-b">
        <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-inner">
            {{ $slot }}            
        </div>
    </td>
</tr>
