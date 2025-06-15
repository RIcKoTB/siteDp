<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryEvent extends Model
{
    protected $table = 'history_events';

    protected $fillable = [
        'event_year',
        'description',
        'sort_order',
    ];

    // Вимкнути автоматичну конвертацію рядків у дати
    public $timestamps = true;
}
