@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')
</div> 

<div id="heroCarousel" class="carousel slide carousel-fade hero-slider shadow-lg mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url('{{ asset('images/sl1.png') }}');">
            <div class="hero-content">
                <h1 class="display-3 fw-bold mb-3 animate__animated animate__fadeInDown">Không Gian Khơi Nguồn Sáng Tạo</h1>
                <p class="lead mb-4 fs-4 animate__animated animate__fadeInUp animate__delay-1s">Hệ thống phòng họp tiêu chuẩn quốc tế dành riêng cho doanh nghiệp của bạn.</p>
                <a href="#room-list" class="btn btn-primary btn-lg px-5 py-3 fw-bold rounded-pill shadow">ĐẶT PHÒNG NGAY</a>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('{{ asset('images/sl2.png') }}');">
            <div class="hero-content">
                <h1 class="display-3 fw-bold mb-3">Thiết Bị Tối Tân</h1>
                <p class="lead mb-4 fs-4">Được trang bị đầy đủ công nghệ trình chiếu và âm thanh hiện đại nhất.</p>
                <a href="#room-list" class="btn btn-light text-primary btn-lg px-5 py-3 fw-bold rounded-pill shadow">KHÁM PHÁ</a>
            </div>
        </div>
        <div class="carousel-item" style="background-image: url('{{ asset('images/sl3.png') }}');">
            <div class="hero-content">
                <h1 class="display-3 fw-bold mb-3">Dịch Vụ Đẳng Cấp</h1>
                <p class="lead mb-4 fs-4">Đội ngũ hỗ trợ chuyên nghiệp luôn đồng hành cùng sự thành công của bạn.</p>
                <a href="#room-list" class="btn btn-primary btn-lg px-5 py-3 fw-bold rounded-pill shadow">XEM CHI TIẾT</a>
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

<div class="container">

<div class="text-center mt-5 mb-5 scroll-reveal">
    <h6 class="text-primary fw-bold text-uppercase tracking-wider"><i class="fa-solid fa-star text-warning me-2"></i>Trải nghiệm vượt trội</h6>
    <h2 class="fw-bold display-6 mb-3">Hơn Cả Một Phòng Họp</h2>
    <div class="mx-auto bg-primary rounded" style="width: 80px; height: 4px;"></div>
    <p class="text-muted mt-3 col-md-8 mx-auto fs-5">Tận hưởng hệ sinh thái tiện ích đẳng cấp 5 sao ngay trong tòa nhà, giúp bạn thư giãn và tái tạo năng lượng sau những giờ làm việc căng thẳng.</p>
</div>

<div class="row mb-5 pb-5">
    <div class="col-md-4 mb-4 scroll-reveal">
        <div class="card service-card shadow-lg">
            <img src="{{ asset('images/waterpool.png') }}" alt="Hồ bơi thư giãn">
            <div class="service-overlay">
                <h4 class="fw-bold"><i class="fa-solid fa-water text-info me-2"></i>Hồ Bơi Vô Cực</h4>
                <p class="mb-0 text-white-50">Thả mình vào làn nước mát lạnh với view ngắm nhìn toàn cảnh thành phố.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4 scroll-reveal" style="transition-delay: 0.2s;">
        <div class="card service-card shadow-lg">
            <img src="{{ asset('images/cafe.png') }}" alt="Không gian Cafe">
            <div class="service-overlay">
                <h4 class="fw-bold"><i class="fa-solid fa-mug-hot text-warning me-2"></i>Cafe Lounge</h4>
                <p class="mb-0 text-white-50">Không gian yên tĩnh thưởng thức hương vị cà phê hảo hạng và đồ ngọt.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4 scroll-reveal" style="transition-delay: 0.4s;">
        <div class="card service-card shadow-lg">
            <img src="{{ asset('images/bar.png') }}" alt="Quầy Bar">
            <div class="service-overlay">
                <h4 class="fw-bold"><i class="fa-solid fa-wine-glass text-danger me-2"></i>Sky Bar</h4>
                <p class="mb-0 text-white-50">Điểm hẹn lý tưởng để giao lưu đối tác và mở rộng mối quan hệ.</p>
            </div>
        </div>
    </div>
</div>

<div id="room-list" class="mt-4 mb-5 pt-4 scroll-reveal">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class="fa-solid fa-door-open text-primary me-2"></i>Phòng Họp Nổi Bật</h2>
            <p class="text-muted mb-0">Lựa chọn không gian phù hợp với quy mô đội ngũ của bạn</p>
        </div>
        <div class="d-none d-md-block text-muted small bg-light px-3 py-2 rounded-pill border">
            <i class="fa-solid fa-arrow-left-long me-2"></i> Vuốt để xem thêm <i class="fa-solid fa-arrow-right-long ms-2"></i>
        </div>
    </div>
    
    <div class="room-horizontal-scroll px-2 py-3">
        @forelse($rooms as $room)
        <div class="room-card-wrapper">
            <div class="card h-100 shadow border-0 rounded-4 overflow-hidden position-relative transition-hover">
                <div class="bg-primary p-4 text-center">
                    <i class="fa-solid fa-users-viewfinder fa-3x text-white opacity-75"></i>
                </div>
                <div class="card-body d-flex flex-column p-4 bg-white">
                    <h4 class="card-title fw-bold text-dark">{{ $room->name }}</h4>
                    <div class="d-flex align-items-center mb-3 mt-2">
                        <span class="badge bg-soft-primary text-primary fs-6 px-3 py-2 rounded-pill border border-primary-subtle">
                            <i class="fa-solid fa-user-group me-1"></i> Sức chứa: {{ $room->capacity }} người
                        </span>
                    </div>
                    <p class="card-text text-muted flex-grow-1 room-description">{{ $room->description }}</p>
                    
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-primary w-100 mt-3 py-2 fw-bold rounded-pill stretched-link">
                        Chi tiết & Đặt phòng <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="w-100 text-center py-5 text-muted">
            <i class="fa-regular fa-folder-open fa-3x mb-3 opacity-50"></i>
            <p class="fs-5">Hệ thống đang cập nhật danh sách phòng mới.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/landing.js') }}"></script>
@endpush