<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đặt phòng</title>
</head>
<body style="margin: 0; padding: 0; background-color: #111112; font-family: Arial, Helvetica, sans-serif; color: #f4f4f5;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #111112; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #252528; border: 1px solid #333; border-top: 4px solid #D4AF37; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.5);">
                    
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0;">
                            <h1 style="color: #D4AF37; margin: 0; font-size: 28px; letter-spacing: 2px;">ROOMBOOKING</h1>
                            <p style="color: #A6192E; margin: 5px 0 0 0; font-size: 14px; letter-spacing: 2px; font-weight: bold;">XÁC NHẬN TẠO ĐƠN THÀNH CÔNG</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 40px 30px 40px;">
                            <h2 style="color: #ffffff; font-size: 20px; font-weight: normal; margin-bottom: 20px;">Kính chào Quý khách <span style="color: #D4AF37; font-weight: bold;">{{ $booking->user->name }}</span>,</h2>
                            
                            <p style="color: #d1d1d6; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">
                                Cảm ơn Quý khách đã lựa chọn không gian của chúng tôi. Yêu cầu đặt phòng <strong>#{{ $booking->id }}</strong> đã được hệ thống ghi nhận và đang trong quá trình xét duyệt.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #1a1a1c; border-left: 4px solid #A6192E; border-radius: 6px; padding: 20px; margin-bottom: 30px;">
                                <tr>
                                    <td colspan="2" style="padding-bottom: 15px; border-bottom: 1px solid #333;">
                                        <h3 style="color: #ffffff; margin: 0; font-size: 16px; text-transform: uppercase;">Chi Tiết Dịch Vụ</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 0 5px 0; color: #a1a1aa; font-size: 14px;">Không gian:</td>
                                    <td style="padding: 15px 0 5px 0; color: #ffffff; font-weight: bold; text-align: right; font-size: 15px;">{{ $booking->room->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; color: #a1a1aa; font-size: 14px;">Nhận phòng:</td>
                                    <td style="padding: 5px 0; color: #ffffff; font-weight: bold; text-align: right; font-size: 14px;">{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i - d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0 15px 0; border-bottom: 1px solid #333; color: #a1a1aa; font-size: 14px;">Trả phòng:</td>
                                    <td style="padding: 5px 0 15px 0; border-bottom: 1px solid #333; color: #ffffff; font-weight: bold; text-align: right; font-size: 14px;">{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i - d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 15px; color: #D4AF37; font-size: 15px; font-weight: bold;">Tổng chi phí:</td>
                                    <td style="padding-top: 15px; color: #D4AF37; font-weight: bold; text-align: right; font-size: 18px;">{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ</td>
                                </tr>
                            </table>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <a href="{{ route('bookings.my') }}" style="background-color: transparent; color: #D4AF37; border: 1px solid #D4AF37; text-decoration: none; padding: 12px 30px; font-size: 14px; font-weight: bold; border-radius: 30px; display: inline-block; text-transform: uppercase;">
                                            Theo Dõi Tiến Độ
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