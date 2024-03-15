<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangpinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'barangs_id',
        'users_id',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'kategori_pinjam',
        'tujuan_pinjam',
        'keterangan_pinjam',
        'dokumen_pendukung',
        'status_pinjam',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'string',
        'barangs_id' => 'string',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];
}
