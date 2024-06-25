<?php

namespace Database\Seeders;

use App\Models\Reservations;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(parking_placesTableSeeder::class);

        $this->call(ReviewSeeder::class);

        $this->call(ParkingSlotsSeeder::class);

        $this->call(ReservationsSeeder::class);
    }
}
