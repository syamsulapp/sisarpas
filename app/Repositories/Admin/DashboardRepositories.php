<?php

namespace App\Repositories\Admin;

use App\Models\Barang;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Barangpinjam;
use App\Models\Barang as Ruangan;
use App\Interface\Admin\DashboardInterface;
use App\Models\ScheduleRoom;
use App\Models\User;
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
        } else if (request()->is('admin/dashboard/peminjaman/verifikasi')) {
            return [
                'status_pinjam' => 'required|in:dipinjam,ditolak'
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/user/create')) {
            return [
                'name' => 'required|string',
                'nim' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'image' => 'required|file|image|mimes:jpg,png,jpeg',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/user/update')) {
            return [
                'id' => 'integer',
                'name' => 'string',
                'nim' => 'string',
                'email' => 'email',
                'image' => 'file|image|mimes:jpg,png,jpeg',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/penjadwalan/create')) {
            return [
                'start_at' => 'required|date',
                'end_at' => 'required|date',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/penjadwalan/update')) {
            return [
                'barangs_id' => 'required',
                'start_at' => 'date',
                'end_at' => 'date',
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

    protected function checkIdByUpdateLandingRepositories($request): bool
    {
        return Landing::where('id', $request->id)->first() ? true : false;
    }

    protected function checkIdByDeleteLandingRepositories($id): bool
    {
        return Landing::where('id', $id->id)->first() ? true : false;
    }

    protected function getListLandingRepositories()
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

    protected function checkIdUpdateContactRepositories($request): bool
    {
        return Contact::where('id', $request->id)->first() ? true : false;
    }

    public function updateContactsRepositories($model, $request): void
    {
        $model->update(['email' => $request->email, 'message' => $request->message]);
    }

    protected function checkIdDeleteContactRepositories($id): bool
    {
        return Contact::where('id', $id)->first() ? true : false;
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

    protected function listBarangRepositories()
    {
        return Barang::where('kategori_barang', 'barang')->orderByDesc('id')->get();
    }

    public function createBarangRepositories($request): void
    {
        Barang::create($request);
    }

    protected function checkIdUpdateBarangRepositories($id): bool
    {
        return Barang::where('id', $id)->first() ? true : false;
    }

    public function updateBarangRepositories($request): void
    {
        Barang::where('id', $request['id'])->update($request);
    }

    public function checkIdDeleteBarangRepositories($id): bool
    {
        return Barang::where('id', $id)->first() ? true : false;
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

    protected function listRuanganRepositories()
    {
        return Ruangan::where('kategori_barang', 'ruangan')->orderByDesc('id')->get();
    }

    public function createRuanganRepositories($request): void
    {
        Ruangan::create($request);
    }

    public function checkIdUpdateRuanganRepositories($id): bool
    {
        return Ruangan::where('id', $id)->first() ? true : false;
    }

    public function updateRuanganRepositories($request): void
    {
        Ruangan::where('id', $request['id'])->update($request);
    }

    public function checkIdDeleteRuanganRepositories($id): bool
    {
        return Ruangan::where('id', $id)->first() ? true : false;
    }

    public function deleteRuanganRepositories($id): void
    {
        Ruangan::where('id', $id)->delete();
    }
    /**
     * end::inventori_ruangan
     */

    /**
     * begin::transaction(verif peminjaman users)
     */
    protected function getVerifikasiPeminjamanRepositories()
    {
        return Barangpinjam::orderByDesc('id')
            ->with(['users', 'barangs'])
            ->get();
    }

    protected function checkVerificationBYIDRepositories($id): bool
    {
        return Barangpinjam::whereId($id)->first() ? true : false;
    }

    protected function getVerificationBYIDRepositories($id)
    {
        return Barangpinjam::whereId($id)->first();
    }

    public function submitRequestVerificationBYIDRepositories($id, $request): void
    {
        Barangpinjam::whereId($id)->firstOrFail()->update($request);
    }
    /**
     * end::transaction(verif peminjaman users)
     */

    /**
     * begin::inventori(user)
     */

    protected function listUserRepositories()
    {
        return User::orderByDesc('id')->get();
    }

    public function createUserRepositories($request): void
    {
        User::create($request);
    }

    protected function checkIdUpdateUserRepositories($id): bool
    {
        return User::where('id', $id)->first() ? true : false;
    }

    public function updateUserRepositories($request): void
    {
        User::where('id', $request['id'])->update($request);
    }

    protected function checkIdDeleteUserRepositories($id): bool
    {
        return User::where('id', $id)->first() ? true : false;
    }

    public function deleteUserRepositories($id): void
    {
        User::where('id', $id)->delete();
    }

    /**
     * end::inventori(user)
     */

    /**
     * begin::penjadwalan inventori
     */
    protected function checkIdUpdatePenjadwalanRepositories($id): bool
    {
        return ScheduleRoom::where('id', $id)->first() ? true : false;
    }

    protected function checkIdDeletePenjadwalanRepositories($id): bool
    {
        return ScheduleRoom::where('id', $id)->first() ? true : false;
    }

    protected function listPenjadwalanRepositories()
    {
        return ScheduleRoom::with('barangs')->orderByDesc('id')->get();
    }

    protected function viewRuanganListRepositories()
    {
        return Ruangan::where('kategori_barang', 'ruangan')->orderByDesc('id')->limit(10)->get();
    }

    public function createPenjadwalanRepositories($request): void
    {
        ScheduleRoom::create($request);
    }

    public function updatePenjadwalanRepositories($request): void
    {
        ScheduleRoom::where('barangs_id', $request['barangs_id'])->update($request);
    }

    public function deletePenjadwalanRepositories($id): void
    {
        ScheduleRoom::where('id', $id)->delete();
    }

    /**
     * end::penjadwalan inventori
     */
}
