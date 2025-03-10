<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionItem extends Model
{
    use HasFactory;

    protected $table = 'distribution_items'; // Explicitly defining table name

    protected $fillable = [
        'distribution_id',
        'item',
        'quantity',
        'source'
    ];

    // Relationship with Distribution
    public function distribution()
    {
        return $this->belongsTo(Distribution::class);
    }
}
