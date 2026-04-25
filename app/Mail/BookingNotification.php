<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking)
    {
        // Nhận dữ liệu đơn đặt phòng để hiển thị trong mail
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Thông báo đặt phòng thành công - RoomBooking')
                    ->view('emails.booking_confirmed'); // Chỉ định file giao diện
    }
}
