<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'alamat_gedung',
        'nomor_telpon',
        'email',
        'nama_gedung',
        'facebook',
        'instagram',
        'youtube',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $cast = [
        'created_at' => 'date:Y-m-d H:i:s',
        'created_at' => 'date:Y-m-d H:i:s',
    ];
    use HasFactory;
}
