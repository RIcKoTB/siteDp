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
        'category',     // 📂 Категорія новини
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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }

    public function getCommentsCountAttribute(): int
    {
        return $this->comments()->count();
    }

    public function getImgUrlAttribute(): string
    {
        return asset("storage/{$this->img_path}");
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Отримати нормалізовані attachments
     */
    public function getNormalizedAttachmentsAttribute(): array
    {
        if (!$this->attachments || !is_array($this->attachments)) {
            return [];
        }

        return collect($this->attachments)->map(function ($attachment) {
            if (is_array($attachment)) {
                return [
                    'url' => $attachment['path'] ?? $attachment['url'] ?? $attachment['file'] ?? null,
                    'name' => $attachment['name'] ?? $attachment['filename'] ?? $attachment['file'] ?? 'Завантажити файл'
                ];
            }
            
            return [
                'url' => $attachment,
                'name' => basename($attachment)
            ];
        })->filter(function ($attachment) {
            return !empty($attachment['url']);
        })->toArray();
    }

    /**
     * Отримати нормалізовану галерею
     */
    public function getNormalizedGalleryAttribute(): array
    {
        if (!$this->gallery || !is_array($this->gallery)) {
            return [];
        }

        return collect($this->gallery)->map(function ($image) {
            if (is_array($image)) {
                return [
                    'url' => $image['path'] ?? $image['url'] ?? $image['file'] ?? null,
                    'alt' => $image['name'] ?? $image['alt'] ?? $image['title'] ?? 'Галерея'
                ];
            }
            
            return [
                'url' => $image,
                'alt' => 'Галерея'
            ];
        })->filter(function ($image) {
            return !empty($image['url']);
        })->toArray();
    }
}
