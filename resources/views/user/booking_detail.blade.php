@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="{{ route('bookings.my') }}" class="text-gold text-decoration-none fw-bold"><i class="fa-solid fa-arrow-left me-2"></i>Trở về danh sách</a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color: var(--charcoal); border-top: 4px solid var(--gold) !important;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-white fw-bold luxury-title border-bottom border-secondary pb-3 mb-4">Chi Tiết Lịch Đặt #{{ $booking->id }}</h3>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <p class="text-white-50 mb-1 small text-uppercase letter-spacing-1">Không gian</p>
                            <h5 class="text-white fw-bold">{{ $booking->room->name }}</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="text-white-50 mb-1 small text-uppercase letter-spacing-1">Trạng thái</p>
                            @if($booking->status == 'approved')
                            <h5 class="text-success fw-bold"><i class="fa-solid fa-circle-check me-2"></i>Đã duyệt</h5>
                            @elseif($booking->status == 'cancel_requested')
                            <h5 class="text-warning fw-bold"><i class="fa-solid fa-spinner fa-spin me-2"></i>Đang chờ duyệt hủy</h5>
                            @elseif($booking->status == 'cancelled')
                            <h5 class="text-secondary fw-bold"><i class="fa-solid fa-ban me-2"></i>Đã hủy</h5>
                            @else
                            <h5 class="text-white fw-bold">{{ strtoupper($booking->status) }}</h5>
                            @endif
                        </div>
                    </div>

                    <div class="bg-dark rounded-3 p-4 border border-secondary mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-white-50">Nhận phòng:</span>
                            <span class="text-white fw-bold">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i - d/m/Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-white-50">Trả phòng:</span>
                            <span class="text-white fw-bold">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i - d/m/Y') }}</span>
                        </div>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-white-50">Tổng thanh toán:</span>
                            <h3 class="text-gold fw-bold mb-0">{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</h3>
                        </div>
                    </div>

                    <!-- LOGIC NÚT HỦY PHÒNG ĐÃ FIX TẬN GỐC LỖI BIẾN MẤT -->
                    @if($booking->status == 'approved' && \Carbon\Carbon::now()->lessThan($booking->start_time))
                    
                    <!-- Đã xóa class 'alert', thay bằng 'p-3 rounded-3 border' -->
                    <div class="p-3 rounded-3 bg-dark border border-danger text-white mt-4">
                        <h6 class="text-danger fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i>Chính sách hủy phòng</h6>
                        <p class="small text-white-50 mb-3">Quý khách chỉ có thể yêu cầu hủy phòng trước giờ Check-in. Ban quản trị sẽ xem xét và phản hồi qua email.</p>

                        <!-- NÚT GỌI MODAL -->
                        <button type="button" class="btn btn-outline-danger w-100 fw-bold py-2" data-bs-toggle="modal" data-bs-target="#userCancelModal">
                            <i class="fa-solid fa-xmark me-2"></i> Yêu Cầu Hủy Phòng
                        </button>
                    </div>

                    <!-- MODAL NHẬP LÝ DO HỦY CỦA USER -->
                    <div class="modal fade" id="userCancelModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark text-white border-secondary text-start">
                                <form action="{{ route('bookings.request-cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Quý khách chắc chắn muốn gửi yêu cầu HỦY đơn này?')">
                                    @csrf
                                    <div class="modal-header border-secondary">
                                        <h5 class="modal-title text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Xác nhận yêu cầu hủy phòng</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-white-50 small mb-3">Ban quản trị sẽ xem xét yêu cầu hủy phòng của quý khách và phản hồi qua email. Vui lòng chia sẻ lý do để chúng tôi hỗ trợ tốt hơn.</p>
                                        <div class="mb-3">
                                            <label class="form-label text-white-50 small">Lý do hủy (Tùy chọn)</label>
                                            <textarea name="cancel_reason" class="form-control bg-secondary text-white border-0 shadow-none" rows="4" placeholder="Ví dụ: Thay đổi lịch trình công tác, sự cố cá nhân..."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-danger">Xác Nhận Gửi Yêu Cầu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @elseif($booking->status == 'cancel_requested')
                    <div class="p-3 rounded-3 border border-warning text-warning bg-dark mt-4 text-center">
                        <i class="fa-solid fa-clock-rotate-left fa-2x mb-2"></i>
                        <p class="mb-0 mt-2">Hệ thống đã tiếp nhận yêu cầu hủy. Vui lòng chờ phản hồi qua email.</p>
                        @if($booking->cancel_reason)
                        <hr class="border-warning opacity-25">
                        <small class="text-white-50">Lý do đã gửi: {{ $booking->cancel_reason }}</small>
                        @endif
                    </div>
                    @elseif($booking->status == 'cancelled' && $booking->cancel_reason)
                    <div class="p-3 rounded-3 border border-secondary text-secondary bg-dark mt-4">
                        <small><i class="fa-solid fa-circle-info me-2"></i><strong>Lý do hủy:</strong> {{ $booking->cancel_reason }}</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection