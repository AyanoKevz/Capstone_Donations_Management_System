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
        'category',
        'item',
        'quantity',
        'expiration_date',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
