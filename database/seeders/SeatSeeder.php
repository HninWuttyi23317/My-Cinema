<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    public function run()
    {
        // Seed for 12 showtimes
        for ($i = 1; $i <= 12; $i++) {
            Seat::factory()->count(20)->create([
                'showtime_id' => $i,
            ]);
        }
    }
}
