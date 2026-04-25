document.addEventListener('DOMContentLoaded', function() {
    // 1. Cấu hình Slider
    const myCarousel = document.querySelector('#heroCarousel');
    if(myCarousel) {
        new bootstrap.Carousel(myCarousel, {
            interval: 5000, // Đổi ảnh chậm lại để tăng vẻ sang trọng (5 giây)
            pause: "hover"
        });
    }

    // 2. Hiệu ứng Cuộn (Scroll Reveal)
    const revealElements = document.querySelectorAll('.scroll-reveal');
    const revealOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, revealOptions);

    revealElements.forEach(el => revealOnScroll.observe(el));

    // 3. Tính năng KÉO THẢ CUỘN (Drag to Scroll) cho Danh sách phòng
    const slider = document.querySelector('.room-horizontal-scroll');
    if(slider) {
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.style.scrollSnapType = 'none'; // Tắt snap khi đang kéo
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.style.scrollSnapType = 'x mandatory';
        });
        
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.style.scrollSnapType = 'x mandatory'; // Bật lại snap khi nhả chuột
        });
        
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Tốc độ cuộn
            slider.scrollLeft = scrollLeft - walk;
        });
    }

    // 4. Validate Logic Giờ giấc ngay trên trình duyệt
    const startTimeInput = document.querySelector('input[name="start_time"]');
    const endTimeInput = document.querySelector('input[name="end_time"]');
    
    if(startTimeInput && endTimeInput) {
        startTimeInput.addEventListener('change', function() {
            // Tự động set End Time = Start Time + 2 tiếng nếu End Time bé hơn
            const start = new Date(this.value);
            const end = new Date(endTimeInput.value);
            if(start >= end) {
                start.setHours(start.getHours() + 2);
                
                // Format lại giờ để gán vào input datetime-local
                const tzOffset = start.getTimezoneOffset() * 60000;
                const localISOTime = (new Date(start - tzOffset)).toISOString().slice(0,16);
                endTimeInput.value = localISOTime;
            }
        });
    }
});