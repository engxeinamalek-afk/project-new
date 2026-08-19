import Swal from 'sweetalert2';
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


// حذف الفئة
document.addEventListener('DOMContentLoaded', function () {

    const deleteForms = document.querySelectorAll('.delete-category-form');

    deleteForms.forEach(form => {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'This category and all associated products will be deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sure',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});