<?php

namespace App\Models\Practical;

use Illuminate\Database\Eloquent\Model;

class DiplomaLink extends Model
{
    protected $table = 'diploma_links';
    protected $fillable = ['topic_id', 'link_text', 'url'];
    public $timestamps = true;

    public function topic()
    {
        return $this->belongsTo(\App\Models\Practical\DiplomaTopic::class);
    }
}