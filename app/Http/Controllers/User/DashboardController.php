<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\DashboardRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends DashboardRepositories
{
    public function index(): View
    {
        return view('sisarpas.user.dashboard.index');
    }
}
