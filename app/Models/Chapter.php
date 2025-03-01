<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';

    protected $fillable = [
        'chapter_name',
        'address',
        'region',
        'latitude',
        'longitude',
    ];

    public $timestamps = true;

    // Relationships
    public function volunteers()
    {
        return $this->hasMany(Volunteer::class, 'chapter_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'chapter_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function pooledResources()
    {
        return $this->hasMany(PooledResource::class);
    }

    public function cashDonations()
    {
        return $this->hasMany(CashDonation::class, 'chapter_id');
    }

    public function fundRequests()
    {
        return $this->hasMany(FundRequest::class, 'chapter_id');
    }

    public function pooledFunds()
    {
        return $this->hasOne(PooledFund::class, 'chapter_id');
    }
}
