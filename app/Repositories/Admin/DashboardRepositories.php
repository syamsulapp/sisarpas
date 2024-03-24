<?php

namespace App\Repositories\Admin;

use App\Models\Barang;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Barangpinjam;
use App\Models\Barang as Ruangan;
use App\Interface\Admin\DashboardInterface;
use App\Models\Admin;
use App\Models\Footer;
use App\Models\Informasi_penting;
use App\Models\ScheduleRoom;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class DashboardRepositories extends FormRequest implements DashboardInterface
{
    public function rules(): array
    {
        if (request()->is('admin/dashboard/master_data/landing/header/create')) {
            return [
                'file' => 'required|file|image|mimes:jpg,png,jpeg|max:3048',
                'type' => 'required|string|in:image',
                'status' => 'required|string|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/landing/header/update')) {
            return [
                'file' => 'file|image|mimes:jpg,png,jpeg|max:3048',
                'type' => 'string|in:image',
                'status' => 'string|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/landing/video/create')) {
            return [
                'file' => 'file|mimes:mp4|max:3048',
                'type' => 'required|string|in:video',
                'status' => 'required|string|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/landing/video/update')) {
            return [
                'file' => 'file|mimes:mp4|max:3048',
                'type' => 'string|in:video',
                'status' => 'string|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/landing/footer/create')) {
            return [
                'status' => 'required|in:hide,unhide',
            ];
        } else if (request()->is('admin/dashboard/master_data/landing/footer/update')) {
            return [
                'alamat_gedung' => 'string',
                'nomor_telpon' => 'string',
                'email' => 'string',
                'nama_gedung' => 'string',
                'facebook' => 'string',
                'instagram' => 'string',
                'youtube' => 'string',
                'status' => 'in:hide,unhide',
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
                'gambar_barang' => 'required|file|image|mimes:jpg,png,jpeg|max:3048',
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
                'gambar_barang' => 'file|image|mimes:jpg,png,jpeg|max:3048',
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
                'gambar_barang' => 'required|file|image|mimes:jpg,png,jpeg|max:3048',
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
                'gambar_barang' => 'file|image|mimes:jpg,png,jpeg|max:3048',
                'status_barang' => 'in:ready,not-ready,maintenance',
            ];
        } else if (request()->is('admin/dashboard/peminjaman/verifikasi')) {
            return [
                'status_pinjam' => 'required|in:dipinjam,ditolak'
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/admin/create')) {
            return [
                'name' => 'required|string',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|string',
                'image' => 'required|file|image|mimes:jpg,png,jpeg|max:3048',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/admin/update')) {
            return [
                'id' => 'integer',
                'name' => 'string',
                'email' => 'email',
                'image' => 'file|image|mimes:jpg,png,jpeg|max:3048',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/penjadwalan/create')) {
            return [
                'barangs_id' => 'required|string|unique:schedule_room,barangs_id',
                'start_at' => 'required|date',
                'end_at' => 'required|date',
            ];
        } else if (request()->is('admin/dashboard/master_data/inventori/penjadwalan/update')) {
            return [
                'barangs_id' => 'string',
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

    protected function checkIdByUpdateFooterRepositories($request): bool
    {
        return Footer::where('id', $request['id'])->first() ? true : false;
    }

    protected function imageFileExitsRepositories($data): bool
    {
        if (isset($data->file)) {
            $imagePath = "sisarpas/assets/landingFile/{$data->file}";
            return File::exists($imagePath) ? true : false;
        }

        if (isset($data->gambar_barang)) {
            $imagePath = "sisarpas/assets/inventoriFile/{$data->gambar_barang}";
            return File::exists($imagePath) ? true : false;
        }

        if (isset($data->image)) {
            $imagePath = "sisarpas/assets/adminAkunImage/{$data->image}";
            return File::exists($imagePath) ? true : false;
        }

        return false;
    }

    protected function deleteImageFileExitsRepositories($data): void
    {
        if (isset($data->file)) {
            $imageLanding = "sisarpas/assets/landingFile/{$data->file}";
            File::delete($imageLanding);
            $imageCrop = "sisarpas/assets/landingFileCrop/{$data->file}";
            File::delete($imageCrop);
        }

        if (isset($data->gambar_barang)) {
            $imagePath = "sisarpas/assets/inventoriFile/{$data->gambar_barang}";
            File::delete($imagePath);
        }

        if (isset($data->image)) {
            $imagePath = "sisarpas/assets/adminAkunImage/{$data->image}";
            File::delete($imagePath);
        }
    }

    protected function checkIdByDeleteFooterRepositories($id): bool
    {
        return Footer::where('id', $id)->first() ? true : false;
    }

    protected function getListLandingHeaderRepositories()
    {
        return Landing::where('type', 'image')->orderBy('id', 'desc')->get();
    }
    protected function getListLandingVideoRepositories()
    {
        return Landing::where('type', 'video')->orderBy('id', 'desc')->get();
    }

    protected function getListLandingFooterRepositories()
    {
        return Footer::orderByDesc('id')->get();
    }

    protected function getListLandingInformasiPentingRepositories()
    {
        return Informasi_penting::orderByDesc('id')->get();
    }

    public function createLandingRepositories($request): void
    {
        Landing::create($request);
    }

    public function createFooterRepositories($request): void
    {
        Footer::create($request);
    }

    public function updateFooterRepositories($request): void
    {
        Footer::where('id', $request['id'])->update($request);
    }

    public function updateLandingRepositories($model, $request): void
    {
        $model->update($request);
    }

    public function deleteLandingRepositories($model): void
    {
        $model->delete();
    }

    public function deleteFooterRepositories($id): void
    {
        Footer::where('id', $id)->delete();
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
     * begin::inventori(admin)
     */

    protected function listAdminRepositories()
    {
        return Admin::orderByDesc('id')->get();
    }

    public function createAdminRepositories($request): void
    {
        Admin::create($request);
    }

    protected function checkIdUpdateAdminRepositories($id): bool
    {
        return Admin::where('id', $id)->first() ? true : false;
    }

    public function updateAdminRepositories($request): void
    {
        Admin::where('id', $request['id'])->update($request);
    }

    protected function checkIdDeleteAdminRepositories($id): bool
    {
        return Admin::where('id', $id)->first() ? true : false;
    }

    public function deleteAdminRepositories($id): void
    {
        Admin::where('id', $id)->delete();
    }

    /**
     * end::inventori(admin)
     */

    /**
     * begin::penjadwalan inventori
     */
    protected function checkIdUpdatePenjadwalanRepositories($id): bool
    {
        return ScheduleRoom::where('barangs_id', $id)->first() ? true : false;
    }

    protected function checkIdDeletePenjadwalanRepositories($id): bool
    {
        return ScheduleRoom::where('barangs_id', $id)->first() ? true : false;
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
