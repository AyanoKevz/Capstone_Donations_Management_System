<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PooledResource extends Model
{
    use HasFactory;

    protected $table = 'pooled_resources';

    protected $fillable = [
        'resource_type',
        'quantity',
        'chapter_id',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
