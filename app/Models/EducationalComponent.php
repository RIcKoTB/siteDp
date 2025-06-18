<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'description',
        'objectives',
        'content',
        'learning_outcomes',
        'assessment_methods',
        'literature',
        'methodical_materials',
        'category',
        'credits',
        'hours_total',
        'hours_lectures',
        'hours_practical',
        'hours_laboratory',
        'hours_independent',
        'semester',
        'teacher_name',
        'teacher_email',
        'image_url',
        'schedule',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'learning_outcomes' => 'array',
        'assessment_methods' => 'array',
        'literature' => 'array',
        'methodical_materials' => 'array',
        'methodical_materials',
        'schedule' => 'array',
        'is_active' => 'boolean'
    ];

    // Зв'язок з категорією
    public function categoryModel()
    {
        return $this->belongsTo(EducationalCategory::class, 'category', 'slug');
    }

    // Accessor для отримання категорії
    public function getCategoryNameAttribute()
    {
        return $this->categoryModel ? $this->categoryModel->name : $this->category;
    }

    // Accessor для отримання кольору категорії
    public function getCategoryColorAttribute()
    {
        return $this->categoryModel ? $this->categoryModel->color : '#3498db';
    }

    // Scope для активних компонентів
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope для фільтрації за категорією
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'all') {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Scope для сортування
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    // Accessor для форматування годин
    public function getFormattedHoursAttribute()
    {
        return [
            'total' => $this->hours_total,
            'lectures' => $this->hours_lectures,
            'practical' => $this->hours_practical,
            'laboratory' => $this->hours_laboratory,
            'independent' => $this->hours_independent
        ];
    }

    // Accessor для URL зображення
    public function getImageAttribute()
    {
        if ($this->image_url) {
            // Якщо зображення завантажене через Filament (зберігається в storage)
            if (!str_starts_with($this->image_url, 'http')) {
                return asset('storage/' . $this->image_url);
            }
            // Якщо це повний URL
            return $this->image_url;
        }
        // Дефолтне зображення
        return asset('images/default-subject.svg');
    }

    // Метод для отримання короткого опису
    public function getShortDescriptionAttribute()
    {
        return \Str::limit(strip_tags($this->description), 150);
    }
}
