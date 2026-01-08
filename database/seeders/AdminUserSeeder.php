<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@umkm.com'], // cek unik
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }
}
