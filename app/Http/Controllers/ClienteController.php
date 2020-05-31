<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteValidation;
use App\Http\Requests\ClienteUpdateValidation;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderBy('id','ASC')->get();
        return view('cliente.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteValidation $request)
    {
        $estado = null;

        if ($request->estado == 1) {
            $estado = true;
        } else {
            $estado = false;
        }
        
        $cliente = new Cliente();
        $cliente->full_name = $request->full_name;
        $cliente->cedula = $request->cedula;
        $cliente->numero_cr = $request->numero_cr;
        $cliente->limite_credito = $request->limite;
        $cliente->tipo = $request->tipo;
        $cliente->estado = $estado;
        $cliente->slug = str_slug($request->full_name.time(),'-');
        $cliente->save();

        return redirect()->route('show-cliente',$cliente->slug)->with('status','Cliente creado exitosamente!!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cliente = Cliente::where('slug',$slug)->firstOrFail();
        return view('cliente.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cliente = Cliente::where('slug',$slug)->firstOrFail();
        return view('cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateValidation $request, $slug)
    {   
        
        $cliente = Cliente::where('slug',$slug)->firstOrFail();

        if($cliente->full_name != $request->full_name){
            $cliente->slug = str_slug($request->full_name.time(),'-');
        }

        $cliente->full_name = $request->full_name;
        $cliente->cedula = $request->cedula;
        $cliente->numero_cr = $request->numero_cr;
        $cliente->limite_credito = $request->limite;
        $cliente->tipo = $request->tipo;
        $cliente->estado = $request->estado;
        $cliente->save();

        return redirect()->route('show-cliente',$cliente->slug)->with('status','Cliente actualizado exitosamente!!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $cliente = Cliente::where('slug',$slug)->firstOrFail();
        $cliente->delete();

        return redirect()->route('index-cliente')->with('delete','El cliente ha sido eliminado exitosamente!');
    }
}
