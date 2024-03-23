<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Barang;
use App\Models\Barang as Ruangan;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Errorlog;
use App\Models\Footer;
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
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class DashboardController extends DashboardRepositories
{
    protected $admin, $successLog, $errorlog, $imageCrop;
    public function __construct(Admin $admin, Successlog $successLog, Errorlog $errorlog)
    {
        $this->admin = $admin;
        $this->successLog = $successLog;
        $this->errorlog = $errorlog;
        $this->imageCrop = new ImageManager(new Driver);
    }

    /**
     * begin:: handler logging and redirect response and others
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

    private function imageFileExits($data): bool
    {
        return $this->imageFileExitsRepositories($data);
    }

    private function deleteImageFileExits($data): void
    {
        $this->deleteImageFileExitsRepositories($data);
    }

    /**
     * end::handler logging and redirect response and others
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
    public function landingHeader(): View
    {
        try {
            return $this->viewForListLandingHeader($this->getListLandingHeader());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_header', 'Mohon maaf ada kesalahan dibagian list landing header');
        }
    }

    public function landingVideo(): View
    {
        try {
            return $this->viewForListLandingVideo($this->getListLandingVideo());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_video', 'Mohon maaf ada kesalahan dibagian list landing video');
        }
    }
    public function landingFooter(): View
    {
        try {
            return $this->viewForListLandingFooter($this->getListLandingFooter());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_footer', 'Mohon maaf ada kesalahan dibagian list landing footer');
        }
    }

    public function doCreateLandingHeader(Request $request): RedirectResponse
    {
        try {
            $this->createLandingRepositories($this->submitRequest($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan konten landing'));
            return $this->redirectSuccess('admin.dashboard_landing_header', 'Berhasil Menambahkan Landing header');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_header', 'Maaf ada kesalahan sistem pada create landing header');
        }
    }

    public function doCreateLandingVideo(Request $request): RedirectResponse
    {
        try {
            $this->createLandingRepositories($this->submitRequest($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan konten landing'));
            return $this->redirectSuccess('admin.dashboard_landing_video', 'Berhasil Menambahkan Landing video');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_video', 'Maaf ada kesalahan sistem pada create landing video');
        }
    }

    public function doCreateLandingFooter(Request $request): RedirectResponse
    {
        try {
            $this->createFooterRepositories($this->submitRequestFooter($request));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan konten landing footer'));
            return $this->redirectSuccess('admin.dashboard_landing_footer', 'Berhasil Menambahkan Landing footer');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_footer', 'Maaf ada kesalahan sistem pada create landing footer');
        }
    }

    public function doUpdateLandingHeader(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdByUpdateLanding($request)) {
                return $this->redirectError('admin.dashboard_landing_header', 'Maaf ID Tidak Di temukan');
            }

            if (!isset($this->landingRequest($request)['file'])) {
                $this->updateLandingRepositories(Landing::where('id', $request->id)->first(), $this->submitLandingRequestUpdateNoFile($request));
            }

            if (isset($this->landingRequest($request)['file'])) {
                $this->updateLandingRepositories(Landing::where('id', $request->id)->first(), $this->submitRequest($request));
            }

            $this->logSuccess($this->dataLogSuccessByID(Landing::where('id', $request->id)->first(), 'telah mengubah landing header'));
            return $this->redirectSuccess('admin.dashboard_landing_header', 'Berhasil Mengubah Landing');
        } catch (\Exception $errros) {
            $this->logError($this->dataLogError($errros->getMessage()));
            return $this->redirectError('admin.dashboard_landing_header', 'Maaf ada kesalahan sistem pada update landing header');
        }
    }

    public function doUpdateLandingVideo(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdByUpdateLanding($request)) {
                return $this->redirectError('admin.dashboard_landing_video', 'Maaf ID Tidak Di temukan');
            }

            if (!isset($this->landingRequest($request)['file']) || !isset($this->landingRequest($request)['embed_yt'])) {
                $this->updateLandingRepositories(Landing::where('id', $request->id)->first(), $this->submitLandingRequestUpdateNoFile($request));
            }

            if (isset($this->landingRequest($request)['file']) || isset($this->landingRequest($request)['embed_yt'])) {
                $this->updateLandingRepositories(Landing::where('id', $request->id)->first(), $this->submitRequest($request));
            }

            $this->logSuccess($this->dataLogSuccessByID(Landing::where('id', $request->id)->first(), 'telah mengubah landing video'));
            return $this->redirectSuccess('admin.dashboard_landing_video', 'Berhasil Mengubah Landing video');
        } catch (\Exception $errros) {
            $this->logError($this->dataLogError($errros->getMessage()));
            return $this->redirectError('admin.dashboard_landing_video', 'Maaf ada kesalahan sistem pada update landing video');
        }
    }

    public function doUpdateLandingFooter(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdByUpdateFooter($request)) {
                return $this->redirectError('admin.dashboard_landing_footer', 'Maaf ID Tidak Di temukan');
            }

            if ($this->checkIdByUpdateFooter($request)) {
                $this->updateFooterRepositories($this->submitLandingRequestUpdateFooter($request));
            }

            $this->logSuccess($this->dataLogSuccessByID(Footer::where('id', $request->id)->first(), 'telah mengubah landing footer'));
            return $this->redirectSuccess('admin.dashboard_landing_footer', 'Berhasil Mengubah Landing footer');
        } catch (\Exception $errros) {
            $this->logError($this->dataLogError($errros->getMessage()));
            return $this->redirectError('admin.dashboard_landing_footer', 'Maaf ada kesalahan sistem pada update landing footer');
        }
    }

    public function doDeleteLandingHeader(Landing $id): RedirectResponse
    {
        try {

            if (!$this->checkIdByDeleteLanding($id)) {
                $this->redirectError('admin.dashboard_landing', 'Maaf ID tidak di temukan');
            }

            if ($this->imageFileExits($id)) {
                $this->deleteImageFileExits($id);
            }

            $this->logSuccess($this->dataLogSuccessByID(Landing::where('id', $id->id)->first(), 'telah menghapus landing header'));
            $this->deleteLandingRepositories(Landing::where('id', $id->id)->first());
            return $this->redirectSuccess('admin.dashboard_landing_header', 'Berhasil Delete Landing header');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_header', 'Maaf ada kesalahan sistem pada delete landing header');
        }
    }

    public function doDeleteLandingVideo(Landing $id): RedirectResponse
    {
        try {

            if (!$this->checkIdByDeleteLanding($id)) {
                $this->redirectError('admin.dashboard_landing_video', 'Maaf ID tidak di temukan');
            }

            if ($this->imageFileExits($id)) {
                $this->deleteImageFileExits($id);
            }

            $this->logSuccess($this->dataLogSuccessByID(Landing::where('id', $id->id)->first(), 'telah menghapus landing video'));
            $this->deleteLandingRepositories(Landing::where('id', $id->id)->first());
            return $this->redirectSuccess('admin.dashboard_landing_video', 'Berhasil Delete Landing video');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_video', 'Maaf ada kesalahan sistem pada delete landing video');
        }
    }

    public function doDeleteLandingFooter(Footer $id): RedirectResponse
    {
        try {
            if (!$this->checkIdByDeleteFooter($id->id)) {
                $this->redirectError('admin.dashboard_landing_footer', 'Maaf ID tidak di temukan');
            }

            if ($this->checkIdByDeleteFooter($id->id)) {
                $this->logSuccess($this->dataLogSuccessByID(Footer::where('id', $id->id)->first(), 'telah menghapus landing footer'));
                $this->deleteFooterRepositories(Footer::where('id', $id->id)->first()->id);
                return $this->redirectSuccess('admin.dashboard_landing_footer', 'Berhasil Delete Landing footer');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_landing_footer', 'Maaf ada kesalahan sistem pada delete landing footer');
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

    private function checkIdByUpdateFooter($request): bool
    {
        return $this->checkIdByUpdateFooterRepositories($request);
    }

    private function checkIdByDeleteFooter($id): bool
    {
        return $this->checkIdByDeleteFooterRepositories($id);
    }

    private function viewForListLandingHeader($landing): View
    {
        return view('sisarpas.admin.dashboard.master-data.landing.header', compact('landing'));
    }

    private function viewForListLandingVideo($landing_video): View
    {
        return view('sisarpas.admin.dashboard.master-data.landing.video', compact('landing_video'));
    }

    private function viewForListLandingFooter($landing_footer): View
    {
        return view('sisarpas.admin.dashboard.master-data.landing.footer', compact('landing_footer'));
    }

    private function getListLandingHeader()
    {
        return $this->getListLandingHeaderRepositories();
    }

    private function getListLandingVideo()
    {
        return $this->getListLandingVideoRepositories();
    }

    private function getListLandingFooter()
    {
        return $this->getListLandingFooterRepositories();
    }

    private function landingRequest($request)
    {
        return $request->only('file', 'type', 'status', 'embed_yt');
    }

    private function fileRequestImg($request)
    {
        $file = $request->file('file');
        if (!strpos($file->getClientOriginalName(), 'mp4')) {
            $namaFile = date('Y-m-d H:i:s') . "_" . $file->getClientOriginalName();
            $destination_upload = "sisarpas/assets/landingFile";
            $file->move($destination_upload, $namaFile);

            $imageResize = $this->imageCrop->read("sisarpas/assets/landingFile/{$namaFile}");
            $imageResize->crop(2400, 1057);
            $destination_upload_crop = "sisarpas/assets/landingFileCrop";
            $imageResize->save(public_path("{$destination_upload_crop}/{$namaFile}"));
        } else {
            $namaFile = date('Y-m-d H:i:s') . "_" . $file->getClientOriginalName();
            $destination_upload = "sisarpas/assets/landingFile";
            $file->move($destination_upload, $namaFile);
        }
        return $namaFile;
    }

    private function submitRequest($request)
    {
        $req = $this->landingRequest($request);
        if (empty($req['embed_yt'])) {
            $req['file'] = $this->fileRequestImg($request);
        } else {
            //https://youtu.be/r9k74AGYZoU?si=yfLb4EmXvAhGlBqU
            $req['embed_yt'] = trim($req['embed_yt'], 'https://youtu.be/');
            $req['embed_yt'] = strtok($req['embed_yt'], '?');
            $req['file'] = "/embed/{$req['embed_yt']}";
        }
        return $req;
    }

    private function submitRequestFooter($request)
    {
        return $request->only('alamat_gedung', 'nomor_telpon', 'email', 'nama_gedung', 'facebook', 'instagram', 'youtube', 'status');
    }

    private function submitLandingRequestUpdateFooter($request)
    {
        return $request->only('id', 'alamat_gedung', 'nomor_telpon', 'email', 'nama_gedung', 'facebook', 'instagram', 'youtube', 'status');
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

                if ($this->imageFileExits($id)) {
                    $this->deleteImageFileExits($id);
                }

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

                if ($this->imageFileExits($id)) {
                    $this->deleteImageFileExits($id);
                }

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
     * begin::admin inventori(master data admin)
     */

    public function admininventori()
    {
        try {
            return $this->viewAdmin($this->listAdmin());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard', 'Maaf ada kesalahan dibagian inventori admin');
        }
    }

    public function doCreateAdmin(Request $request)
    {
        try {
            $this->createAdminRepositories(array_merge($this->submitRequestCreateAdmin($request), $this->requestCreatePasswordOfAdmin($request)));
            $this->logSuccess($this->dataLogSuccess('telah menambahkan inventori admin'));
            return $this->redirectSuccess('admin.dashboard_inventori_admin', 'Berhasil Menambahkan Inventori admin');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_admin', 'Maaf ada kesalahan dibagian inventori create admin');
        }
    }

    private function checkPasswordIfUpdateWithImage($request): array
    {
        $requestPass = $this->requestCreatePasswordOfAdmin($request);
        if (!empty($request->password)) {
            $updateWithImage = array_merge($this->submitRequestUpdateAdminWithImg($request), $requestPass);
        } else {
            $updateWithImage = $this->submitRequestUpdateAdminWithImg($request);
        }
        return $updateWithImage;
    }

    private function checkPasswordIfUpdateNoImage($request): array
    {
        $requestPass = $this->requestCreatePasswordOfAdmin($request);
        if (!empty($request->password)) {
            $updateWithImage = array_merge($this->submitRequestUpdateAdminNoImg($request), $requestPass);
        } else {
            $updateWithImage = $this->submitRequestUpdateAdminNoImg($request);
        }
        return $updateWithImage;
    }

    public function doUpdateAdmin(Request $request): RedirectResponse
    {
        try {
            if (!$this->checkIdUpdateAdmin($request->id)) {
                $this->logError($this->dataLogError('id update admin inventori salah'));
                return $this->redirectError('admin.dashboard_inventori_admin', 'Id admin salah');
            }

            if ($this->checkIdUpdateAdmin($request->id)) {

                if (!empty($request->file('image'))) {
                    $this->updateAdminRepositories($this->checkPasswordIfUpdateWithImage($request));
                }

                if (empty($request->file('image'))) {
                    $this->updateAdminRepositories($this->checkPasswordIfUpdateNoImage($request));
                }

                $this->logSuccess($this->dataLogSuccessByID(Admin::where('id', $request->id)->first(), 'Berhasil Mengubah Inventori Admin'));
                return $this->redirectSuccess('admin.dashboard_inventori_admin', 'Berhasil Update Admin Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_admin', 'Maaf ada kesalahan dibagian inventori update admin');
        }
    }

    public function doDeleteAdmin(Admin $id)
    {
        try {
            if (!$this->checkIdDeleteAdmin($id->id)) {
                return $this->redirectError('admin.dashboard_inventori_admin', 'Id admin salah');
            }

            if ($this->checkIdDeleteAdmin($id->id)) {
                $this->logSuccess($this->dataLogSuccessByID(Admin::where('id', $id->id)->first(), 'Berhasil Menghapus admin Inventori'));
                $this->deleteAdminRepositories($id->id);

                if ($this->imageFileExits($id)) {
                    $this->deleteImageFileExits($id);
                }

                return $this->redirectSuccess('admin.dashboard_inventori_admin', 'Berhasil Menghapus admin Inventori');
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('admin.dashboard_inventori_admin', 'Mohon maaf ada kesalahan dibagian delete inventori admin');
        }
    }

    private function checkIdUpdateAdmin($id): bool
    {
        return $this->checkIdUpdateAdminRepositories($id);
    }

    private function checkIdDeleteAdmin($id): bool
    {
        return $this->checkIdDeleteAdminRepositories($id);
    }

    private function viewAdmin($admin): View
    {
        return view('sisarpas.admin.dashboard.master-data.inventori.admin', compact('admin'));
    }

    private function listAdmin()
    {
        return $this->listAdminRepositories();
    }

    private function imageAdmin($request)
    {
        $image = $request->file('image');
        $namaFile = date('Y-m-d H:i:s') . "_" . $image->getClientOriginalName();
        $destination_upload = "sisarpas/assets/adminAkunImage";
        $image->move($destination_upload, $namaFile);
        return $namaFile;
    }

    private function requestCreatePasswordOfAdmin($request)
    {
        $req = $request->only('password');
        $req['password'] = Hash::make($request->password);
        return $req;
    }

    private function requestCreateAdmin($request)
    {
        return $request->only('name', 'email', 'roles_id', 'image');
    }

    private function requestUpdateAdminNoImg($request)
    {
        return $request->only('id', 'name', 'email', 'roles_id');
    }

    private function requestUpdateAdminWithImg($request)
    {
        return $request->only('id', 'name', 'email', 'roles_id', 'image');
    }

    private function submitRequestCreateAdmin($request)
    {
        $req = $this->requestCreateAdmin($request);
        $req['image'] = $this->imageAdmin($request);
        $req['roles_id'] = 1;
        return $req;
    }
    private function submitRequestUpdateAdminWithImg($request)
    {
        $req = $this->requestUpdateAdminWithImg($request);
        $req['image'] = $this->imageAdmin($request);
        $req['roles_id'] = 1;
        return $req;
    }
    private function submitRequestUpdateAdminNoImg($request)
    {
        $req = $this->requestUpdateAdminNoImg($request);
        $req['roles_id'] = 1;
        return $req;
    }
    /**
     * end::admin inventori(master data admin)
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
            if (!$this->checkIdUpdatePenjadwalan($request->barangs_id)) {
                $this->logError($this->dataLogError('id update penjadwalan inventori salah'));
                return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Id penjadwalan salah');
            }

            if ($this->checkIdUpdatePenjadwalan($request->barangs_id)) {
                $this->updatePenjadwalanRepositories($this->submitRequestUpdatePenjadwalan($request));
                $this->logSuccess($this->dataLogSuccessByID(ScheduleRoom::where('barangs_id', $request->barangs_id)->first(), 'Berhasil Mengubah Inventori Penjadwalan'));
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
            if (!$this->checkIdDeletePenjadwalan($id->barangs_id)) {
                return $this->redirectError('admin.dashboard_inventori_penjadwalan', 'Id penjadwalan salah');
            }

            if ($this->checkIdDeletePenjadwalan($id->barangs_id)) {
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
