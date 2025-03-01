<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PooledFund extends Model
{
    use HasFactory;

    protected $table = 'pooled_funds';

    protected $fillable = [
        'chapter_id',
        'total_cash',
        'cause',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
