<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // ĐÃ THÊM: price và image
    protected $fillable = ['name', 'capacity', 'price', 'description', 'image', 'status'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}