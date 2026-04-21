@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-8 col-lg-6">
        <div class="card auth-card">
            <div class="auth-header bg-success" style="background: linear-gradient(135deg, #198754 0%, #146c43 100%);">
                <i class="fa-solid fa-user-plus fa-4x mb-3 opacity-75"></i>
                <h3 class="fw-bold mb-0">Tạo Tài Khoản</h3>
                <p class="text-white-50 mb-0 mt-1">Đăng ký để sử dụng hệ thống đặt phòng</p>
            </div>
            
            <div class="card-body p-4 p-md-5">
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

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mật khẩu</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" class="form-control auth-input" placeholder="Tạo mật khẩu (Ít nhất 6 ký tự)" required>
                            <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                        </div>
                        @error('password') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="fa-solid fa-check-double"></i></span>
                            <input type="password" name="password_confirmation" class="form-control auth-input" placeholder="Nhập lại mật khẩu" required>
                            <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 py-3 fw-bold fs-5 shadow-sm">
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
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush