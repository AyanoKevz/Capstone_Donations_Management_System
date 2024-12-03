<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
