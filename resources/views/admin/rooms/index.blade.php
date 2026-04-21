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

<div class="card admin-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th><i class="fa-solid fa-signature me-1"></i> Tên phòng</th>
                        <th><i class="fa-solid fa-users me-1"></i> Sức chứa</th>
                        <th><i class="fa-solid fa-toggle-on me-1"></i> Trạng thái</th>
                        <th class="text-center"><i class="fa-solid fa-gears me-1"></i> Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    <tr>
                        <td class="text-muted">#{{ $room->id }}</td>
                        <td class="fw-bold text-primary">{{ $room->name }}</td>
                        <td>{{ $room->capacity }} người</td>
                        <td>
                            @if($room->status)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Hoạt động</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1"><i class="fa-solid fa-wrench me-1"></i> Bảo trì</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-warning text-dark btn-action" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cảnh báo: Bạn có chắc chắn muốn xóa phòng này không? Hành động này không thể hoàn tác!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action" data-bs-toggle="tooltip" title="Xóa phòng">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu phòng.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-end mt-3">
    {{ $rooms->links() }}
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
@endpush