<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'full_name', 'cedula', 'numero_cr', 'limite_credito','tipo','estado','slug'
    ];
}
