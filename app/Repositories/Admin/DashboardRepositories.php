<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Interface\Admin\DashboardInterface;
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

    public function createLandingRepositories($request): void
    {
        try {
            $reqLandingCreate = $request->only('file', 'type', 'status');
            $file = $request->file('file');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $destination_upload = "sisarpas/assets/landingFile";
            $file->move($destination_upload, $namaFile);
            $reqLandingCreate['file'] = $namaFile;
            Landing::create($reqLandingCreate);
            //map success logs jika sukses create landing
            $mapSuccessLog = array('message' => "Admin atas nama {$this->admin->authAdmin()->name} telah menambahkan konten landing", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
        }
    }
}
