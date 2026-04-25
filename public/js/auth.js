document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');

    togglePasswordBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Tìm ô input nằm cùng một nhóm (input-group) với nút bấm này
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                icon.style.color = 'var(--gold)'; // Thêm hiệu ứng màu vàng khi hiện pass
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                icon.style.color = ''; // Trả về màu mặc định
            }
        });
    });
});