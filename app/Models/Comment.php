<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    protected $fillable = [
        'news_id', 'parent_id', 'author_name', 'content', 'views',
    ];

    public function news()
    {
        return $this->belongsTo(\App\Models\News::class);
    }

    public function getPreviewAttribute(): string
    {
        return "{$this->author_name}: " . Str::limit($this->content, 50);
    }


    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }
}
