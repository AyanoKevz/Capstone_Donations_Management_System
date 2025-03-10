<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    use HasFactory;

    protected $table = 'fund_request';

    protected $fillable = [
        'created_by_admin_id',
        'location_id',
        'cause',
        'urgency',
        'amount_needed',
        'description',
        'proof_photo_1',
        'proof_photo_2',
        'proof_video',
        'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by_admin_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function cashDonations()
    {
        return $this->hasMany(CashDonation::class, 'fund_request_id');
    }
}
