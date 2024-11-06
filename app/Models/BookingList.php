<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingList extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'movie_id',
        'theater_id',
        'showtime_id',
        'seat_name',
        'booking_code',
        'total_price'
    ];
}
