<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'movie_id',
        'theater_id',
        'showtime_id',
        'seat_price',
        'seat_name'
    ];
}
