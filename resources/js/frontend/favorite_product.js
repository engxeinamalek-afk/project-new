document.addEventListener('DOMContentLoaded', function () {
    // تحديد جميع أزرار المفضلة في الصفحة
    const favoriteButtons = document.querySelectorAll('.favorite-btn');

    favoriteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // منع الزر من الانتقال لأعلى الصفحة بسبب href="#"

            const url = this.getAttribute('data-url');
            const icon = this.querySelector('.favorite-icon');

            // إرسال الطلب إلى لارافيل باستخدام Fetch
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
                if (data.is_favorite) {
                    // إذا أصبح المنتج مفضلاً: نملأ القلب باللون الأحمر
                    icon.setAttribute('fill', '#ef4444');
                } else {
                    // إذا أزيل من المفضلة: نجعل القلب مفرغاً
                    icon.setAttribute('fill', 'transparent');
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء معالجة الطلب:', error);
            });
        });
    });
});
