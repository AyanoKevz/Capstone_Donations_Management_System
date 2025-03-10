<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionFund extends Model
{
    use HasFactory;

    protected $table = 'distribution_funds';
    protected $fillable = [
        'distribution_id',
        'fund_request_id',
        'amount'
    ];

    // Relationship with Distribution
    public function distribution()
    {
        return $this->belongsTo(Distribution::class);
    }

    // Relationship with FundRequest
    public function fundRequest()
    {
        return $this->belongsTo(FundRequest::class);
    }
}
