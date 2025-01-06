<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapter';

    protected $fillable = [
        'chapter_name',
        'address',
        'region',
        'latitude',
        'longitude',
    ];

    public $timestamps = true;

    // Relationships
    public function volunteers()
    {
        return $this->hasMany(Volunteer::class, 'chapter_id');
    }
}
