@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="row justify-content-center mt-3 mb-5">
    <div class="col-xl-10 col-lg-12">
        <div class="card auth-card shadow-lg" style="--mobile-bg: url('{{ asset('images/register.png') }}');">
            <div class="row g-0">
                
                <div class="col-md-5 d-none d-md-block auth-image-side" style="background-image: url('{{ asset('images/register.png') }}');">
                    <div class="auth-image-overlay">
                        <i class="fa-solid fa-gem fa-4x mb-4 opacity-75" style="color: var(--crimson);"></i>
                        <h2 class="fw-bold mb-3 luxury-title">Đặc Quyền Mới</h2>
                        <p class="text-white-50" style="font-size: 0.95rem; line-height: 1.6;">Gia nhập cộng đồng thượng lưu ngay hôm nay để trải nghiệm dịch vụ không gian làm việc số 1 khu vực.</p>
                    </div>
                </div>

                <div class="col-md-7 auth-form-side">
                    <div class="card-body p-4 p-lg-5">
                        <div class="text-center mb-4">
                            <i class="fa-solid fa-user-plus fa-3x mb-3 text-crimson"></i>
                            <h3 class="fw-bold mb-0 luxury-title">Khởi Tạo Tài Khoản</h3>
                            <p class="text-white-50 mt-2 small">Điền thông tin để kích hoạt thẻ hội viên</p>
                        </div>
                        
                        <form method="POST" action="/register">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-id-card me-1"></i> Họ và Tên</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                    <input type="text" name="name" class="form-control auth-input" placeholder="Nhập họ tên đầy đủ" value="{{ old('name') }}" required>
                                </div>
                                @error('name') <small class="text-danger mt-2 d-block"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-envelope me-1"></i> Địa chỉ Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                    <input type="email" name="email" class="form-control auth-input" placeholder="name@domain.com" value="{{ old('email') }}" required>
                                </div>
                                @error('email') <small class="text-danger mt-2 d-block"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-key me-1"></i> Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control auth-input" placeholder="Tạo mật khẩu bảo mật" required>
                                    <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                                </div>
                                @error('password') <small class="text-danger mt-2 d-block"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-bold"><i class="fa-solid fa-check-double me-1"></i> Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-shield-halved"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control auth-input" placeholder="Nhập lại mật khẩu" required>
                                    <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-crimson btn-lg w-100 py-3 fw-bold fs-6 shadow-sm rounded-pill mb-4">
                                ĐĂNG KÝ HỘI VIÊN <i class="fa-solid fa-gem ms-2"></i>
                            </button>
                            
                            <div class="text-center mt-2 text-white-50 small">
                                Đã có thẻ hội viên? <a href="/login" class="text-decoration-none fw-bold text-gold ms-1 border-bottom border-gold pb-1">Đăng nhập tại đây</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush