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
        'last_name',
        'contact',
        'gender',
        'id_type',
        'id_image',
        'user_photo',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'donor_id');
    }

    public function cashDonations()
    {
        return $this->hasMany(CashDonation::class, 'donor_id');
    }
}
