<?php

namespace App\Repositories;

use App\Interface\LandingInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class LandingRepositories extends FormRequest implements LandingInterface
{
    public function rules(): array //set validation rules
    {
        return [];
    }

    public function messages(): array // message custom of validation rules
    {
        return [];
    }

    public function indexRepositories(): View
    {
        return view('sisarpas.landing.index');
    }
}
