<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi_penting extends Model
{
    protected $fillable = ['judul_informasi', 'isi_informasi', 'gambar_informasi', 'status', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'isi_informasi' => 'string',
    ];

    use HasFactory;
}
