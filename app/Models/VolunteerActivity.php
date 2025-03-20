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
        'activity_date', // Added this
        'task_description',
        'hours_worked',
        'event_id',
        'distribution_id',
        'status',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }

    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Relationship with Distribution
    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id');
    }
}
