@extends('layouts.app')

@push('styles')
<style>
    :root {
        --gold: #D4AF37;
        --charcoal: #111112;
        --dark-gray: #1a1a1c;
        --crimson: #A6192E;
    }
    .luxury-card {
        background-color: var(--charcoal);
        border: 1px solid rgba(212, 175, 55, 0.15);
        border-top: 4px solid var(--gold);
        border-radius: 12px;
    }
    .luxury-input {
        background-color: var(--dark-gray) !important;
        color: #ffffff !important;
        border: 1px solid rgba(212, 175, 55, 0.3) !important;
    }
    .luxury-input:focus {
        border-color: var(--gold) !important;
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25) !important;
    }
    .luxury-input-group-text {
        background-color: var(--charcoal) !important;
        color: var(--gold) !important;
        border: 1px solid rgba(212, 175, 55, 0.3) !important;
        border-left: none !important;
    }
    .btn-gold { background-color: var(--gold); color: #000; font-weight: bold; border: 1px solid var(--gold); }
    .btn-gold:hover { background-color: #b8962e; color: #000; }
    .btn-outline-gold { color: var(--gold); border: 1px solid var(--gold); background: transparent; }
    .btn-outline-gold:hover { background-color: var(--gold); color: var(--charcoal); }
</style>
@endpush

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-9">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-gold rounded-circle me-3 shadow-sm" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="text-white text-uppercase fw-bold mb-0" style="letter-spacing: 1px;">Chỉnh sửa: <span style="color: var(--gold);">{{ $room->name }}</span></h2>
        </div>

        <div class="card luxury-card shadow-lg p-4">
            <div class="card-body">
                <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold" style="color: var(--gold);"><i class="fa-solid fa-signature me-2"></i> Tên phòng / Không gian</label>
                        <input type="text" name="name" class="form-control form-control-lg luxury-input @error('name') is-invalid @enderror" value="{{ old('name', $room->name) }}">
                        @error('name') <div class="invalid-feedback text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label fw-bold text-white"><i class="fa-solid fa-money-bill-wave me-2" style="color: #4ade80;"></i> Giá phòng (Theo ngày)</label>
                            <div class="input-group input-group-lg">
                                <input type="number" name="price" class="form-control luxury-input @error('price') is-invalid @enderror" value="{{ old('price', $room->price) }}" min="0" step="1000">
                                <span class="input-group-text luxury-input-group-text">VNĐ</span>
                                @error('price') <div class="invalid-feedback text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-white"><i class="fa-solid fa-users me-2" style="color: #38bdf8;"></i> Sức chứa</label>
                            <div class="input-group input-group-lg">
                                <input type="number" name="capacity" class="form-control luxury-input @error('capacity') is-invalid @enderror" value="{{ old('capacity', $room->capacity) }}">
                                <span class="input-group-text luxury-input-group-text">Khách</span>
                                @error('capacity') <div class="invalid-feedback text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-white"><i class="fa-solid fa-align-left me-2 text-white-50"></i> Mô tả chi tiết</label>
                        <textarea name="description" class="form-control luxury-input" rows="4">{{ old('description', $room->description) }}</textarea>
                    </div>

                    <div class="mb-5 p-4 rounded-4" style="background-color: #1a1a1c; border: 1px solid rgba(255,255,255,0.1);">
                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input mt-0 me-3" type="checkbox" role="switch" name="status" id="status" value="1" {{ $room->status == 1 ? 'checked' : '' }} style="transform: scale(1.5); cursor: pointer;">
                            <label class="form-check-label fw-bold text-white fs-5" for="status" style="cursor: pointer;">Phòng đang hoạt động (Bật để khách có thể đặt)</label>
                        </div>
                    </div>

                    <hr class="border-secondary mb-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-gold btn-lg px-5 rounded-pill">
                            <i class="fa-solid fa-arrows-rotate me-2"></i> Cập Nhật Dữ Liệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection