<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingMovie extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_title',
        'image',
        'cast',
        'director',
        'genre_id'
        ];
}
