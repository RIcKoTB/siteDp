<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    // Якщо назва таблиці за конвенцією: snake_case plural,
    // можна не вказувати $table, але в нашому випадку таблиця називається contact_info:
    protected $table = 'contact_info';

    // Поля, доступні для масового заповнення
    protected $fillable = [
        'phone',
        'address',
        'email',
    ];
}
