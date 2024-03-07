<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Errorlog;
use App\Http\Controllers\Controller;
use App\Models\Successlog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\AuthUserRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthUserController extends Controller
{
    public function login()
    {
        if (!Auth::guard('user')->check()) {
            return view('sisarpas.auth.user.login');
        }
        return redirect()->route('user.dashboard');
    }

    public function doLogin(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        try {
            /**
             * cek terlebih dahulu credential login(email dan password)
             * jika benar maka lanjut jalankan fungsi login akan tetapi jika salah
             * maka akan di kembalikan ke halaman login dengan pesan error yaitu email atau password salah
             */
            $credential = $authUserRepositories->loginRepositories();
            if (Auth::guard('user')->attempt($credential)) {
                $login = Auth::getProvider()->retrieveByCredentials($credential);
                Auth::guard('user')->login($login);
                /**
                 * setelah login ambil data user berdasarkan session login
                 * simpan informasi sukses login kedalam logs sukses dan arahkan user ke halaman dashboard user
                 */
                $user = Auth::guard('user')->user();
                $mapSuccessLog = array('message' => "user atas nama {$user->name} berhasil login", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
                Successlog::create($mapSuccessLog);
                return redirect()->intended('user/dashboard');
            } else {
                Session::flash('error', 'Email Atau Password Salah');
                return redirect()->route('user.login');
            }
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            return Errorlog::create($mapErrorLogs);
        }
    }

    public function register()
    {
        try {
            if (!Auth::guard('user')->check()) {
                return view('sisarpas.auth.user.register');
            }
            return redirect()->route('user.dashboard');
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            return Errorlog::create($mapErrorLogs);
        }
    }

    public function doRegister(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $authUserRepositories->registerRepositories();
        return redirect()->route('user.login')->with('success', 'Berhasil register');
    }

    public function doLogout(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        /**
         *  setelah logout berhasil selanjutnya arahkan ke halaman login dan memberikan pesan flash success login
         */
        try {
            $authUserRepositories->logoutRepositories();
            Session::flash('success', 'Berhasil Logout Dari User');
            return Redirect::route('user.login');
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            return Errorlog::create($mapErrorLogs);
        }
    }

    public function forgotPass(): View
    {
        return view('sisarpas.auth.user.reset-password.index');
    }

    public function doforgotPass(AuthUserRepositories $authUserRepositories)
    {
        try {
            if (User::where('email', request()->input('email'))->first()) {
                $authUserRepositories->forgotPasswordRepositories();
            } else {
                Session::flash('error', 'Email Anda Tidak Terdaftar');
                return Redirect::route('user.forgot_password');
            }
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            return Errorlog::create($mapErrorLogs);
        }
    }

    public function checkCodeReset(): View
    {
        return view('');
    }

    public function docheckCodeReset()
    {
    }
}
