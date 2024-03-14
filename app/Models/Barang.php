<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'id_barang',
        'nama_barang', 'jumlah_barang',
        'kondisi_barang', 'kategori_barang',
        'detail_barang', 'spesifikasi_barang',
        'gambar_barang', 'status_barang',
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    use HasFactory;
}
