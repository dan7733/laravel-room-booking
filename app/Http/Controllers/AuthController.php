<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập (ĐÃ CẬP NHẬT LOGIC CHUYỂN HƯỚNG ADMIN)
    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra xem người dùng có tích vào ô "Ghi nhớ đăng nhập" (checkbox name="remember") không
        // Hàm has() sẽ trả về true nếu checkbox được tích, ngược lại là false
        $remember = $request->has('remember');

        // Truyền thêm biến $remember làm tham số thứ 2
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Tránh lỗi bảo mật Session Fixation

            // Nếu tài khoản là Admin
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/rooms')->with('success', 'Chào mừng Quản trị viên!');
            }

            // Nếu tài khoản là User bình thường
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Đã đăng xuất thành công.');
    }
}
