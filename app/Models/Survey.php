<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Survey extends Model
{
    protected $fillable = [
        'title',
        'description',
        'questions',
        'is_active',
        'is_anonymous',
        'start_date',
        'end_date',
        'target_audience',
        'thank_you_message',
        'sort_order',
    ];

    protected $casts = [
        'questions' => 'array',
        'is_active' => 'boolean',
        'is_anonymous' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $now);
            });
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getIsAvailableAttribute(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = Carbon::now();

        if ($this->start_date && $this->start_date > $now) {
            return false;
        }

        if ($this->end_date && $this->end_date < $now) {
            return false;
        }

        return true;
    }

    public function getStatusAttribute(): string
    {
        if (!$this->is_active) {
            return 'Неактивне';
        }

        $now = Carbon::now();

        if ($this->start_date && $this->start_date > $now) {
            return 'Заплановане';
        }

        if ($this->end_date && $this->end_date < $now) {
            return 'Завершене';
        }

        return 'Активне';
    }

    // Relationships
    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }





    // Helper methods
    public function hasUserCompleted($userId = null): bool
    {
        $userId = $userId ?? auth()->id();

        if (!$userId) {
            return false;
        }

        return $this->responses()
            ->where('user_id', $userId)
            ->exists();
    }

    public function getUserResponse($userId = null)
    {
        $userId = $userId ?? auth()->id();

        if (!$userId) {
            return null;
        }

        return $this->responses()
            ->where('user_id', $userId)
            ->first();
    }



    public function getResponsesCountAttribute(): int
    {
        return $this->responses()->count();
    }
}
