document.addEventListener('DOMContentLoaded', function() {
    const startInput = document.querySelector('input[name="start_time"]');
    const endInput = document.querySelector('input[name="end_time"]');
    const form = document.getElementById('bookingForm');

    // Chặn người dùng chọn ngày trong quá khứ cho thời gian bắt đầu
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    startInput.min = now.toISOString().slice(0,16);

    // Bắt lỗi trực tiếp: Thời gian kết thúc phải lớn hơn thời gian bắt đầu
    form.addEventListener('submit', function(e) {
        if (startInput.value && endInput.value) {
            if (new Date(endInput.value) <= new Date(startInput.value)) {
                e.preventDefault(); // Dừng việc gửi form
                alert('Lỗi: Thời gian kết thúc phải sau thời gian bắt đầu!');
                endInput.classList.add('is-invalid');
            }
        }
    });

    endInput.addEventListener('change', function() {
        this.classList.remove('is-invalid');
    });
});