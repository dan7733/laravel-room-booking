@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/room_detail.css') }}">
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card booking-card shadow-lg mb-5">
            <div class="booking-header text-white text-center">
                <h3 class="fw-bold mb-0"><i class="fa-solid fa-calendar-check me-2"></i>Đặt phòng: {{ $room->name }}</h3>
            </div>
            
            <div class="card-body p-4">
                <div class="info-box shadow-sm">
                    <p class="mb-2"><i class="fa-solid fa-users text-primary me-2"></i><strong>Sức chứa:</strong> {{ $room->capacity }} người</p>
                    <p class="mb-0"><i class="fa-solid fa-circle-info text-primary me-2"></i><strong>Mô tả:</strong> {{ $room->description }}</p>
                </div>
                
                <hr class="text-muted mb-4">
                
                <form id="bookingForm" action="{{ route('rooms.book', $room->id) }}" method="POST">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="fw-bold mb-2"><i class="fa-regular fa-clock me-1"></i> Thời gian bắt đầu</label>
                            <input type="datetime-local" name="start_time" class="form-control bg-light" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold mb-2"><i class="fa-solid fa-hourglass-end me-1"></i> Thời gian kết thúc</label>
                            <input type="datetime-local" name="end_time" class="form-control bg-light" required>
                            <div class="invalid-feedback">Thời gian kết thúc không hợp lệ.</div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5 shadow-sm">
                        <i class="fa-solid fa-paper-plane me-2"></i>Xác nhận đặt lịch
                    </button>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="text-decoration-none text-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
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
@endpush