<?php

namespace App\Http\Controllers\Landing;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Landing;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\LandingRepositories;
use Illuminate\Http\Request;

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
            return $this->viewLanding($this->getLanding());
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
        }
    }

    private function getLanding()
    {
        return Landing::where([['status', '=', 'unhide'], ['type', '=', 'image']])->orderByDesc('id')->limit(1)->get();
    }

    public function viewLanding($landing_image): View
    {
        return view('sisarpas.landing.index', compact('landing_image'));
    }

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
        $barang = Barang::orderByDesc('id')
            ->when($kategori, function ($model) use ($kategori) {
                $model->where('kategori_barang', $kategori);
            })->limit(10)->get();
        return $barang;
    }

    private function cariBarang($cari_barang)
    {
        $cari_barang = Barang::orderByDesc('id')
            ->when($cari_barang, function ($model) use ($cari_barang) {
                $model->where('nama_barang', 'like', "%{$cari_barang}%");
            })->limit(10)->get();
        return $cari_barang;
    }
    /**
     * end::landing
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
                return $this->viewTransactionPinjamBYID($this->getBarangBYID($id));
            }
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.barang', 'barang', 'Mohon maaf ada kesalahan dibagian transaction peminjaman barang/aula');
        }
    }

    public function doPinjam(LandingRepositories $landingRepositories)
    {
        try {
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.barang', 'barang', 'Mohon maaf ada kesalahan dibagian transaction peminjaman barang/aula');
        }
    }


    private function checkIDBarang($id): bool
    {
        if (Barang::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    private function getBarangBYID($id)
    {
        return Barang::where('id', $id)->first();
    }

    private function viewTransactionPinjamBYID($id): View
    {
        return view('sisarpas.landing.peminjaman.transaction.pinjam_barang', compact('id'));
    }

    /**
     * end::transaction pinjam
     */
}
