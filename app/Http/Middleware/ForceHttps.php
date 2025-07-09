<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu không phải môi trường local và không có HTTPS qua proxy
        if (app()->environment() !== 'local' && $request->header('x-forwarded-proto') !== 'https') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
