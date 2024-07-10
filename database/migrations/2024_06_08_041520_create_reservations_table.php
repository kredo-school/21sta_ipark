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
            $table->string('parking_slot_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->string('fee');
            $table->time('planning_time_from');
            $table->time('planning_time_to');
            $table->time('actual_start_time')->nullable();
            $table->time('actual_end_time')->nullable();
            $table->string('car_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parking_place_id')->references('id')->on('parking_places');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('users');
    }
};
