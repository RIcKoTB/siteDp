<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramOverview extends Model
{
    protected $table = 'program_overview';

    protected $fillable = [
        'title',
        'value',
        'icon',
    ];
}
