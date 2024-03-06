<?php

namespace App\Repositories\User;

use App\Interface\User\AuthUserInterface;
use App\Models\Errorlog;
use App\Models\Successlog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthUserRepositories extends FormRequest implements AuthUserInterface
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array //validation rules
    {
        if (request()->isMethod('post')) { //login
            return [
                'email_user' => 'required|email',
                'password_user' => 'required',
            ];
        } else if (request()->isMethod('patch')) { //register
            return [
                'nama_user' => 'required',
                'nim_user' => 'required',
                'email_user' => 'required|unique:users,email_user',
                'password_user' => 'required|min:8',
                'confirm_password' => 'required|same:password_user|min:8',
                'roles_id' => 'integer',
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
            'unique' => ':attribute sudah ada'
        ];
    }

    // get credential login
    public function loginRepositories()
    {
        return request()->only('email_user', 'password_user');
    }

    public function logoutRepositories()
    {
    }

    public function registerRepositories(): void
    {
        DB::beginTransaction();
        try {
            $req_regis = request()->only('name', 'nim', 'email', 'password', 'roles_id');
            $req_regis['password'] = Hash::make($req_regis['password']);
            $req_regis['roles_id'] = 2;
            $user = User::create($req_regis);
            $mapSuccessLogs = array('message' => "user dengan ID: {$user->id}, nama: {$user->nama_user} Berhasil Registrasi", 'route' => request()->route()->getName(), 'created_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLogs);
            DB::commit();
        } catch (\Exception $errors) {
            DB::rollBack();
            $mapLogErrors = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapLogErrors);
        }
    }
}
