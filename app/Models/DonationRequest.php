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

    public function checkIfFulfilled()
    {
        // Get all requested items
        $allItems = $this->items;

        foreach ($allItems as $item) {
            $donatedQuantity = DonationItem::where('donation_request_id', $this->id)
                ->where('item', $item->item)
                ->whereHas('donation', function ($q) {
                    $q->where('status', '!=', 'pending');
                })
                ->sum('quantity');

            if ($donatedQuantity < $item->quantity) {
                return false;
            }
        }

        // If all items are fulfilled, update status
        $this->status = 'Fulfilled';
        $this->save();
        return true;
    }
}
