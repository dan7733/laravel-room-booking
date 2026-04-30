<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// 1. CÁC TRANG CÔNG KHAI
Route::get('/', [BookingController::class, 'index'])->name('home');
Route::get('/room/{room}', [BookingController::class, 'show'])->name('rooms.show');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// 2. CÁC TRANG DÀNH CHO KHÁCH (Chưa đăng nhập)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // Quên mật khẩu
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// 3. CÁC ROUTE XÁC THỰC EMAIL
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 4. CÁC TRANG DÀNH CHO HỘI VIÊN ĐÃ KÍCH HOẠT
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/room/{room}/book', [BookingController::class, 'book'])->name('rooms.book');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    
    // XEM CHI TIẾT VÀ XIN HỦY PHÒNG (USER)
    Route::get('/my-bookings/{id}', [BookingController::class, 'showBookingDetail'])->name('bookings.show_detail');
    Route::post('/my-bookings/{id}/request-cancel', [BookingController::class, 'requestCancel'])->name('bookings.request-cancel');
});

// 5. KHU VỰC QUẢN TRỊ (ADMIN)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', RoomController::class);
    Route::patch('rooms/{room}/toggle-status', [RoomController::class, 'toggleStatus'])->name('rooms.toggle-status');
    
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    
    // XỬ LÝ YÊU CẦU HỦY (ADMIN)
    Route::post('bookings/{booking}/approve-cancel', [AdminBookingController::class, 'approveCancel'])->name('bookings.approve-cancel');
    Route::post('bookings/{booking}/reject-cancel', [AdminBookingController::class, 'rejectCancel'])->name('bookings.reject-cancel');
    Route::post('bookings/{booking}/force-cancel', [AdminBookingController::class, 'forceCancel'])->name('bookings.force-cancel');
});