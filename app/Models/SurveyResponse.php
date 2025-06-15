<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $table = 'survey_responses';

    protected $fillable = [
        'category_id',
        'rating',
        'comment',
        'submitted_at',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\SurveyCategory::class, 'category_id');
    }
}
