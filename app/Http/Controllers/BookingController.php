<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingNotification;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;

class BookingController extends Controller
{
    // Bước 1: Trang chủ - Danh sách phòng đang hoạt động & Lọc lịch trống
    public function index(Request $request)
    {
        $query = Room::where('status', 1);

        // Nếu người dùng nhập form lọc -> Dùng thời gian người dùng chọn
        if ($request->filled(['start_time', 'end_time'])) {
            $start = Carbon::parse($request->start_time);
            $end = Carbon::parse($request->end_time);
        } else {
            // Nếu MỚI VÀO WEB (chưa lọc) -> Kiểm tra phòng trống từ NGAY BÂY GIỜ đến hết ngày hôm nay
            $start = Carbon::now();
            $end = Carbon::now()->endOfDay();
        }

        // THUẬT TOÁN LOẠI BỎ PHÒNG TRÙNG LỊCH:
        // Lọc ra các phòng KHÔNG CÓ (whereDoesntHave) đơn đặt phòng nào thỏa mãn điều kiện trùng
        $query->whereDoesntHave('bookings', function($q) use ($start, $end) {
            $q->whereIn('status', ['approved', 'pending'])
              ->where(function($timeQuery) use ($start, $end) {
                  // Điều kiện trùng lịch kinh điển: (Start_DB < End_Search) AND (End_DB > Start_Search)
                  // Lưu ý dùng dấu < và > (thay vì <=) để cho phép khách mới check-in ngay khoảnh khắc khách cũ check-out
                  $timeQuery->where('start_time', '<', $end)
                            ->where('end_time', '>', $start);
              });
        });

        // Lấy danh sách cuối cùng
        $rooms = $query->get();
        return view('user.home', compact('rooms'));
    }

    // Bước 2: Chi tiết phòng
    public function show(Room $room)
    {
        return view('user.room_detail', compact('room'));
    }

    // Bước 3: Logic đặt phòng & Tính tiền & Gửi Email
    public function book(StoreBookingRequest $request, Room $room, BookingService $bookingService)
    {
        // 1. Kiểm tra trùng lịch
        $isOverlap = $bookingService->checkOverlap($room->id, $request->start_time, $request->end_time);

        if ($isOverlap) {
            return back()->with('error', 'Rất tiếc, phòng đã có người đặt trong khoảng thời gian này!');
        }

        // 2. Tính số ngày và Tổng tiền
        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);
        
        // Đếm số ngày giữa ngày trả và ngày nhận
        $days = $start->diffInDays($end);
        
        if ($days == 0) {
            $days = 1; 
        }

        $totalPrice = $days * $room->price;

        // 3. Lưu vào Database
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $totalPrice, 
            'status' => 'pending'
        ]);

        // 4. Gửi Email thông báo
        try {
            $user = Auth::user();
            Mail::to($user->email)->send(new BookingNotification($booking));
            $message = 'Gửi yêu cầu đặt phòng thành công! Vui lòng kiểm tra email thông báo.';
        } catch (\Exception $e) {
            $message = 'Gửi yêu cầu đặt phòng thành công! (Hệ thống gặp sự cố gửi email thông báo).';
        }

        return redirect()->route('bookings.my')->with('success', $message);
    }

    // Bước 4: Lịch sử đặt phòng cá nhân
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->get();
        return view('user.my_bookings', compact('bookings'));
    }
}