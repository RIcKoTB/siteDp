<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticalCategory extends Model
{
    protected $fillable = ['title', 'slug', 'content'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
