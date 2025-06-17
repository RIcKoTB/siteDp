<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class CourseworkRequirement extends Model
{
    protected $table = 'coursework_requirements';
    protected $fillable = ['topic_id', 'requirement', 'priority'];
    public $timestamps = true;

    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\CourseworkTopic::class);
    }
}