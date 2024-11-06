<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShowTimes extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id',
        'theater_id',
        'show_time'
    ];

    public function movie():BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function theater():BelongsTo
    {
        return $this->belongsTo(Theaters::class);
    }

    public function bookings():HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
