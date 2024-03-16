<?php

namespace App\Repositories\User;

use App\Models\Barangpinjam;
use App\Interface\User\DashboardInterface;
use Illuminate\Foundation\Http\FormRequest;

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

    protected function listPeminjamanRepositories($id)
    {
        return Barangpinjam::where('users_id', $id)
            ->orderByDesc('id')
            ->with(['users', 'barangs'])
            ->get();
    }
}
