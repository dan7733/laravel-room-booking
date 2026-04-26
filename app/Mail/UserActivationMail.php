<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url; // Link kích hoạt an toàn (Signed Route)

    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Đặc quyền hội viên - Kích hoạt tài khoản RoomBooking')
                    ->view('emails.user_activation'); // Trỏ tới file giao diện mail
    }
}