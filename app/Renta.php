<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $fillable = [
        'empleado_id', 'vehiculo_id', 'cliente_id', 'monto', 'dias',
        'comentario', 'estado', 'slug'
    ];

    protected $dates = [ 'fecha_renta', 'fecha_devolucion'];

    public function scopeSearch($query, $tipo_vehiculo, $fecha_renta, $fecha_devolucion)
    {
        //Los 1 filtros
        if($tipo_vehiculo != null && $fecha_renta == null && $fecha_renta == null){
           return $query->where('tipovehiculos.id',$tipo_vehiculo); 
        }elseif($tipo_vehiculo == null && $fecha_renta != null && $fecha_devolucion == null){
            return $query->where('rentas.fecha_renta',$fecha_renta); 
        }elseif ($tipo_vehiculo == null && $fecha_renta == null && $fecha_devolucion != null) {
            return $query->where('rentas.fecha_devolucion',$fecha_devolucion); 
        }
        //Solo 2 filtros
        elseif($tipo_vehiculo != null && $fecha_renta != null && $fecha_renta == null){
            return $query->where('tipovehiculos.id',$tipo_vehiculo)->where('rentas.fecha_renta',$fecha_renta); 
         }elseif($tipo_vehiculo != null && $fecha_renta == null && $fecha_renta != null){
            return $query->where('tipovehiculos.id',$tipo_vehiculo)->where('rentas.fecha_devolucion',$fecha_devolucion); 
         }elseif($tipo_vehiculo == null && $fecha_renta != null && $fecha_devolucion != null){
             return $query->where('rentas.fecha_renta','>=',$fecha_renta)->where('rentas.fecha_devolucion','<=',$fecha_devolucion);
         }
         //Los 3 filtros
         elseif($tipo_vehiculo != null && $fecha_renta != null && $fecha_renta != null){
            return $query->where('tipovehiculos.id',$tipo_vehiculo)->where('rentas.fecha_renta',$fecha_renta)->where('rentas.fecha_devolucion','<=',$fecha_devolucion); 
         }
    }
}
