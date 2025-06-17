<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class CourseworkApplication extends Model
{
    protected $table = 'coursework_applications';
    protected $fillable = ['student_name', 'student_email', 'proposed_title', 'description', 'status'];
    public $timestamps = true;
}