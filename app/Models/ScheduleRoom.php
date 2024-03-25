<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScheduleRoom extends Model
{
    protected $table = 'schedule_room';

    protected $fillable = ['barangs_id', 'start_at', 'end_at', 'created_at', 'updated_at'];

    protected $casts = [
        'barangs_id' => 'string',
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];
    use HasFactory;

    public function barangs(): HasOne
    {
        return $this->hasOne(Barang::class, 'id', 'barangs_id');
    }
}
