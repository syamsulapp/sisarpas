<?php

namespace App\Repositories\Admin;

use Illuminate\Support\Facades\Auth;
use App\Interface\Admin\AuthAdminInterface;
use Illuminate\Foundation\Http\FormRequest;

class AuthAdminRepositories extends FormRequest implements AuthAdminInterface
{
    public function rules(): array
    {
        if (request()->is('admin/auth/login')) { //login admin
            return [
                'email' => 'required|email',
                'password' => 'required',
            ];
        } else {
            return [];
        }
    }

    public function messages(): array //custom message validation for admin
    {
        return [
            'required' => ':attribute wajib di isi',
            'same' => 'password tidak sama',
            'min' => ':attribute minimal 8 karakter',
            'unique' => ':attribute sudah ada'
        ];
    }

    public function loginRepositories()
    {
        return request()->only('email', 'password');
    }

    public function logoutRepositories(): void
    {
        Auth::guard('admin')->logout();
    }
}
