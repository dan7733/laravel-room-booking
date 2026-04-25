@extends('layouts.app')

@push('styles')
<style>
    /* Custom CSS riêng cho bảng Lịch sử Đặt phòng Luxury */
    .luxury-table {
        --bs-table-bg: transparent;
        --bs-table-color: var(--text-main);
        --bs-table-hover-bg: rgba(255, 255, 255, 0.02);
        --bs-table-hover-color: var(--text-main);
        border-collapse: separate;
        border-spacing: 0;
    }
    .luxury-table thead th {
        background-color: #111112;
        color: var(--gold);
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border-bottom: 1px solid var(--crimson);
        padding: 1.2rem 1rem;
        font-weight: 700;
    }
    .luxury-table tbody td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        vertical-align: middle;
    }
    .luxury-table tbody tr:last-child td {
        border-bottom: none;
    }
    .room-icon-sm {
        width: 45px; height: 45px;
        background: rgba(212, 175, 55, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
    }
    /* Các huy hiệu trạng thái (Badges) */
    .badge-pending {
        background-color: rgba(212, 175, 55, 0.1);
        color: var(--gold);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }
    .badge-approved {
        background-color: rgba(74, 222, 128, 0.1);
        color: #4ade80;
        border: 1px solid rgba(74, 222, 128, 0.3);
    }
    .badge-rejected {
        background-color: rgba(166, 25, 46, 0.1);
        color: #ff4d4d;
        border: 1px solid rgba(166, 25, 46, 0.4);
    }
</style>
@endpush

@section('content')
<div class="container py-4 mt-3 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
        <div>
            <h6 class="text-gold fw-bold text-uppercase letter-spacing-1 mb-2"><i class="fa-solid fa-clock-rotate-left me-2"></i>Lịch sử của bạn</h6>
            <h2 class="fw-bold display-6 mb-0 luxury-title text-white">Bộ Sưu Tập Không Gian</h2>
        </div>
        <div>
            <a href="{{ route('home') }}#room-list" class="btn btn-crimson rounded-pill fw-bold px-4 py-2 text-nowrap">
                <i class="fa-solid fa-plus me-2"></i> Đặt thêm phòng
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-0">
            @if($bookings->isEmpty())
                <div class="text-center py-5 my-4">
                    <div class="mb-4">
                        <i class="fa-regular fa-calendar-xmark fa-4x text-gold opacity-50"></i>
                    </div>
                    <h4 class="fw-bold text-white luxury-title mb-3">Chưa Có Dữ Liệu Chuyến Đi</h4>
                    <p class="text-white-50 mb-4">Hãy bắt đầu trải nghiệm dịch vụ đẳng cấp của chúng tôi bằng cách tạo lịch đặt phòng đầu tiên.</p>
                    <a href="{{ route('home') }}#room-list" class="btn btn-outline-gold rounded-pill px-4 py-2 fw-bold">Khám phá ngay</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover luxury-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="ps-4">Không gian</th>
                                <th scope="col">Thời gian sử dụng</th>
                                <th scope="col">Chi phí</th>
                                <th scope="col">Ngày tạo đơn</th>
                                <th scope="col" class="text-center pe-4">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="room-icon-sm me-3">
                                            <i class="fa-solid fa-chess-king fs-5 text-gold"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 fw-bold text-white">{{ $booking->room->name }}</h6>
                                            <small class="text-white-50"><i class="fa-solid fa-user-group me-1"></i> {{ $booking->room->capacity }} Khách</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-white-50" style="font-size: 0.9rem;">
                                    <div class="mb-1"><span class="fw-bold text-white">Nhận:</span> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i - d/m/Y') }}</div>
                                    <div><span class="fw-bold text-white">Trả:</span> &nbsp;&nbsp;&nbsp;{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i - d/m/Y') }}</div>
                                </td>
                                <td class="py-3 fw-bold text-gold fs-5">
                                    {{ number_format($booking->total_price, 0, ',', '.') }}đ
                                </td>
                                <td class="py-3 text-white-50 small">
                                    {{ $booking->created_at->format('H:i - d/m/Y') }}
                                </td>
                                <td class="py-3 text-center pe-4">
                                    @if($booking->status == 'pending')
                                        <span class="badge badge-pending px-3 py-2 rounded-pill fw-bold"><i class="fa-solid fa-hourglass-half me-1"></i> Chờ duyệt</span>
                                    @elseif($booking->status == 'approved')
                                        <span class="badge badge-approved px-3 py-2 rounded-pill fw-bold"><i class="fa-solid fa-check-circle me-1"></i> Đã duyệt</span>
                                    @elseif($booking->status == 'rejected')
                                        <span class="badge badge-rejected px-3 py-2 rounded-pill fw-bold"><i class="fa-solid fa-times-circle me-1"></i> Từ chối</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $booking->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection