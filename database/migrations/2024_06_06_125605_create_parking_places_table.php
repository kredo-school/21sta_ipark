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
        Schema::create('parking_places', function (Blueprint $table) {
            $table->id();
            $table->string('parking_place_name');
            $table->string('postal_code');
            $table->string('city');
            $table->string('street');
            $table->integer('max_number');
            $table->time('daytime_from');
            $table->time('daytime_to');
            $table->longText('image');
            $table->string('contact_number');
            $table->double('weekday_daytime_amount');
            $table->double('weekday_night_amount');
            $table->double('holiday_daytime_amount');
            $table->double('holiday_night_amount');
            $table->double('maximum_amount');
            $table->double('penalty_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_places');
    }
};
