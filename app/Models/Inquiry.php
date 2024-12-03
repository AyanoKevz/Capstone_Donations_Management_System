<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiry';
    public $timestamps = false;
    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'email',
        'contact',
        'subject',
        'message',
        'status',
        'submitted_at',
    ];
}
