<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // 1. Danh sách người dùng
    public function index()
    {
        // Lấy danh sách user, ngoại trừ chính Admin đang đăng nhập để tránh tự khóa mình
        $users = User::where('id', '!=', Auth::id())->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. Form thêm mới
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. Lưu người dùng mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
            'status' => 'required|boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'email_verified_at' => now(), // Auto verify khi Admin tạo
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Đã thêm người dùng mới thành công!');
    }

    // 4. Form chỉnh sửa
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 5. Cập nhật thông tin
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Không bắt buộc nhập pass khi sửa
            'role' => 'required|in:admin,user',
            'status' => 'required|boolean'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Nếu Admin có gõ pass mới thì mới cập nhật pass
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật thông tin người dùng!');
    }

    // 6. XÓA MỀM (Khóa tài khoản)
    public function toggleStatus(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Bạn không thể tự khóa chính mình!');
        }
        
        $user->update(['status' => !$user->status]);
        $message = $user->status ? 'Đã mở khóa tài khoản!' : 'Đã khóa tài khoản thành công!';
        
        return back()->with('success', $message);
    }

    // 7. XÓA CỨNG (Xóa vĩnh viễn)
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Bạn không thể tự xóa chính mình!');
        }

        // Xóa user (Nếu có ràng buộc foreign key với bookings, Laravel sẽ tự xử lý nếu set cascade)
        $user->delete();
        
        return back()->with('success', 'Đã xóa vĩnh viễn tài khoản người dùng!');
    }
}