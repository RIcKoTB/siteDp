<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class DiplomaApplication extends Model
{
    protected $table = 'diploma_applications';
    protected $fillable = ['student_name', 'student_email', 'proposed_title', 'description', 'status'];
    public $timestamps = true;
}