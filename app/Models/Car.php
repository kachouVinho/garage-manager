<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'price',
        'status',
        'image',
        'description',
        'kilometers',
        'color',
        'fuel_type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'kilometers' => 'integer',
    ];

    public function getStatusBadgeAttribute()
    {
        // logic to return status badge
    }

    public function getImageUrlAttribute()
    {
        // logic to return image URL
    }
}