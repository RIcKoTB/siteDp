<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeResourcess extends Model
{
    protected $table = 'practice_resources';

    protected $fillable = [
        'title',
        'url',
    ];
}
