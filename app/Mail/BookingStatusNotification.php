<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $action; 

    public function __construct($booking, $action = null)
    {
        $this->booking = $booking;
        $this->action = $action;
    }

    public function build()
    {
        $subject = 'Cập nhật trạng thái đặt phòng - RoomBooking';
        
        if ($this->action == 'request_cancel') {
            $subject = 'Đã tiếp nhận yêu cầu hủy phòng - RoomBooking';
        } elseif ($this->action == 'reject_cancel') {
            $subject = 'Từ chối yêu cầu hủy phòng - RoomBooking';
        } elseif ($this->action == 'approve_cancel' || $this->action == 'force_cancel') {
            $subject = 'Phòng của bạn đã bị hủy - RoomBooking';
        } elseif ($this->action == 'approved') {
            $subject = 'Đã duyệt yêu cầu đặt phòng - RoomBooking';
        } elseif ($this->action == 'rejected') {
            $subject = 'Từ chối yêu cầu đặt phòng - RoomBooking';
        }

        return $this->subject($subject)->view('emails.booking_status');
    }
}