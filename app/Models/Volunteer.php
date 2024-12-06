<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $table = 'volunteer';

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'contact',
        'birthday',
        'gender',
        'id_type',
        'id_image',
        'user_photo',
        'pref_services',
        'availability',
        'availability_time',
        'educ_prof',
        'studying',
        'employed',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }
}
