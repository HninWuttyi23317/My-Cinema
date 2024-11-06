<?php

namespace Database\Factories;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition()
    {
        static $seatCounter = 1;
        static $rowCounter = 'A';
        static $showtimeCounter = 1;


        if ($seatCounter > 10)
        {
            $seatCounter = 1;
            $rowCounter++;
        }

        if ($showtimeCounter > 10)
        {
            $showtimeCounter = 1;
        }

        $seatName = $rowCounter . $seatCounter;

        // Determine price
        $price = match ($rowCounter) {
            'A' => 3000,
            'B' => 4000,
            'C' => 3000,
            'D' => 4000,
            'E' => 3000,
            'F' => 4000,
            'G' => 3000,
            'H' => 4000,
            'I' => 3000,
            'J' => 4000,
            'K' => 3000,
            'L' => 4000,
            'M' => 3000,
            'N' => 4000,
            'O' => 3000,
            'P' => 4000,
            'Q' => 3000,
            'R' => 4000,
            'S' => 3000,
            'T' => 4000,
            'U' => 3000,
            'V' => 4000,
            'W' => 3000,
            'X' => 4000,
            default => 5000,
        };

        $seatCounter++;
        $showtimeId = $showtimeCounter++;

        return [
            'seat_name' => $seatName,
            'price' => $price,
            'showtime_id' => $showtimeId,
            'theater_id' => 1,
        ];
    }
}
