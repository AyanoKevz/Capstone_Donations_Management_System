<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $table = 'user_account';

    protected $fillable = [
        'username',
        'email',
        'password',
        'account_type',
        'is_verified',
    ];

    // Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function donor()
    {
        return $this->hasOne(Donor::class, 'user_id');
    }

    public function donee()
    {
        return $this->hasOne(Donee::class, 'user_id');
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class, 'user_id');
    }
}
