<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipovehiculo extends Model
{
    protected $fillable = [
        'name', 'descripcion', 'estado', 'slug',
    ];
}
