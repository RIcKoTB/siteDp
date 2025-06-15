<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    // Таблиця за конвенцією: partners
    protected $table = 'partners';

    // Поля, доступні для масового заповнення
    protected $fillable = [
        'logo_path',
    ];
}
