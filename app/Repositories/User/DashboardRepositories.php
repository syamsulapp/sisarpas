<?php

namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Interface\User\DashboardInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DashboardRepositories extends FormRequest implements DashboardInterface
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
