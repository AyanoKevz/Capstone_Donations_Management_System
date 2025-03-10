<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'location';

    protected $fillable = [
        'user_id',
        'region',
        'province',
        'city_municipality',
        'barangay',
        'full_address',
        'latitude',
        'longitude',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

    public function fundRequests()
    {
        return $this->hasMany(FundRequest::class, 'location_id');
    }
}
