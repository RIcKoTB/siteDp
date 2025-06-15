<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyCategory extends Model
{
    protected $table = 'survey_categories';

    protected $fillable = [
        'slug',
        'title',
    ];
}
