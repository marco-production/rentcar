<?php

namespace App\Http\Controllers;

use App\Modelo;
use App\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\BasicValidation;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $modelos = Modelo::orderBy('id','ASC')->get();
            $marcas = Marca::where('estado',true)->orderBy('name','ASC')->get();
            return ['modelos' => $modelos, 'marcas' => $marcas];
        }else{
            return view('empleado.index');
        }
    }
    /* Obtener todos los nombres */
    public function getNames()
    {
        $names = Modelo::select('name')->get();
        return $names;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$marcas = Marca::orderBy('name','ASC')->get();
        return view('empleado.modelo',compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicValidation $request)
    {
        $modelo = new Modelo();
        $modelo->name = $request->name;
        $modelo->descripcion = $request->descripcion;
        $modelo->estado = $request->estado;
        $modelo->marca_id = $request->marca;
        $modelo->slug = str_slug($request->name.time(),'-');
        $modelo->save();

        return $modelo;
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
        $modelo = Modelo::find($id);
        $modelo->name = $request->name;
        $modelo->descripcion = $request->descripcion;
        $modelo->estado = $request->estado;
        $modelo->marca_id = $request->marca;
        if($modelo->name != $request->name){
        $modelo->slug = str_slug($request->name.time(),'-');
        }

        $modelo->save();

        return $modelo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $modelo = Modelo::where('slug',$slug)->firstOrFail();
        $modelo->delete();
        return;
    }
}
