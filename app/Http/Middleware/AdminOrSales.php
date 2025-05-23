<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOrSales
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() || Auth::guard('sales')->check()) {
            return $next($request);
        }

        return redirect()->route('login'); // or return abort(403);
    }
}
