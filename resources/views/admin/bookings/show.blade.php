@extends('layouts.app')

@push('styles')
<style>
    :root {
        --gold: #D4AF37;
        --charcoal: #111112;
        --dark-gray: #1a1a1c;
        --crimson: #A6192E;
    }
    .detail-card {
        background-color: var(--dark-gray);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-top: 4px solid var(--gold);
        border-radius: 12px;
    }
    .info-label { color: #8b949e; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
    .info-value { color: #ffffff; font-size: 1.1rem; font-weight: bold; } /* Luôn là màu trắng */
    .action-panel { background-color: var(--charcoal); border-top: 1px solid rgba(255,255,255,0.05); padding: 20px; border-radius: 0 0 12px 12px; }
    .btn-gold { background-color: var(--gold); color: #000; font-weight: bold; }
    .btn-gold:hover { background-color: #b8962e; color: #000; }
</style>
@endpush

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.bookings.index') }}" class="text-decoration-none fw-bold" style="color: var(--gold);">
        <i class="fa-solid fa-arrow-left me-2"></i> Quay lại danh sách
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        
        @if(session('success'))
            <div class="alert border-0 text-white shadow-sm mb-4" style="background-color: rgba(46, 160, 67, 0.2); border-left: 4px solid #2ea043;">
                <i class="fa-solid fa-circle-check me-2 text-success"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card detail-card shadow-lg">
            <div class="card-header bg-transparent border-secondary p-4 d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-white fw-bold text-uppercase"><i class="fa-solid fa-file-invoice me-2" style="color: var(--gold);"></i> Hồ Sơ Đặt Phòng #{{ $booking->id }}</h3>
                
                @if($booking->status == 'pending')
                    <span class="badge fs-6 px-4 py-2 text-dark" style="background-color: var(--gold);"><i class="fa-solid fa-spinner fa-spin me-2"></i>CHỜ DUYỆT</span>
                @elseif($booking->status == 'approved')
                    <span class="badge bg-success fs-6 px-4 py-2 text-white"><i class="fa-solid fa-check me-2"></i>ĐÃ DUYỆT</span>
                @elseif($booking->status == 'cancel_requested')
                    <span class="badge bg-danger fs-6 px-4 py-2 border border-danger text-white"><i class="fa-solid fa-bell me-2"></i>KHÁCH XIN HỦY</span>
                @elseif($booking->status == 'cancelled')
                    <span class="badge bg-dark fs-6 px-4 py-2 border border-secondary text-white-50"><i class="fa-solid fa-ban me-2"></i>ĐÃ HỦY</span>
                @else
                    <span class="badge fs-6 px-4 py-2 text-white" style="background-color: var(--crimson);">TỪ CHỐI</span>
                @endif
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="row g-5">
                    <!-- THÔNG TIN KHÁCH HÀNG -->
                    <div class="col-md-6 border-end border-secondary">
                        <h5 class="text-uppercase mb-4 fw-bold" style="color: var(--gold); letter-spacing: 1px;"><i class="fa-solid fa-user-tie me-2"></i>Thông Tin Khách Hàng</h5>
                        <div class="mb-4">
                            <div class="info-label">Họ và Tên</div>
                            <div class="info-value">{{ $booking->user->name }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="info-label">Email Liên Hệ</div>
                            <div class="info-value">{{ $booking->user->email }}</div>
                        </div>
                        <div>
                            <div class="info-label">Ngày Yêu Cầu</div>
                            <div class="info-value text-white-50 fs-6">{{ $booking->created_at->format('H:i - d/m/Y') }}</div>
                        </div>
                    </div>

                    <!-- THÔNG TIN DỊCH VỤ -->
                    <div class="col-md-6">
                        <h5 class="text-uppercase mb-4 fw-bold" style="color: var(--gold); letter-spacing: 1px;"><i class="fa-solid fa-key me-2"></i>Chi Tiết Dịch Vụ</h5>
                        <div class="mb-4">
                            <div class="info-label">Không Gian / Phòng</div>
                            <div class="info-value">{{ $booking->room->name }}</div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="info-label" style="color: #4ade80;">Check-in</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i d/m/Y') }}</div>
                            </div>
                            <div class="col-6">
                                <div class="info-label" style="color: #ff4d4d;">Check-out</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="p-3 rounded-3" style="background-color: rgba(212, 175, 55, 0.05); border: 1px solid rgba(212, 175, 55, 0.2);">
                            <div class="info-label">Tổng Chi Phí</div>
                            <div class="fs-4 fw-bold" style="color: var(--gold);">{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                </div>

                <!-- LÝ DO HỦY (NẾU CÓ) -->
                @if($booking->cancel_reason)
                    <div class="mt-5 p-4 rounded-3 border" style="background-color: #212124; border-color: @if($booking->status == 'cancel_requested') #A6192E @else #444 @endif !important;">
                        <h6 class="text-uppercase mb-2 fw-bold" style="color: @if($booking->status == 'cancel_requested') #ff4d4d @else #8b949e @endif;"><i class="fa-solid fa-comment-dots me-2"></i>Ghi Chú / Lý Do Hủy</h6>
                        <p class="text-white mb-0" style="font-size: 1.1rem; font-style: italic;">"{{ $booking->cancel_reason }}"</p>
                    </div>
                @endif
            </div>

            <!-- KHU VỰC THAO TÁC TRỰC TIẾP TRONG TRANG CHI TIẾT -->
            <div class="action-panel text-end">
                @if($booking->status == 'pending')
                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success px-4 py-2 fw-bold me-2 text-white"><i class="fa-solid fa-check me-2"></i> Phê Duyệt Đơn</button>
                    </form>
                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 fw-bold text-white"><i class="fa-solid fa-ban me-2"></i> Từ Chối</button>
                    </form>

                @elseif($booking->status == 'cancel_requested')
                    <form action="{{ route('admin.bookings.approve-cancel', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-gold px-4 py-2 fw-bold me-2" onclick="return confirm('Chấp thuận cho khách hủy phòng này?')"><i class="fa-solid fa-check-double me-2"></i> Đồng Ý Cho Hủy</button>
                    </form>
                    <form action="{{ route('admin.bookings.reject-cancel', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light px-4 py-2 fw-bold text-white" onclick="return confirm('Từ chối yêu cầu hủy của khách?')"><i class="fa-solid fa-xmark me-2"></i> Bác Bỏ Yêu Cầu Hủy</button>
                    </form>

                @elseif($booking->status == 'approved')
                    <button type="button" class="btn px-4 py-2 fw-bold text-white" style="background-color: var(--crimson); border: 1px solid #ff4d4d;" data-bs-toggle="modal" data-bs-target="#forceCancelModal"><i class="fa-solid fa-trash-can me-2"></i> Cưỡng Chế Hủy Đơn</button>
                    
                    <!-- Modal Cưỡng Chế Hủy -->
                    <div class="modal fade text-start" id="forceCancelModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark border-secondary">
                                <form action="{{ route('admin.bookings.force-cancel', $booking->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-header border-secondary">
                                        <h5 class="modal-title text-danger fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i> Cưỡng Chế Hủy Đơn</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-white-50 mb-3">Vui lòng nhập lý do (tùy chọn) để hệ thống gửi email thông báo cho khách hàng.</p>
                                        <textarea name="cancel_reason" class="form-control bg-secondary text-white border-0 shadow-none" rows="4" placeholder="Ví dụ: Bảo trì đột xuất..."></textarea>
                                    </div>
                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-danger fw-bold text-white">Xác Nhận Hủy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <span class="text-white-50"><i class="fa-solid fa-lock me-2"></i> Hồ sơ này đã được đóng và không thể thay đổi trạng thái.</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection