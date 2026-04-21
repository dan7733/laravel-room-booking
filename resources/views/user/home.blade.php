@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold"><i class="fa-solid fa-hotel text-primary me-2"></i>Danh sách phòng trống</h2>
</div>

<div class="row">
    @foreach($rooms as $room)
    <div class="col-md-4 mb-4 fade-up">
        <div class="card room-card shadow-sm h-100">
            <div class="room-icon-wrapper">
                <i class="fa-solid fa-door-open fa-4x text-white"></i>
            </div>
            
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold text-uppercase">{{ $room->name }}</h5>
                <p class="card-text text-primary fw-semibold mb-2">
                    <i class="fa-solid fa-users me-1"></i> Sức chứa: {{ $room->capacity }} người
                </p>
                <p class="card-text text-muted flex-grow-1">{{ Str::limit($room->description, 100) }}</p>
                
                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-primary w-100 mt-3 fw-bold">
                    Xem chi tiết & Đặt phòng <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush