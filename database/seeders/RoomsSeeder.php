<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'id' => 1,
                'name' => 'Digital Room Meeting',
                'capacity' => 50,
                'location' => 'PVJ',
                'description' => "nice for meeting everytime , have ac and have digital board \r\n",
                'created_at' => '2025-11-21 11:41:25',
                'updated_at' => '2025-11-22 11:41:23',
            ],
        ]);
    }
}
