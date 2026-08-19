
    // 1. منطق التحكم بالأسهم والدولاب
const carousel = document.getElementById('carousel-container');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');

// دالة لمعرفة مسافة التمرير المطلوبة (عرض بطاقة واحدة + الفراغ)
function getScrollAmount() {
    const firstCard = carousel.querySelector('.flex-shrink-0');
    return firstCard ? firstCard.clientWidth + 24 : 340; // 24px هو مقدار الـ gap
}

// في الـ RTL التمرير لليسار (سالب) يعني الاتجاه للأمام، ولليمين (موجب) يعني للخلف
nextBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
});

prevBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
});
