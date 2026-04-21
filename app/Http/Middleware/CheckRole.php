<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Kiểm tra xem đã đăng nhập chưa và role có khớp với tham số truyền vào không
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Bạn không có quyền truy cập khu vực này.'); // Trả về lỗi 403 Forbidden
        }

        return $next($request);
    }
}