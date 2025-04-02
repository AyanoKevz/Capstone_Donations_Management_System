<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerActivity extends Model
{
    use HasFactory;

    protected $table = 'volunteer_activity';

    protected $fillable = [
        'volunteer_id',
        'donation_id',
        'distribution_id', // only for distribution activity
        'activity_date',
        'task_description',
        'hours_worked', // total hours worked by the volunteer for that activity
        'status',
        'proof_image',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }

    // Relationship with Donation
    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }

    // Relationship with Distribution
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id');
    }
}
