<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable
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

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class, 'user_id');
    }

    public function getRoleNameAttribute()
    {
        return $this->roles->first()?->role_name ?? 'No Role';
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'user_id');
    }
}
