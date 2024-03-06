<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    public function login()
    {
        return view('sisarpas.auth.admin.login');
    }

    public function doLogin()
    {
    }

    public function doLogout()
    {
    }
}
