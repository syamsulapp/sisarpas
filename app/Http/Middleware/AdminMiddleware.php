<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            if (Auth::guard('admin')->user()->roles_id != 1) {
                return redirect()->route('user.dashboard')->with('error', 'Access Denied For Admin');
            } else {
                return $next($request);
            }
        } else {
            return redirect()->route('admin.login')->with('error', 'Untuk Mengakses Fitur Admin Anda Harus Login');
        }
    }
}
