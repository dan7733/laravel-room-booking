@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-secondary rounded-circle me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="admin-title mb-0">Chỉnh sửa: <span class="text-primary">{{ $room->name }}</span></h2>
        </div>

        <div class="card admin-card border-0 shadow-sm rounded-4 p-4">
            <div class="card-body">
                <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold"><i class="fa-solid fa-signature text-primary me-2"></i> Tên phòng</label>
                        <input type="text" name="name" class="form-control form-control-lg bg-light @error('name') is-invalid @enderror" value="{{ old('name', $room->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold"><i class="fa-solid fa-money-bill-wave text-success me-2"></i> Giá phòng (Theo ngày)</label>
                            <div class="input-group input-group-lg">
                                <input type="number" name="price" class="form-control bg-light @error('price') is-invalid @enderror" value="{{ old('price', $room->price) }}" min="0" step="1000">
                                <span class="input-group-text bg-white text-muted">VNĐ</span>
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fa-solid fa-users text-info me-2"></i> Sức chứa</label>
                            <div class="input-group input-group-lg">
                                <input type="number" name="capacity" class="form-control bg-light @error('capacity') is-invalid @enderror" value="{{ old('capacity', $room->capacity) }}">
                                <span class="input-group-text bg-white text-muted">người</span>
                                @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold"><i class="fa-solid fa-align-left text-secondary me-2"></i> Mô tả chi tiết</label>
                        <textarea name="description" class="form-control bg-light" rows="4">{{ old('description', $room->description) }}</textarea>
                    </div>

                    <div class="mb-5 p-4 bg-light rounded-4 border">
                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input mt-0 me-3" type="checkbox" role="switch" name="status" id="status" value="1" {{ $room->status == 1 ? 'checked' : '' }} style="transform: scale(1.5);">
                            <label class="form-check-label fw-bold fs-5" for="status" style="cursor: pointer;">Phòng đang hoạt động (Bật để cho phép khách đặt)</label>
                        </div>
                    </div>

                    <hr class="text-muted mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning btn-lg px-5 fw-bold shadow-sm rounded-pill text-dark">
                            <i class="fa-solid fa-arrows-rotate me-2"></i> Cập nhật dữ liệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection