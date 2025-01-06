<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'volunteer_appointment';

    protected $fillable = [
        'volunteer_id',
        'appointment_date',
        'appointment_time',
    ];

    public $timestamps = true;

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
}
