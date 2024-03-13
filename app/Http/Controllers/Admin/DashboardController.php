<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Admin\DashboardRepositories;
use Exception;

class DashboardController extends DashboardRepositories
{
    protected $admin, $successLog, $errorlog;
    public function __construct(Admin $admin, Successlog $successLog, Errorlog $errorlog)
    {
        $this->admin = $admin;
        $this->successLog = $successLog;
        $this->errorlog = $errorlog;
    }

    /**
     * begin::logging and redirect response
     */
    private function logSuccess($getLogSuccess)
    {
        return $this->successLog->create($getLogSuccess);
    }

    private function logError($getLogError)
    {
        return $this->errorlog->create($getLogError);
    }

    private function dataLogSuccessByID($data, $message): array
    {
        return array('message' => "Admin atas nama {$this->admin->authAdmin()->name} telah {$message} di ID: {$data->id}", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function dataLogSuccess($message): array
    {
        return array('message' => "Admin atas nama {$this->admin->authAdmin()->name} telah {$message}", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function dataLogError($message): array
    {
        return array('message' => $message, 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function redirectSuccess($route, $message): RedirectResponse
    {
        Session::flash("success", $message);
        return Redirect::route($route);
    }

    private function redirectError($route, $message): RedirectResponse
    {
        Session::flash("error", $message);
        return Redirect::route($route);
    }

    /**
     * end::logging and redirect response
     */


    /**
     * begin::dashboard view
     */
    public function index(): View
    {
        return view('sisarpas.admin.dashboard.index');
    }
    /**
     * end::dashboard view
     */
    /**
     * begin::landing
     */
    public function landing(): View
    {
        try {
            return $this->viewForListLanding($this->getListLanding());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing', 'Mohon maaf ada kesalahan dibagian list landing');
        }
    }

    public function doCreateLanding(Request $request): RedirectResponse
    {
        try {
            $this->createLandingRepositories($this->submitRequest($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan konten landing'));
            return $this->redirectSuccess('admin.dashboard_landing', 'Berhasil Menambahkan Landing');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing', 'Maaf ada kesalahan sistem pada create landing');
        }
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

    private function viewForListLanding($landing)
    {
        return view('sisarpas.admin.dashboard.master-data.landing.index', compact('landing'));
    }

    private function getListLanding()
    {
        return Landing::orderBy('id', 'desc')->get();
    }

    private function landingRequest($request)
    {
        return $request->only('file', 'type', 'status');
    }

    private function fileRequestImg($request)
    {
        $file = $request->file('file');
        $namaFile = date('Y-m-d H:i:s') . "_" . $file->getClientOriginalName();
        $destination_upload = "sisarpas/assets/landingFile";
        $file->move($destination_upload, $namaFile);
        return $namaFile;
    }

    private function submitRequest($request)
    {
        $req = $this->landingRequest($request);
        $req['file'] = $this->fileRequestImg($request);
        return $req;
    }

    /**
     * end::landing
     */

    /**
     * begin::contacts
     */

    public function contacts(): View
    {
        try {
            return $this->viewForListContact($this->getListContact());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_contacts', 'Maaf Ada Kesalahan Dibagian List Contacts');
        }
    }

    private function getListContact()
    {
        return Contact::orderBy('id', 'desc')->get();
    }

    private function viewForListContact($contacs): View
    {
        return view('sisarpas.admin.dashboard.master-data.contact.index', compact('contacs'));
    }

    public function doUpdateContacts(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdUpdateContact($request)) {
                return $this->redirectError('admin.dashboard_contacts', 'Maaf ID Tidak Di temukan');
            }
            $this->logSuccess($this->dataLogSuccessByID(Contact::where('id', $request->id)->first(), 'telah mengubah contact'));
            $this->updateContactsRepositories(Contact::where('id', $request->id)->first(), $request);
            return $this->redirectSuccess('admin.dashboard_contacts', 'Berhasil Mengubah Contacts');
        } catch (Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_contacts', 'Maaf ada kesalahan pada update contacts');
        }
    }

    private function checkIdUpdateContact($request): bool
    {
        if (Contact::where('id', $request->id)->first()) {
            return true;
        }
        return false;
    }


    public function doDeleteContacts($id): RedirectResponse
    {
        try {
            if (!$this->checkIdDeleteContact($id)) {
                return $this->redirectError('admin.dashboard_contacts', 'Maaf ID Tidak Di temukan');
            }
            $this->logSuccess($this->dataLogSuccessByID(Contact::where('id', $id)->first(), 'telah menghapus contact'));
            $this->deleteContactsRepositories(Contact::where('id', $id)->first());
            return $this->redirectSuccess('admin.dashboard_contacts', 'Berhasil Menghapus Contacts');
        } catch (Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_contacts', 'Maaf ada kesalahan pada delete contacts');
        }
    }

    private function checkIdDeleteContact($id): bool
    {
        if (Contact::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    /**
     * end::contacts
     */
}
