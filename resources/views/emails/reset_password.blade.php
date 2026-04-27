<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khôi phục mật khẩu</title>
</head>
<body style="margin: 0; padding: 0; background-color: #111112; font-family: Arial, sans-serif; color: #f4f4f5;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #111112; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #252528; border: 1px solid #333; border-top: 4px solid #D4AF37; border-radius: 12px; overflow: hidden;">
                    <tr>
                        <td align="center" style="padding: 40px 0 20px 0;">
                            <h1 style="color: #D4AF37; margin: 0; font-size: 28px; letter-spacing: 2px;">ROOMBOOKING</h1>
                            <p style="color: #a1a1aa; margin: 5px 0 0 0; font-size: 14px; letter-spacing: 4px;">THE SIGNATURE COLLECTION</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 50px 30px 50px;">
                            <h2 style="color: #ffffff; font-size: 22px; font-weight: normal; margin-bottom: 20px;">Kính chào Quý khách <span style="color: #D4AF37; font-weight: bold;">{{ $user->name }}</span>,</h2>
                            <p style="color: #d1d1d6; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                                Hệ thống vừa nhận được yêu cầu khôi phục mật khẩu cho tài khoản liên kết với địa chỉ email này. Vui lòng nhấp vào nút bên dưới để thiết lập mật khẩu mới:
                            </p>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0 40px 0;">
                                        <a href="{{ $url }}" style="background-color: #A6192E; color: #ffffff; text-decoration: none; padding: 16px 40px; font-size: 16px; font-weight: bold; border-radius: 30px; display: inline-block; text-transform: uppercase;">
                                            Khôi Phục Mật Khẩu
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <div style="background-color: #1a1a1c; padding: 20px; border-left: 3px solid #A6192E; border-radius: 4px;">
                                <p style="color: #a1a1aa; font-size: 14px; line-height: 1.5; margin: 0;">
                                    * Liên kết bảo mật này sẽ hết hạn trong vòng 60 phút. Nếu Quý khách không yêu cầu đổi mật khẩu, vui lòng bỏ qua email này.
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>