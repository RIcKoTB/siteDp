<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class CourseworkConsultation extends Model
{
    protected $table = 'coursework_consultations';
    protected $fillable = ['teacher', 'date', 'time', 'location', 'notes'];
    public $timestamps = true;
}