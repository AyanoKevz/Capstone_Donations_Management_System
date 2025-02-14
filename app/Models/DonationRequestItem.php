<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequestItem extends Model
{
    use HasFactory;

    protected $table = 'donation_request_items';

    protected $fillable = [
        'donation_request_id',
        'category',
        'item',
        'quantity',
    ];

    public $timestamps = false;

    public function donationRequest()
    {
        return $this->belongsTo(DonationRequest::class);
    }
}
