<?php

namespace App\Repositories\User;

use App\Interface\User\AuthUserInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AuthUserRepositories extends FormRequest implements AuthUserInterface
{
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [];
        } else if (request()->isMethod('patch')) {
            return [];
        } else {
            return [];
        }
    }

    public function messages(): array
    {
        return [];
    }

    public function loginRepositories(): void
    {
    }

    public function registerRepositories(): void
    {
    }
}
