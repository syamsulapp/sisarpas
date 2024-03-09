<?php

namespace App\Repositories\Admin;

use App\Interface\Admin\DashboardInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DashboardRepositories extends FormRequest implements DashboardInterface
{
    public function rules(): array
    {
        if (request()->is('admin/dashboard/master_data/landing/create')) {
            return [
                'file' => 'required|file|mimes:jpg,png,jpeg',
                'type' => 'required|string|in:image,video',
                'status' => 'required|string|in:hide,unhide',
            ];
        } else {
            return [];
        }
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib di isi',
            'file' => ':attribute harus file',
            'mimes' => ':attribute yang diupload harus jenis jpg,png,jpeg',
            'in' => ':attribute hanya 2 jenis yaitu image dan video',
        ];
    }

    public function createLandingRepositories(): void
    {
    }
}
