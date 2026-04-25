@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')

<div id="heroCarousel" class="carousel slide carousel-fade hero-slider mb-0" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('{{ asset('images/sl1.png') }}');">
            <div class="hero-content">
                <h6 class="text-uppercase tracking-wider mb-3" style="color: var(--gold); letter-spacing: 3px;">The Signature Collection</h6>
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown luxury-title">Tuyệt Tác Không Gian<br>Dành Cho Doanh Nghiệp</h1>
                <p class="lead mb-5 fs-5 text-white-50 animate__animated animate__fadeInUp animate__delay-1s">Nâng tầm giá trị cuộc họp với hệ thống sinh thái 5 sao đẳng cấp quốc tế.</p>
                <a href="#search-section" class="btn btn-crimson btn-lg px-5 py-3 fw-bold rounded-pill text-nowrap text-white">ĐẶT PHÒNG NGAY</a>
            </div>
        </div>
        
        <div class="carousel-item" style="background-image: url('{{ asset('images/sl2.png') }}');">
            <div class="hero-content">
                <h6 class="text-uppercase tracking-wider mb-3" style="color: var(--gold); letter-spacing: 3px;">Công Nghệ Đỉnh Cao</h6>
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown luxury-title">Hệ Thống Thiết Bị<br>Tối Tân Nhất</h1>
                <p class="lead mb-5 fs-5 text-white-50 animate__animated animate__fadeInUp animate__delay-1s">Trải nghiệm âm thanh và hình ảnh không viền giới, giúp bài thuyết trình của bạn tỏa sáng.</p>
                <a href="#room-list" class="btn btn-outline-gold btn-lg px-5 py-3 fw-bold rounded-pill text-nowrap">KHÁM PHÁ NGAY</a>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('{{ asset('images/sl3.png') }}');">
            <div class="hero-content">
                <h6 class="text-uppercase tracking-wider mb-3" style="color: var(--gold); letter-spacing: 3px;">Đặc Quyền Hội Viên</h6>
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown luxury-title">Dịch Vụ Hỗ Trợ<br>Chuyên Nghiệp 24/7</h1>
                <p class="lead mb-5 fs-5 text-white-50 animate__animated animate__fadeInUp animate__delay-1s">Đội ngũ kỹ thuật viên và lễ tân luôn sẵn sàng đồng hành cùng sự thành công của bạn.</p>
                <a href="#room-list" class="btn btn-crimson btn-lg px-5 py-3 fw-bold rounded-pill text-nowrap text-white">XEM CHI TIẾT</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

<div class="container search-section" id="search-section">
    <div class="luxury-search-bar">
        <form action="{{ route('home') }}#room-list" method="GET">
            <div class="row g-4 align-items-end">
                <div class="col-md-5">
                    <label class="form-label text-uppercase fw-bold mb-3" style="font-size: 0.85rem; color: var(--gold); letter-spacing: 1px;">
                        <i class="fa-regular fa-calendar-check me-2"></i>Nhận phòng
                    </label>
                    <input type="datetime-local" name="start_time" class="form-control form-control-lg luxury-input text-white" value="{{ request('start_time', now()->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label text-uppercase fw-bold mb-3" style="font-size: 0.85rem; color: var(--gold); letter-spacing: 1px;">
                        <i class="fa-regular fa-calendar-xmark me-2"></i>Trả phòng
                    </label>
                    <input type="datetime-local" name="end_time" class="form-control form-control-lg luxury-input text-white" value="{{ request('end_time', now()->addDays(1)->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-crimson w-100 fw-bold rounded-3 text-nowrap text-white" style="height: 52px; font-size: 1.1rem;">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> TÌM PHÒNG
                    </button>
                </div>
            </div>
        </form>
        
        @if(request()->filled('start_time'))
            <div class="text-center mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <p class="text-success fw-bold mb-2" style="color: #4ade80 !important;"><i class="fa-solid fa-check-double me-2"></i>Tuyệt vời! Có {{ $rooms->count() }} phòng trống cho lịch trình của bạn.</p>
                <a href="{{ route('home') }}" class="text-decoration-none border-bottom border-secondary text-muted small pb-1">Xóa bộ lọc</a>
            </div>
        @endif
    </div>
</div>

<div class="container">

<div class="text-center mt-5 pt-5 mb-5 scroll-reveal">
    <h6 class="fw-bold text-uppercase tracking-wider mb-2" style="color: var(--gold); letter-spacing: 2px;">Tiện ích đặc quyền</h6>
    <h2 class="fw-bold display-5 mb-4 luxury-title" style="color: #fff;">Trải Nghiệm Thượng Lưu</h2>
    <div class="mx-auto mb-4" style="width: 60px; height: 3px; background: var(--crimson);"></div>
    <p class="text-white-50 mt-3 col-md-8 mx-auto fs-5">Hệ sinh thái khép kín giúp đối tác của bạn ấn tượng ngay từ khoảnh khắc bước chân vào sảnh.</p>
</div>

<div class="row mb-5 pb-5">
    <div class="col-md-4 mb-4 scroll-reveal">
        <div class="card service-card">
            <img src="{{ asset('images/waterpool.png') }}" alt="Hồ bơi thư giãn">
            <div class="service-overlay">
                <h4 class="fw-bold luxury-title"><i class="fa-solid fa-water me-2" style="color: var(--gold);"></i>Hồ Bơi Vô Cực</h4>
                <p class="mb-0 text-white-50 small">Tầm nhìn panorama thu trọn vẻ đẹp lộng lẫy của thành phố.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4 scroll-reveal" style="transition-delay: 0.2s;">
        <div class="card service-card">
            <img src="{{ asset('images/cafe.png') }}" alt="Không gian Cafe">
            <div class="service-overlay">
                <h4 class="fw-bold luxury-title"><i class="fa-solid fa-mug-hot me-2" style="color: var(--gold);"></i>The Gold Lounge</h4>
                <p class="mb-0 text-white-50 small">Thưởng thức trà chiều Anh Quốc và đàm phán trong tĩnh lặng.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4 scroll-reveal" style="transition-delay: 0.4s;">
        <div class="card service-card">
            <img src="{{ asset('images/bar.png') }}" alt="Quầy Bar">
            <div class="service-overlay">
                <h4 class="fw-bold luxury-title"><i class="fa-solid fa-martini-glass-citrus me-2" style="color: var(--gold);"></i>Skyfall Bar</h4>
                <p class="mb-0 text-white-50 small">Gắn kết đối tác với bộ sưu tập rượu vang danh tiếng.</p>
            </div>
        </div>
    </div>
</div>

<div id="room-list" class="mt-2 mb-5 pt-5 scroll-reveal">
    <div class="d-flex justify-content-between align-items-end mb-5">
        <div>
            <h6 class="fw-bold text-uppercase mb-2" style="color: var(--gold); letter-spacing: 2px;">The Collection</h6>
            <h2 class="fw-bold mb-0 luxury-title" style="color: #fff;">
                {{ request()->filled('start_time') ? 'Phòng Phù Hợp Lịch Trình' : 'Không Gian Đang Sẵn Sàng' }}
            </h2>
        </div>
        <div class="d-none d-md-flex align-items-center text-white-50">
            <i class="fa-solid fa-hand-pointer fs-4 me-2" style="color: var(--gold);"></i> <span class="fw-medium">Kéo để xem</span>
        </div>
    </div>
    
    <div class="room-horizontal-scroll px-2 py-3">
        @forelse($rooms as $room)
        <div class="room-card-wrapper">
            <div class="card luxury-room-card h-100 overflow-hidden position-relative">
                
                <div class="position-absolute top-0 end-0 m-3 z-3">
                    <span class="crimson-badge shadow-sm text-nowrap">
                        {{ number_format($room->price, 0, ',', '.') }}đ <span class="fw-normal opacity-75">/ngày</span>
                    </span>
                </div>

                <div class="room-header-lux text-center">
                    <div class="room-icon-wrapper mb-3">
                        <i class="fa-solid fa-chess-king fa-2x"></i>
                    </div>
                    <h3 class="card-title fw-bold text-white luxury-title mb-0">{{ $room->name }}</h3>
                </div>

                <div class="card-body d-flex flex-column p-4">
                    <div class="d-flex align-items-center justify-content-center mb-4 pb-3 border-bottom border-secondary">
                        <div class="text-center px-3 border-end border-secondary">
                            <i class="fa-solid fa-users text-white mb-2 fs-5"></i>
                            <h6 class="mb-0 fw-bold text-white">{{ $room->capacity }}</h6>
                            <small class="text-white-50 fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Khách</small>
                        </div>
                        <div class="text-center px-3">
                            <i class="fa-solid fa-wifi text-white mb-2 fs-5"></i>
                            <h6 class="mb-0 fw-bold text-white">Free</h6>
                            <small class="text-white-50 fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Internet</small>
                        </div>
                    </div>
                    
                    <p class="card-text text-white-50 flex-grow-1 text-center" style="font-size: 0.95rem; line-height: 1.6;">
                        {{ \Illuminate\Support\Str::limit($room->description, 80) }}
                    </p>
                    
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-gold w-100 mt-3 py-2 fw-bold rounded-pill stretched-link text-nowrap">
                        XEM CHI TIẾT
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="w-100 text-center py-5 border border-secondary rounded-4">
            <div class="mb-4">
                <i class="fa-solid fa-hourglass-empty fa-4x opacity-25" style="color: var(--gold);"></i>
            </div>
            <h3 class="fw-bold luxury-title text-white">Kín Lịch Hiện Tại</h3>
            <p class="text-white-50 fs-5">Tất cả các không gian đẳng cấp của chúng tôi đã được quý khách hàng khác đặt trước.<br>Hãy thử tìm kiếm với một khung giờ mới.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}"></script>
@endpush