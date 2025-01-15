<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonial';

    protected $fillable = [
        'user_id',
        'user_type',
        'content',
        'rating',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }
}
