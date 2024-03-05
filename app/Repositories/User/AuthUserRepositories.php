<?php

namespace App\Repositories\User;

use App\Interface\User\AuthUserInterface;
use App\Models\Errorlog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthUserRepositories extends FormRequest implements AuthUserInterface
{
    public function rules(): array //validation rules
    {
        if (request()->isMethod('post')) {
            return [];
        } else if (request()->isMethod('patch')) {
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

    public function loginRepositories(): void
    {
    }

    public function registerRepositories(): void
    {
        DB::beginTransaction();
        try {
            $req_regis = request()->only('nama_user', 'nim_user', 'email_user', 'password_user', 'roles_id');
            $req_regis['password_user'] = Hash::make($req_regis['password_user']);
            $req_regis['roles_id'] = 2;
            User::create($req_regis);
            DB::commit();
        } catch (\Exception $erros) {
            DB::rollBack();
            $mapLog = array('message' => $erros->getMessage(), 'route' => request()->route()->getName(), 'created_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapLog);
        }
    }
}
