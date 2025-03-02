<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerActivity extends Model
{
    use HasFactory;

    protected $table = 'volunteer_activity';

    protected $fillable = [
        'task_description',
        'hours_worked',
        'created_at',
        'updated_at',
    ];
}
