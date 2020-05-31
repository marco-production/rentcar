<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model
{
    protected $fillable = [
        'ralladura', 'combustible', 'goma_repuesto', 'gato', 'rotura_cristal',
        'gomas', 'renta_id', /*'cliente_id',*/ 'empleado_id', 'estado', 'slug'
    ];

    protected $dates = [ 'fecha_inspeccion'];
}
