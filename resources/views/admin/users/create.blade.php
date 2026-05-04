@extends('layouts.app')

@push('styles')
<style>
    :root { --gold: #D4AF37; --charcoal: #111112; --dark-gray: #1a1a1c; --crimson: #A6192E; }
    .luxury-card { background-color: var(--charcoal); border: 1px solid rgba(212, 175, 55, 0.15); border-top: 4px solid var(--gold); border-radius: 12px; }
    .luxury-input, .luxury-select { background-color: var(--dark-gray) !important; color: #ffffff !important; border: 1px solid rgba(212, 175, 55, 0.3) !important; }
    .luxury-input:focus, .luxury-select:focus { border-color: var(--gold) !important; box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25) !important; }
    .luxury-input::placeholder { color: #8b949e !important; }
    .btn-gold { background-color: var(--gold); color: #000; font-weight: bold; border: 1px solid var(--gold); }
    .btn-gold:hover { background-color: #b8962e; color: #000; }
    .btn-outline-gold { color: var(--gold); border: 1px solid var(--gold); background: transparent; }
    .btn-outline-gold:hover { background-color: var(--gold); color: #000; }
</style>
@endpush

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-gold rounded-circle me-3 shadow-sm" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="text-white text-uppercase fw-bold mb-0" style="letter-spacing: 1px;">Thêm Người Dùng</h2>
        </div>

        <div class="card luxury-card shadow-lg p-4">
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">Họ và Tên</label>
                        <input type="text" name="name" class="form-control form-control-lg luxury-input @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">Email đăng nhập</label>
                        <input type="email" name="email" class="form-control form-control-lg luxury-input @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-white">Mật khẩu</label>
                        <input type="password" name="password" class="form-control form-control-lg luxury-input @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold" style="color: var(--gold);">Vai trò hệ thống</label>
                            <select name="role" class="form-select luxury-select">
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Khách Hàng</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản Trị Viên (Admin)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-white">Trạng thái (Khóa/Mở)</label>
                            <select name="status" class="form-select luxury-select">
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Hoạt động bình thường</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Đóng băng tài khoản</option>
                            </select>
                        </div>
                    </div>

                    <hr class="border-secondary mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-gold btn-lg px-5 rounded-pill">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Lưu Hệ Thống
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection