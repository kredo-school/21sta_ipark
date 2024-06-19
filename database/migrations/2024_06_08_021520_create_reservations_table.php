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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parking_place_id');
            $table->unsignedBigInteger('parking_slot_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->time('planning_time_from');
            $table->time('planning_time_to');
            $table->time('actual_start_time');
            $table->time('actual_end_time');
            $table->string('car_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parking_place_id')->references('id')->on('parking_places');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('parking_slot_id')->references('id')->on('parking_slots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
