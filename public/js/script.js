document.addEventListener('DOMContentLoaded', function() {
    // Tự động mờ dần và ẩn thông báo Flash Message sau 3 giây
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(function(alert) {
        // Thêm class fade của Bootstrap nếu chưa có để tạo hiệu ứng mượt
        if (!alert.classList.contains('fade')) {
            alert.classList.add('fade', 'show');
        }
        
        setTimeout(function() {
            // Chuyển opacity về 0 trước khi đóng
            alert.classList.remove('show');
            
            // Đợi hiệu ứng mờ kết thúc rồi mới xóa element khỏi DOM
            setTimeout(function() {
                // Kiểm tra xem bootstrap có load thành công không
                if (typeof bootstrap !== 'undefined') {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                } else {
                    alert.remove();
                }
            }, 300); // 300ms khớp với CSS transition của Bootstrap
            
        }, 3000); // Hiển thị 3 giây
    });

    // Kích hoạt toàn bộ tooltip trên trang nếu có
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});