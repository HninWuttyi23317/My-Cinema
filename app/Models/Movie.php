<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_title',
        'image',
        'duration',
        'cast',
        'director',
        'genre_id',
        'description',
        'trailer',
        'release_date'
    ];

    public function showtimes():HasMany
    {
        return $this->hasMany(ShowTimes::class);
    }
}
