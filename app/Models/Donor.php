<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $table = 'donor';

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
        'location_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
