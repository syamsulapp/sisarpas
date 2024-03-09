<?php

namespace App\Http\Controllers\Admin;

use App\Models\Landing;
use App\Repositories\Admin\DashboardRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends DashboardRepositories
{
    public function index(): View
    {
        return view('sisarpas.admin.dashboard.index');
    }

    public function landing(): View
    {
        $landing = Landing::orderByDesc('id');

        return view('sisarpas.admin.dashboard.master-data.landing.index', compact('landing'));
    }

    public function doCreateLanding()
    {
    }

    public function doUpdateLanding()
    {
    }

    public function doDeleteLanding()
    {
    }
}
