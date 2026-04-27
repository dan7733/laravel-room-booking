@extends('layouts.app')
@push('styles')<link rel="stylesheet" href="{{ asset('css/auth.css') }}">@endpush

@section('content')
<div class="row justify-content-center mt-5 mb-5 animate__animated animate__fadeIn">
    <div class="col-lg-5 col-md-7">
        <div class="card auth-card shadow-lg p-0" style="background-color: var(--charcoal); border: 1px solid rgba(255, 255, 255, 0.05); border-top: 4px solid var(--gold); border-radius: 20px;">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-shield-check fa-3x mb-3 text-success"></i>
                    <h3 class="fw-bold mb-0 luxury-title text-white">Mật Khẩu Mới</h3>
                    <p class="text-white-50 mt-2 small">Thiết lập lại mật khẩu bảo mật của quý khách</p>
                </div>
                
                <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-gold small text-uppercase">Email</label>
                        <input type="email" name="email" class="form-control auth-input" value="{{ $email ?? old('email') }}" readonly>
                        @error('email') <small class="text-danger mt-2 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-gold small text-uppercase">Mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control auth-input" required minlength="6">
                            <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                        </div>
                        @error('password') <small class="text-danger mt-2 d-block">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold text-gold small text-uppercase">Xác nhận mật khẩu</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control auth-input" required minlength="6">
                            <span class="input-group-text toggle-password"><i class="fa-regular fa-eye"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-crimson btn-lg w-100 py-3 fw-bold rounded-pill">
                        LƯU MẬT KHẨU <i class="fa-solid fa-check ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')<script src="{{ asset('js/auth.js') }}"></script>@endpush