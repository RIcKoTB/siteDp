<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class CourseworkLink extends Model
{
    protected $table = 'coursework_links';
    protected $fillable = ['topic_id', 'url', 'text', 'type'];
    public $timestamps = true;

    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\CourseworkTopic::class);
    }
}