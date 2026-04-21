<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController as BookingController;
Route::get('/', function () {
    return view('layouts.app'); // Tạm thời trả về layout rỗng
});

// Routes dành cho khách (chưa đăng nhập)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Route cần đăng nhập
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Tự động tạo 7 route CRUD cho phòng
    Route::resource('rooms', RoomController::class); 
    
    // Quản lý đơn đặt phòng
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
});

// Route cho User
Route::middleware('auth')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('home');
    Route::get('/room/{room}', [BookingController::class, 'show'])->name('rooms.show');
    Route::post('/room/{room}/book', [BookingController::class, 'book'])->name('rooms.book');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::post('/logout', [AuthController::class, 'logout']);
});