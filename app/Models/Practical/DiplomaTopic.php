<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class DiplomaTopic extends Model
{
    protected $table = 'diploma_topics';
    protected $fillable = ['title', 'description', 'supervisor'];
    public $timestamps = true;

    public function requirements()
    {
        return $this->hasMany(\App\Models\Practical\DiplomaRequirement::class);
    }

    public function timelines()
    {
        return $this->hasMany(\App\Models\Practical\DiplomaTimeline::class);
    }

    public function links()
    {
        return $this->hasMany(\App\Models\Practical\DiplomaLink::class);
    }

    public function approveds()
    {
        return $this->hasMany(\App\Models\Practical\DiplomaApproved::class);
    }
}