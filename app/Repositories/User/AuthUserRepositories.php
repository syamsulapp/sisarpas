<?php

namespace App\Repositories\User;

use App\Interface\User\AuthUserInterface;
use App\Mail\ForgotPassword;
use App\Models\Errorlog;
use App\Models\Password_reset_token;
use App\Models\Successlog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthUserRepositories extends FormRequest implements AuthUserInterface
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array //validation rules
    {
        if (request()->is('user/auth/login')) { //login user
            return [
                'email' => 'required|email',
                'password' => 'required',
            ];
        } else if (request()->is('user/auth/register')) { //register user
            return [
                'name' => 'required',
                'nim' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password|min:8',
                'roles_id' => 'integer',
            ];
        } else if (request()->is('user/auth/forgot_password')) {
            return [
                'email' => 'required|email',
            ];
        } else if (request()->is('user/auth/reset_password')) { // forgot password
            return [
                'password' => 'required|confirmed|min:8',
            ];
        } else {
            return [];
        }
    }

    public function messages(): array //vustom message validation
    {
        return [
            'required' => ':attribute wajib di isi',
            'same' => 'password tidak sama',
            'min' => ':attribute minimal 8 karakter',
            'unique' => ':attribute sudah ada',
            'confirmed' => 'password tidak sama',
        ];
    }

    public function loginRepositories()
    {
        return request()->only('email', 'password');
    }


    public function registerRepositories($user)
    {
        return User::create($user);
    }

    public function logoutRepositories(): void
    {
        /**
         * masukan informasi dari user yang logout di log success agar dapat diketahui user siapa yang logout
         * jalankan fungsi logout untuk keluar sistem(user)
         */
        $userLogout = Auth::guard('user')->user();
        $mapSuccessLog = array('message' => "user atas nama {$userLogout->name} berhasil logout", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
        Successlog::create($mapSuccessLog);
        Auth::guard('user')->logout();
    }


    /**
     * begin:: reset and change password
     */

    private static function createTokenReset($user)
    {

        $tokens =  Password_reset_token::updateOrCreate(
            [
                'email' => $user->email
            ],
            [
                'email' => $user->email,
                'token' => random_int(100000, 999999)
            ]
        );
        return $tokens;
    }

    public function forgotPasswordRepositories($user): void
    {
        try {
            $link_reset_password = env('APP_URL') . '/' . 'user/auth/check_verify_token'; // link mengarah ke cek token reset password
            Mail::to($user->email)->send(new ForgotPassword($user, $this->createTokenReset($user), $link_reset_password));
            $mapSuccessLog = array('message' => "user atas nama {$user->name} berhasil meminta perubahan password", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
        }
    }

    public function resetPasswordRepositories(): void
    {
        /**
         * cek email dan cek token untuk memastikan kedua parameter reset telah valid
         * jika keduanya valid maka password akun pada user akan di ubah
         * dan token yang digunakan untuk ubah password akan dihapus
         * karena sudah tidak digunakan lagi
         */
        try {
            $user = User::where('email', request()->input('email'))->firstOrFail();
            $user->update(['password' => Hash::make(request()->input('password'))]);
            $token = Password_reset_token::where('token', request()->input('token'))->firstOrFail();
            $mapSuccessLog = array('message' => "Email atas nama {$user->email} berhasil mengubah password dan token: {$token->token} telah di hapus", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            $token->delete();
            Successlog::create($mapSuccessLog);
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
        }
    }
    /**
     * end:: reset and change password
     */
}
