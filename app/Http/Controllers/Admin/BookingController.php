<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusNotification;

class BookingController extends Controller
{
    // BƯỚC 3: Danh sách yêu cầu đặt phòng
    public function index()
    {
        // Eager loading user và room để tránh lỗi N+1 Query
        // Mẹo: Dùng latest() thay cho orderBy('created_at', 'desc') cho code ngắn gọn hơn
        $bookings = Booking::with(['user', 'room'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // BƯỚC 4: Xử lý Duyệt (Approve)
    public function approve(Booking $booking)
    {
        // Cập nhật trạng thái trong Database
        $booking->update(['status' => 'approved']);

        // Gửi mail thông báo kết quả Duyệt
        try {
            Mail::to($booking->user->email)->send(new BookingStatusNotification($booking));
            $message = 'Đã duyệt yêu cầu đặt phòng và gửi email thông báo cho khách!';
        } catch (\Exception $e) {
            // Nếu lỗi gửi mail, vẫn báo thành công thao tác duyệt nhưng kèm cảnh báo
            $message = 'Đã duyệt đơn! (Hệ thống email đang gặp sự cố, chưa thể gửi thông báo).';
        }

        return back()->with('success', $message);
    }

    // BƯỚC 4: Xử lý Từ chối (Reject)
    public function reject(Booking $booking)
    {
        // Cập nhật trạng thái trong Database
        $booking->update(['status' => 'rejected']);

        // Gửi mail thông báo kết quả Từ chối
        try {
            Mail::to($booking->user->email)->send(new BookingStatusNotification($booking));
            $message = 'Đã từ chối yêu cầu đặt phòng và gửi email thông báo cho khách!';
        } catch (\Exception $e) {
            $message = 'Đã từ chối đơn! (Hệ thống email đang gặp sự cố, chưa thể gửi thông báo).';
        }

        // Lưu ý: Thao tác từ chối thành công nên mình vẫn dùng 'success' để hiện thông báo xanh lá cho Admin
        return back()->with('success', $message);
    }
}