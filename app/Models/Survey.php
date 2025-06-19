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
        'target_audience',
        'is_anonymous',
        'start_date',
        'end_date',
        'thank_you_message',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'questions' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_anonymous' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->active()
            ->where(function ($q) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
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

    public function getImageAttribute(): ?string
    {
        return $this->image_url ? asset('storage/' . $this->image_url) : null;
    }

    // Relationships
    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }

    // Перевірка, чи користувач вже проходив це опитування
    public function hasUserCompleted($userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        if (!$userId) {
            return false;
        }
        
        return $this->responses()->where('user_id', $userId)->exists();
    }

    // Отримати відповідь користувача
    public function getUserResponse($userId = null)
    {
        $userId = $userId ?? auth()->id();
        
        if (!$userId) {
            return null;
        }
        
        return $this->responses()->where('user_id', $userId)->first();
    }
}
