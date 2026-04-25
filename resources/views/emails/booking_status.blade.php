<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="margin: 0; padding: 0; background-color: #0d1117; font-family: 'Segoe UI', Arial, sans-serif; color: #c9d1d9;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0d1117; padding: 40px 10px;">
        <tr>
            <td align="center">
                <table width="100%" style="max-width: 600px; background-color: #161b22; border-radius: 12px; overflow: hidden; border: 1px solid #30363d;">
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #8b0000 0%, #dc3545 100%); padding: 30px;">
                            <h2 style="color: #ffffff; margin: 0; text-transform: uppercase; letter-spacing: 2px;">RoomBooking</h2>
                            <p style="color: #ffcccc; margin: 5px 0 0 0;">KẾT QUẢ XÉT DUYỆT</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="font-size: 16px;">Xin chào <strong>{{ $booking->user->name }}</strong>,</p>
                            <p style="font-size: 16px; margin-bottom: 25px;">Admin đã xem xét và phản hồi yêu cầu đặt phòng của bạn như sau:</p>
                            
                            <div style="text-align: center; padding: 20px; border-radius: 8px; margin-bottom: 30px; 
                                background-color: {{ $booking->status == 'approved' ? '#1a3321' : '#3d161a' }}; 
                                border: 1px solid {{ $booking->status == 'approved' ? '#2ea043' : '#f85149' }};">
                                <h2 style="margin: 0; color: {{ $booking->status == 'approved' ? '#3fb950' : '#f85149' }};">
                                    {{ $booking->status == 'approved' ? 'CHẤP NHẬN' : 'TỪ CHỐI' }}
                                </h2>
                            </div>

                            <table width="100%" style="background-color: #010409; border-radius: 8px; padding: 20px;">
                                <tr>
                                    <td style="color: #8b949e; padding: 10px 0; border-bottom: 1px solid #21262d;">Không gian:</td>
                                    <td style="color: #ffffff; font-weight: bold; text-align: right; padding: 10px 0; border-bottom: 1px solid #21262d;">{{ $booking->room->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #8b949e; padding: 10px 0; border-bottom: 1px solid #21262d;">Ngày nhận:</td>
                                    <td style="color: #ffffff; font-weight: bold; text-align: right; padding: 10px 0; border-bottom: 1px solid #21262d;">{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #8b949e; padding: 10px 0; border-bottom: 1px solid #21262d;">Giờ nhận:</td>
                                    <td style="color: #ffffff; font-weight: bold; text-align: right; padding: 10px 0; border-bottom: 1px solid #21262d;">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #8b949e; padding: 10px 0;">Giờ trả:</td>
                                    <td style="color: #ffffff; font-weight: bold; text-align: right; padding: 10px 0;">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                </tr>
                            </table>

                            <div style="text-align: center; margin-top: 35px;">
                                <a href="{{ route('bookings.my') }}" style="display: inline-block; padding: 12px 30px; background-color: #dc3545; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">XEM LỊCH SỬ ĐẶT PHÒNG</a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #010409; padding: 20px; font-size: 12px; color: #484f58;">
                            &copy; 2026 RoomBooking System - Thành phố Cần Thơ.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>