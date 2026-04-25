@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="admin-title"><i class="fa-solid fa-hotel text-primary me-2"></i>Quản lý Phòng</h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary fw-bold shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Thêm phòng mới
    </a>
</div>

<div class="card admin-card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover admin-table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th><i class="fa-solid fa-signature me-1"></i> Tên phòng</th>
                        <th><i class="fa-solid fa-users me-1"></i> Sức chứa</th>
                        <th><i class="fa-solid fa-money-bill-wave me-1"></i> Giá / Ngày</th>
                        <th><i class="fa-solid fa-toggle-on me-1"></i> Trạng thái</th>
                        <th class="text-center pe-4"><i class="fa-solid fa-gears me-1"></i> Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td class="text-muted ps-4">#{{ $room->id }}</td>
                        <td class="fw-bold text-primary">{{ $room->name }}</td>
                        <td>{{ $room->capacity }} người</td>
                        <td class="fw-bold text-danger">{{ number_format($room->price, 0, ',', '.') }}đ</td>
                        <td>
                            @if($room->status == 1)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill"><i class="fa-solid fa-circle-check me-1"></i> Hoạt động</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill"><i class="fa-solid fa-wrench me-1"></i> Bảo trì</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <form action="{{ route('admin.rooms.toggle-status', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $room->status == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} btn-action me-1 shadow-sm" data-bs-toggle="tooltip" title="{{ $room->status == 1 ? 'Khóa bảo trì' : 'Mở hoạt động' }}">
                                    <i class="fa-solid {{ $room->status == 1 ? 'fa-lock-open' : 'fa-lock' }}"></i>
                                </button>
                            </form>

                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning text-dark btn-action me-1 shadow-sm" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cảnh báo: Bạn có chắc chắn muốn xóa phòng này không? Hành động này không thể hoàn tác!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action shadow-sm" data-bs-toggle="tooltip" title="Xóa phòng">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-box-open fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Chưa có dữ liệu phòng.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mt-4">
    {{ $rooms->links('pagination::bootstrap-5') }}
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        // Kích hoạt tooltip của Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush