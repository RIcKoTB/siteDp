<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTopic extends Model
{
    protected $table = 'course_topics';

    protected $fillable = [
        'title',
        'description',
        'supervisor',
    ];
}
