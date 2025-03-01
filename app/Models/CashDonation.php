<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDonation extends Model
{
    use HasFactory;

    protected $table = 'cash_donation';

    protected $fillable = [
        'donor_id',
        'donor_name',
        'chapter_id',
        'fund_request_id',
        'amount',
        'donation_method',
        'payment_method',
        'proof_payment',
        'transaction_reference',
        'status',
        'cause',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function fundRequest()
    {
        return $this->belongsTo(FundRequest::class, 'fund_request_id');
    }
}
