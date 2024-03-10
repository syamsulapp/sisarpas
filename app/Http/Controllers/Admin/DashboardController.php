<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
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
    /**
     * begin::landing
     */
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

    public function doUpdateLanding(Request $request)
    {
        $this->updateLandingRepositories($request);
        return redirect()->route('admin.dashboard_landing')->with('success', 'berhasil update data landing');
    }

    public function doDeleteLanding(Landing $id): RedirectResponse
    {
        $this->deleteLandingRepositories($id);
        return redirect()->route('admin.dashboard_landing')->with('success', 'berhasil delete data landing');
    }

    /**
     * end::landing
     */

    /**
     * begin::contacts
     */

    public function contacts(): View
    {
        $contacs = Contact::orderBy('id', 'desc')->get();
        return view('sisarpas.admin.dashboard.master-data.contact.index', compact('contacs'));
    }

    public function doUpdateContacts(Request $request): RedirectResponse
    {
        $this->updateContactsRepositories($request);
        Session::flash('success', 'Berhasil Update Contacts');
        return Redirect::route('admin.dashboard_contacts');
    }

    public function doDeleteContacts($id): RedirectResponse
    {
        $this->deleteContactsRepositories($id);
        Session::flash('success', 'Berhasil Delete Contacts');
        return Redirect::route('admin.dashboard_contacts');
    }

    /**
     * end::contacts
     */
}
