<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\AuthAdminInterface;
use Illuminate\Foundation\Http\FormRequest;

class AuthAdminRepositories extends FormRequest implements AuthAdminInterface
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    public function loginRepositories(): void
    {
    }
}
