<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PracticalTopic extends Model
{
    protected $fillable = [
        'category_id',
        'teacher_id',
        'title',
        'description',
        'teacher',
        'hours',
        'is_active',
        'supervisor_name',
        'supervisor_position',
        'supervisor_email',
        'supervisor_phone',
        'supervisor_bio',
        'stages',
        'resources',
        'requirements',
        'consultations'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stages' => 'array',
        'resources' => 'array',
        'consultations' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PracticalCategory::class);
    }

    public function teacherUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(PracticalRequirement::class, 'topic_id');
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(PracticalTimeline::class, 'topic_id');
    }

    public function links(): HasMany
    {
        return $this->hasMany(PracticalLink::class, 'topic_id');
    }

    public function approveds(): HasMany
    {
        return $this->hasMany(PracticalApproved::class, 'topic_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(StudentApplication::class, 'topic_id');
    }

    // Допоміжні методи для роботи з JSON полями
    public function getStagesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getResourcesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getConsultationsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
