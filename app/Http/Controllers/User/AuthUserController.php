<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Errorlog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\AuthUserRepositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthUserController extends Controller
{
    public function login(): View
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard');
        } else {
            return view('sisarpas.auth.user.login');
        }
    }

    public function doLogin(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $credential = $authUserRepositories->loginRepositories();

        if (Auth::guard('user')->attempt($credential)) {
            $user = Auth::getProvider()->retrieveByCredentials($credential);
            Auth::guard('user')->login($user);
            return redirect()->intended('user/dashboard');
        } else {
            Session::flash('error', 'Email Atau Password Salah');
            return redirect()->route('user.login');
        }
    }

    public function doLogout()
    {
    }

    public function register(): View
    {
        return view('sisarpas.auth.user.register');
    }

    public function doRegister(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $authUserRepositories->registerRepositories();
        return redirect()->route('user.login')->with('success', 'Berhasil register');
    }
}
