<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Các trường cho phép thêm dữ liệu hàng loạt (Mass Assignment)
    protected $fillable = ['name', 'capacity', 'description', 'status'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
