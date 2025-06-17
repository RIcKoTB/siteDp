<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class DiplomaApproved extends Model
{
    protected $table = 'diploma_approveds';
    protected $fillable = ['topic_id', 'student_name', 'student_email', 'supervisor', 'status', 'approved_date'];
    public $timestamps = true;

    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\DiplomaTopic::class);
    }
}