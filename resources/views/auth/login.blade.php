@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="row justify-content-center mt-3 mb-5">
    <div class="col-xl-10 col-lg-12">
        <div class="card auth-card shadow-lg" style="--mobile-bg: url('{{ asset('images/login.png') }}');">
            <div class="row g-0">
                
                <div class="col-md-6 d-none d-md-block auth-image-side" style="background-image: url('{{ asset('images/login.png') }}');">
                    <div class="auth-image-overlay">
                        <i class="fa-solid fa-building-user fa-4x mb-4 text-white opacity-75"></i>
                        <h2 class="fw-bold mb-3">RoomBooking</h2>
                        <p class="fs-5 text-white-50">Hệ thống quản lý không gian chuyên nghiệp. Chào mừng bạn quay trở lại để tiếp tục công việc.</p>
                    </div>
                </div>

                <div class="col-md-6 auth-form-side">
                    <div class="card-body p-4 p-lg-5">
                        <div class="text-center mb-5 mt-2">
                            <i class="fa-solid fa-circle-user fa-3x mb-3 text-primary"></i>
                            <h3 class="fw-bold mb-0">Đăng Nhập</h3>
                            <p class="text-muted mt-1">Vui lòng nhập thông tin của bạn</p>
                        </div>
                        
                        <form method="POST" action="/login">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Địa chỉ Email</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control auth-input" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                                </div>
                                @error('email') <small class="text-danger mt-1 d-block"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Mật khẩu</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control auth-input" placeholder="Nhập mật khẩu" required>
                                    <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                                </div>
                            </div>

                            <div class="mb-5 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="remember" style="cursor: pointer;">
                                        Ghi nhớ
                                    </label>
                                </div>
                                <a href="#" class="text-decoration-none text-primary fw-semibold small">Quên mật khẩu?</a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold fs-5 shadow-sm rounded-pill">
                                Đăng Nhập <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                            </button>
                            
                            <div class="text-center mt-4 text-muted">
                                Chưa có tài khoản? <a href="/register" class="text-decoration-none fw-bold">Đăng ký ngay</a>
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