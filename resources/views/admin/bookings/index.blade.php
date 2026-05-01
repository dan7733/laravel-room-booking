@extends('layouts.app')

@push('styles')
<style>
    :root {
        --gold: #D4AF37;
        --charcoal: #111112;
        --dark-gray: #1a1a1c;
        --crimson: #A6192E;
    }
    
    /* Ép nền thẻ Card thành Đen */
    .luxury-card {
        background-color: var(--charcoal) !important;
        border: 1px solid rgba(212, 175, 55, 0.15) !important;
        border-top: 4px solid var(--gold) !important;
        border-radius: 12px;
    }

    /* Ép bảng Bootstrap trong suốt để ăn theo nền Đen của Card */
    .luxury-table {
        --bs-table-bg: transparent;
        --bs-table-color: #ffffff;
        color: #ffffff;
        margin-bottom: 0;
    }
    
    /* Đầu bảng (Tiêu đề) */
    .luxury-table thead th {
        background-color: var(--dark-gray) !important;
        color: var(--gold) !important;
        border-bottom: 2px solid var(--crimson) !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 15px;
        border-top: none;
    }

    /* Từng dòng trong bảng */
    .luxury-table tbody tr {
        background-color: transparent !important;
    }
    .luxury-table tbody td {
        background-color: transparent !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        vertical-align: middle;
        padding: 15px;
        color: #ffffff !important; /* Chữ auto trắng */
    }

    /* Hover vào dòng sáng nhẹ lên */
    .luxury-table tbody tr:hover td {
        background-color: rgba(212, 175, 55, 0.05) !important;
    }

    /* Fix lỗi ô chọn Lọc (Select Dropdown) */
    .filter-select {
        background-color: var(--charcoal) !important;
        color: #ffffff !important; /* Chữ trắng */
        border: 1px solid rgba(212, 175, 55, 0.5) !important;
    }
    .filter-select:focus {
        border-color: var(--gold) !important;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25) !important;
        color: #ffffff !important;
    }
    .filter-select option {
        background-color: var(--dark-gray) !important;
        color: #ffffff !important; /* Tùy chọn thả xuống cũng phải trắng */
    }

    /* Nút bấm Vàng */
    .btn-gold { background-color: var(--gold); color: #000; font-weight: bold; border: none;}
    .btn-gold:hover { background-color: #b8962e; color: #000; }
    
    .blink-soft { animation: blinker 2s linear infinite; }
    @keyframes blinker { 50% { opacity: 0.5; } }
</style>
@endpush

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <h2 class="text-white fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">
        <i class="fa-solid fa-chess-king me-2" style="color: var(--gold);"></i> Quản Lý Đặt Phòng
    </h2>
    
    <!-- BỘ LỌC TRẠNG THÁI -->
    <form action="{{ route('admin.bookings.index') }}" method="GET" class="d-flex gap-2">
        <!-- Bỏ hết class text-dark đi để chữ trắng 100% -->
        <select name="status" class="form-select filter-select shadow-none" onchange="this.form.submit()">
            <option value="">Tất cả trạng thái</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt đặt phòng</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã duyệt (Đang chạy)</option>
            <option value="cancel_requested" {{ request('status') == 'cancel_requested' ? 'selected' : '' }}>Khách xin hủy (Cần xử lý)</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
        </select>
        @if(request('status'))
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-light" title="Xóa lọc"><i class="fa-solid fa-rotate-left"></i></a>
        @endif
    </form>
</div>

@if(session('success'))
    <div class="alert border-0 text-white shadow-sm mb-4" style="background-color: rgba(46, 160, 67, 0.2); border-left: 4px solid #2ea043;">
        <i class="fa-solid fa-circle-check me-2 text-success"></i> {{ session('success') }}
    </div>
@endif

<div class="card luxury-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <!-- Đã thêm .table-dark nếu Bootstrap bắt buộc, nhưng CSS ở trên đã ép màu rồi -->
            <table class="table luxury-table mb-0">
                <thead>
                    <tr>
                        <th><i class="fa-solid fa-hashtag me-1"></i> Mã</th>
                        <th><i class="fa-solid fa-user me-1"></i> Khách hàng</th>
                        <th><i class="fa-solid fa-door-open me-1"></i> Phòng</th>
                        <th><i class="fa-regular fa-clock me-1"></i> Thời gian</th>
                        <th><i class="fa-solid fa-circle-half-stroke me-1"></i> Trạng thái</th>
                        <th class="text-center"><i class="fa-solid fa-bolt me-1"></i> Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="fw-bold" style="color: var(--gold);">#{{ $booking->id }}</td>
                        <td>
                            <div class="fw-bold text-white">{{ $booking->user->name }}</div>
                            <div class="small text-white-50">{{ $booking->user->email }}</div>
                        </td>
                        <td><span class="badge bg-dark border border-secondary text-white px-3 py-2">{{ $booking->room->name }}</span></td>
                        <td>
                            <div class="small text-white mb-1"><span style="color: #4ade80; font-weight: bold; width: 35px; display: inline-block;">IN:</span> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i d/m/y') }}</div>
                            <div class="small text-white"><span style="color: #ff4d4d; font-weight: bold; width: 35px; display: inline-block;">OUT:</span> {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i d/m/y') }}</div>
                        </td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge rounded-pill text-dark px-3 py-2 fw-bold" style="background-color: var(--gold);"><i class="fa-solid fa-spinner fa-spin me-1"></i> Chờ duyệt</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge rounded-pill bg-success px-3 py-2 text-white"><i class="fa-solid fa-check me-1"></i> Đã duyệt</span>
                            @elseif($booking->status == 'cancel_requested')
                                <span class="badge rounded-pill bg-danger px-3 py-2 border border-danger text-white blink-soft"><i class="fa-solid fa-bell me-1"></i> Xin hủy</span>
                                @if($booking->cancel_reason)
                                    <div class="small mt-1" style="color: var(--gold); max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $booking->cancel_reason }}">
                                        Lý do: {{ $booking->cancel_reason }}
                                    </div>
                                @endif
                            @elseif($booking->status == 'cancelled')
                                <span class="badge rounded-pill bg-dark px-3 py-2 border border-secondary text-white-50"><i class="fa-solid fa-ban me-1"></i> Đã hủy</span>
                            @else
                                <span class="badge rounded-pill px-3 py-2 text-white" style="background-color: var(--crimson);">Từ chối</span>
                            @endif
                        </td>
                        <td>
                            <!-- NHÓM NÚT THAO TÁC NHANH TRỰC TIẾP TRÊN BẢNG -->
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <!-- Nút Xem Chi Tiết -->
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-outline-info btn-sm text-white border-info" title="Xem chi tiết đơn">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if($booking->status == 'pending')
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" title="Duyệt đơn"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" title="Từ chối đơn"><i class="fa-solid fa-ban"></i></button>
                                    </form>

                                @elseif($booking->status == 'cancel_requested')
                                    <form action="{{ route('admin.bookings.approve-cancel', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-gold btn-sm" title="Đồng ý hủy" onclick="return confirm('Chấp thuận cho khách hủy phòng này?')"><i class="fa-solid fa-check-double"></i></button>
                                    </form>
                                    <form action="{{ route('admin.bookings.reject-cancel', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-sm text-white" title="Không cho hủy" onclick="return confirm('Từ chối yêu cầu hủy của khách?')"><i class="fa-solid fa-xmark"></i></button>
                                    </form>

                                @elseif($booking->status == 'approved')
                                    <button type="button" class="btn btn-outline-danger btn-sm text-white border-danger" data-bs-toggle="modal" data-bs-target="#forceCancelModal{{ $booking->id }}" title="Ép Hủy Đơn">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    <!-- Modal Cưỡng Chế Hủy Nhỏ -->
                                    <div class="modal fade" id="forceCancelModal{{ $booking->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-dark border-secondary">
                                                <form action="{{ route('admin.bookings.force-cancel', $booking->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header border-secondary">
                                                        <h5 class="modal-title text-danger text-start fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i> Ép Hủy Đơn #{{ $booking->id }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p class="text-white-50 mb-3">Vui lòng nhập lý do (tùy chọn) để thông báo cho khách hàng:</p>
                                                        <textarea name="cancel_reason" class="form-control bg-secondary text-white border-0 shadow-none" rows="3"></textarea>
                                                    </div>
                                                    <div class="modal-footer border-secondary">
                                                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-danger text-white fw-bold">Xác Nhận Hủy</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-white-50">
                            <i class="fa-solid fa-folder-open fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Không tìm thấy yêu cầu đặt phòng nào.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection