<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nama_user = ['user_umum', 'user_peminjaman'];
        $email_user = ['userumum@gmail.com', 'userpeminjaman@gmail.com'];
        for ($x = 0; $x <= 1; $x++) {
            DB::table('users')->insert([
                'name' => $nama_user[$x],
                'email' => $email_user[$x],
                'password' => Hash::make('12345'),
                'roles_id' => 1,
                'created_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')),
                'updated_at' => Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')),
            ]);
        }
    }
}
