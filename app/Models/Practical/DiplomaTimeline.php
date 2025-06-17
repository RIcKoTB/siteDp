<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class DiplomaTimeline extends Model
{
    protected $table = 'diploma_timelines';
    protected $fillable = ['topic_id', 'date', 'time', 'stage', 'description', 'location'];
    public $timestamps = true;

    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\DiplomaTopic::class);
    }
}