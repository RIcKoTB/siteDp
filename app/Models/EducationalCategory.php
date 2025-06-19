<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationalCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Зв'язок з освітніми компонентами
    public function components()
    {
        return $this->hasMany(EducationalComponent::class, 'category', 'slug');
    }

    // Scope для активних категорій
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope для сортування
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessor для кількості компонентів
    public function getComponentsCountAttribute()
    {
        return $this->components()->active()->count();
    }

    // Метод для автоматичного створення slug
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (!$this->slug) {
            $this->attributes['slug'] = \Str::slug($value);
        }
    }
}
