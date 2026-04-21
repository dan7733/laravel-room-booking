<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Đặt lịch phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-building"></i> RoomBooking
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/rooms*') ? 'active' : '' }}" href="{{ route('admin.rooms.index') }}">Quản lý Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">Duyệt Lịch Đặt</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Danh sách Phòng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('my-bookings') ? 'active' : '' }}" href="{{ route('bookings.my') }}">Lịch sử Đặt phòng</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link text-white fw-bold">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }} 
                                @if(Auth::user()->role === 'admin') 
                                    <span class="badge bg-danger ms-1">Admin</span> 
                                @endif
                            </span>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-warning">
                                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Đăng ký</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('partials.flash')

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>