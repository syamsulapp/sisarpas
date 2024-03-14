<?php

namespace App\Http\Controllers\Landing;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barang;
use App\Models\Landing;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\LandingRepositories;
use Illuminate\Http\Request;

class LandingControllers extends Controller
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

    private function redirectError($route, $message): RedirectResponse
    {
        Session::flash("error", $message);
        return Redirect::route($route);
    }

    /**
     * end::logging and redirect response
     */
    public function index(LandingRepositories $landingRepositories)
    {
        $landing = Landing::where([['status', '=', 'unhide'], ['type', '=', 'image']])->orderByDesc('id')->limit(1)->get();
        return $landingRepositories->indexRepositories($landing);
    }

    public function alat_barang($kategori)
    {
        try {
            return $this->viewBarang($this->listBarang($kategori));
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.alat_barang', 'Mohon maaf ada kesalahan dibagian search barang');
        }
    }

    public function cari_barang(Request $request)
    {
        try {
            return $this->viewBarang($this->cariBarang($request));
        } catch (\Exception $errors) {
            $this->logError($this->dataLogError($errors->getMessage()));
            return $this->redirectError('peminjaman.alat_barang', 'Mohon maaf ada kesalahan dibagian pengajuan pinjaman sarana dan prasarana');
        }
    }

    public function contact(LandingRepositories $landingRepositories): RedirectResponse
    {
        $landingRepositories->contactRepositories();
        Session::flash('success', 'Berhasil Kirim Kontak');
        return Redirect::route('sisarpas.landing');
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
            })->get();
        return $barang;
    }

    private function cariBarang($request)
    {
        $cari_barang = Barang::orderByDesc('id')
            ->when($request->cari, function ($model) use ($request) {
                $model->where('nama_barang', 'like', "%{$request->cari}%");
            })->get();
        return $cari_barang;
    }
}
