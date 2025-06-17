<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PracticalCategory extends Model
{
    protected $fillable = ['title', 'slug', 'content'];

    public function topics(): HasMany
    {
        return $this->hasMany(PracticalTopic::class, 'category_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(StudentApplication::class, 'category_id');
    }
}
