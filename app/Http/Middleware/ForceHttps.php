<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        // Chỉ redirect nếu không phải HTTPS và không phải local, bỏ qua nếu Render đã proxy
        if (!$request->secure() && app()->environment() !== 'local' && $request->header('x-forwarded-proto') !== 'https') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
