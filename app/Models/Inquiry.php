<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiry';
    public $timestamps = false;

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
