<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeSchedule extends Model
{
    protected $table = 'practice_schedule';

    protected $fillable = [
        'module_id',
        'date',
        'start_time',
        'end_time',
        'room',
    ];

    public function module()
    {
        return $this->belongsTo(PracticeModule::class, 'module_id');
    }
}
