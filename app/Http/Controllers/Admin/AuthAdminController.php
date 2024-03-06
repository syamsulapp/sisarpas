<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Errorlog;
use App\Models\Successlog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Admin\AuthAdminRepositories;

class AuthAdminController extends Controller
{
    public function login()
    {
        if (!Auth::guard('admin')->check()) {
            return view('sisarpas.auth.admin.login');
        }
        return redirect()->route('admin.dashboard');
    }

    public function doLogin(AuthAdminRepositories $authAdminRepositories)
    {
        try {
            /**
             * cek terlebih dahulu credential login(email dan password)
             * jika benar maka lanjut jalankan fungsi login akan tetapi jika salah
             * maka akan di kembalikan ke halaman login dengan pesan error yaitu email atau password salah
             */
            $credential = $authAdminRepositories->loginRepositories();
            if (Auth::guard('admin')->attempt($credential)) {
                $login = Auth::getProvider()->retrieveByCredentials($credential);
                Auth::guard('admin')->login($login);
                /**
                 * setelah login ambil data admin berdasarkan session login
                 * simpan informasi sukses login kedalam logs sukses dan arahkan admin ke halaman dashboard admin
                 */
                $admin = Auth::guard('admin')->user();
                $mapSuccessLog = array('message' => "admin atas nama {$admin->name} berhasil login", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
                Successlog::create($mapSuccessLog);
                return redirect()->intended('admin/dashboard');
            } else {
                Session::flash('error', 'Email Atau Password Salah');
                return redirect()->route('admin.login');
            }
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            return Errorlog::create($mapErrorLogs);
        }
    }

    public function doLogout()
    {
        /**
         * masukan informasi dari admin yang logout di log success agar dapat diketahui admin siapa yang logout
         * jalankan fungsi logout untuk keluar sistem(admin) dan setelah logout berhasil selanjutnya arahkan ke halaman admin
         */
        try {
            $admin_logout = Auth::guard('admin')->user();
            $mapSuccessLog = array('message' => "admin atas nama {$admin_logout->name} berhasil logout", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
            Auth::guard('admin')->logout();
            Session::flash('success', 'Berhasil Logout Dari Admin');
            return Redirect::route('admin.login');
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            return Errorlog::create($mapErrorLogs);
        }
    }
}
