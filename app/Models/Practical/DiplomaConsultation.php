<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class DiplomaConsultation extends Model
{
    protected $table = 'diploma_consultations';
    protected $fillable = ['teacher', 'date', 'time', 'location', 'notes'];
    public $timestamps = true;
}