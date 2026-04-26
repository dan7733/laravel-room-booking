<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController;

// THÊM 2 THƯ VIỆN NÀY ĐỂ XỬ LÝ MAIL XÁC THỰC
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// 1. CÁC TRANG CÔNG KHAI (Không cần đăng nhập) 
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
});

// ==========================================
// 3. CÁC ROUTE XÁC THỰC EMAIL (Cần đăng nhập)
// ==========================================
Route::middleware('auth')->group(function () {
    // 3.1. Trang thông báo yêu cầu kiểm tra email
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    // 3.2. Đường link người dùng bấm vào từ trong Email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); // Đánh dấu là đã xác nhận
        return redirect('/')->with('success', 'Kích hoạt đặc quyền hội viên thành công! Chào mừng Quý khách.');
    })->middleware(['signed'])->name('verification.verify');

    // 3.3. Nút "Gửi lại email" nếu khách không nhận được
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Đã gửi lại link kích hoạt. Vui lòng kiểm tra hộp thư đến (hoặc Spam).');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // Cho phép đăng xuất mọi lúc
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ==========================================
// 4. CÁC TRANG DÀNH CHO HỘI VIÊN ĐÃ KÍCH HOẠT
// ==========================================
// ĐÃ THÊM MIDDLEWARE 'verified' VÀO ĐÂY
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/room/{room}/book', [BookingController::class, 'book'])->name('rooms.book');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
});

// 5. KHU VỰC QUẢN TRỊ (ADMIN)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', RoomController::class);
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::patch('rooms/{room}/toggle-status', [\App\Http\Controllers\Admin\RoomController::class, 'toggleStatus'])->name('rooms.toggle-status');
});