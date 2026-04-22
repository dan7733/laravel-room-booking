@extends('layouts.app')

@section('content')
<div class="container py-5 mt-4">
    <div class="row align-items-center mb-5">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
            <h6 class="text-primary fw-bold text-uppercase"><i class="fa-solid fa-building me-2"></i>Câu chuyện của chúng tôi</h6>
            <h1 class="fw-bold display-5 mb-4">Giải pháp không gian <span class="text-primary">tối ưu</span></h1>
            <p class="lead text-muted">RoomBooking được thành lập với sứ mệnh mang đến không gian làm việc chuyên nghiệp, linh hoạt và tiện nghi nhất cho các doanh nghiệp, startup và freelancer tại Việt Nam.</p>
            <p class="text-muted">Chúng tôi không chỉ cho thuê phòng họp, chúng tôi cung cấp một hệ sinh thái tiện ích đẳng cấp giúp khơi nguồn sáng tạo và kết nối những ý tưởng lớn.</p>
        </div>
        <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <div class="row g-4">
                <div class="col-6">
                    <div class="p-4 bg-white shadow-sm rounded-4 border-top border-primary border-4">
                        <i class="fa-solid fa-medal fa-3x text-warning mb-3"></i>
                        <h3 class="fw-bold">5+ Năm</h3>
                        <p class="text-muted mb-0">Kinh nghiệm</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-4 bg-white shadow-sm rounded-4 border-top border-success border-4 mt-4">
                        <i class="fa-solid fa-handshake fa-3x text-success mb-3"></i>
                        <h3 class="fw-bold">1000+</h3>
                        <p class="text-muted mb-0">Khách hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection