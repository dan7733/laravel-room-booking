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
    .luxury-card { background-color: var(--charcoal) !important; border: 1px solid rgba(212, 175, 55, 0.15); border-top: 4px solid var(--gold); border-radius: 12px; }
    .luxury-table { --bs-table-bg: transparent !important; --bs-table-color: var(--text-light) !important; --bs-table-hover-bg: rgba(212, 175, 55, 0.05) !important; --bs-table-hover-color: #ffffff !important; margin-bottom: 0; }
    .luxury-table thead th { background-color: var(--dark-gray) !important; color: var(--gold) !important; border-bottom: 2px solid var(--crimson) !important; text-transform: uppercase; font-size: 0.85rem; padding: 15px; border-top: none; }
    .luxury-table tbody td { border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important; vertical-align: middle; padding: 15px; color: #ffffff !important; }
    .btn-gold { background-color: var(--gold); color: #000; font-weight: bold; }
    .btn-gold:hover { background-color: #b8962e; color: #000; }
    .btn-outline-gold { color: var(--gold); border: 1px solid var(--gold); background: transparent; }
    .btn-outline-gold:hover { background-color: var(--gold); color: #000; }
</style>
@endpush

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <h2 class="text-white fw-bold text-uppercase mb-0" style="letter-spacing: 1px;">
        <i class="fa-solid fa-users-gear me-2" style="color: var(--gold);"></i> Quản Lý Tài Khoản
    </h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-gold rounded-pill px-4 shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Thêm Quản Trị / Khách Hàng
    </a>
</div>

@if(session('success'))
    <div class="alert border-0 text-white shadow-sm mb-4" style="background-color: rgba(46, 160, 67, 0.2); border-left: 4px solid #2ea043;">
        <i class="fa-solid fa-circle-check me-2 text-success"></i> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert border-0 text-white shadow-sm mb-4" style="background-color: rgba(166, 25, 46, 0.2); border-left: 4px solid var(--crimson);">
        <i class="fa-solid fa-triangle-exclamation me-2 text-danger"></i> {{ session('error') }}
    </div>
@endif

<div class="card luxury-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover luxury-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Mã User</th>
                        <th><i class="fa-solid fa-user me-1"></i> Hồ sơ</th>
                        <th><i class="fa-solid fa-shield-halved me-1"></i> Vai trò</th>
                        <th><i class="fa-solid fa-lock me-1"></i> Trạng thái (Xóa mềm)</th>
                        <th><i class="fa-regular fa-calendar me-1"></i> Ngày tạo</th>
                        <th class="text-center pe-4"><i class="fa-solid fa-gears me-1"></i> Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="text-white-50 ps-4">#{{ $user->id }}</td>
                        <td>
                            <div class="fw-bold text-white fs-6">{{ $user->name }}</div>
                            <div class="small text-white-50">{{ $user->email }}</div>
                        </td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge px-3 py-2 text-dark" style="background-color: var(--gold);">Quản Trị Viên</span>
                            @else
                                <span class="badge bg-secondary px-3 py-2 text-white border border-secondary">Khách Hàng</span>
                            @endif
                        </td>
                        <td>
                            @if($user->status == 1)
                                <span class="badge bg-dark text-success border border-success px-3 py-2 rounded-pill"><i class="fa-solid fa-circle-check me-1"></i> Đang hoạt động</span>
                            @else
                                <span class="badge bg-dark text-danger border border-danger px-3 py-2 rounded-pill"><i class="fa-solid fa-lock me-1"></i> Đã bị khóa</span>
                            @endif
                        </td>
                        <td class="text-light small">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-center pe-4 d-flex justify-content-center gap-1">
                            
                            <!-- XÓA MỀM (KHÓA) -->
                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $user->status == 1 ? 'btn-outline-warning' : 'btn-outline-success' }} btn-sm shadow-sm" title="{{ $user->status == 1 ? 'Khóa tài khoản' : 'Mở khóa' }}" onclick="return confirm('Xác nhận thay đổi trạng thái hoạt động của tài khoản này?')">
                                    <i class="fa-solid {{ $user->status == 1 ? 'fa-user-lock' : 'fa-user-check' }}"></i>
                                </button>
                            </form>

                            <!-- SỬA -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-gold btn-sm shadow-sm" title="Chỉnh sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            <!-- XÓA CỨNG -->
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('CẢNH BÁO ĐỎ: Xóa cứng sẽ xóa vĩnh viễn người dùng và các hóa đơn liên quan. Chắc chắn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm" title="Xóa vĩnh viễn (Xóa cứng)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-white-50">
                            <i class="fa-solid fa-users-slash fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">Chưa có người dùng nào khác trong hệ thống.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($users->hasPages())
    <div class="d-flex justify-content-end mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection