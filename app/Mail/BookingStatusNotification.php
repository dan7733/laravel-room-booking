<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        // Tự động thay đổi tiêu đề dựa trên trạng thái
        $statusText = $this->booking->status == 'approved' ? 'Đã được Duyệt' : 'Bị Từ Chối';
        
        return $this->subject("Kết quả đặt phòng: $statusText - RoomBooking")
                    ->view('emails.booking_status');
    }
}
