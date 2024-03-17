<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Barang;
use App\Models\Barang as Ruangan;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Errorlog;
use App\Models\ScheduleRoom;
use App\Models\Successlog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Admin\DashboardRepositories;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function doUpdateLanding(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdByUpdateLanding($request)) {
                return $this->redirectError('admin.dashboard_landing', 'Maaf ID Tidak Di temukan');
            }

            if (!isset($this->landingRequest($request)['file'])) {
                $this->updateLandingRepositories(Landing::where('id', $request->id)->first(), $this->submitLandingRequestUpdateNoFile($request));
            }

            if (isset($this->landingRequest($request)['file'])) {
                $this->updateLandingRepositories(Landing::where('id', $request->id)->first(), $this->submitRequest($request));
            }

            $this->logSuccess($this->dataLogSuccessByID(Landing::where('id', $request->id)->first(), 'telah mengubah landing'));
            return $this->redirectSuccess('admin.dashboard_landing', 'Berhasil Mengubah Landing');
        } catch (\Exception $errros) {
            $this->logError($this->dataLogError($errros->getMessage()));
            return $this->redirectError('admin.dashboard_landing', 'Maaf ada kesalahan sistem pada update landing');
        }
    }

    public function doDeleteLanding(Landing $id): RedirectResponse
    {
        try {
            if (!$this->checkIdByDeleteLanding($id)) {
                $this->redirectError('admin.dashboard_landing', 'Maaf ID tidak di temukan');
            }
            $this->logSuccess($this->dataLogSuccessByID(Landing::where('id', $id->id)->first(), 'telah menghapus landing'));
            $this->deleteLandingRepositories(Landing::where('id', $id->id)->first());
            return $this->redirectSuccess('admin.dashboard_landing', 'Berhasil Delete Landing');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing', 'Maaf ada kesalahan sistem pada delete landing');
        }
    }

    private function checkIdByUpdateLanding($request): bool
    {
        return $this->checkIdByUpdateLandingRepositories($request);
    }

    private function checkIdByDeleteLanding($id): bool
    {
        return $this->checkIdByDeleteLandingRepositories($id);
    }

    private function viewForListLanding($landing)
    {
        return view('sisarpas.admin.dashboard.master-data.landing.index', compact('landing'));
    }

    private function getListLanding()
    {
        return $this->getListLandingRepositories();
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

    private function submitLandingRequestUpdateNoFile($request)
    {
        return $request->only('type', 'status');
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
        return $this->checkIdUpdateContactRepositories($request);
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
        return $this->checkIdDeleteContactRepositories($id);
    }

    /**
     * end::contacts
     */

    /**
     * Begin::inventori(barang)
     */

    public function barang()
    {
        try {
            return $this->viewBarang($this->listBarang());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard', 'Maaf ada kesalahan dibagian inventori barang');
        }
    }

    public function doCreateBarang(Request $request)
    {
        try {
            $this->createBarangRepositories($this->submitRequestCreateBarang($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan inventori barang'));
            $this->dataLogSuccess('telah menambahkan inventori barang');
            return $this->redirectSuccess('admin.dashboard_inventori_barang', 'Berhasil Menambahkan Inventori Barang');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_barang', 'Maaf ada kesalahan dibagian inventori create barang');
        }
    }

    public function doUpdateBarang(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdUpdateBarang($request->id)) {
                $this->logError($this->dataLogError('id update barang inventori salah'));
                return $this->redirectError('admin.dashboard_inventori_barang', 'Id barang salah');
            }

            if ($this->checkIdUpdateBarang($request->id)) {
                if (!empty($request->file('gambar_barang'))) {
                    $this->updateBarangRepositories($this->submitRequestUpdateBarangWithImg($request));
                }

                if (empty($request->file('gambar_barang'))) {
                    $this->updateBarangRepositories($this->submitRequestUpdateBarangNoImg($request));
                }

                $this->logSuccess($this->dataLogSuccessByID(Barang::where('id', $request->id)->first(), 'Berhasil Mengubah Inventori Barang'));
                return $this->redirectSuccess('admin.dashboard_inventori_barang', 'Berhasil Update Barang Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_barang', 'Maaf ada kesalahan dibagian inventori update barang');
        }
    }

    public function doDeleteBarang(Barang $id)
    {
        try {
            if (!$this->checkIdDeleteBarang($id->id)) {
                return $this->redirectError('admin.dashboard_inventori_barang', 'Id barang salah');
            }

            if ($this->checkIdDeleteBarang($id->id)) {
                $this->logSuccess($this->dataLogSuccessByID(Barang::where('id', $id->id)->first(), 'Berhasil Menghapus Barang Inventori'));
                $this->deleteBarangRepositories($id->id);
                return $this->redirectSuccess('admin.dashboard_inventori_barang', 'Berhasil Menghapus Barang Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_barang', 'Mohon maaf ada kesalahan dibagian delete inventori barang');
        }
    }

    private function checkIdUpdateBarang($id): bool
    {
        return $this->checkIdUpdateBarangRepositories($id);
    }

    private function checkIdDeleteBarang($id): bool
    {
        return $this->checkIdDeleteBarangRepositories($id);
    }

    private function viewBarang($barang): View
    {
        return view('sisarpas.admin.dashboard.master-data.inventori.barang', compact('barang'));
    }

    private function listBarang()
    {
        return $this->listBarangRepositories();
    }

    private function imageBarang($request)
    {
        $image = $request->file('gambar_barang');
        $namaFile = date('Y-m-d H:i:s') . "_" . $image->getClientOriginalName();
        $destination_upload = "sisarpas/assets/inventoriFile";
        $image->move($destination_upload, $namaFile);
        return $namaFile;
    }

    private function requestCreateBarang($request)
    {
        return $request->only('id', 'nama_barang', 'jumlah_barang', 'kondisi_barang', 'kategori_barang', 'detail_barang', 'spesifikasi_barang', 'gambar_barang', 'status_barang');
    }

    private function requestUpdateBarangNoImg($request)
    {
        return $request->only('id', 'nama_barang', 'jumlah_barang', 'kondisi_barang', 'kategori_barang', 'detail_barang', 'spesifikasi_barang', 'status_barang');
    }

    private function requestUpdateBarangWithImg($request)
    {
        return $request->only('id', 'nama_barang', 'jumlah_barang', 'kondisi_barang', 'kategori_barang', 'detail_barang', 'spesifikasi_barang', 'gambar_barang', 'status_barang');
    }

    private function submitRequestCreateBarang($request)
    {
        $req = $this->requestCreateBarang($request);
        $req['gambar_barang'] = $this->imageBarang($request);
        $req['id'] = uniqid();
        $req['kategori_barang'] = 'barang';
        return $req;
    }
    private function submitRequestUpdateBarangWithImg($request)
    {
        $req = $this->requestUpdateBarangWithImg($request);
        $req['gambar_barang'] = $this->imageBarang($request);
        $req['kategori_barang'] = 'barang';
        return $req;
    }
    private function submitRequestUpdateBarangNoImg($request)
    {
        $req = $this->requestUpdateBarangNoImg($request);
        $req['kategori_barang'] = 'barang';
        return $req;
    }

    /**
     * End::inventori(barang)
     */

    /**
     * begin::inventori(ruangan)
     */

    public function ruangan()
    {
        try {
            return $this->viewRuangan($this->listRuangan());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard', 'Maaf ada kesalahan dibagian inventori ruangan');
        }
    }

    public function doCreateRuangan(Request $request)
    {
        try {
            $this->createRuanganRepositories($this->submitRequestCreateRuangan($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan inventori ruangan'));
            $this->dataLogSuccess('telah menambahkan inventori ruangan');
            return $this->redirectSuccess('admin.dashboard_inventori_ruangan', 'Berhasil Menambahkan Inventori Ruangan');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_ruangan', 'Maaf ada kesalahan dibagian inventori create ruangan');
        }
    }

    public function doUpdateRuangan(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdUpdateRuangan($request->id)) {
                $this->logError($this->dataLogError('id update ruangan inventori salah'));
                return $this->redirectError('admin.dashboard_inventori_ruangan', 'Id ruangan salah');
            }

            if ($this->checkIdUpdateRuangan($request->id)) {
                if (!empty($request->file('gambar_barang'))) {
                    $this->updateRuanganRepositories($this->submitRequestUpdateRuanganWithImg($request));
                }

                if (empty($request->file('gambar_barang'))) {
                    $this->updateRuanganRepositories($this->submitRequestUpdateRuanganNoImg($request));
                }

                $this->logSuccess($this->dataLogSuccessByID(Ruangan::where('id', $request->id)->first(), 'Berhasil Mengubah Inventori Ruangan'));
                return $this->redirectSuccess('admin.dashboard_inventori_ruangan', 'Berhasil Update Ruangan Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_ruangan', 'Maaf ada kesalahan dibagian inventori update ruangan');
        }
    }

    public function doDeleteRuangan(Ruangan $id)
    {
        try {
            if (!$this->checkIdDeleteRuangan($id->id)) {
                return $this->redirectError('admin.dashboard_inventori_ruangan', 'Id ruangan salah');
            }

            if ($this->checkIdDeleteRuangan($id->id)) {
                $this->logSuccess($this->dataLogSuccessByID(Ruangan::where('id', $id->id)->first(), 'Berhasil Menghapus Ruangan Inventori'));
                $this->deleteRuanganRepositories($id->id);
                return $this->redirectSuccess('admin.dashboard_inventori_ruangan', 'Berhasil Menghapus Ruangan Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_ruangan', 'Mohon maaf ada kesalahan dibagian delete inventori ruangan');
        }
    }

    private function checkIdUpdateRuangan($id): bool
    {
        return $this->checkIdUpdateRuanganRepositories($id);
    }

    private function checkIdDeleteRuangan($id): bool
    {
        return $this->checkIdDeleteRuanganRepositories($id);
    }

    private function viewRuangan($ruangan): View
    {
        return view('sisarpas.admin.dashboard.master-data.inventori.ruangan', compact('ruangan'));
    }

    private function listRuangan()
    {
        return $this->listRuanganRepositories();
    }

    private function imageRuangan($request)
    {
        $image = $request->file('gambar_barang');
        $namaFile = date('Y-m-d H:i:s') . "_" . $image->getClientOriginalName();
        $destination_upload = "sisarpas/assets/inventoriFile";
        $image->move($destination_upload, $namaFile);
        return $namaFile;
    }

    private function requestCreateRuangan($request)
    {
        return $request->only('id', 'nama_barang', 'jumlah_barang', 'kondisi_barang', 'kategori_barang', 'detail_barang', 'spesifikasi_barang', 'gambar_barang', 'status_barang');
    }

    private function requestUpdateRuanganNoImg($request)
    {
        return $request->only('id', 'nama_barang', 'jumlah_barang', 'kondisi_barang', 'kategori_barang', 'detail_barang', 'spesifikasi_barang', 'status_barang');
    }

    private function requestUpdateRuanganWithImg($request)
    {
        return $request->only('id', 'nama_barang', 'jumlah_barang', 'kondisi_barang', 'kategori_barang', 'detail_barang', 'spesifikasi_barang', 'gambar_barang', 'status_barang');
    }

    private function submitRequestCreateRuangan($request)
    {
        $req = $this->requestCreateRuangan($request);
        $req['gambar_barang'] = $this->imageRuangan($request);
        $req['id'] = uniqid();
        $req['kategori_barang'] = 'ruangan';
        return $req;
    }
    private function submitRequestUpdateRuanganWithImg($request)
    {
        $req = $this->requestUpdateRuanganWithImg($request);
        $req['gambar_barang'] = $this->imageRuangan($request);
        $req['kategori_barang'] = 'ruangan';
        return $req;
    }
    private function submitRequestUpdateRuanganNoImg($request)
    {
        $req = $this->requestUpdateRuanganNoImg($request);
        $req['kategori_barang'] = 'ruangan';
        return $req;
    }
    /**
     * end::inventori(ruangan)
     */

    /**
     * begin::transaction(verif peminjaman users)
     */
    public function verifikasiPeminjaman()
    {
        try {
            return $this->viewVerifikasiPeminjaman($this->getVerifikasiPeminjaman());
            $this->logSuccess($this->dataLogSuccess('admin berhasil membuka module verifikasi peminjaman barang user'));
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard', 'Mohon maaf ada kesalahan dibagian module verifikasi peminjaman users');
        }
    }

    public function doverifikasiPeminjaman(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!$this->checkVerificationBYID($request->id)) {
                return $this->redirectError('admin.dashboard_peminjaman', 'Maaf ID Transaction Verifikasi Salah');
            }

            if (!$this->checkEventNotApproveButFieldTanggal($request)) {
                return $this->redirectError('admin.dashboard_peminjaman', 'Anda tidak bisa melakukan transaction jika memasukan tanggal pengembalikan akan tetapi tidak di approve, sistem hanya mengizinkan memasukan tanggal pengembalian jika statusnya approve');
            } else {
                if ($this->checkVerificationBYID($request->id)) {
                    $this->submitRequestVerificationBYID($request->id, $this->requestVerificationPeminjaman($request));
                    DB::commit();
                    $this->logSuccess($this->dataLogSuccessByID($this->getVerificationBYID($request->id), 'Berhasil Melakukan Verifikasi Transaction Peminjaman Dengan'));
                    return $this->redirectSuccess('admin.dashboard_peminjaman', 'Berhasil Melakukan Transaction Verifikasi Peminjaman');
                }
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            DB::rollBack();
            return $this->redirectError('admin.dashboard_peminjaman', 'Mohon maaf ada kesalahan dibagian melakukan verifikasi peminjaman users');
        }
    }

    private function viewVerifikasiPeminjaman($peminjaman): View
    {
        return view('sisarpas.admin.dashboard.peminjaman.verifikasi', compact('peminjaman'));
    }

    private function getVerifikasiPeminjaman()
    {
        return $this->getVerifikasiPeminjamanRepositories();
    }

    private function requestVerificationPeminjaman($request)
    {
        return $request->only('status_pinjam', 'tanggal_pengembalian');
    }

    private function checkVerificationBYID($id): bool
    {
        return $this->checkVerificationBYIDRepositories($id);
    }

    private function getVerificationBYID($id)
    {
        return $this->getVerificationBYIDRepositories($id);
    }

    private function submitRequestVerificationBYID($id, $request)
    {
        return $this->submitRequestVerificationBYIDRepositories($id, $request);
    }

    private function checkEventNotApproveButFieldTanggal($request): bool
    {
        // memasukan tanggal pengembalian pada saat status pinjam usernya di approve
        return isset($request->tanggal_pengembalian) && $request->status_pinjam == 'dipinjam' ? true : false;
    }

    /**
     * end::transaction(verif of peminjaman users)
     */


    /**
     * begin::user inventori(master data user)
     */

    public function userinventori()
    {
        try {
            return $this->viewUser($this->listUser());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard', 'Maaf ada kesalahan dibagian inventori user');
        }
    }

    public function doCreateUser(Request $request)
    {
        try {
            $this->createUserRepositories(array_merge($this->submitRequestCreateUser($request), $this->requestCreatePasswordOfUsers($request)));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan inventori users'));
            $this->dataLogSuccess('telah menambahkan inventori user');
            return $this->redirectSuccess('admin.dashboard_inventori_user', 'Berhasil Menambahkan Inventori User');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_user', 'Maaf ada kesalahan dibagian inventori create user');
        }
    }

    private function checkPasswordIfUpdateWithImage($request): array
    {
        $requestPass = $this->requestCreatePasswordOfUsers($request);
        if (!empty($request->password)) {
            $updateWithImage = array_merge($this->submitRequestUpdateUserWithImg($request), $requestPass);
        } else {
            $updateWithImage = $this->submitRequestUpdateUserWithImg($request);
        }
        return $updateWithImage;
    }

    private function checkPasswordIfUpdateNoImage($request): array
    {
        $requestPass = $this->requestCreatePasswordOfUsers($request);
        if (!empty($request->password)) {
            $updateWithImage = array_merge($this->submitRequestUpdateUserNoImg($request), $requestPass);
        } else {
            $updateWithImage = $this->submitRequestUpdateUserNoImg($request);
        }
        return $updateWithImage;
    }

    public function doUpdateUser(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdUpdateUser($request->id)) {
                $this->logError($this->dataLogError('id update ruangan inventori salah'));
                return $this->redirectError('admin.dashboard_inventori_user', 'Id ruangan salah');
            }

            if ($this->checkIdUpdateUser($request->id)) {

                if (!empty($request->file('image'))) {
                    $this->updateUserRepositories($this->checkPasswordIfUpdateWithImage($request));
                }

                if (empty($request->file('image'))) {
                    $this->updateUserRepositories($this->checkPasswordIfUpdateNoImage($request));
                }

                $this->logSuccess($this->dataLogSuccessByID(User::where('id', $request->id)->first(), 'Berhasil Mengubah Inventori User'));
                return $this->redirectSuccess('admin.dashboard_inventori_user', 'Berhasil Update User Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_user', 'Maaf ada kesalahan dibagian inventori update user');
        }
    }

    public function doDeleteUser(User $id)
    {
        try {
            if (!$this->checkIdDeleteUser($id->id)) {
                return $this->redirectError('admin.dashboard_inventori_user', 'Id ruangan salah');
            }

            if ($this->checkIdDeleteUser($id->id)) {
                $this->logSuccess($this->dataLogSuccessByID(User::where('id', $id->id)->first(), 'Berhasil Menghapus User Inventori'));
                $this->deleteUserRepositories($id->id);
                return $this->redirectSuccess('admin.dashboard_inventori_user', 'Berhasil Menghapus User Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_user', 'Mohon maaf ada kesalahan dibagian delete inventori user');
        }
    }

    private function checkIdUpdateUser($id): bool
    {
        return $this->checkIdUpdateUserRepositories($id);
    }

    private function checkIdDeleteUser($id): bool
    {
        return $this->checkIdDeleteUserRepositories($id);
    }

    private function viewUser($users): View
    {
        return view('sisarpas.admin.dashboard.master-data.inventori.user', compact('users'));
    }

    private function listUser()
    {
        return $this->listUserRepositories();
    }

    private function imageUser($request)
    {
        $image = $request->file('image');
        $namaFile = date('Y-m-d H:i:s') . "_" . $image->getClientOriginalName();
        $destination_upload = "sisarpas/assets/userImage";
        $image->move($destination_upload, $namaFile);
        return $namaFile;
    }

    private function requestCreatePasswordOfUsers($request)
    {
        $req = $request->only('password');
        $req['password'] = Hash::make($request->password);
        return $req;
    }

    private function requestCreateUser($request)
    {
        return $request->only('name', 'nim', 'email', 'roles_id', 'image');
    }

    private function requestUpdateUserNoImg($request)
    {
        return $request->only('id', 'name', 'nim', 'email', 'roles_id');
    }

    private function requestUpdateUserWithImg($request)
    {
        return $request->only('id', 'name', 'nim', 'email', 'roles_id', 'image');
    }

    private function submitRequestCreateUser($request)
    {
        $req = $this->requestCreateUser($request);
        $req['image'] = $this->imageUser($request);
        $req['roles_id'] = 2;
        return $req;
    }
    private function submitRequestUpdateUserWithImg($request)
    {
        $req = $this->requestUpdateUserWithImg($request);
        $req['image'] = $this->imageUser($request);
        $req['roles_id'] = 2;
        return $req;
    }
    private function submitRequestUpdateUserNoImg($request)
    {
        $req = $this->requestUpdateUserNoImg($request);
        $req['roles_id'] = 2;
        return $req;
    }
    /**
     * end::user inventori(master data user)
     */

    /**
     * begin::penjadwalan inventori
     */
    public function penjadwalan_inventori()
    {
        try {
            return $this->viewPenjadwalan($this->listPenjadwalan(), $this->viewRuanganList());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard', 'Maaf ada kesalahan dibagian inventori ruangan');
        }
    }

    public function doCreatePenjadwalan(Request $request)
    {
        try {
            $this->createPenjadwalanRepositories($this->submitRequestCreatePenjadwalan($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan inventori penjadwalan'));
            $this->dataLogSuccess('telah menambahkan inventori penjadwalan');
            return $this->redirectSuccess('admin.dashboard_inventori_penjadwalan', 'Berhasil Menambahkan Inventori Penjadwalan');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Maaf ada kesalahan dibagian inventori create penjadwalan');
        }
    }

    public function doUpdatePenjadwalan(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdUpdatePenjadwalan($request->id)) {
                $this->logError($this->dataLogError('id update penjadwalan inventori salah'));
                return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Id penjadwalan salah');
            }

            if ($this->checkIdUpdatePenjadwalan($request->id)) {
                $this->updatePenjadwalanRepositories($this->submitRequestUpdatePenjadwalan($request));
                $this->logSuccess($this->dataLogSuccessByID(ScheduleRoom::where('id', $request->id)->first(), 'Berhasil Mengubah Inventori Penjadwalan'));
                return $this->redirectSuccess('admin.dashboard_inventori_penjadwalan', 'Berhasil Update Penjadwalan Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Maaf ada kesalahan dibagian inventori update penjadwalan');
        }
    }

    public function doDeletePenjadwalan(ScheduleRoom $id)
    {
        try {
            if (!$this->checkIdDeletePenjadwalan($id->id)) {
                return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Id penjadwalan salah');
            }

            if ($this->checkIdDeletePenjadwalan($id->id)) {
                $this->logSuccess($this->dataLogSuccessByID(ScheduleRoom::where('id', $id->id)->first(), 'Berhasil Menghapus Ruangan Penjadwalan'));
                $this->deletePenjadwalanRepositories($id->id);
                return $this->redirectSuccess('admin.dashboard_inventori_penjadwalan', 'Berhasil Menghapus Inventori Penjadwalan');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Mohon maaf ada kesalahan dibagian delete inventori penjadwalan');
        }
    }

    private function checkIdUpdatePenjadwalan($id): bool
    {
        return $this->checkIdUpdatePenjadwalanRepositories($id);
    }

    private function checkIdDeletePenjadwalan($id): bool
    {
        return $this->checkIdDeletePenjadwalanRepositories($id);
    }

    private function viewPenjadwalan($penjadwalan, $ruangan): View
    {
        return view('sisarpas.admin.dashboard.master-data.inventori.penjadwalan', compact('penjadwalan', 'ruangan'));
    }

    private function viewRuanganList()
    {
        return $this->viewRuanganListRepositories();
    }

    private function listPenjadwalan()
    {
        return $this->listPenjadwalanRepositories();
    }

    private function requestCreatePenjadwalan($request)
    {
        return $request->only('barangs_id', 'start_at', 'end_at');
    }

    private function requestUpdatePenjadwalan($request)
    {
        return $request->only('barangs_id', 'start_at', 'end_at');
    }

    private function submitRequestCreatePenjadwalan($request)
    {
        return $this->requestCreatePenjadwalan($request);
    }

    private function submitRequestUpdatePenjadwalan($request)
    {
        return $this->requestUpdatePenjadwalan($request);
    }

    /**
     * end::penjadwalan inventori
     */
}
