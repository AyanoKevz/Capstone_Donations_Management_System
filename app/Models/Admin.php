<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_image',
        'chapter_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    public function news()
    {
        return $this->hasMany(News::class, 'admin_id');
    }

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class, 'created_by_admin_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function fundRequests()
    {
        return $this->hasMany(FundRequest::class, 'created_by_admin_id');
    }
}
