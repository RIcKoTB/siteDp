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
        'gallery',      // 🖼 Галерея зображень
        'attachments',  // 📎 Додані файли
    ];

    protected $casts = [
        'gallery'     => 'array',
        'attachments' => 'array',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getImgUrlAttribute(): string
    {
        return asset("storage/{$this->img_path}");
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
