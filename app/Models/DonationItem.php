<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationItem extends Model
{
    use HasFactory;

    protected $table = 'donation_items';

    protected $fillable = [
        'donation_id',
        'donation_request_id',
        'category',
        'item',
        'quantity',
        'status',


    ];

    public $timestamps = false;

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function donationRequest()
    {
        return $this->belongsTo(DonationRequest::class, 'donation_request_id');
    }
}
