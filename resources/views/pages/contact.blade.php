@extends('layouts.app')

@section('content')
<div class="container py-5 mt-4">
    <div class="text-center mb-5 animate__animated animate__fadeInDown">
        <h6 class="text-primary fw-bold text-uppercase"><i class="fa-solid fa-headset me-2"></i>Kết nối với RoomBooking</h6>
        <h1 class="fw-bold display-5">Chúng tôi luôn lắng nghe</h1>
    </div>

    <div class="row g-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary text-white p-4">
                <h4 class="fw-bold mb-4">Thông Tin Liên Hệ</h4>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-location-dot fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Trụ sở chính</h6>
                        <small>Quận Phú Nhuận, TP. Hồ Chí Minh</small>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-phone fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Hotline (24/7)</h6>
                        <small>0987.654.321</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-envelope fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Email hỗ trợ</h6>
                        <small>support@roombooking.com</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <form action="#" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Họ và tên</label>
                            <input type="text" class="form-control" placeholder="Nhập tên của bạn">
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" placeholder="name@example.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Lời nhắn</label>
                        <textarea class="form-control" rows="4" placeholder="Bạn cần chúng tôi hỗ trợ gì?"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm" onclick="alert('Cảm ơn bạn! Lời nhắn đã được gửi (Tính năng demo).')">
                        <i class="fa-solid fa-paper-plane me-2"></i>Gửi Lời Nhắn
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection