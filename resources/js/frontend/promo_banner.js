    document.addEventListener("DOMContentLoaded", function() {
        const slides = document.querySelectorAll('.banner-slide');
        const dots = document.querySelectorAll('.banner-dot');
        let currentSlide = 0;
        const slideInterval = 4000; // وقت التبديل بالملي ثانية (4 ثوانٍ)

        function nextSlide() {
            // إخفاء الصورة الحالية ونقاط المؤشر
            slides[currentSlide].classList.replace('opacity-100', 'opacity-0');
            dots[currentSlide].classList.replace('bg-white', 'bg-white/40');
            dots[currentSlide].classList.replace('w-6', 'w-2');

            // الانتقال للصورة التالية (والعودة للصفر إذا وصلنا لآخر صورة)
            currentSlide = (currentSlide + 1) % slides.length;

            // إظهار الصورة الجديدة وتنشيط مؤشرها
            slides[currentSlide].classList.replace('opacity-0', 'opacity-100');
            dots[currentSlide].classList.replace('bg-white/40', 'bg-white');
            dots[currentSlide].classList.replace('w-2', 'w-6');
        }

        // تشغيل التبادل التلقائي المتكرر
        setInterval(nextSlide, slideInterval);
    });