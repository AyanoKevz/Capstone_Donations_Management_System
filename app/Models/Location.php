<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'location';

    protected $fillable = [
        'region',
        'province',
        'city_municipality',
        'barangay',
        'full_address',
        'latitude',
        'longitude',
    ];
}
