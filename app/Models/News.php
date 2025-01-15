<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'admin_id',
        'subtitle',
        'title',
        'content',
        'image_url_1',
        'image_url_2',
        'posted_at',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
