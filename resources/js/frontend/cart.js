import Swal from 'sweetalert2';

// 1. تشغيل الكود عند التحميل التقليدي للمتصفح أول مرة
document.addEventListener("DOMContentLoaded", function() {
    initCheckout();
});

// 2. تشغيل الكود عند انتقال لايف واير السريع بين الصفحات
document.addEventListener("livewire:navigated", function() {
    initCheckout();
});

window.addEventListener('pageshow', function (event) {
    // إذا عادت الصفحة من الذاكرة المؤقتة (BFCache)، أغلق نافذة التحميل فوراً
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        Swal.close();
    }
});

function initCheckout() {
    const checkoutBtn = document.getElementById('checkout-btn');
    const checkoutForm = document.getElementById('checkout-form');
    
    // نتأكد من وجود الزر والفورم معاً في الصفحة
    if (checkoutBtn && checkoutForm) {
        
        // نتحقق من إزالة أي أحداث سابقة ملتصقة بالزر من خلال نسخه
        checkoutBtn.replaceWith(checkoutBtn.cloneNode(true));
        
        // إعادة جلب الزر بنسخته النظيفة وربطه بـ Swal
        document.getElementById('checkout-btn').addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Confirm Payment',
                text: "Are you sure you want to complete the purchase?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Pay Now!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    // إظهار مؤشر تحميل (Loading) حتى ينتهي السيرفر من معالجة الطلب والـ Transaction
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we complete your order.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // إرسال البيانات للمتحكم عبر Fetch API
                    fetch(checkoutForm.action, {
                        method: 'POST',
                        body: new FormData(checkoutForm),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' // لإعلام لارافيل أن الطلب هو AJAX
                        }
                    })
                    .then(response => {
                        if (response.status === 401) {
                            window.location.href = '/login'; // أو اسم مسار اللوجن عندك
                            return;
                        }
                        // تحويل الرد القادم من لارافيل إلى جيسون (JSON)
                        return response.json();
                    })
                    .then(data => {
                        if(!data) return;
                        // فحص إذا كان الرد يحتوي على معامل نجاح نجاح من السيرفر
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message, // استقبال الرسالة المكتوبة في الـ Controller
                                icon: 'success',
                                confirmButtonColor: '#2563eb'
                            }).then(() => {
                                // إعادة توجيه المستخدم لصفحة الفاتورة أو الرئيسية بعد إغلاق الإشعار
                                window.location.href = '/'; 
                            });
                        } else {
                            // إظهار رسالة خطأ مخصصة إذا أرجع السيرفر فشلاً منطقياً
                            Swal.fire('Error', data.message || 'Something went wrong', 'error');
                        }
                    })
                    .catch(error => {
                        // التقاط أي أخطاء متعلقة بالشبكة أو انهيار في السيرفر (كود 500 مثلاً)
                        Swal.fire('Error', 'Failed to process payment. Please try again.', 'error');
                    });
                }
            });
        });
    }
}
