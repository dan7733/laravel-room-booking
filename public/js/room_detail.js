document.addEventListener('DOMContentLoaded', function() {
    const startInput = document.querySelector('input[name="start_time"]');
    const endInput = document.querySelector('input[name="end_time"]');
    const form = document.getElementById('bookingForm');

    // Chặn người dùng chọn ngày trong quá khứ cho thời gian bắt đầu
    const now = new Date();
    // Điều chỉnh múi giờ cho chuẩn với múi giờ của hệ thống máy tính
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    startInput.min = now.toISOString().slice(0,16);

    // Bắt lỗi trực tiếp: Thời gian kết thúc phải lớn hơn thời gian bắt đầu
    form.addEventListener('submit', function(e) {
        if (startInput.value && endInput.value) {
            const startDate = new Date(startInput.value);
            const endDate = new Date(endInput.value);

            if (endDate <= startDate) {
                e.preventDefault(); // Dừng việc gửi form
                // Thêm class báo lỗi đỏ (is-invalid) của Bootstrap để người dùng biết nhập sai chỗ nào
                endInput.classList.add('is-invalid');
                
                // Cuộn mượt mà (smooth scroll) lên chỗ bị lỗi
                endInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Xóa cảnh báo đỏ ngay khi người dùng bắt đầu chọn lại ngày khác
    endInput.addEventListener('change', function() {
        this.classList.remove('is-invalid');
    });
    
    // Tự động gợi ý ngày trả phòng = ngày nhận phòng + 1 ngày (để tiện UX)
    startInput.addEventListener('change', function() {
        if(this.value && !endInput.value) {
            const nextDay = new Date(this.value);
            nextDay.setDate(nextDay.getDate() + 1);
            nextDay.setMinutes(nextDay.getMinutes() - nextDay.getTimezoneOffset());
            endInput.value = nextDay.toISOString().slice(0,16);
            
            // Kích hoạt event change để ô TotalPrice nhảy số
            endInput.dispatchEvent(new Event('change'));
        }
    });
});