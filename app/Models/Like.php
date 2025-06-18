<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = [
        'news_id',
        'ip_address',
        'user_agent',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
