<?php

namespace App\Http\Controllers;

use App\User;
use App\Renta;
use App\Inspeccion;
use App\Vehiculo;
use Illuminate\Http\Request;
use App\Http\Requests\InspeccionValidation;

class InspeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $renta = Renta::where('slug',$slug)->select('vehiculo_id','id')->firstOrFail();
        $empleados = User::orderBy('full_name','ASC')->where('role_id',2)->where('estado',true)->get();

        $vehiculo = Vehiculo::join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->where('vehiculos.id',$renta->vehiculo_id)
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name')
        ->firstOrFail();

        return view('inspeccion.create',compact('renta','vehiculo','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InspeccionValidation $request)
    {
        $inspeccion = new Inspeccion();
        
        $gomas = implode(',',$request->gomas);
        $inspeccion->renta_id = $request->renta;
        $inspeccion->fecha_inspeccion = $request->fecha_inspeccion;
        
        $inspeccion->empleado_id = $request->empleado;
        $inspeccion->ralladura = $request->ralladura;
        $inspeccion->goma_repuesto = $request->goma_repuesto;
        $inspeccion->gato = $request->gato;
        $inspeccion->rotura_cristal = $request->rotura_cristal;
        $inspeccion->gomas = $gomas;
        $inspeccion->combustible = $request->combustible;
        $inspeccion->estado = $request->estado;

        $vehiculo = Vehiculo::join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->where('vehiculos.id',$inspeccion->renta_id)
        ->select('vehiculos.anio','marcas.name AS marca_name','modelos.name AS modelo_name')
        ->firstOrFail();
        
        $inspeccion->slug = str_slug($vehiculo->marca_name.' '.$vehiculo->modelo_name.' '.$vehiculo->anio.' '.time(),'-');
        $inspeccion->save();

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $inspeccion = Inspeccion::where('slug',$slug)->firstOrFail();
        return view('inspeccion.show',compact('inspeccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $inspeccion = Inspeccion::where('slug',$slug)->firstOrFail();
        $empleados = User::orderBy('full_name','ASC')->where('role_id',2)->where('estado',true)->get();
        $renta = Renta::find($inspeccion->id)->select('id')->firstOrFail();
        $gomas = explode(',',$inspeccion->gomas);

        $vehiculo = Vehiculo::join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->where('vehiculos.id',$renta->id)
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name')
        ->firstOrFail();
        
        return view('inspeccion.edit',compact('renta','inspeccion','vehiculo','empleados','gomas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
