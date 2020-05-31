<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Modelo;
use App\Tipovehiculo;
use App\Combustible;
use App\Vehiculo;
use Illuminate\Http\Request;
use App\Http\Requests\VehiculoValidation;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::orderBy('id','ASC')
        ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->join('combustibles','combustibles.id','vehiculos.combustible_id')
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name',
        'tipovehiculos.name AS tipo_name','combustibles.name AS combustible_name')
        ->get();
        return view('vehiculo.index',compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_vehiculos = Tipovehiculo::where('estado',true)->orderBy('name','ASC')->get();
        $marcas = Marca::where('estado',true)->orderBy('name','ASC')->get();
        $combustibles = Combustible::where('estado',true)->orderBy('name','ASC')->get();
        return view('vehiculo.create',compact('tipo_vehiculos','marcas','combustibles'));
    }

    public function getModelos(Request $request)
    {   
        $marca = (int)$request->marca_id;
        return Modelo::where('marca_id',$marca)->where('estado',true)->orderBy('name','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoValidation $request)
    {
        $marca = Marca::find($request->marca);
        $modelo = Modelo::find($request->modelo);

        $estado = null;

        if ($request->estado == 1) {
            $estado = true;
        } else {
            $estado = false;
        }

        $vehiculo = new Vehiculo();
        $vehiculo->descripcion = $request->descripcion;
        $vehiculo->chasis = $request->chasis;
        $vehiculo->motor = $request->motor;
        $vehiculo->placa = $request->placa;
        $vehiculo->anio = $request->anio;
        $vehiculo->tipovehiculo_id = $request->tipo_vehiculo;
        $vehiculo->marca_id = $request->marca;
        $vehiculo->modelo_id = $request->modelo;
        $vehiculo->combustible_id = $request->combustible;
        $vehiculo->estado = $estado;
        $vehiculo->slug = str_slug($marca->name.' '.$modelo->name.' '.time(),'-');
        $vehiculo->save();

        return redirect()->route('show-vehiculo',$vehiculo->slug)->with('status','Vehiculo creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $vehiculo = Vehiculo::join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->join('combustibles','combustibles.id','vehiculos.combustible_id')
        ->where('vehiculos.slug',$slug)
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name',
        'tipovehiculos.name AS tipo_name','combustibles.name AS combustible_name')
        ->firstOrFail();

        return view('vehiculo.show',compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $vehiculo = Vehiculo::join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->join('combustibles','combustibles.id','vehiculos.combustible_id')
        ->where('vehiculos.slug',$slug)
        ->select('vehiculos.*','marcas.id AS marca_id','modelos.id AS modelo_id',
        'marcas.name AS marca_name','modelos.name AS modelo_name',
        'tipovehiculos.id AS tipo_id','combustibles.id AS combustible_id')
        ->firstOrFail();

        $tipo_vehiculos = Tipovehiculo::where('estado',true)->orderBy('name','ASC')->get();
        $marcas = Marca::where('estado',true)->orderBy('name','ASC')->get();
        $modelos = Modelo::where('estado',true)->orderBy('name','ASC')->get();
        $combustibles = Combustible::where('estado',true)->orderBy('name','ASC')->get();

        return view('vehiculo.edit',compact('vehiculo','tipo_vehiculos','marcas','combustibles','modelos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculoValidation $request, $slug)
    {
        $marca = Marca::find($request->marca);
        $modelo = Modelo::find($request->modelo);

        $vehiculo = Vehiculo::where('slug',$slug)->firstOrFail();

        if($vehiculo->marca_id != $request->marca || $vehiculo->modelo_id != $request->modelo){
            $vehiculo->slug = str_slug($marca->name.' '.$modelo->name.' '.time(),'-');
        }

        $vehiculo->descripcion = $request->descripcion;
        $vehiculo->chasis = $request->chasis;
        $vehiculo->motor = $request->motor;
        $vehiculo->placa = $request->placa;
        $vehiculo->anio = $request->anio;
        $vehiculo->tipovehiculo_id = $request->tipo_vehiculo;
        $vehiculo->marca_id = $request->marca;
        $vehiculo->modelo_id = $request->modelo;
        $vehiculo->combustible_id = $request->combustible;
        $vehiculo->estado = $request->estado;

        $vehiculo->save();

        return redirect()->route('show-vehiculo',$vehiculo->slug)->with('status','Vehiculo actualizado exitosamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $vehiculo = Vehiculo::where('slug',$slug)->firstOrFail();
        $vehiculo->delete();

        return redirect()->route('index-vehiculo')->with('delete','El vehiculo ha sido eliminado exitosamente!');
    }
}
