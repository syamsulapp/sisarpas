<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Interface\LandingInterface;
use App\Models\Barangpinjam;
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
        } else if (request()->is('user/transaction/pinjam')) {
            return [
                'id' => 'string',
                'barangs_id' => 'required|string',
                'users_id' => 'required|integer',
                'tanggal_pinjam' => 'required|date',
                'kategori_pinjam' => 'required|string',
                'tujuan_pinjam' => 'required|string',
                'keterangan_pinjam' => 'required|string',
                'dokumen_pendukung' => 'required|file|mimes:pdf',
                'status_pinjam' => 'required|string',
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
    public function doPinjamRepositories($request): void
    {
        Barangpinjam::create($request);
    }
    /**
     * end::transaction pinjam
     */
}
