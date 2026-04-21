<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // BƯỚC 3: Danh sách yêu cầu đặt phòng
    public function index()
    {
        // Eager loading user và room để tránh lỗi N+1 Query
        $bookings = Booking::with(['user', 'room'])->orderBy('created_at', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // BƯỚC 4: Xử lý Duyệt (Approve)
    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'approved']);
        return back()->with('success', 'Đã duyệt yêu cầu đặt phòng!');
    }

    // BƯỚC 4: Xử lý Từ chối (Reject)
    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);
        return back()->with('success', 'Đã từ chối yêu cầu đặt phòng!');
    }
}