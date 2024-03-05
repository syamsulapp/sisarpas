<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Successlog extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'route', 'created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];
}
