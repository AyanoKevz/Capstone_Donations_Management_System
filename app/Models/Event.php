<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'event_name',
        'event_description',
        'event_date',
        'task_reference'
    ];

    public function declinedTask()
    {
        return $this->belongsTo(VolunteerActivity::class, 'task_reference');
    }


    public function volunteerActivities()
    {
        return $this->hasMany(VolunteerActivity::class, 'event_id');
    }
}
