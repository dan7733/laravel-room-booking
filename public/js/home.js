// Tạo hiệu ứng xuất hiện lần lượt cho các thẻ phòng
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.fade-up');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('show');
        }, index * 150); // Mỗi thẻ hiện cách nhau 0.15s
    });
});