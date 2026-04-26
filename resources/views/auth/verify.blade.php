@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="row justify-content-center mt-4 mb-5 animate__animated animate__fadeIn">
    <div class="col-lg-6 col-md-8">
        
        <div class="card auth-card p-0" style="border-top: 4px solid var(--gold); background-image: none !important;">
            <div class="card-body p-4 p-md-5 text-center">
                
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 90px; height: 90px; background: rgba(212, 175, 55, 0.05); border: 1px solid rgba(212, 175, 55, 0.3);">
                        <i class="fa-solid fa-envelope-open-text fa-3x text-gold"></i>
                    </div>
                    <h2 class="fw-bold luxury-title text-white">Kích Hoạt Tài Khoản</h2>
                </div>

                <div class="alert text-start mb-4" style="background: rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px;">
                    <p class="mb-2 text-white" style="font-size: 1.05rem;">Chào mừng quý khách, một email chứa liên kết bảo mật đã được gửi đến địa chỉ <strong>{{ Auth::user()->email }}</strong>.</p>
                    <p class="mb-0 text-white-50 small"><i class="fa-solid fa-circle-info me-2 text-gold"></i>Vui lòng kiểm tra hộp thư đến và nhấp vào liên kết để xác thực danh tính, kích hoạt toàn quyền trải nghiệm hệ thống.</p>
                </div>

                @if (session('success'))
                    <div class="alert bg-transparent border-success text-success fw-bold mb-4 rounded-3 text-start">
                        <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <p class="text-white-50 mb-4 small" style="line-height: 1.6;">
                    Thời gian nhận email có thể mất từ 1-3 phút. Nếu quý khách không tìm thấy thư, vui lòng kiểm tra mục Thư rác (Spam) hoặc yêu cầu hệ thống cấp lại liên kết mới.
                </p>

                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-gold rounded-pill px-5 py-3 fw-bold text-nowrap w-100 mb-3" style="letter-spacing: 1px;">
                        <i class="fa-solid fa-rotate-right me-2"></i>GỬI LẠI MÃ XÁC THỰC
                    </button>
                </form>
                
            </div>
        </div>
        
    </div>
</div>
@endsection