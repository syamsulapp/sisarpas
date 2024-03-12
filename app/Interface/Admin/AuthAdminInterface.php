<?php

namespace App\Interface\Admin;

use Illuminate\Foundation\Http\FormRequest;

interface AuthAdminInterface
{
    public function loginRepositories();
    public function logoutRepositories(): void;
}
