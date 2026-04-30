@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="admin-title"><i class="fa-solid fa-calendar-check text-primary me-2"></i>Quản Lý Đặt Phòng</h2>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 bg-success text-white shadow-sm">{{ session('success') }}</div>
@endif

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead class="table-light">
                    <tr>
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
                        <td class="fw-bold">{{ $booking->user->name }}</td>
                        <td><span class="badge bg-secondary">{{ $booking->room->name }}</span></td>
                        <td>
                            <div class="small"><span class="text-success fw-bold">IN:</span> {{ \Carbon\Carbon::parse($booking->start_time)->format('d/m H:i') }}</div>
                            <div class="small"><span class="text-danger fw-bold">OUT:</span> {{ \Carbon\Carbon::parse($booking->end_time)->format('d/m H:i') }}</div>
                        </td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2"><i class="fa-solid fa-spinner fa-spin me-1"></i> Chờ duyệt</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge rounded-pill bg-success px-3 py-2"><i class="fa-solid fa-check me-1"></i> Đã duyệt</span>
                            @elseif($booking->status == 'cancel_requested')
                                <span class="badge rounded-pill bg-danger px-3 py-2 border border-danger blink-soft"><i class="fa-solid fa-bell me-1"></i> Xin hủy</span>
                                <!-- Hiển thị lý do khách xin hủy -->
                                @if($booking->cancel_reason)
                                    <div class="small text-warning mt-1" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $booking->cancel_reason }}">
                                        Lý do: {{ $booking->cancel_reason }}
                                    </div>
                                @endif
                            @elseif($booking->status == 'cancelled')
                                <span class="badge rounded-pill bg-dark text-muted px-3 py-2 border border-secondary"><i class="fa-solid fa-ban me-1"></i> Đã hủy</span>
                                <!-- Hiển thị lý do Admin ép hủy -->
                                @if($booking->cancel_reason)
                                    <div class="small text-secondary mt-1" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $booking->cancel_reason }}">
                                        Lý do: {{ $booking->cancel_reason }}
                                    </div>
                                @endif
                            @else
                                <span class="badge rounded-pill bg-secondary px-3 py-2">Từ chối</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- ĐƠN MỚI CHỜ DUYỆT --}}
                            @if($booking->status == 'pending')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-action" data-bs-toggle="tooltip" title="Duyệt">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-action" data-bs-toggle="tooltip" title="Từ chối">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>

                            {{-- KHÁCH XIN HỦY --}}
                            @elseif($booking->status == 'cancel_requested')
                                <form action="{{ route('admin.bookings.approve-cancel', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-action text-dark" data-bs-toggle="tooltip" title="Đồng ý cho hủy" onclick="return confirm('Chấp thuận cho khách hủy phòng này?')">
                                        <i class="fa-solid fa-check-double"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.reject-cancel', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-action" data-bs-toggle="tooltip" title="Không cho hủy" onclick="return confirm('Từ chối yêu cầu hủy của khách?')">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>

                            {{-- ĐƠN ĐANG CHẠY - ADMIN ÉP HỦY CÓ LÝ DO (MODAL) --}}
                            @elseif($booking->status == 'approved')
                                <button type="button" class="btn btn-outline-danger btn-sm px-2" data-bs-toggle="modal" data-bs-target="#forceCancelModal{{ $booking->id }}">
                                    <i class="fa-solid fa-trash-can"></i> Ép Hủy
                                </button>

                                <!-- Modal Ép Hủy -->
                                <div class="modal fade" id="forceCancelModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content bg-dark text-white border-secondary text-start">
                                      <form action="{{ route('admin.bookings.force-cancel', $booking->id) }}" method="POST">
                                          @csrf
                                          <div class="modal-header border-secondary">
                                            <h5 class="modal-title text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Cưỡng chế hủy đơn #{{ $booking->id }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                          </div>
                                          <div class="modal-body">
                                            <p class="text-white-50 small">Hành động này sẽ hủy đơn đặt phòng đang có hiệu lực. Vui lòng nhập lý do (tùy chọn) để hệ thống gửi email thông báo cho khách hàng.</p>
                                            <textarea name="cancel_reason" class="form-control bg-secondary text-white border-0" rows="3" placeholder="Ví dụ: Sự cố kỹ thuật, bảo trì đột xuất..."></textarea>
                                          </div>
                                          <div class="modal-footer border-secondary">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-danger">Xác nhận Hủy Đơn</button>
                                          </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>

                            {{-- CÁC TRẠNG THÁI KHÁC --}}
                            @else
                                <span class="text-muted small"><i class="fa-solid fa-lock"></i> Đã đóng</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Chưa có yêu cầu nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection