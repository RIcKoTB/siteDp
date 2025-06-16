<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class TestTopic extends Model
{
    protected $table = 'test_topics';
    protected $fillable = ['title', 'description', 'teacher'];
    public $timestamps = true;}