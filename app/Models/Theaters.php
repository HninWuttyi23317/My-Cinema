<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theaters extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'location',
    ];

    public function showtimes():HasMany
    {
        return $this->hasMany(ShowTimes::class);
    }

    public function seats():HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
