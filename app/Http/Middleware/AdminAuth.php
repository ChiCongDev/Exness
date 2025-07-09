<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra session có email và password của admin không
        if ($request->session()->has('email') && $request->session()->has('password')) {
            $admin = User::where('email', $request->session()->get('email'))
                ->where('password', $request->session()->get('password'))
                ->where('is_admin', true)
                ->first();

            if ($admin) {
                return $next($request);
            }
        }

        // Nếu không phải admin, chuyển hướng về trang welcome
        return redirect()->secure('/welcome')->with('error', 'Bạn không có quyền truy cập trang admin.');
    }
}
