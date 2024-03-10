<?php

namespace App\Http\Controllers\Admin;

use App\Models\Landing;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Admin\DashboardRepositories;
use Illuminate\Http\RedirectResponse;

class DashboardController extends DashboardRepositories
{
    public function index(): View
    {
        return view('sisarpas.admin.dashboard.index');
    }

    public function landing(): View
    {
        $landing = Landing::orderBy('id', 'desc')->get();
        return view('sisarpas.admin.dashboard.master-data.landing.index', compact('landing'));
    }

    public function doCreateLanding(Request $request): RedirectResponse
    {
        $this->createLandingRepositories($request);
        return redirect()->route('admin.dashboard_landing')->with('success', 'berhasil create data landing');
    }

    public function doUpdateLanding()
    {
    }

    public function doDeleteLanding(Landing $id)
    {
        $this->deleteLandingRepositories($id);
        return redirect()->route('admin.dashboard_landing')->with('success', 'berhasil delete data landing');
    }
}
