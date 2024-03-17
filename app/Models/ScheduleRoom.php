<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleRoom extends Model
{
    protected $table = 'schedule_room';

    protected $fillable = ['barangs_id', 'start_at', 'end_at', 'created_at', 'updated_at'];

    protected $casts = [
        'barangs_id' => 'string',
        'created_at' => 'date',
        'updated_at' => 'date',
    ];
    use HasFactory;
}
