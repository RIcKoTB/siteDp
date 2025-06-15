<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiplomaTopic extends Model
{
    protected $table = 'diploma_topics';

    protected $fillable = [
        'title',
        'description',
        'supervisor',
    ];
}
