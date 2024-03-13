<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Interface\Admin\DashboardInterface;
use App\Models\Contact;
use App\Models\Landing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class DashboardRepositories extends FormRequest implements DashboardInterface
{

    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
    public function rules(): array
    {
        if (request()->is('admin/dashboard/master_data/landing/create')) {
            return [
                'file' => 'required|file|image|mimes:jpg,png,jpeg',
                'type' => 'required|string|in:image,video',
                'status' => 'required|string|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/landing/update')) {
            return [
                'file' => 'file|image|mimes:jpg,png,jpeg',
                'type' => 'string|in:image,video',
                'status' => 'string|required|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/contacts/update')) {
            return [
                'email' => 'required|email',
                'message' => 'required|string',
            ];
        } else {
            return [];
        }
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib di isi',
            'file' => ':attribute harus file',
            'mimes' => ':attribute yang diupload harus jenis jpg,png,jpeg',
            'in' => ':attribute hanya 2 jenis yaitu image dan video',
            'image' => ':attribute harus gambar',
        ];
    }

    /**
     * begin::landing
     */
    public function createLandingRepositories($request): void
    {
        Landing::create($request);
    }

    public function updateLandingRepositories($request): void
    {
        try {
            $landing = Landing::where('id', $request->id)->firstOrFail();
            $reqLandingCreate = $request->only('file', 'type', 'status');
            if (isset($reqLandingCreate['file'])) {
                $file = $request->file('file');
                $namaFile = date('Y-m-d H:i:s') . "_" . $file->getClientOriginalName();
                $destination_upload = "sisarpas/assets/landingFile";
                $file->move($destination_upload, $namaFile);
                $reqLandingCreate['file'] = $namaFile;
            }
            $mapSuccessLog = array('message' => "Admin atas nama {$this->admin->authAdmin()->name} telah update konten landing di ID: {$landing->id}", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
            $landing->update($reqLandingCreate);
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
        }
    }

    public function deleteLandingRepositories($id): void
    {
        try {
            $landing = Landing::where('id', $id->id)->firstOrFail();
            $mapSuccessLog = array('message' => "Admin atas nama {$this->admin->authAdmin()->name} telah menghapus konten landing di ID: {$landing->id}", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
            $landing->delete();
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
        }
    }
    /**
     * end::landing
     */

    /**
     * begin::contacts
     */

    public function updateContactsRepositories($model, $request): void
    {
        $model->update(['email' => $request->email, 'message' => $request->message]);
    }

    public function deleteContactsRepositories($model): void
    {
        $model->delete();
    }
    /**
     * end::contacts
     */
}
