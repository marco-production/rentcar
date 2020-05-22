<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    protected $fillable = [
        'name', 'descripcion', 'estado', 'slug',
    ];
}
