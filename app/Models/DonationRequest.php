<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    use HasFactory;

    protected $table = 'donation_request';

    protected $fillable = [
        'created_by_admin_id',
        'urgency',
        'cause',
        'description',
        'proof_photo_1',
        'proof_photo_2',
        'proof_video',
        'status',
        'location_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by_admin_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function items()
    {
        return $this->hasMany(DonationRequestItem::class, 'donation_request_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'donation_request_id');
    }

    public function donationItems()
    {
        return $this->hasMany(DonationItem::class, 'donation_request_id');
    }
}
