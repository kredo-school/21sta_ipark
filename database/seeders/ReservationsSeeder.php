<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            'parking_place_id' => '1',
            'parking_slot_id' => '1',
            'user_id' => '1',
            'date' => '2024-07-21',
            'fee' => '1500',
            'planning_time_from' => '14:00',
            'planning_time_to' => '16:00',
            'actual_start_time' => '14:05',
            'actual_end_time' => '15:55',
            'car_type' => 'standard',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('reservations')->insert([
            'parking_place_id' => '1',
            'parking_slot_id' => '2',
            'user_id' => '1',
            'date' => '2024-07-22',
            'fee' => '1500',
            'planning_time_from' => '16:00',
            'planning_time_to' => '18:00',
            'car_type' => 'standard',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
