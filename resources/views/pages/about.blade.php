@extends('layouts.app')

@section('content')
<div class="container py-5 mt-4 mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 animate__animated animate__fadeInLeft mb-5 mb-md-0">
            <h6 class="text-gold fw-bold text-uppercase" style="letter-spacing: 2px;">
                <i class="fa-solid fa-building me-2"></i>Câu chuyện của chúng tôi
            </h6>
            <h1 class="fw-bold display-5 mb-4 luxury-title text-white">Giải pháp không gian <span class="text-crimson">Đỉnh Cao</span></h1>
            
            <p class="lead text-white-50 mb-4" style="line-height: 1.8;">
                RoomBooking Signature được thành lập với sứ mệnh mang đến không gian đàm phán chuyên nghiệp, riêng tư và sang trọng nhất cho giới tinh hoa, doanh nhân tại khu vực.
            </p>
            <p class="text-white-50" style="line-height: 1.8;">
                Chúng tôi không chỉ cho thuê không gian, chúng tôi kiến tạo một hệ sinh thái đặc quyền giúp nâng tầm vị thế và là bệ phóng cho những thương vụ triệu đô của đối tác.
            </p>
        </div>
        
        <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <div class="row g-4">
                <div class="col-6">
                    <div class="card h-100 p-4 shadow-lg rounded-4 bg-transparent" style="border: 1px solid rgba(212, 175, 55, 0.2); border-top: 4px solid var(--gold);">
                        <i class="fa-solid fa-gem fa-3x text-gold mb-3"></i>
                        <h3 class="fw-bold text-white luxury-title mb-2">Tiêu Chuẩn</h3>
                        <p class="text-white-50 mb-0 small text-uppercase" style="letter-spacing: 1px;">5 Sao Quốc Tế</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card h-100 p-4 shadow-lg rounded-4 bg-transparent mt-4" style="border: 1px solid rgba(166, 25, 46, 0.2); border-top: 4px solid var(--crimson);">
                        <i class="fa-solid fa-handshake-angle fa-3x text-crimson mb-3"></i>
                        <h3 class="fw-bold text-white luxury-title mb-2">1000+</h3>
                        <p class="text-white-50 mb-0 small text-uppercase" style="letter-spacing: 1px;">Thương vụ thành công</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection