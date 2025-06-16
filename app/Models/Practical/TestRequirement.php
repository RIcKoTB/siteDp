<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class TestRequirement extends Model
{
    protected $table = 'test_requirements';
    protected $fillable = ['topic_id', 'requirement'];
    public $timestamps = true;
    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\TestTopic::class);
    }
}