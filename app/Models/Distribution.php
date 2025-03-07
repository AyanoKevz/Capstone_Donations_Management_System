<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $table = 'distribution'; // Explicitly defining table name

    protected $fillable = [
        'donation_request_id',
        'chapter_id',
        'distributed_by_admin_id',
        'distributed_at',
        'distribution_type'
    ];

    // Relationship with DistributionItem
    public function distributionItems()
    {
        return $this->hasMany(DistributionItem::class);
    }

    // Relationship with DistributionFund
    public function distributionFunds()
    {
        return $this->hasMany(DistributionFund::class);
    }

    // Relationship with VolunteerActivity (if still needed)
    public function volunteerActivities()
    {
        return $this->hasMany(VolunteerActivity::class);
    }
}
