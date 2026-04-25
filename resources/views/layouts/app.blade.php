<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomBooking Signature</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="/">
                <i class="fa-solid fa-chess-king text-gold me-2"></i> RoomBooking
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">Câu chuyện</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Liên hệ</a>
                    </li>

                    @auth
                    <hr class="d-lg-none text-white-50 my-2">
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item ms-lg-4">
                        <a class="nav-link text-warning {{ request()->is('admin/rooms*') ? 'active' : '' }}" href="{{ route('admin.rooms.index') }}"><i class="fa-solid fa-hotel me-1"></i>QL Phòng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning {{ request()->is('admin/bookings*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}"><i class="fa-solid fa-clipboard-check me-1"></i>QL Lịch Đặt</a>
                    </li>
                    @else
                    <li class="nav-item ms-lg-4">
                        <a class="nav-link text-gold {{ request()->is('my-bookings') ? 'active' : '' }}" href="{{ route('bookings.my') }}"><i class="fa-solid fa-clock-rotate-left me-1"></i>Lịch sử của bạn</a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto pb-3 pb-lg-0">
                    @auth
                    <hr class="d-lg-none text-white-50 my-2">
                    <li class="nav-item">
                        <span class="nav-link text-white fw-bold">
                            <i class="fa-solid fa-circle-user fs-5 align-middle me-1 text-gold"></i> {{ Auth::user()->name }}
                            @if(Auth::user()->role === 'admin')
                            <span class="badge bg-crimson ms-1">Admin</span>
                            @endif
                        </span>
                    </li>
                    <li class="nav-item d-flex align-items-center mt-2 mt-lg-0">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-gold btn-sm ms-lg-3 fw-bold rounded-pill">
                                <i class="fa-solid fa-right-from-bracket me-1"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item me-2 mt-2 mt-lg-0 d-grid">
                        <a class="btn btn-outline-gold rounded-pill px-4 fw-bold" href="/login">Đăng nhập</a>
                    </li>
                    <li class="nav-item mt-2 mt-lg-0 d-grid">
                        <a class="btn btn-crimson rounded-pill px-4 fw-bold shadow-sm text-white" href="/register">Tham gia ngay</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @include('partials.flash')
            @yield('content')
        </div>
    </main>

    @if(!request()->is('admin*'))
    <footer class="main-footer mt-3 mt-md-5 pt-4 pt-md-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="fw-bold mb-3 text-white">
                        <i class="fa-solid fa-chess-king text-gold me-2"></i>RoomBooking
                    </h4>
                    <p class="small pe-lg-4 mb-4 text-white-50">Hệ thống đặt phòng chuyên nghiệp. Giải pháp không gian làm việc và đàm phán đẳng cấp dành riêng cho giới tinh hoa tại Cần Thơ.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-icon-footer text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-icon-footer text-decoration-none"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-icon-footer text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="col-6 col-lg-2 offset-lg-1 mb-4">
                    <h5 class="fw-bold mb-4 text-white">Khám Phá</h5>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-3"><a href="{{ route('about') }}" class="footer-link">Câu chuyện</a></li>
                        <li class="mb-3"><a href="#" class="footer-link">Bộ Sưu Tập</a></li>
                        <li class="mb-3"><a href="#" class="footer-link">Đặc Quyền VIP</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-2 mb-4">
                    <h5 class="fw-bold mb-4 text-white">Hỗ Trợ</h5>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-3"><a href="{{ route('contact') }}" class="footer-link">Liên hệ CSKH</a></li>
                        <li class="mb-3"><a href="#" class="footer-link">Chính sách</a></li>
                        <li class="mb-3"><a href="#" class="footer-link">Bảo mật</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 mt-2 mt-lg-0">
                    <h5 class="fw-bold mb-4 text-white">Liên Hệ</h5>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-3 d-flex align-items-start text-white-50">
                            <i class="fa-solid fa-location-dot mt-1 me-3 text-gold fs-5"></i>
                            <span>Trung tâm thương mại Ninh Kiều,<br>Thành phố Cần Thơ</span>
                        </li>
                        <li class="mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-phone me-3 text-gold fs-5"></i>
                            <span class="fs-6 fw-bold text-white">0123.456.789</span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary mt-4 mb-4 opacity-25">

            <div class="row align-items-center pb-2">
                <div class="col-md-6 text-center text-md-start text-white-50" style="font-size: 0.85rem;">
                    &copy; 2026 RoomBooking Signature. Mọi quyền được bảo lưu.
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0 d-flex justify-content-center justify-content-md-end gap-3">
                    <i class="fa-brands fa-cc-visa text-white-50 fs-3"></i>
                    <i class="fa-brands fa-cc-mastercard text-white-50 fs-3"></i>
                    <i class="fa-brands fa-cc-paypal text-white-50 fs-3"></i>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>