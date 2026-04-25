<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đặt phòng</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0d1117; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #c9d1d9;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #0d1117; padding: 40px 10px;">
        <tr>
            <td align="center">
                
                <table width="100%" max-width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; background-color: #161b22; border-radius: 10px; overflow: hidden; border: 1px solid #30363d; box-shadow: 0 10px 30px rgba(0,0,0,0.8);">
                    
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #8b0000 0%, #dc3545 100%); padding: 35px 20px;">
                            <h1 style="color: #ffffff; font-size: 26px; margin: 0; text-transform: uppercase; letter-spacing: 2px;">RoomBooking</h1>
                            <p style="color: #ffcccc; margin: 10px 0 0 0; font-size: 15px;">XÁC NHẬN ĐẶT PHÒNG</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px;">
                                Xin chào <strong style="color: #ffffff;">{{ $booking->user->name }}</strong>,
                            </p>
                            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                                Cảm ơn bạn đã lựa chọn dịch vụ của chúng tôi. Yêu cầu đặt phòng của bạn đã được hệ thống ghi nhận thành công và đang chờ xét duyệt.
                            </p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #010409; border-left: 4px solid #dc3545; border-radius: 6px; padding: 25px;">
                                <tr>
                                    <td colspan="2" style="padding-bottom: 15px; border-bottom: 1px solid #21262d;">
                                        <h3 style="color: #ffffff; margin: 0; font-size: 18px;">Chi Tiết Dịch Vụ</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 0; border-bottom: 1px solid #21262d; width: 40%; color: #8b949e;">Phòng / Không gian:</td>
                                    <td style="padding: 15px 0; border-bottom: 1px solid #21262d; color: #ffffff; font-weight: bold; text-align: right;">{{ $booking->room->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 0; border-bottom: 1px solid #21262d; color: #8b949e;">Ngày sử dụng:</td>
                                    <td style="padding: 15px 0; border-bottom: 1px solid #21262d; color: #ffffff; font-weight: bold; text-align: right;">{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 0; border-bottom: 1px solid #21262d; color: #8b949e;">Giờ nhận phòng:</td>
                                    <td style="padding: 15px 0; border-bottom: 1px solid #21262d; color: #ffffff; font-weight: bold; text-align: right;">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 0; color: #8b949e;">Giờ trả phòng:</td>
                                    <td style="padding: 15px 0; color: #ffffff; font-weight: bold; text-align: right;">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                </tr>
                            </table>

                            <p style="font-size: 15px; line-height: 1.6; margin-top: 30px; text-align: center;">
                                Để theo dõi tiến độ phê duyệt, vui lòng truy cập vào hệ thống.
                            </p>
                            
                            <div style="text-align: center; margin-top: 35px; margin-bottom: 20px;">
                                <a href="{{ route('bookings.my') }}" style="display: inline-block; padding: 14px 35px; background-color: #dc3545; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Theo Dõi Đơn Đặt</a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #010409; padding: 25px; border-top: 1px solid #21262d;">
                            <p style="color: #8b949e; font-size: 13px; margin: 0 0 10px 0;">
                                Đây là email tự động, vui lòng không phản hồi.
                            </p>
                            <p style="color: #484f58; font-size: 12px; margin: 0;">
                                &copy; 2026 RoomBooking System.
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>