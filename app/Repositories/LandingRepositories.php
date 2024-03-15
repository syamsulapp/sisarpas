<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Interface\LandingInterface;
use Illuminate\Foundation\Http\FormRequest;

class LandingRepositories extends FormRequest implements LandingInterface
{
    public function rules(): array //set validation rules
    {
        if (request()->is('contact')) {
            return [
                'email' => 'required|email',
                'message' => 'required|string'
            ];
        } else {
            return [];
        }
    }

    public function messages(): array // message custom of validation rules
    {
        return [
            'required' => ':attribute wajib di isi',
            'email' => ':attribute penulisan salah',
            'string' => ':attribute harus string'
        ];
    }

    public function contactRepositories($request): void
    {
        Contact::create($request);
    }

    /**
     * begin::transaction pinjam
     */
    public function doPinjamRepositories(): void
    {
    }
    /**
     * end::transaction pinjam
     */
}
