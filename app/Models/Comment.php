<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    protected $fillable = [
        'news_id', 'user_id', 'parent_id', 'author_name', 'content', 'views',
    ];

    public function news()
    {
        return $this->belongsTo(\App\Models\News::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getPreviewAttribute(): string
    {
        $authorName = $this->user ? $this->user->name : $this->author_name;
        return "{$authorName}: " . Str::limit($this->content, 50);
    }

    public function getAuthorNameAttribute($value)
    {
        // Якщо є зв'язок з користувачем, повертаємо ім'я користувача
        if ($this->user) {
            return $this->user->name;
        }
        
        // Інакше повертаємо збережене ім'я (для старих коментарів)
        return $value;
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with(['replies', 'user'])->orderBy('created_at', 'asc');
    }
}
