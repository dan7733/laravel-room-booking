<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusNotification;

class BookingController extends Controller
{
    // CẬP NHẬT: Thêm chức năng lọc theo trạng thái
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room'])->latest();

        // Nếu admin chọn bộ lọc
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']); 
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        $this->sendMailSafe($booking, 'approved', 'Đã duyệt yêu cầu đặt phòng!');
        return back()->with('success', 'Đã duyệt đơn đặt phòng thành công.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);
        $this->sendMailSafe($booking, 'rejected', 'Từ chối đơn đặt phòng.');
        return back()->with('success', 'Đã từ chối đơn đặt phòng.');
    }

    // XỬ LÝ HỦY PHÒNG =====================================
    public function approveCancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        $this->sendMailSafe($booking, 'approve_cancel', 'Đồng ý hủy phòng.');
        return back()->with('success', 'Đã chấp thuận yêu cầu hủy phòng của khách.');
    }

    public function rejectCancel(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        $this->sendMailSafe($booking, 'reject_cancel', 'Từ chối yêu cầu hủy phòng.');
        return back()->with('success', 'Đã từ chối yêu cầu hủy. Đơn vẫn giữ nguyên hiệu lực.');
    }

    public function forceCancel(Request $request, Booking $booking)
    {
        $request->validate([
            'cancel_reason' => 'nullable|string|max:500'
        ]);

        $booking->update([
            'status' => 'cancelled',
            'cancel_reason' => $request->cancel_reason 
        ]);
        
        $this->sendMailSafe($booking, 'force_cancel', 'Hệ thống cưỡng chế hủy đơn.');
        return back()->with('success', 'Đã cưỡng chế hủy đơn đặt phòng này.');
    }

    private function sendMailSafe(Booking $booking, $action, $adminMessage)
    {
        try {
            Mail::to($booking->user->email)->send(new BookingStatusNotification($booking, $action));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Lỗi gửi mail admin ($adminMessage): " . $e->getMessage());
        }
    }
}