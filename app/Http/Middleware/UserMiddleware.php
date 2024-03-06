<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('user')->check()) {
            if (Auth::guard('user')->user()->roles_id != 2) {
                return redirect()->route('admin.dashboard')->with('error', 'Access Denied For User');
            } else {
                return $next($request);
            }
        } else {
            return redirect()->route('user.login')->with('error', 'Untuk Mengakses Fitur User Anda Harus Login');
        }
    }
}
