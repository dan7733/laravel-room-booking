@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="admin-title mb-0">Thêm phòng mới</h2>
        </div>

        <div class="card admin-card p-4">
            <div class="card-body">
                <form action="{{ route('admin.rooms.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold"><i class="fa-solid fa-signature text-muted me-1"></i> Tên phòng</label>
                            <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="VD: Phòng họp A1">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <label class="form-label fw-semibold"><i class="fa-solid fa-users text-muted me-1"></i> Sức chứa</label>
                            <div class="input-group input-group-lg">
                                <input type="number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" placeholder="0">
                                <span class="input-group-text bg-light">người</span>
                                @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-align-left text-muted me-1"></i> Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Nhập các trang thiết bị có trong phòng (Máy chiếu, Bảng trắng...)">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-5 p-3 bg-light rounded-3 border">
                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input mt-0 me-3" type="checkbox" role="switch" name="status" id="status" checked>
                            <label class="form-check-label fw-bold" for="status" style="cursor: pointer;">Cho phép hoạt động ngay lập tức</label>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg px-5 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Lưu dữ liệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection