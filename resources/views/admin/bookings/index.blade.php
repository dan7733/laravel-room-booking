@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="admin-title"><i class="fa-solid fa-calendar-check text-primary me-2"></i>Duyệt Lịch Đặt Phòng</h2>
</div>

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead class="table-light">
                    <tr>
                        <th><i class="fa-solid fa-user me-1"></i> Người đặt</th>
                        <th><i class="fa-solid fa-door-open me-1"></i> Phòng</th>
                        <th><i class="fa-regular fa-clock me-1"></i> Bắt đầu</th>
                        <th><i class="fa-solid fa-hourglass-end me-1"></i> Kết thúc</th>
                        <th><i class="fa-solid fa-circle-half-stroke me-1"></i> Trạng thái</th>
                        <th class="text-center"><i class="fa-solid fa-bolt me-1"></i> Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="fw-bold">{{ $booking->user->name }}</td>
                        <td><span class="badge bg-secondary">{{ $booking->room->name }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y - H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d/m/Y - H:i') }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2"><i class="fa-solid fa-spinner fa-spin me-1"></i> Chờ duyệt</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge rounded-pill bg-success px-3 py-2"><i class="fa-solid fa-check me-1"></i> Đã duyệt</span>
                            @else
                                <span class="badge rounded-pill bg-danger px-3 py-2"><i class="fa-solid fa-xmark me-1"></i> Từ chối</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($booking->status == 'pending')
                                <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-action" data-bs-toggle="tooltip" title="Duyệt yêu cầu này">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-action" data-bs-toggle="tooltip" title="Từ chối yêu cầu">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small"><i class="fa-solid fa-lock"></i> Đã xử lý</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fa-regular fa-folder-open fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Hiện chưa có yêu cầu đặt phòng nào.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
@endpush