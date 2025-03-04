<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $table = 'distribution'; // Explicitly defining table name

    protected $fillable = [
        'distribution_date',
        'location',
        'distributed_by'
    ];

    public function volunteerActivities()
    {
        return $this->hasMany(VolunteerActivity::class);
    }
}
