<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'room_id' => 1,
                'date' => '2025-11-22',
                'start_time' => '08:00:00',
                'end_time' => '10:48:00',
                'status' => 'cancelled',
                'created_at' => '2025-11-21 19:46:38',
                'updated_at' => '2025-11-21 19:50:02',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'room_id' => 1,
                'date' => '2025-11-21',
                'start_time' => '08:00:00',
                'end_time' => '09:50:00',
                'status' => 'active',
                'created_at' => '2025-11-22 01:53:49',
                'updated_at' => '2025-11-22 01:53:49',
            ],
        ]);
    }
}
