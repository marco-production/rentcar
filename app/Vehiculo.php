<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'descripcion', 'chasis', 'motor', 'placa', 'anio', 'tipovehiculo_id', 'marca_id',
        'modelo_id', 'combustible_id', 'estado', 'slug'
    ];
}
