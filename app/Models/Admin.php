<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['name', 'email', 'password', 'image', 'roles_id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s'
    ];

    public function roles_id(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'roles_id'); //roles_id dari table admin ke id table roles
    }

    public function authAdmin()
    {
        return Auth::guard('admin')->user();
    }
}
