<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\DashboardInterface;
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

    public function createLandingRepositories(): void
    {
    }
}
