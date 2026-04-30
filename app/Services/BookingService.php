<?php

namespace App\Services;

use App\Models\Booking;

class BookingService {
    public function checkOverlap($roomId, $start, $end) {
        return Booking::where('room_id', $roomId)
            // CHỈ lọc những đơn đang có hiệu lực hoặc đang chờ xử lý
            ->whereIn('status', ['pending', 'approved', 'cancel_requested'])
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                      ->where('end_time', '>', $start);
            })->exists();
    }
}