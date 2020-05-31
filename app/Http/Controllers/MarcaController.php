<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\BasicValidation;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Marca::orderBy('id','ASC')->get();
        }else{
            return view('empleado.index');
        }
    }
    /* Obtener todos los nombres */
    public function getNames()
    {
        $names = Marca::select('name')->get();
        return $names;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.marca');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicValidation $request)
    {
        $marca = new Marca();
        $marca->name = $request->name;
        $marca->descripcion = $request->descripcion;
        $marca->estado = $request->estado;
        $marca->slug = str_slug($request->name.time(),'-');
        $marca->save();

        return $marca;
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
        $marca = Marca::find($id);
        $marca->name = $request->name;
        $marca->descripcion = $request->descripcion;
        $marca->estado = $request->estado;
        if($marca->name != $request->name){
        $marca->slug = str_slug($request->name.time(),'-');
        }

        $marca->save();

        return $marca;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $marca = Marca::where('slug',$slug)->firstOrFail();
        $marca->delete();
        return;
    }
}
