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
                    <div class="auth-image-overlay success-overlay">
                        <i class="fa-solid fa-user-shield fa-4x mb-4 text-white opacity-75"></i>
                        <h2 class="fw-bold mb-3">Tạo Mới</h2>
                        <p class="fs-5 text-white-50">Đăng ký ngay hôm nay để trải nghiệm toàn bộ tiện ích và bắt đầu đặt phòng dễ dàng.</p>
                    </div>
                </div>

                <div class="col-md-7 auth-form-side">
                    <div class="card-body p-4 p-lg-5">
                        <div class="text-center mb-4">
                            <i class="fa-solid fa-user-plus fa-3x mb-3 text-success"></i>
                            <h3 class="fw-bold mb-0">Tạo Tài Khoản</h3>
                            <p class="text-muted mt-1">Điền thông tin để tham gia hệ thống</p>
                        </div>
                        
                        <form method="POST" action="/register">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Họ và Tên</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" name="name" class="form-control auth-input" placeholder="Nhập họ tên đầy đủ" value="{{ old('name') }}" required>
                                </div>
                                @error('name') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Địa chỉ Email</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control auth-input" placeholder="name@example.com" value="{{ old('email') }}" required>
                                </div>
                                @error('email') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label class="form-label fw-semibold">Mật khẩu</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                        <input type="password" name="password" class="form-control auth-input" placeholder="Tạo mật khẩu" required>
                                    </div>
                                    @error('password') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-lg-6 mb-5">
                                    <label class="form-label fw-semibold">Xác nhận</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text"><i class="fa-solid fa-check-double"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control auth-input" placeholder="Nhập lại" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100 py-3 fw-bold fs-5 shadow-sm rounded-pill">
                                Đăng Ký Tài Khoản <i class="fa-solid fa-user-check ms-2"></i>
                            </button>
                            
                            <div class="text-center mt-4 text-muted">
                                Đã có tài khoản? <a href="/login" class="text-decoration-none fw-bold text-success">Đăng nhập tại đây</a>
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