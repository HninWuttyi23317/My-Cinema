<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'movie_id',
        'theater_id',
        'showtime_id',
        'seat_name',
        'booking_code',
        'total_price',
        'status'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seat():BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function showtime():BelongsTo
    {
        return $this->belongsTo(ShowTimes::class);
    }
}
