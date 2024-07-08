<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class parking_placesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parking_places')->insert([
            'parking_place_name' => 'Arakawa 3rd Street',
            'postal_code' => '116-0002',
            'city' => 'Arakawa',
            'street' => '3-22 Arakawa',
            'max_number' => '2',
            'daytime_from' => '08:00',
            'daytime_to' => '19:00',
            'image' => 'https://i.pinimg.com/originals/3c/8d/3d/3c8d3d68888888888888888888888888.jpg',
            'contact_number' => '080-1234-5678',
<<<<<<< HEAD
=======
            'weekday_daytime_amount' => '220',
            'weekday_night_amount' => '110',
            'holiday_daytime_amount' => '220',
            'holiday_night_amount' => '110',
            'maximum_amount' => '1320',
            'penalty_amount' => '2000',
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parking_places')->insert([
            'parking_place_name' => 'Shinjuku Kabukicho',
            'postal_code' => '160-0021',
            'city' => 'Shinjuku',
            'street' => '1-20 kabukicho',
            'max_number' => '28',
            'daytime_from' => '00:00',
            'daytime_to' => '24:00',
            'image' => 'https://i.pinimg.com/originals/3c/8d/3d/3c8d3d68888888888888888888888888.jpg',
            'contact_number' => '080-1234-5678',
<<<<<<< HEAD
=======
            'weekday_daytime_amount' => '250',
            'weekday_night_amount' => '250',
            'holiday_daytime_amount' => '250',
            'holiday_night_amount' => '250',
            'maximum_amount' => '1300',
            'penalty_amount' => '2000',
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parking_places')->insert([
            'parking_place_name' => 'Shiba Park 2nd Street',
            'postal_code' => '105-0014',
            'city' => 'Minato',
            'street' => '2-9 Shiba Park',
            'max_number' => '9',
            'daytime_from' => '08:00',
            'daytime_to' => '18:00',
            'image' => 'https://i.pinimg.com/originals/3c/8d/3d/3c8d3d68888888888888888888888888.jpg',
            'contact_number' => '080-1234-5678',
<<<<<<< HEAD
=======
            'weekday_daytime_amount' => '990',
            'weekday_night_amount' => '990',
            'holiday_daytime_amount' => '990',
            'holiday_night_amount' => '990',
            'maximum_amount' => '4000',
            'penalty_amount' => '2000',
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('parking_places')->insert([
            'parking_place_name' => 'Dogenzaka Street',
            'postal_code' => '150-0043',
            'city' => 'Shibuya',
            'street' => '2-25 Dogenzaka',
            'max_number' => '128',
            'daytime_from' => '00:00',
            'daytime_to' => '24:00',
            'image' => 'https://i.pinimg.com/originals/3c/8d/3d/3c8d3d68888888888888888888888888.jpg',
            'contact_number' => '080-1234-5678',
<<<<<<< HEAD
=======
            'weekday_daytime_amount' => '400',
            'weekday_night_amount' => '400',
            'holiday_daytime_amount' => '400',
            'holiday_night_amount' => '400',
            'maximum_amount' => '1500',
            'penalty_amount' => '2000',
>>>>>>> c7cdff2c3c131fb7cb30d0cf8444de430e967c4b
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
