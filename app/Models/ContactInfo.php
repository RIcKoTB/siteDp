<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_infos'; // або залиш, якщо в тебе реально назва таблиці singular (але краще plural)

    protected $fillable = ['name', 'email', 'phone', 'message'];

}
