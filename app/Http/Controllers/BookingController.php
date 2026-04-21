<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;

class BookingController extends Controller
{
    // Bước 1: Trang chủ - Danh sách phòng đang hoạt động
    public function index() {
        $rooms = Room::where('status', 1)->get();
        return view('user.home', compact('rooms'));
    }

    // Bước 2: Chi tiết phòng
    public function show(Room $room) {
        return view('user.room_detail', compact('room'));
    }

    // Bước 3: Logic đặt phòng & Chống trùng lịch (Core Logic)
    public function book(StoreBookingRequest $request, Room $room, BookingService $bookingService) 
    {
        // Nhờ dùng StoreBookingRequest, việc validate (kiểm tra rỗng, sai định dạng ngày...) 
        // đã được tự động xử lý ngầm trước khi chạy vào trong hàm này.

        // Gọi hàm từ Service để kiểm tra trùng lịch
        $isOverlap = $bookingService->checkOverlap($room->id, $request->start_time, $request->end_time);

        if ($isOverlap) {
            // Nếu trùng, quay lại trang trước và báo lỗi bằng Flash Message
            return back()->with('error', 'Rất tiếc, phòng đã có người đặt trong khoảng thời gian này!');
        }

        // Nếu hợp lệ, lưu vào Database
        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.my')->with('success', 'Gửi yêu cầu đặt phòng thành công! Vui lòng chờ Admin duyệt.');
    }

    // Bước 4: Lịch sử đặt phòng cá nhân
    public function myBookings() {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->get();
        return view('user.my_bookings', compact('bookings'));
    }
}