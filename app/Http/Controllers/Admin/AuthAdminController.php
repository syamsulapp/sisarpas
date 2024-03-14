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
    /**
     * begin::login
     */
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
            if (!$this->checkCredentialAdmin($authAdminRepositories->loginRepositories())) {
                return $this->flashErrorLogin();
            } else {
                $session = $this->generateSessionAdmin();
                Successlog::create($this->logSuccessLogin($session));
                return $this->redirectSuccessLogin();
            }
        } catch (\Exception $errors) {
            Errorlog::create($this->logErrorLogin($errors));
            return $this->redirectErrorLogin();
        }
    }

    private function checkCredentialAdmin($credential)
    {
        if (Auth::guard('admin')->attempt($credential)) {
            return true;
        }
        return false;
    }

    private function generateSessionAdmin()
    {
        return Auth::guard('admin')->user();
    }

    private function redirectSuccessLogin()
    {
        return redirect()->intended('admin/dashboard');
    }

    private function flashErrorLogin()
    {
        Session::flash('error', 'Email Atau Password Salah');
        return redirect()->route('admin.login');
    }

    private function redirectErrorLogin()
    {
        Session::flash('error', 'Maaf ada kesalahan pada login admin');
        return redirect()->route('admin.login');
    }

    private function logSuccessLogin($admin): array
    {
        return array('message' => "admin atas nama {$admin->name} berhasil login", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function logErrorLogin($errors): array
    {
        return array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    /**
     * end::login
     */

    /**
     * begin::logout
     */

    public function doLogout(AuthAdminRepositories $authAdminRepositories)
    {
        try {
            Successlog::create($this->logSuccessLogout($this->getSessionAdmin()));
            $authAdminRepositories->logoutRepositories();
            return $this->redirectResponseAfterLogoutSuccess();
        } catch (\Exception $errors) {
            Errorlog::create($this->logErrorLogout($errors));
            return $this->redirectResponseAfterLogoutError();
        }
    }

    private function getSessionAdmin()
    {
        return Auth::guard('admin')->user();
    }

    private function logSuccessLogout($admin_logout): array
    {
        return array('message' => "admin atas nama {$admin_logout->name} berhasil logout", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function logErrorLogout($errors): array
    {
        return array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function redirectResponseAfterLogoutSuccess()
    {
        Session::flash('success', 'Berhasil Logout Dari Admin');
        return Redirect::route('admin.login');
    }

    private function redirectResponseAfterLogoutError()
    {
        Session::flash('error', 'Maaf sistem logout sedang bermasalah');
        return Redirect::route('admin.dashboard');
    }

    /**
     * end::logout
     */
}
