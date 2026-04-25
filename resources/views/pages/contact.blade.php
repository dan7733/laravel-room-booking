@extends('layouts.app')

@push('styles')
<style>
    /* CSS Dành riêng cho ô nhập liệu trang Liên hệ */
    .contact-input {
        background-color: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
        border-radius: 10px;
        padding: 14px 15px;
    }
    .contact-input:focus {
        border-color: var(--gold) !important;
        box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.2) !important;
    }
    .contact-input::placeholder {
        color: rgba(255, 255, 255, 0.4) !important;
    }

    /* Thiết kế thẻ Thông tin liên hệ */
    .info-card {
        background: linear-gradient(135deg, #111112 0%, #1a1a1c 100%);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 4px solid var(--crimson);
    }
    .icon-box {
        width: 55px; height: 55px;
        background: rgba(212, 175, 55, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.2);
        color: var(--gold);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="container py-5 mt-4 mb-5">
    <div class="text-center mb-5 animate__animated animate__fadeInDown">
        <h6 class="text-gold fw-bold text-uppercase" style="letter-spacing: 2px;"><i class="fa-solid fa-headset me-2"></i>Dịch vụ đặc quyền</h6>
        <h1 class="fw-bold display-5 text-white luxury-title">Chúng Tôi Luôn Lắng Nghe</h1>
        <div class="mx-auto mt-3 mb-4" style="width: 60px; height: 3px; background: var(--crimson);"></div>
        <p class="text-white-50">Đội ngũ chuyên viên của chúng tôi luôn sẵn sàng hỗ trợ quý khách 24/7.</p>
    </div>

    <div class="row g-5">
        <div class="col-md-5">
            <div class="card info-card shadow-lg rounded-4 h-100 p-4 p-lg-5">
                <h4 class="fw-bold mb-5 luxury-title text-white">Kết Nối Với Chúng Tôi</h4>
                
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary" style="border-opacity: 0.3;">
                    <div class="icon-box me-4">
                        <i class="fa-solid fa-location-dot fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white letter-spacing-1 text-uppercase">Trụ sở chính</h6>
                        <small class="text-white-50">Trung tâm thương mại Ninh Kiều, Cần Thơ</small>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom border-secondary" style="border-opacity: 0.3;">
                    <div class="icon-box me-4">
                        <i class="fa-solid fa-phone fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white letter-spacing-1 text-uppercase">Đường dây nóng VIP</h6>
                        <small class="text-gold fw-bold fs-6">0123.456.789</small>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="icon-box me-4">
                        <i class="fa-solid fa-envelope fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white letter-spacing-1 text-uppercase">Thư điện tử</h6>
                        <small class="text-white-50">vip@roombooking.com</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-lg rounded-4 p-4 p-lg-5">
                <h4 class="fw-bold mb-4 luxury-title text-white">Gửi Yêu Cầu Hỗ Trợ</h4>
                <form action="#" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold text-gold small text-uppercase">Họ và tên</label>
                            <input type="text" class="form-control contact-input" placeholder="Nhập tên của bạn">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-gold small text-uppercase">Số điện thoại</label>
                            <input type="text" class="form-control contact-input" placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-gold small text-uppercase">Thư điện tử (Email)</label>
                        <input type="email" class="form-control contact-input" placeholder="name@domain.com">
                    </div>
                    <div class="mb-5">
                        <label class="form-label fw-bold text-gold small text-uppercase">Nội dung yêu cầu</label>
                        <textarea class="form-control contact-input" rows="4" placeholder="Vui lòng cho chúng tôi biết bạn cần hỗ trợ gì..."></textarea>
                    </div>
                    <button type="button" class="btn btn-crimson btn-lg w-100 fw-bold shadow-sm rounded-pill py-3" onclick="alert('Cảm ơn quý khách! Chuyên viên của chúng tôi sẽ liên hệ trong ít phút.')">
                        <i class="fa-solid fa-paper-plane me-2"></i>GỬI YÊU CẦU
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection