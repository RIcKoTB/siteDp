<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaTimeline extends Model
{
    protected $table = 'diploma_timeline';

    protected $fillable = [
        'topic_id',
        'step_order',
        'date',
        'description',
    ];

    public function topic()
    {
        return $this->belongsTo(\App\Models\DiplomaTopic::class, 'topic_id');
    }
}
