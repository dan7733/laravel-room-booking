@extends('layouts.app')
@push('styles')<link rel="stylesheet" href="{{ asset('css/auth.css') }}">@endpush

@section('content')
<div class="row justify-content-center mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="col-lg-5 col-md-7">
        <div class="card auth-card shadow-lg p-0" style="background-color: var(--charcoal); border: 1px solid rgba(255, 255, 255, 0.05); border-top: 4px solid var(--gold); border-radius: 20px;">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-unlock-keyhole fa-3x mb-3 text-gold"></i>
                    <h3 class="fw-bold mb-0 luxury-title text-white">Khôi Phục Đặc Quyền</h3>
                    <p class="text-white-50 mt-2 small">Nhập email để nhận liên kết thiết lập lại mật khẩu</p>
                </div>
                
                <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold text-gold small text-uppercase"><i class="fa-solid fa-envelope me-1"></i> Email đăng ký</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                            <input type="email" name="email" class="form-control auth-input" placeholder="name@domain.com" required>
                        </div>
                        @error('email') <small class="text-danger mt-2 d-block">{{ $message }}</small> @enderror
                    </div>
                    <button type="submit" class="btn btn-crimson btn-lg w-100 py-3 fw-bold rounded-pill mb-3">
                        GỬI YÊU CẦU <i class="fa-solid fa-paper-plane ms-2"></i>
                    </button>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-white-50 text-decoration-none small hover-text-gold"><i class="fa-solid fa-arrow-left me-1"></i> Trở về đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')<script src="{{ asset('js/auth.js') }}"></script>@endpush