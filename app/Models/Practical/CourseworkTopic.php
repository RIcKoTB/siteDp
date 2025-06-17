<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class CourseworkTopic extends Model
{
    protected $table = 'coursework_topics';
    protected $fillable = ['title', 'description', 'teacher', 'hours', 'type'];
    public $timestamps = true;

    public function requirements()
    {
        return $this->hasMany(\App\Models\Practical\CourseworkRequirement::class);
    }

    public function timelines()
    {
        return $this->hasMany(\App\Models\Practical\CourseworkTimeline::class);
    }

    public function links()
    {
        return $this->hasMany(\App\Models\Practical\CourseworkLink::class);
    }

    public function approveds()
    {
        return $this->hasMany(\App\Models\Practical\CourseworkApproved::class);
    }
}