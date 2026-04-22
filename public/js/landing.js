document.addEventListener('DOMContentLoaded', function() {
    // Bật tính năng tự động chạy Slider
    const myCarousel = document.querySelector('#heroCarousel');
    const carousel = new bootstrap.Carousel(myCarousel, {
        interval: 4000, // 4 giây đổi ảnh 1 lần
        pause: "hover"
    });

    // Hiệu ứng Fade-in khi cuộn trang
    const revealElements = document.querySelectorAll('.scroll-reveal');
    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Chỉ chạy 1 lần
            }
        });
    }, revealOptions);

    revealElements.forEach(el => {
        revealOnScroll.observe(el);
    });
});