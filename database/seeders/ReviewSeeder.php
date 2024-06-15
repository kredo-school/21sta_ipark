<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reviews')->insert([
            'parking_place_id' => '1',
            'user_id' => '1',
            'comment' => 'Comment Comment Comment Comment Comment Comment Comment Comment1',
            'star' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('reviews')->insert([
            'parking_place_id' => '1',
            'user_id' => '1',
            'comment' => 'Comment Comment Comment Comment Comment Comment Comment Comment2',
            'star' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('reviews')->insert([
            'parking_place_id' => '1',
            'user_id' => '1',
            'comment' => 'Comment Comment Comment Comment Comment Comment Comment Comment3',
            'star' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('reviews')->insert([
            'parking_place_id' => '1',
            'user_id' => '1',
            'comment' => 'Comment Comment Comment Comment Comment Comment Comment Comment4',
            'star' => '4',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('reviews')->insert([
            'parking_place_id' => '1',
            'user_id' => '1',
            'comment' => 'Comment Comment Comment Comment Comment Comment Comment Comment5',
            'star' => '5',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
