@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/room_detail.css') }}">
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 mt-4 mb-5">
        <div class="card booking-card shadow-lg mb-5 border-0 rounded-4 overflow-hidden animate__animated animate__fadeInUp">
            
            <div class="booking-header text-white text-center">
                <h2 class="fw-bold mb-0 luxury-title"><i class="fa-solid fa-chess-king text-gold me-3"></i>{{ $room->name }}</h2>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <div class="info-box shadow-sm mb-5">
                    <div class="row text-center">
                        <div class="col-6 border-end border-secondary">
                            <h6 class="text-white-50 text-uppercase small fw-bold letter-spacing-1">Sức chứa</h6>
                            <h4 class="text-white fw-bold mb-0"><i class="fa-solid fa-users text-gold me-2"></i>{{ $room->capacity }} <span class="fs-6 fw-normal text-white-50">người</span></h4>
                        </div>
                        <div class="col-6">
                            <h6 class="text-white-50 text-uppercase small fw-bold letter-spacing-1">Giá phòng</h6>
                            <h4 class="text-crimson fw-bold mb-0" id="roomPrice" data-price="{{ $room->price }}">{{ number_format($room->price, 0, ',', '.') }}đ <span class="fs-6 fw-normal text-white-50">/ ngày</span></h4>
                        </div>
                    </div>
                    <hr class="border-secondary opacity-50 my-4">
                    <p class="mb-0 text-white-50 lh-lg"><i class="fa-solid fa-gem text-gold me-2"></i><strong class="text-white">Đặc quyền:</strong> {{ $room->description }}</p>
                </div>
                
                <h5 class="fw-bold mb-4 text-white luxury-title border-left-gold ps-3">Thiết Lập Lịch Trình</h5>
                
                <form id="bookingForm" action="{{ route('rooms.book', $room->id) }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <label class="fw-bold mb-2 text-gold small text-uppercase"><i class="fa-regular fa-calendar-check me-1"></i> Thời gian nhận</label>
                            <input type="datetime-local" id="startTime" name="start_time" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold mb-2 text-gold small text-uppercase"><i class="fa-regular fa-calendar-xmark me-1"></i> Thời gian trả</label>
                            <input type="datetime-local" id="endTime" name="end_time" class="form-control form-control-lg" required>
                            <div class="invalid-feedback text-danger">Thời gian kết thúc phải sau thời gian bắt đầu.</div>
                        </div>
                    </div>

                    <div class="calculation-box p-4 rounded-4 mb-5 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-white-50 fs-5">Chi phí dự kiến (<span id="dayCount" class="text-white">0</span> ngày):</span>
                        <h2 class="fw-bold text-crimson mb-0" id="totalPriceDisplay">0đ</h2>
                    </div>
                    
                    <button type="submit" class="btn btn-crimson w-100 py-3 fw-bold fs-5 shadow-sm rounded-pill mb-4">
                        <i class="fa-solid fa-paper-plane me-2"></i>Gửi Yêu Cầu Đặt Lịch
                    </button>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="text-decoration-none text-white-50 hover-text-gold transition-all">
                            <i class="fa-solid fa-arrow-left me-1"></i> Trở về bộ sưu tập
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/room_detail.js') }}"></script>
<script>
    // JS Tính tiền động giữ nguyên, chỉ sửa ID nếu cần. (Đã xử lý gọn trong js file)
    document.addEventListener('DOMContentLoaded', function() {
        const startTimeInput = document.getElementById('startTime');
        const endTimeInput = document.getElementById('endTime');
        const pricePerDay = parseInt(document.getElementById('roomPrice').getAttribute('data-price'));
        const dayCountDisplay = document.getElementById('dayCount');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');

        function calculateTotal() {
            if (startTimeInput.value && endTimeInput.value) {
                const start = new Date(startTimeInput.value);
                const end = new Date(endTimeInput.value);
                
                if (end <= start) {
                    endTimeInput.classList.add('is-invalid');
                    dayCountDisplay.innerText = "0";
                    totalPriceDisplay.innerText = "0đ";
                    return;
                } else {
                    endTimeInput.classList.remove('is-invalid');
                }

                const diffTime = Math.abs(end - start);
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays === 0) diffDays = 1;

                const total = diffDays * pricePerDay;

                dayCountDisplay.innerText = diffDays;
                totalPriceDisplay.innerText = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
            }
        }

        startTimeInput.addEventListener('change', calculateTotal);
        endTimeInput.addEventListener('change', calculateTotal);
    });
</script>
@endpush