<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khôi phục mật khẩu</title>
</head>
<body style="margin: 0; padding: 0; background-color: #111112; font-family: Arial, Helvetica, sans-serif; color: #f4f4f5;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #111112; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #252528; border: 1px solid #333; border-top: 4px solid #D4AF37; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.5);">
                    
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0;">
                            <h1 style="color: #D4AF37; margin: 0; font-size: 28px; letter-spacing: 2px;">ROOMBOOKING</h1>
                            <p style="color: #a1a1aa; margin: 5px 0 0 0; font-size: 14px; letter-spacing: 4px;">THE SIGNATURE COLLECTION</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 40px 30px 40px;">
                            <h2 style="color: #ffffff; font-size: 20px; font-weight: normal; margin-bottom: 20px;">Kính chào Quý khách,</h2>
                            
                            <p style="color: #d1d1d6; font-size: 15px; line-height: 1.6; margin-bottom: 30px;">
                                Chúng tôi nhận được yêu cầu khôi phục mật khẩu cho tài khoản liên kết với địa chỉ email này.<br><br>
                                Vui lòng nhấp vào nút bên dưới để thiết lập lại mật khẩu an toàn cho tài khoản của Quý khách:
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0 30px 0;">
                                        <!-- Thay $url bằng biến route reset password của bạn -->
                                        <a href="{{ $url ?? '#' }}" style="background-color: #A6192E; color: #ffffff; text-decoration: none; padding: 14px 35px; font-size: 14px; font-weight: bold; border-radius: 30px; display: inline-block; text-transform: uppercase; letter-spacing: 1px;">
                                            Đặt Lại Mật Khẩu
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <div style="background-color: #1a1a1c; padding: 15px; border-left: 3px solid #A6192E; border-radius: 4px;">
                                <p style="color: #a1a1aa; font-size: 13px; line-height: 1.5; margin: 0;">
                                    * Liên kết này sẽ hết hạn trong vòng 60 phút. Nếu Quý khách không yêu cầu đổi mật khẩu, vui lòng bỏ qua email này.
                                </p>
                            </div>
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