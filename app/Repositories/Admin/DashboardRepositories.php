<?php

namespace App\Repositories\Admin;

use App\Models\Barang;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Barang as Ruangan;
use App\Interface\Admin\DashboardInterface;
use Illuminate\Foundation\Http\FormRequest;

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
                'id' => 'string',
                'nama_barang' => 'required|string',
                'jumlah_barang' => 'required|integer',
                'kondisi_barang' => 'required|string',
                'kategori_barang' => 'in:barang,ruangan',
                'detail_barang' => 'required|string',
                'spesifikasi_barang' => 'string',
                'gambar_barang' => 'required|file|image|mimes:jpg,png,jpeg',
                'status_barang' => 'required|in:ready,not-ready,maintenance',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/barang/update')) {
            return [
                'id' => 'string',
                'nama_barang' => 'string',
                'jumlah_barang' => 'integer',
                'kondisi_barang' => 'string',
                'kategori_barang' => 'in:barang,ruangan',
                'detail_barang' => 'string',
                'spesifikasi_barang' => 'string',
                'gambar_barang' => 'file|image|mimes:jpg,png,jpeg',
                'status_barang' => 'in:ready,not-ready,maintenance',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/ruangan/create')) {
            return [
                'id' => 'string',
                'nama_barang' => 'required|string',
                'jumlah_barang' => 'required|integer',
                'kondisi_barang' => 'required|string',
                'kategori_barang' => 'in:barang,ruangan',
                'detail_barang' => 'required|string',
                'spesifikasi_barang' => 'string',
                'gambar_barang' => 'required|file|image|mimes:jpg,png,jpeg',
                'status_barang' => 'required|in:ready,not-ready,maintenance',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/ruangan/update')) {
            return [
                'id' => 'string',
                'nama_barang' => 'string',
                'jumlah_barang' => 'integer',
                'kondisi_barang' => 'string',
                'kategori_barang' => 'in:barang,ruangan',
                'detail_barang' => 'string',
                'spesifikasi_barang' => 'string',
                'gambar_barang' => 'file|image|mimes:jpg,png,jpeg',
                'status_barang' => 'in:ready,not-ready,maintenance',
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

    public function checkIdByUpdateLandingRepositories($request): bool
    {
        if (Landing::where('id', $request->id)->first()) {
            return true;
        }
        return false;
    }

    public function checkIdByDeleteLandingRepositories($id): bool
    {
        if (Landing::where('id', $id->id)->first()) {
            return true;
        }
        return false;
    }

    public function getListLandingRepositories()
    {
        return Landing::orderBy('id', 'desc')->get();
    }

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

    public function checkIdUpdateContactRepositories($request): bool
    {
        if (Contact::where('id', $request->id)->first()) {
            return true;
        }
        return false;
    }

    public function updateContactsRepositories($model, $request): void
    {
        $model->update(['email' => $request->email, 'message' => $request->message]);
    }

    public function checkIdDeleteContactRepositories($id): bool
    {
        if (Contact::where('id', $id)->first()) {
            return true;
        }
        return false;
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

    public function listBarangRepositories()
    {
        return Barang::where('kategori_barang', 'barang')->orderByDesc('id')->get();
    }

    public function createBarangRepositories($request): void
    {
        Barang::create($request);
    }

    public function checkIdUpdateBarangRepositories($id): bool
    {
        if (Barang::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    public function updateBarangRepositories($request): void
    {
        Barang::where('id', $request['id'])->update($request);
    }

    public function checkIdDeleteBarangRepositories($id): bool
    {
        if (Barang::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    public function deleteBarangRepositories($id): void
    {
        Barang::where('id', $id)->delete();
    }
    /**
     * end::inventori_barang
     */


    /**
     * begin::inventori_ruangan
     */

    public function listRuanganRepositories()
    {
        return Ruangan::where('kategori_barang', 'ruangan')->orderByDesc('id')->get();
    }

    public function createRuanganRepositories($request): void
    {
        Ruangan::create($request);
    }

    public function checkIdUpdateRuanganRepositories($id): bool
    {
        if (Barang::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    public function updateRuanganRepositories($request): void
    {
        Ruangan::where('id', $request['id'])->update($request);
    }

    public function checkIdDeleteRuanganRepositories($id): bool
    {
        if (Barang::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    public function deleteRuanganRepositories($id): void
    {
        Ruangan::where('id', $id)->delete();
    }
    /**
     * end::inventori_barang
     */
}
