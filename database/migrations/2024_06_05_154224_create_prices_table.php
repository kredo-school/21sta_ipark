<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->unsignedBigInteger('parking_place_id');
            $table->time('weekday_daytime');
            $table->time('weekday_night');
            $table->time('holiday_daytime');
            $table->time('holiday_night');
            $table->double('maximum_amount');
            $table->double('penalty_amount');

            $table->foreign('parking_place_id')->references('id')->on('parking_places');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
