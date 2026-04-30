<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật trạng thái đặt phòng</title>
</head>
<body style="margin: 0; padding: 0; background-color: #111112; font-family: Arial, Helvetica, sans-serif; color: #f4f4f5;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #111112; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #252528; border: 1px solid #333; border-top: 4px solid #D4AF37; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.5);">
                    
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0;">
                            <h1 style="color: #D4AF37; margin: 0; font-size: 28px; letter-spacing: 2px;">ROOMBOOKING</h1>
                            <p style="color: #a1a1aa; margin: 5px 0 0 0; font-size: 14px; letter-spacing: 2px;">CẬP NHẬT TRẠNG THÁI ĐƠN</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 40px 30px 40px;">
                            <h2 style="color: #ffffff; font-size: 20px; font-weight: normal; margin-bottom: 20px;">Kính chào Quý khách <span style="color: #D4AF37; font-weight: bold;">{{ $booking->user->name }}</span>,</h2>
                            
                            <p style="color: #d1d1d6; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                                Hệ thống xin trân trọng thông báo về sự thay đổi trạng thái đối với yêu cầu đặt phòng <strong>#{{ $booking->id }}</strong> của Quý khách.
                            </p>
                            
                            <!-- LOGIC TRẠNG THÁI -->
                            @php
                                $statusColor = '#8b949e';
                                $statusTitle = 'CẬP NHẬT TRẠNG THÁI';
                                $statusMessage = '';

                                switch($action) {
                                    case 'request_cancel':
                                        $statusColor = '#D4AF37'; 
                                        $statusTitle = 'TIẾP NHẬN YÊU CẦU HỦY';
                                        $statusMessage = 'Hệ thống đã ghi nhận yêu cầu xin hủy phòng. Ban quản trị đang xem xét và sẽ sớm phản hồi.';
                                        break;
                                    case 'approve_cancel':
                                        $statusColor = '#8b949e'; 
                                        $statusTitle = 'ĐÃ XÁC NHẬN HỦY';
                                        $statusMessage = 'Yêu cầu xin hủy phòng đã được chấp thuận. Đơn đặt phòng này chính thức bị hủy.';
                                        break;
                                    case 'reject_cancel':
                                        $statusColor = '#A6192E'; 
                                        $statusTitle = 'TỪ CHỐI HỦY PHÒNG';
                                        $statusMessage = 'Rất tiếc, yêu cầu hủy phòng không được chấp thuận. Đơn của Quý khách vẫn đang có hiệu lực.';
                                        break;
                                    case 'force_cancel':
                                        $statusColor = '#A6192E'; 
                                        $statusTitle = 'HỆ THỐNG HỦY ĐƠN';
                                        $statusMessage = 'Ban quản trị đã buộc phải hủy đơn đặt phòng của Quý khách. Vui lòng liên hệ Hotline để được hỗ trợ.';
                                        break;
                                    case 'approved':
                                        $statusColor = '#2ea043'; 
                                        $statusTitle = 'ĐÃ ĐƯỢC DUYỆT';
                                        $statusMessage = 'Tuyệt vời! Yêu cầu đặt phòng của Quý khách đã được duyệt thành công. Hẹn gặp Quý khách trong thời gian tới.';
                                        break;
                                    case 'rejected':
                                        $statusColor = '#A6192E'; 
                                        $statusTitle = 'BỊ TỪ CHỐI';
                                        $statusMessage = 'Rất tiếc, yêu cầu đặt phòng của Quý khách đã bị từ chối do không đáp ứng đủ điều kiện hoặc trùng lịch.';
                                        break;
                                }
                            @endphp

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #1a1a1c; border-left: 4px solid {{ $statusColor }}; border-radius: 6px; padding: 20px; margin-bottom: 25px;">
                                <tr>
                                    <td style="padding-bottom: 10px;">
                                        <h3 style="color: {{ $statusColor }}; margin: 0; font-size: 16px; text-transform: uppercase;">{{ $statusTitle }}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #d1d1d6; font-size: 14px; line-height: 1.6;">
                                        {{ $statusMessage }}
                                    </td>
                                </tr>

                                @if($booking->cancel_reason && in_array($action, ['request_cancel', 'force_cancel', 'approve_cancel', 'reject_cancel']))
                                <tr>
                                    <td style="padding-top: 15px;">
                                        <div style="background-color: #252528; padding: 12px; border-radius: 4px; border-left: 2px solid {{ $statusColor }};">
                                            <span style="color: #a1a1aa; font-size: 13px;">Ghi chú / Lý do:</span><br>
                                            <span style="color: #ffffff; font-size: 14px; font-style: italic;">"{{ $booking->cancel_reason }}"</span>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #333; width: 40%; color: #a1a1aa; font-size: 14px;">Không gian:</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #333; color: #ffffff; font-weight: bold; text-align: right; font-size: 14px;">{{ $booking->room->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; color: #a1a1aa; font-size: 14px;">Thời gian sử dụng:</td>
                                    <td style="padding: 10px 0; color: #ffffff; font-weight: bold; text-align: right; font-size: 14px;">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i d/m') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i d/m') }}
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <a href="{{ route('bookings.show_detail', $booking->id) }}" style="background-color: transparent; color: #D4AF37; border: 1px solid #D4AF37; text-decoration: none; padding: 12px 30px; font-size: 14px; font-weight: bold; border-radius: 30px; display: inline-block; text-transform: uppercase;">
                                            Xem Chi Tiết Đơn
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 25px; background-color: #1a1a1c; border-top: 1px solid #333;">
                            <p style="color: #6c6c70; font-size: 12px; margin: 0; line-height: 1.5;">
                                &copy; {{ date('Y') }} RoomBooking Signature. Mọi quyền được bảo lưu.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>