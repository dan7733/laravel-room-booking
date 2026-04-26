<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Import thêm 3 thư viện để tạo link và gửi Mail
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    // GHI ĐÈ HÀM NÀY ĐỂ LARAVEL DÙNG APP/MAIL VÀ BỌC BẢO VỆ CHỐNG SẬP WEB
    public function sendEmailVerificationNotification()
    {
        try {
            // 1. Tự tạo Link xác thực mã hóa an toàn (Sống trong 60 phút)
            $url = \Illuminate\Support\Facades\URL::temporarySignedRoute(
                'verification.verify',
                \Illuminate\Support\Carbon::now()->addMinutes(60),
                [
                    'id' => $this->getKey(),
                    'hash' => sha1($this->getEmailForVerification()),
                ]
            );

            // 2. Gửi email thông qua class UserActivationMail
            \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\UserActivationMail($this, $url));
            
        } catch (\Exception $e) {
            // 3. NẾU GỬI MAIL BỊ LỖI (MẠNG CHẬM, SAI MẬT KHẨU GMAIL...)
            // Hệ thống sẽ không văng lỗi 500 nữa, mà sẽ im lặng ghi lỗi vào file log
            \Illuminate\Support\Facades\Log::error('Lỗi gửi mail xác thực: ' . $e->getMessage());
        }
    }
}