<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController;

//  1. CÁC TRANG CÔNG KHAI (Không cần đăng nhập) 

Route::get('/', [BookingController::class, 'index'])->name('home');
Route::get('/room/{room}', [BookingController::class, 'show'])->name('rooms.show');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');


//  2. CÁC TRANG DÀNH CHO KHÁCH (Chưa đăng nhập mới được vào)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. CÁC TRANG DÀNH CHO NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP
// Muốn đặt phòng hoặc xem lịch sử thì phải qua chốt kiểm tra này
Route::middleware('auth')->group(function () {
    Route::post('/room/{room}/book', [BookingController::class, 'book'])->name('rooms.book');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 4. KHU VỰC QUẢN TRỊ (ADMIN)
// Phải vừa đăng nhập, vừa có role là 'admin' mới vào được
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Tự động tạo 7 route CRUD cho phòng
    Route::resource('rooms', RoomController::class);
    // Quản lý đơn đặt phòng
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::patch('rooms/{room}/toggle-status', [\App\Http\Controllers\Admin\RoomController::class, 'toggleStatus'])->name('rooms.toggle-status');
});
