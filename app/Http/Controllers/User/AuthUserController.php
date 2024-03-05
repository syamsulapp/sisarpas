<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\AuthUserRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        return redirect()->route('/')->with('success', 'Berhasil register');
    }
}
