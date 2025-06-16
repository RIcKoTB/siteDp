<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class TestTimeline extends Model
{
    protected $table = 'test_timelines';
    protected $fillable = ['topic_id', 'date', 'stage', 'description'];
    public $timestamps = true;
    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\TestTopic::class);
    }
}