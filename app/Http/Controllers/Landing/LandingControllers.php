<?php

namespace App\Http\Controllers\Landing;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\LandingRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingControllers extends LandingRepositories
{
    protected $user, $successLog, $errorlog;
    public function __construct(User $user, Successlog $successLog, Errorlog $errorlog)
    {
        $this->user = $user;
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
        return array('message' => "User atas nama {$this->user->authUser()->name} telah {$message} di ID: {$data->id}", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function dataLogSuccess($message): array
    {
        return array('message' => "User atas nama {$this->user->authUser()->name} telah {$message}", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
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

    private function redirectError($route, $parameter, $message): RedirectResponse
    {
        Session::flash("error", $message);
        return Redirect::route($route, ['kategori' => $parameter]);
    }

    private function redirectErrorNoParams($route, $message): RedirectResponse
    {
        Session::flash("error", $message);
        return Redirect::route($route);
    }

    /**
     * end::logging and redirect response
     */

    /**
     * begin::landing
     */

    public function index(): View
    {
        try {
            return $this->viewLanding($this->getLandingHeader(), $this->getLandingVideo(), $this->getJadwalRuangan(), $this->getLandingFooter(), $this->getInformasiRuangan());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
        }
    }

    private function getLandingHeader()
    {
        return $this->landingHeaderRepositories();
    }

    private function getLandingVideo()
    {
        return $this->landingVideoRepositories();
    }

    private function getJadwalRuangan()
    {
        return $this->landingJadwalRepositories();
    }

    private function getLandingFooter()
    {
        return $this->LandingFooterRepositories();
    }

    private function getInformasiRuangan()
    {
        return $this->getInformasiRuanganRepositories();
    }

    private function viewLanding($landing_header, $landing_video, $landing_jadwal_ruangan, $landing_footer, $informasi_penting): View
    {
        return view('sisarpas.landing.index', compact('landing_header', 'landing_video', 'landing_jadwal_ruangan', 'landing_footer', 'informasi_penting'));
    }

    /**
     * end::landing
     */


    /**
     * begin::page alat barang dan aula
     */
    public function alat_barang($kategori)
    {
        try {
            return $this->viewBarang($this->listBarang($kategori));
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.barang', 'barang', 'Mohon maaf ada kesalahan dibagian halaman barang dan aula');
        }
    }

    public function cari_barang(Request $request)
    {
        try {
            if (!empty($request->cari)) {
                return $this->viewBarang($this->cariBarang($request->cari));
            }
            return $this->redirectError('peminjaman.barang', 'barang', 'Silahkan Ketikan Pencarian');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.barang', 'barang', 'Mohon maaf ada kesalahan dibagian pengajuan pinjaman sarana dan prasarana');
        }
    }

    public function contact(Request $request): RedirectResponse
    {
        try {
            $this->contactRepositories($this->requestContact($request));
            return $this->redirectSuccess('sisarpas.landing', 'Berhasil Kirim Kontak');
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectErrorNoParams('sisarpas.landing', 'Maaf ada kesalahan dibagian kirim kontak');
        }
    }

    private function requestContact($request)
    {
        return $request->only('email', 'message');
    }

    private function viewBarang($barang)
    {
        return view('sisarpas.landing.peminjaman.alat_barang', compact('barang'));
    }

    private function listBarang($kategori)
    {
        return $this->listBarangRepositories($kategori);
    }

    private function cariBarang($cari_barang)
    {
        return $this->cariBarangRepositories($cari_barang);
    }
    /**
     * end::page alat barang dan aula
     */


    /**
     * begin::transaction pinjam
     */
    public function pinjam($id)
    {
        try {
            if (!$this->checkIDBarang($id)) {
                return $this->redirectError('peminjaman.barang', 'barang', 'id transaction barang tidak ditemukan');
            }

            if ($this->checkIDBarang($id)) {
                if ($this->getBarangBYID($id)['status_barang'] == 'maintenance') {
                    return $this->redirectError('peminjaman.barang', 'barang', 'barang tidak boleh dipinjam dikarenakan sedang maintenance');
                }
                if ($this->getBarangBYID($id)['status_barang'] == 'not-ready') {
                    return $this->redirectError('peminjaman.barang', 'barang', 'barang belum siap untuk di pinjam');
                }

                if ($this->getBarangBYID($id)['status_barang'] != 'not-ready' &&  $this->getBarangBYID($id)['status_barang'] != 'maintenance') {
                    return $this->viewTransactionPinjamBYID($this->getBarangBYID($id), $this->listDaftarPeminjam($id));
                }
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.barang', 'barang', 'Mohon maaf ada kesalahan dibagian transaction peminjaman barang/aula');
        }
    }

    public function doTransactionPinjam(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->doTransactionPinjamRepositories($this->requestSubmitTransactionPinjam($request));
            DB::commit();
            $this->logSuccess($this->dataLogSuccess('telah berhasil melakukan transaction pinjam barang'));
            return $this->redirectSuccess('user.dashboard-peminjaman', 'Berhasil Melakukan Transaction Barang');
        } catch (\Exception $errors) {
            DB::rollBack();
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.barang', 'barang', 'Mohon maaf ada kesalahan dibagian transaction peminjaman barang/aula');
        }
    }


    private function listDaftarPeminjam($id)
    {
        return $this->listDaftarPeminjamRepositories($id);
    }

    private function checkIDBarang($id): bool
    {
        return $this->checkIDBarangRepositories($id);
    }

    private function getBarangBYID($id)
    {
        return $this->getBarangBYIDRepositories($id);
    }

    private function viewTransactionPinjamBYID($id, $listDaftarPeminjam): View
    {
        return view('sisarpas.landing.peminjaman.transaction.pinjam_barang', compact('id', 'listDaftarPeminjam'));
    }

    private function requestTransactionFilePendukung($request)
    {
        $file_pendukung = $request->file('dokumen_pendukung');
        $namaFile = date('Y-m-d H:i:s') . "_" . $file_pendukung->getClientOriginalName();
        $destination_upload = "sisarpas/assets/file_pendukung";
        $file_pendukung->move($destination_upload, $namaFile);
        return $namaFile;
    }

    private function requestTransactionPinjam($request)
    {
        return $request->only('id', 'barangs_id', 'users_id', 'tanggal_pinjam', 'tanggal_pengembalian', 'kategori_pinjam', 'tujuan_pinjam', 'keterangan_pinjam', 'dokumen_pendukung', 'status_pinjam');
    }

    private function requestSubmitTransactionPinjam($request)
    {
        $req = $this->requestTransactionPinjam($request);
        $req['dokumen_pendukung'] = $this->requestTransactionFilePendukung($request);
        $req['id'] = uniqid();
        return $req;
    }
}
