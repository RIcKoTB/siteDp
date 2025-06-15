<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreValue extends Model
{
    protected $table = 'core_values';

    protected $fillable = [
        'title',
        'description',
        'img_path',
    ];
}
