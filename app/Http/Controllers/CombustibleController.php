<?php

namespace App\Http\Controllers;

use App\Combustible;
use Illuminate\Http\Request;
use App\Http\Requests\BasicValidation;

class CombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return Combustible::orderBy('id','ASC')->get();
        }else{
            return view('empleado.index');
        }
    }
    /* Obtener todos los nombres */
    public function getNames()
    {
        $names = Combustible::select('name')->get();
        return $names;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.combustible');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicValidation $request)
    {
        $combustible = new Combustible();
        $combustible->name = $request->name;
        $combustible->descripcion = $request->descripcion;
        $combustible->estado = $request->estado;
        $combustible->slug = str_slug($request->name.time(),'-');
        $combustible->save();

        return $combustible;
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
        $combustible = Combustible::find($id);
        $combustible->name = $request->name;
        $combustible->descripcion = $request->descripcion;
        $combustible->estado = $request->estado;
        if($combustible->name != $request->name){
        $combustible->slug = str_slug($request->name.time(),'-');
        }

        $combustible->save();

        return $combustible;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $combustible = Combustible::where('slug',$slug)->firstOrFail();
        $combustible->delete();
        return;
    }
}
