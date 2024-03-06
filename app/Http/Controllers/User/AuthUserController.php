<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Errorlog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Successlog;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\AuthUserRepositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthUserController extends Controller
{
    public function login(): RedirectResponse
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->route('user.login');
        }
    }

    public function doLogin(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $credential = $authUserRepositories->loginRepositories();

        if (Auth::guard('user')->attempt($credential)) {
            $user = Auth::getProvider()->retrieveByCredentials($credential);
            Auth::guard('user')->login($user);
            $mapSuccessLog = array('message' => "user atas nama {$user->name} berhasil login", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create([$mapSuccessLog]);
            return redirect()->intended('user/dashboard');
        } else {
            Session::flash('error', 'Email Atau Password Salah');
            return redirect()->route('user.login');
        }
    }

    public function doLogout()
    {
    }

    public function register(): RedirectResponse
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->route('user.register');
        }
    }

    public function doRegister(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $authUserRepositories->registerRepositories();
        return redirect()->route('user.login')->with('success', 'Berhasil register');
    }
}
