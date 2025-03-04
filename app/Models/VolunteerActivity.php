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
        'task_description',
        'hours_worked',
        'event_id',
        'distribution_id'
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class)->withDefault();
    }

    public function distribution()
    {
        return $this->belongsTo(Distribution::class)->withDefault();
    }
}
