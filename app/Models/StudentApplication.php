<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentApplication extends Model
{
    protected $fillable = [
        'category_id',
        'topic_id',
        'student_name',
        'student_email',
        'student_phone',
        'student_group',
        'motivation',
        'status',
        'admin_notes',
        'approved_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PracticalCategory::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(PracticalTopic::class);
    }
}
