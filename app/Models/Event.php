<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event'; // Explicitly defining table name

    protected $fillable = [
        'event_name',
        'event_description',
        'event_date'
    ];

    public function volunteerActivities()
    {
        return $this->hasMany(VolunteerActivity::class);
    }
}
