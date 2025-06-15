<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeModule extends Model
{
    protected $table = 'practice_modules';

    protected $fillable = [
        'module_type',
        'title',
        'description',
        'resource_url',
    ];
}
