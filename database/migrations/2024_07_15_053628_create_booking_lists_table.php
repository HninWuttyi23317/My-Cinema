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
        Schema::create('booking_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('movie_id');
            $table->integer('theater_id');
            $table->integer('showtime_id');
            $table->string('seat_name');
            $table->integer('total_price');
            $table->string('booking_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_lists');
    }
};
