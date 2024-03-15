<?php

namespace App\Repositories;

use App\Models\Barang;
use App\Models\Contact;
use App\Models\Landing;
use App\Models\Barangpinjam;
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

    public function landingRepositories()
    {
        return Landing::where([['status', '=', 'unhide'], ['type', '=', 'image']])->orderByDesc('id')->limit(1)->get();
    }

    /**
     * begin::barang dan aula
     */

    public function listBarangRepositories($kategori)
    {
        $barang = Barang::orderByDesc('id')
            ->when($kategori, function ($model) use ($kategori) {
                $model->where('kategori_barang', $kategori);
            })->limit(10)->get();
        return $barang;
    }

    public function cariBarangRepositories($cari_barang)
    {
        $cari_barang = Barang::orderByDesc('id')
            ->when($cari_barang, function ($model) use ($cari_barang) {
                $model->where('nama_barang', 'like', "%{$cari_barang}%");
            })->limit(10)->get();
        return $cari_barang;
    }

    /**
     * end::barang dan aula
     */

    /**
     * begin::contact
     */

    public function contactRepositories($request): void
    {
        Contact::create($request);
    }

    /**
     * end::contact
     */

    /**
     * begin::transaction pinjam
     */
    public function checkIDBarangRepositories($id): bool
    {
        if (Barang::where('id', $id)->first()) {
            return true;
        }
        return false;
    }

    public function getBarangBYIDRepositories($id)
    {
        return Barang::where('id', $id)->first();
    }

    public function doTransactionPinjamRepositories($request): void
    {
        Barangpinjam::create($request);
    }
    /**
     * end::transaction pinjam
     */
}
