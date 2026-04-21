<?php

namespace App\Services;

use App\Models\Booking;

class BookingService {
    public function checkOverlap($roomId, $start, $end) {
        return Booking::where('room_id', $roomId)
            ->where('status', '!=', 'rejected')
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                      ->where('end_time', '>', $start);
            })->exists();
    }
}