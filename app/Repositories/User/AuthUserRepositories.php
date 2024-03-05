<?php

namespace App\Repositories\User;

use App\Interface\User\AuthUserInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AuthUserRepositories extends FormRequest implements AuthUserInterface
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
