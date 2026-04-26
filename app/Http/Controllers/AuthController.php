<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

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
}
