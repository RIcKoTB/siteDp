<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'sort_order',
        'is_active',
        'category',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scope для активних фото
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope для сортування
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Accessor для повного URL зображення
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
