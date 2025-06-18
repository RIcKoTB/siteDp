<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class EducationalProgram extends Model
{
    protected $fillable = [
        'title',
        'code',
        'description',
        'objectives',
        'competencies',
        'learning_outcomes',
        'admission_requirements',
        'duration_years',
        'credits_total',
        'qualification',
        'career_prospects',
        'curriculum',
        'image_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'competencies' => 'array',
        'learning_outcomes' => 'array',
        'curriculum' => 'array',
        'is_active' => 'boolean',
        'duration_years' => 'integer',
        'credits_total' => 'integer',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    // Accessor для зображення
    public function getImageAttribute()
    {
        if ($this->image_url) {
            if (!str_starts_with($this->image_url, 'http')) {
                return asset('storage/' . $this->image_url);
            }
            return $this->image_url;
        }
        return asset('images/default-program.svg');
    }
}
