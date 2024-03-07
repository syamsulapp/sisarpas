<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_nama = ['admin', 'user'];
        $role_desc = ['roles ini adalah admin', 'roles ini adalah user'];
        for ($x = 0; $x <= 1; $x++) {
            DB::table('roles')->insert([
                'nama_roles' => $role_nama[$x],
                'description_roles' => $role_desc[$x],
                'created_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')),
                'updated_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')),
            ]);
        }
    }
}
