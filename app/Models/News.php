<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'date',
        'img_path',
        'url',
        'views',
        'content',
        'gallery', // 🆕 додано
    ];
    protected $casts = [
        'gallery' => 'array',
    ];


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getImgUrlAttribute(): string
    {
        return asset("storage/{$this->img_path}");
    }

    // ➕ Метод для інкременту переглядів
    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
