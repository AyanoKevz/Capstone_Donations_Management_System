<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donation';

    protected $fillable = [
        'donor_id',
        'donor_name',
        'chapter_id',
        'donation_request_id',
        'cause',
        'donation_method',
        'pickup_address',
        'donation_datetime',
        'status',
        'proof_image',
        'tracking_number',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function donationRequest()
    {
        return $this->belongsTo(DonationRequest::class, 'donation_request_id');
    }

    public function donationItems()
    {
        return $this->hasMany(DonationItem::class);
    }
}
