document.querySelectorAll('.featured-btn').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            const clickedBtn = this;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.featured-btn').forEach(btn => {
                        btn.classList.remove('!bg-slate-900', '!text-white', '!border-slate-900', 'font-bold');
                        btn.classList.add('bg-transparent', 'text-slate-950', 'hover:bg-slate-100');
                        btn.querySelector('.btn-text').innerText = "Not Featured";
                    });

                    clickedBtn.classList.remove('bg-transparent', 'text-slate-950', 'hover:bg-slate-100');
                    clickedBtn.classList.add('!bg-slate-900', '!text-white', '!border-slate-900', 'font-bold');
                    clickedBtn.querySelector('.btn-text').innerText = "Featured";
                }
            })
            .catch(error => console.error('حدث خطأ أثناء التحديث:', error));
        });
});
    //

document.addEventListener('DOMContentLoaded', () => {  
    // 1. عند الضغط على زر المنتج الأساسي
    const toggleButtons = document.querySelectorAll('.toggle-discount-btn');  
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            const discountRow = document.getElementById(`discount-row-${productId}`);
            const isCurrentlyOnSale = this.classList.contains('!bg-slate-900');

            // إذا كان المنتج عليه عرض أصلاً، نلغيه مباشرة عبر السيرفر دون إظهار السجل
            if (isCurrentlyOnSale) {
                sendDiscountRequest(this, productId, null);
            } else {
                // إذا كان سعره كاملاً، نُظهر السجل المخفي لإدخال القيمة
                discountRow.classList.toggle('hidden');
            }
        });
    });

    // 2. عند الضغط على زر "تطبيق العرض" داخل السجل المخفي
 const saveButtons = document.querySelectorAll('.save-discount-btn');
  saveButtons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const inputField = document.getElementById(`input-discount-${productId}`);
        const discountValue = parseInt(inputField.value);

        // 1. التحقق من صحة القيمة المدخلة في المتصفح قبل الإرسال
        if (isNaN(discountValue) || discountValue < 1 || discountValue > 100) {
            alert("الرجاء إدخال نسبة صحيحة بين 1 و 100");
            return;
        }

        // 2. إرسال طلب AJAX إلى السيرفر
        fetch(`/products/${productId}/apply-discount`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ discount_percentage: discountValue })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // 3. عمل ريفريش تلقائي فوراً لتحديث كل الأسعار بالشكل الصحيح القادم من السيرفر
                window.location.reload();
            } else {
                alert('حدث خطأ أثناء معالجة الطلب.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('تعذر الاتصال بالسيرفر، يرجى المحاولة لاحقاً.');
        });
    });
  });



    // 3. عند الضغط على زر "إلغاء" لإغلاق السجل
    const cancelButtons = document.querySelectorAll('.cancel-discount-btn');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            document.getElementById(`discount-row-${productId}`).classList.add('hidden');
        });
    });

    // دالة مساعدة لإرسال طلب الأياكس وتحديث الواجهة
    function sendDiscountRequest(button, productId, discountPercentage) {
        const url = button.getAttribute('data-url');
        const btnText = button.querySelector('.btn-text');
        const discountRow = document.getElementById(`discount-row-${productId}`);

        button.disabled = true;
        if (btnText) btnText.textContent = 'Processing...';

        axios.post(url, { discount_percentage: discountPercentage })
            .then(response => {
                const isOnSale = response.data.is_flash_sale;

                if (isOnSale) {
                    // تحويل الزر للون الغامق وعرض النسبة الجديدة
                    button.classList.add('!bg-slate-900', '!text-white', '!border-slate-900', 'font-bold');
                    button.classList.remove('bg-transparent', 'text-slate-950', 'hover:bg-slate-100');
                    if (btnText) btnText.textContent = `On Sale (${response.data.discount_percentage}%)`;
                } else {
                    // إعادة الزر لوضعه الطبيعي الكامل
                    button.classList.remove('!bg-slate-900', '!text-white', '!border-slate-900', 'font-bold');
                    button.classList.add('bg-transparent', 'text-slate-950', 'hover:bg-slate-100');
                    if (btnText) btnText.textContent = 'Full Price';
                    // تفريغ حقل الإدخال
                    document.getElementById(`input-discount-${productId}`).value = '';
                }
                
                // إخفاء السجل المخفي بعد انتهاء العملية بنجاح
                discountRow.classList.add('hidden');
            })
            .catch(error => {
                console.error(error);
                alert('حدث خطأ ما، يرجى المحاولة مرة أخرى.');
                if (btnText) btnText.textContent = button.classList.contains('!bg-slate-900') ? 'On Sale' : 'Full Price';
            })
            .finally(() => {
                button.disabled = false;
            });
    }
});
