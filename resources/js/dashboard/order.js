window.updateOrderStatus= function(selectElement, orderId) {
    const newStatus = selectElement.value;

    fetch(`/orders/${orderId}/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(async response => {
        if (response.ok) {
            return response.json();
        }
        const errorText = await response.text();
        throw new Error(errorText);
    })
    .then(data => {
        if(data.success) {
            alert('تم تحديث حالة الطلب بنجاح في قاعدة البيانات.');
            selectElement.classList.add('border-green-500', 'ring-2', 'ring-green-400');
            setTimeout(() => selectElement.classList.remove('border-green-500', 'ring-2', 'ring-green-400'), 1000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const shortError = error.message.substring(0, 200);
        alert('الخطأ الحقيقي من السيرفر هو:\n' + shortError);
    });
}

window.toggleDetails= function(orderId) {
    const detailsRow = document.getElementById(`details-${orderId}`);
    if (detailsRow) {
        detailsRow.classList.toggle('hidden');
    }
}
