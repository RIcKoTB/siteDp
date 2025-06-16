<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class TestLink extends Model
{
    protected $table = 'test_links';
    protected $fillable = ['topic_id', 'url', 'text'];
    public $timestamps = true;
    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\TestTopic::class);
    }
}