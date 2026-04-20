<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'business_name',
        'address',
        'city',
        'phone',
        'category',
        'latitude',
        'longitude',
        'rating',
        'user_ratings_total',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'rating' => 'float',
            'user_ratings_total' => 'integer',
        ];
    }
}
