<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Errorlog;
use App\Http\Controllers\Controller;
use App\Models\Password_reset_token;
use App\Models\Successlog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\AuthUserRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * begin::login
     */

    public function doLogin(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        try {
            /**
             * cek terlebih dahulu credential login(email dan password)
             * jika benar maka lanjut jalankan fungsi login akan tetapi jika salah
             * maka akan di kembalikan ke halaman login dengan pesan error yaitu email atau password salah
             */
            if ($this->checkLoginCredential($authUserRepositories->loginRepositories())) {
                $session = $this->generateSessionUsers($authUserRepositories->loginRepositories());
                Successlog::create($this->successLogResponse($session));
                return $this->redirectSuccessLoginUsers();
            } else {
                return $this->flashErrorResponse();
            }
        } catch (\Exception $errors) {
            return $this->errorLogResponse($errors);
        }
    }

    private function flashErrorResponse(): RedirectResponse
    {
        Session::flash('error', 'Email Atau Password Salah');
        return redirect()->route('user.login');
    }

    private function checkLoginCredential($credential): bool
    {
        if (Auth::guard('user')->attempt($credential)) {
            return true;
        }
        return false;
    }

    private function generateSessionUsers($credential)
    {
        $login = Auth::getProvider()->retrieveByCredentials($credential);
        Auth::guard('user')->login($login);
        return Auth::guard('user')->user();
    }

    private function redirectSuccessLoginUsers(): RedirectResponse
    {
        return redirect()->intended('user/dashboard');
    }

    private function successLogResponse($user): array
    {
        return array('message' => "user atas nama {$user->name} berhasil login", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    private function errorLogResponse($errors): array
    {
        return array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
    }

    /**
     * end::login
     */

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

    /**
     * begin::forgot and reset pass
     */

    public function forgotPass(): View
    {
        return view('sisarpas.auth.user.reset-password.index');
    }

    public function doforgotPass(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        if ($user = User::where('email', request()->input('email'))->first()) {
            $authUserRepositories->forgotPasswordRepositories($user);
            Session::flash('success', 'Token Dan Link Reset Password Dikirim Ke Email Anda');
            return Redirect::route('user.forgot_password');
        } else {
            Session::flash('error', 'Email Tidak Terdaftar');
            return Redirect::route('user.forgot_password');
        }
    }

    public function CheckVerifyToken(): View
    {
        return view('sisarpas.auth.user.reset-password.verify_token');
    }

    public function doCheckVerifyToken()
    {
        try {
            /**
             *  gabung setiap input token
             *  ubah string token menjadi integer token
             *  jika token valid maka jalankan fungsi reset password
             *  akan tetapi jika invalid maka menampilkan pesan token invalid
             */
            $token1 = request()->input('token1');
            $token2 = request()->input('token2');
            $token3 = request()->input('token3');
            $token4 = request()->input('token4');
            $token5 = request()->input('token5');
            $token6 = request()->input('token6');
            $getToken = "$token1$token2$token3$token4$token5$token6";
            $intToken = (int)$getToken;
            $token = Password_reset_token::where('token', $intToken)->firstOrFail();
            $mapSuccessLog = array('message' => "Email {$token['email']} token valid dan diarahkan kehalaman reset password", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
            Session::flash('success', 'token benar harap reset password anda');
            return Redirect::route('user.reset_password', $token['token']);
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
            Session::flash('error', 'token invalid credentials');
            return Redirect::route('user.check_verify_token');
        }
    }

    public function resetPass($token)
    {
        /**
         * cek token sebelum melakukan reset password pastikan token benar
         * jika token benar maka akan diarahkan kehalaman reset password
         * akan tetapi jika token invalid maka balik ke halaman input token
         */
        try {
            $token = Password_reset_token::where('token', $token)->firstOrFail();
            return view('sisarpas.auth.user.reset-password.reset_pass', compact('token'));
        } catch (\Exception $error) {
            $mapErrorLogs = array('message' => $error->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
            Session::flash('error', 'token invalid credentials');
            return Redirect::route('user.check_verify_token');
        }
    }


    public function doResetPass(AuthUserRepositories $authUserRepositories): RedirectResponse
    {
        $authUserRepositories->resetPasswordRepositories();
        Session::flash('success', 'Berhasil Ubah Password Harap Login kembali');
        return Redirect::route('user.login');
    }

    /**
     * end::forgot and reset pass
     */
}
