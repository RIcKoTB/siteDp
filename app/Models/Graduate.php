<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Graduate extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'specialty',
        'graduation_year',
        'photo_url',
        'achievements',
        'current_position',
        'company',
        'contact_email',
        'contact_phone',
        'linkedin_url',
        'testimonial',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('graduation_year', 'desc')->orderBy('last_name');
    }

    public function scopeByYear(Builder $query, int $year): Builder
    {
        return $query->where('graduation_year', $year);
    }

    public function scopeBySpecialty(Builder $query, string $specialty): Builder
    {
        return $query->where('specialty', 'like', '%' . $specialty . '%');
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        $parts = array_filter([$this->last_name, $this->first_name, $this->middle_name]);
        return implode(' ', $parts);
    }

    public function getPhotoAttribute(): ?string
    {
        return $this->photo_url ? asset('storage/' . $this->photo_url) : null;
    }

    public function getGraduationStatusAttribute(): string
    {
        $currentYear = now()->year;
        $yearsDiff = $currentYear - $this->graduation_year;
        
        if ($yearsDiff == 0) {
            return 'Випускник цього року';
        } elseif ($yearsDiff == 1) {
            return 'Випускник минулого року';
        } else {
            return "Випускник {$this->graduation_year} року";
        }
    }

    public function getExperienceYearsAttribute(): int
    {
        return max(0, now()->year - $this->graduation_year);
    }

    // Static methods
    public static function getAvailableYears(): array
    {
        return self::active()
            ->distinct()
            ->orderBy('graduation_year', 'desc')
            ->pluck('graduation_year')
            ->toArray();
    }

    public static function getAvailableSpecialties(): array
    {
        return self::active()
            ->distinct()
            ->orderBy('specialty')
            ->pluck('specialty')
            ->toArray();
    }
}
