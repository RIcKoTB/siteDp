<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaRequirement extends Model
{
    protected $table = 'diploma_requirements';

    protected $fillable = [
        'topic_id',
        'requirement',
    ];

    public function topic()
    {
        return $this->belongsTo(\App\Models\DiplomaTopic::class, 'topic_id');
    }
}
