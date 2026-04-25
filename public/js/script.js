document.addEventListener('DOMContentLoaded', function() {
    // Tự động mờ dần và ẩn thông báo Flash Message sau 3 giây
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        // Thêm class fade của Bootstrap nếu chưa có
        if (!alert.classList.contains('fade')) {
            alert.classList.add('fade', 'show');
        }
        
        setTimeout(function() {
            // Chuyển opacity về 0 trước khi đóng
            alert.classList.remove('show');
            
            // Đợi hiệu ứng mờ kết thúc rồi mới xóa element khỏi DOM
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 300); // 300ms khớp với CSS transition của Bootstrap
            
        }, 3000); // Hiển thị 3 giây
    });
});