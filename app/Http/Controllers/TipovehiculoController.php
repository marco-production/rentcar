<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use App\Cliente;
use App\Tipovehiculo;
use App\Renta;
use Illuminate\Http\Request;
use App\Http\Requests\BasicValidation;

class TipovehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $vehiculos = Vehiculo::All()->count();
        $clientes = Cliente::All()->count();
        $rentas_activa = Renta::where('estado',1)->count();
        $rentas_inactiva = Renta::where('estado',0)->count();
        return view('empleado.index',compact('vehiculos','clientes','rentas_activa','rentas_inactiva'));
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            return Tipovehiculo::orderBy('id','ASC')->get();
        }else{
            return view('empleado.index');
        }
    }
    /* Obtener todos los nombres */
    public function getNames()
    {
        $names = Tipovehiculo::select('name')->get();
        return $names;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.tipovehiculo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicValidation $request)
    {
        $tipo_vehiculo = new Tipovehiculo();
        $tipo_vehiculo->name = $request->name;
        $tipo_vehiculo->descripcion = $request->descripcion;
        $tipo_vehiculo->estado = $request->estado;
        $tipo_vehiculo->slug = str_slug($request->name.time(),'-');
        $tipo_vehiculo->save();

        return $tipo_vehiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BasicValidation $request, $id)
    {
        $tipo_vehiculo = Tipovehiculo::find($id);
        $tipo_vehiculo->name = $request->name;
        $tipo_vehiculo->descripcion = $request->descripcion;
        $tipo_vehiculo->estado = $request->estado;
        if($tipo_vehiculo->name != $request->name){
        $tipo_vehiculo->slug = str_slug($request->name.time(),'-');
        }

        $tipo_vehiculo->save();

        return $tipo_vehiculo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tipo_vehiculo = Tipovehiculo::where('slug',$slug)->firstOrFail();
        $tipo_vehiculo->delete();
        return;
    }
}
