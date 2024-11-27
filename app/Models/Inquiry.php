<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    public $timestamps = false;
    protected $primaryKey = 'inquiry_id';
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
