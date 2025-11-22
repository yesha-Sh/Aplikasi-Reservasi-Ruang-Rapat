<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'admin@office.com',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => '2025-11-21 19:23:31',
                'updated_at' => '2025-11-21 19:23:31',
            ],
            [
                'id' => 2,
                'name' => 'Aditya Mahdar',
                'email' => 'user@office.com',
                'email_verified_at' => null,
                 'password' => Hash::make('password'),
                'role' => 'user',
                'remember_token' => null,
                'created_at' => '2025-11-21 11:39:27',
                'updated_at' => '2025-11-24 11:39:38',
            ],
        ]);
    }
}
