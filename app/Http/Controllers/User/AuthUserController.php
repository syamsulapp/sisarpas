<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Errorlog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\AuthUserRepositories;

class AuthUserController extends Controller
{
    public function login(): View
    {
        return view('sisarpas.auth.user.login');
    }

    public function doLogin(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $authUserRepositories->loginRepositories();
        return redirect()->route('/')->with('success', 'Berhasil Login');
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
