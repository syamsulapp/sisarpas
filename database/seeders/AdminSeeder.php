<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nama_admin = ['admin_umum', 'admin_prasarana'];
        $email_admin = ['adminumum@gmail.com', 'adminprasarana@gmail.com'];
        for ($x = 0; $x <= 1; $x++) {
            DB::table('admins')->insert([
                'name' => $nama_admin[$x],
                'email' => $email_admin[$x],
                'password' => Hash::make('12345'),
                'roles_id' => 1,
                'created_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')),
                'updated_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')),
            ]);
        }
    }
}
