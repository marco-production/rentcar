<?php

namespace App\Exports;

use App\Renta;
use Maatwebsite\Excel\Concerns\FromCollection;

class RentaExport implements FromCollection
{
    public function __construct($tipo_vehiculo = null, $empleado = null, $fecha_renta = null, $fecha_devolucion = null, $estado = null)
    {
        $this->tipo_vehiculo = $tipo_vehiculo;
        $this->empleado = $empleado;
        $this->fecha_renta = $fecha_renta;
        $this->fecha_devolucion = $fecha_devolucion;
        $this->estado = $estado;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //Solo 1 filtro
        if($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado == null){
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }elseif($this->tipo_vehiculo == null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado == null) {
            return Renta::join('users','users.id','rentas.empleado_id')
            ->where('users.id',$this->empleado)->select('rentas.*','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta != null && $this->fecha_devolucion == null && $this->estado == null) {
            return Renta::where('fecha_renta',$this->fecha_renta)->get();            
        }elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::where('fecha_devolucion',$this->fecha_devolucion)->get(); 
        }elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::where('estado',$this->estado)->get();
        }
        //Solo 2 filtros
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado == null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('users.id',$this->empleado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta != null && $this->fecha_devolucion == null && $this->estado == null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_renta',$this->fecha_renta)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_devolucion',$this->fecha_devolucion)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion == null && $this->estado == null) {
            return Renta::join('users','users.id','rentas.empleado_id')
            ->where('users.id',$this->empleado)->where('fecha_renta',$this->fecha_renta)->select('rentas.*','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::join('users','users.id','rentas.empleado_id')
            ->where('users.id',$this->empleado)->where('fecha_devolucion',$this->fecha_devolucion)->select('rentas.*','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::join('users','users.id','rentas.empleado_id')
            ->where('users.id',$this->empleado)->where('rentas.estado',$this->estado)->select('rentas.*','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta != null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::where('fecha_renta',$this->fecha_renta)->where('estado',$this->estado)->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta == null && $this->fecha_devolucion != null && $this->estado != null) {
            return Renta::where('fecha_devolucion',$this->fecha_devolucion)->where('estado',$this->estado)->get();
        }
        //Solo 3 filtros
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion == null && $this->estado == null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_renta',$this->fecha_renta)->where('users.id',$this->empleado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_devolucion',$this->fecha_devolucion)->where('users.id',$this->empleado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('rentas.estado',$this->estado)->where('users.id',$this->empleado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::join('users','users.id','rentas.empleado_id')
            ->where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->where('users.id',$this->empleado)->select('rentas.*','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado == null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado != null) {
            return Renta::where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->where('estado',$this->estado)->get();
        }
        //Solo 4 filtros
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado == null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->where('users.id',$this->empleado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion == null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_renta',$this->fecha_renta)->where('users.id',$this->empleado)->where('rentas.estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta == null && $this->fecha_devolucion != null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_devolucion',$this->fecha_devolucion)->where('users.id',$this->empleado)->where('rentas.estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        elseif($this->tipo_vehiculo != null && $this->empleado == null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->where('rentas.estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo')->get();
        }
        elseif($this->tipo_vehiculo == null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado != null) {
            return Renta::join('users','users.id','rentas.empleado_id')
            ->where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->where('users.id',$this->empleado)->where('rentas.estado',$this->estado)->select('rentas.*','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
        //Los 5 filtros
        elseif($this->tipo_vehiculo != null && $this->empleado != null && $this->fecha_renta != null && $this->fecha_devolucion != null && $this->estado != null) {
            return Renta::join('vehiculos','vehiculos.id','rentas.vehiculo_id')
            ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
            ->join('users','users.id','rentas.empleado_id')
            ->where('vehiculos.tipovehiculo_id',$this->tipo_vehiculo)->where('fecha_renta','>=',$this->fecha_renta)->where('fecha_devolucion','<=',$this->fecha_devolucion)->where('users.id',$this->empleado)->where('rentas.estado',$this->estado)->select('rentas.*','tipovehiculos.name AS tipo_de_vehiculo','users.full_name AS empleado','users.email AS empleado_mail')->get();
        }
    }
}
