@extends('layouts.app')

@push('styles')
<style>
    :root {
        --gold: #D4AF37;
        --charcoal: #111112;
        --dark-gray: #1a1a1c;
        --crimson: #A6192E;
        --text-light: #f4f4f5;
    }
    
    .luxury-card {
        background-color: var(--charcoal) !important;
        border: 1px solid rgba(212, 175, 55, 0.15);
        border-top: 4px solid var(--gold);
        border-radius: 12px;
    }

    /* ÉP BẢNG TRONG SUỐT - CHỮ TRẮNG */
    .luxury-table {
        --bs-table-bg: transparent !important;
        --bs-table-color: var(--text-light) !important;
        --bs-table-hover-bg: rgba(212, 175, 55, 0.05) !important;
        --bs-table-hover-color: #ffffff !important;
        margin-bottom: 0;
    }
    
    .luxury-table thead th {
        background-color: var(--dark-gray) !important;
        color: var(--gold) !important;
        border-bottom: 2px solid var(--crimson) !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 15px;
        border-top: none;
    }

    .luxury-table tbody td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        vertical-align: middle;
        padding: 15px;
        color: #ffffff !important;
    }

    /* NÚT BẤM LUXURY */
    .btn-gold { background-color: var(--gold); color: #000; font-weight: bold; border: 1px solid var(--gold); }
    .btn-gold:hover { background-color: #b8962e; color: #000; }
    
    .btn-outline-gold { color: var(--gold); border: 1px solid var(--gold); background: transparent; }
    .btn-outline-gold:hover { background-color: var(--gold); color: #000; }
    
    .btn-outline-crimson { color: #ff4d4d; border: 1px solid #ff4d4d; background: transparent; }
    .btn-outline-crimson:hover { background-color: var(--crimson); color: #fff; border-color: var(--crimson); }

    /* CUSTOM PHÂN TRANG (PAGINATION) NỀN ĐEN */
    .pagination .page-link {
        background-color: var(--dark-gray);
        border-color: rgba(255,255,255,0.1);
        color: var(--gold);
    }
    .pagination .page-item.active .page-link {
        background-color: var(--gold);
        border-color: var(--gold);
        color: #000;
        font-weight: bold;
    }
    .pagination .page-link:hover {
        background-color: var(--charcoal);
        color: #fff;
    }
    .pagination .page-item.disabled .page-link {
        background-color: var(--dark-gray);
        color: #6c757d;
        border-color: rgba(255,255,255,0.05);
    }
</style>
@endpush

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <h2 class="text-white fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">
        <i class="fa-solid fa-hotel me-2" style="color: var(--gold);"></i> Quản Lý Phân Khu Phòng
    </h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-gold rounded-pill px-4 shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Thêm Phòng Mới
    </a>
</div>

<div class="card luxury-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover luxury-table align-middle">
                <thead>
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
                        <td class="text-white-50 ps-4">#{{ $room->id }}</td>
                        <td class="fw-bold text-white">{{ $room->name }}</td>
                        <td class="text-light">{{ $room->capacity }} người</td>
                        <td class="fw-bold" style="color: var(--gold);">{{ number_format($room->price, 0, ',', '.') }} VNĐ</td>
                        <td>
                            @if($room->status == 1)
                                <span class="badge bg-dark text-success border border-success px-3 py-2 rounded-pill"><i class="fa-solid fa-circle-check me-1"></i> Hoạt động</span>
                            @else
                                <span class="badge bg-dark text-danger border border-danger px-3 py-2 rounded-pill"><i class="fa-solid fa-wrench me-1"></i> Bảo trì</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <form action="{{ route('admin.rooms.toggle-status', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $room->status == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} btn-sm me-1 shadow-sm" data-bs-toggle="tooltip" title="{{ $room->status == 1 ? 'Khóa bảo trì' : 'Mở hoạt động' }}">
                                    <i class="fa-solid {{ $room->status == 1 ? 'fa-lock-open' : 'fa-lock' }}"></i>
                                </button>
                            </form>

                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-outline-gold btn-sm me-1 shadow-sm" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cảnh báo: Bạn có chắc chắn muốn xóa phòng này không? Mọi lịch sử đặt phòng liên quan có thể bị ảnh hưởng!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-crimson btn-sm shadow-sm" data-bs-toggle="tooltip" title="Xóa phòng">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-white-50">
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

<!-- THANH PHÂN TRANG PAGINATION -->
@if($rooms->hasPages())
    <div class="d-flex justify-content-end mt-4">
        {{ $rooms->links('pagination::bootstrap-5') }}
    </div>
@endif

@endsection

@push('scripts')
    <script>
        // Kích hoạt tooltip của Bootstrap
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endpush