document.addEventListener('DOMContentLoaded', function () {
    // Kích hoạt toàn bộ Tooltip trong trang Admin
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});