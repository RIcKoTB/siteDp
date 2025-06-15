<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaLink extends Model
{
    protected $table = 'diploma_links';

    protected $fillable = [
        'topic_id',
        'link_text',
        'url',
    ];

    public function topic()
    {
        return $this->belongsTo(\App\Models\DiplomaTopic::class, 'topic_id');
    }
}
