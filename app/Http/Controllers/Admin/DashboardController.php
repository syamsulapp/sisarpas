<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\DashboardRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends DashboardRepositories
{
    public function index(): View
    {
        return view('sisarpas.admin.dashboard.index');
    }
}
