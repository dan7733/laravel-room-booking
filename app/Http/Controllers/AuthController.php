<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'user'
        ]);

        // 1. Đăng nhập trước để giữ phiên làm việc
        \Illuminate\Support\Facades\Auth::login($user);

        // 2. BỌC THÉP SỰ KIỆN GỬI MAIL (Dùng \Throwable để bắt mọi loại lỗi sập web)
        try {
            event(new \Illuminate\Auth\Events\Registered($user));
        } catch (\Throwable $e) {
            // Im lặng ghi lỗi vào sổ nhật ký, không làm phiền khách hàng
            \Illuminate\Support\Facades\Log::error('Lỗi sập Mail đăng ký: ' . $e->getMessage());
        }

        // 3. Chuyển hướng sang trang thông báo
        return redirect()->route('verification.notice');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/rooms')->with('success', 'Chào mừng Quản trị viên!');
            }
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Đã đăng xuất thành công.');
    }

    // Quên và đặt lại mật khẩu
    // 1. Hiển thị form nhập Email
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // 2. Gửi link vào Email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            // Gửi yêu cầu reset
            $status = \Illuminate\Support\Facades\Password::sendResetLink(
                $request->only('email')
            );

            // Xử lý TỪNG TRẠNG THÁI để không bị báo nhầm lỗi
            switch ($status) {
                case \Illuminate\Support\Facades\Password::RESET_LINK_SENT:
                    return back()->with('success', 'Liên kết khôi phục đã được gửi vào email của quý khách.');

                case \Illuminate\Support\Facades\Password::RESET_THROTTLED:
                    // Lỗi này xảy ra khi bạn bấm nút lần 2 quá nhanh (trong vòng 60s)
                    return back()->withErrors(['email' => 'Quý khách thao tác quá nhanh. Vui lòng đợi 1 phút rồi thử lại.']);

                case \Illuminate\Support\Facades\Password::INVALID_USER:
                    return back()->withErrors(['email' => 'Địa chỉ email này chưa được đăng ký trong hệ thống.']);

                default:
                    return back()->withErrors(['email' => 'Có lỗi xảy ra, vui lòng thử lại sau.']);
            }

        } catch (\Throwable $e) {
            // Nếu vẫn bị lỗi 500 (do mail server hoặc APP_KEY), nó sẽ rơi vào đây
            \Illuminate\Support\Facades\Log::error('Lỗi sập trang Quên mật khẩu: ' . $e->getMessage());
            return back()->with('success', 'Yêu cầu đã được ghi nhận. Vui lòng kiểm tra hộp thư trong ít phút.');
        }
    }

    // 3. Hiển thị form Đặt mật khẩu mới
    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // 4. Xử lý đổi mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $status = \Illuminate\Support\Facades\Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => \Illuminate\Support\Facades\Hash::make($password)
                    ])->setRememberToken(\Illuminate\Support\Str::random(60));

                    $user->save();
                    event(new \Illuminate\Auth\Events\PasswordReset($user));
                }
            );

            if ($status === \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
                return redirect('/login')->with('success', 'Mật khẩu đã được khôi phục thành công. Vui lòng đăng nhập lại.');
            }

            return back()->withErrors(['email' => 'Mã khôi phục không hợp lệ hoặc đã hết hạn.']);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Lỗi sập trang Đổi mật khẩu: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Có lỗi hệ thống xảy ra, vui lòng thử lại sau.']);
        }
    }
}
