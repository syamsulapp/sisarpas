<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Interface\Admin\DashboardInterface;
use App\Models\Barang;
use App\Models\Contact;
use App\Models\Landing;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class DashboardRepositories extends FormRequest implements DashboardInterface
{
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
        } else if (request()->is('admin/dashboard/master_data/inventori/barang/create')) {
            return [
                'id_barang' => 'string',
                'nama_barang' => 'required|string',
                'jumlah_barang' => 'required|integer',
                'kondisi_barang' => 'required|string',
                'kategori_barang' => 'in:barang,ruangan',
                'detail_barang' => 'required|string',
                'spesifikasi_barang' => 'string',
                'gambar_barang' => 'required|file|image|mimes:jpg,png,jpeg',
                'status_barang' => 'required|in:ready,not-ready,maintenance',
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

    public function updateLandingRepositories($model, $request): void
    {
        $model->update($request);
    }

    public function deleteLandingRepositories($model): void
    {
        $model->delete();
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

    /**
     * begin::inventori_barang
     */
    public function createBarangRepositories($request): void
    {
        Barang::create($request);
    }
    /**
     * end::inventori_barang
     */
}
