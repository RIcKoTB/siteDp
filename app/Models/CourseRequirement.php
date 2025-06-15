<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRequirement extends Model
{
    protected $table = 'course_requirements';

    protected $fillable = [
        'topic_id',
        'requirement',
    ];

    public function topic()
    {
        return $this->belongsTo(CourseTopic::class, 'topic_id');
    }
}
