<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    public function login(): View
    {
        return view();
    }

    public function doLogin()
    {
    }
}
