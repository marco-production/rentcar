<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Renta;
use App\Cliente;
use App\Marca;
use App\Modelo;
use App\Vehiculo;
use App\Inspeccion;
use App\Tipovehiculo;
use Illuminate\Http\Request;
use App\Http\Requests\RentaValidation;
use App\Http\Requests\RentaUpdateValidation;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RentaExport;

class RentaController extends Controller
{

    public function exportExcel()
    {
        return Excel::download(new RentaExport, 'Reporte-de-renta.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $get_tipo_vehiculo = $request->get('tipo_vehiculo');
        $get_fecha_renta = $request->get('fecha_renta');
        $get_fecha_devolucion = $request->get('fecha_devolucion');

        $tipo_vehiculos = Tipovehiculo::orderBy('name','ASC')->get();
        $rentas = Renta::search($get_tipo_vehiculo,$get_fecha_renta,$get_fecha_devolucion)->orderBy('rentas.id','ASC')
        ->join('users','users.id','rentas.empleado_id')
        ->join('vehiculos','vehiculos.id','rentas.vehiculo_id')
        ->join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->join('clientes','clientes.id','rentas.cliente_id')
        ->leftJoin('inspeccions','inspeccions.renta_id','rentas.id')
        ->select('rentas.*','users.full_name','users.email','marcas.name AS marca_name',
        'modelos.name AS modelo_name','clientes.full_name AS cliente_name','vehiculos.anio', 'tipovehiculos.name AS tipovehiculo_name',
        'inspeccions.slug AS inspeccion_slug',DB::raw('count(inspeccions.id) as inspeccion_count'))
        ->groupBy('rentas.id')
        ->get();

        return view('renta.index',compact('rentas','tipo_vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = User::orderBy('full_name','ASC')->where('role_id',2)->where('estado',true)->get();
        $clientes = Cliente::orderBy('full_name','ASC')->where('estado',true)->get();
        $vehiculos = Vehiculo::join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->orderBy('marcas.name','ASC')
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name')
        ->where('vehiculos.estado',true)->get();
        
        return view('renta.create',compact('empleados','vehiculos','clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RentaValidation $request)
    {
        $renta = new Renta();
        $vehiculo = Vehiculo::find($request->vehiculo);
        $cliente = Cliente::find($request->cliente);
        
        $renta->empleado_id = $request->empleado;
        $renta->vehiculo_id = $request->vehiculo;
        $renta->cliente_id = $request->cliente;
        $renta->fecha_renta = $request->fecha_renta;
        $renta->fecha_devolucion = $request->fecha_devolucion;
        $renta->monto = $request->monto;
        $renta->dias = $request->dias;
        $renta->comentario = $request->comentario;
        $renta->slug = str_slug($cliente->full_name.' '.'renta'.' '.time(),'-');
        $vehiculo->estado = false;

        $renta->save();
        $vehiculo->save();

        return redirect()->route('show-renta',$renta->slug)->with('status','Renta registrada exitosamente!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $renta = Renta::where('slug',$slug)->firstOrFail();
        $empleado = User::find($renta->empleado_id);
        $cliente = Cliente::find($renta->cliente_id);
        $vehiculo = Vehiculo::join('tipovehiculos','tipovehiculos.id','vehiculos.tipovehiculo_id')
        ->join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->where('vehiculos.id',$renta->vehiculo_id)
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name')
        ->firstOrFail();

        $inspeccion = Inspeccion::join('users','users.id','inspeccions.empleado_id')
        ->where('renta_id',$renta->id)
        ->select('inspeccions.*','users.full_name','users.email')->first();

        if($inspeccion){
            $gomas = explode(',',str_replace('-',' ',$inspeccion->gomas));
        }
        
        return view('renta.show',compact('empleado','renta','cliente','vehiculo','inspeccion','gomas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $renta = Renta::where('slug',$slug)->firstOrFail();
        $empleados = User::orderBy('full_name','ASC')->where('role_id',2)->where('estado',true)->orWhere('id',$renta->empleado_id)->get();
        $clientes = Cliente::orderBy('full_name','ASC')->where('estado',true)->orWhere('id',$renta->cliente_id)->get();
        $vehiculos = Vehiculo::join('marcas','marcas.id','vehiculos.marca_id')
        ->join('modelos','modelos.id','vehiculos.modelo_id')
        ->orderBy('marcas.name','ASC')
        ->where('vehiculos.estado',true)
        ->orWhere('vehiculos.id',$renta->vehiculo_id)
        ->select('vehiculos.*','marcas.name AS marca_name','modelos.name AS modelo_name')->get();
        
        return view('renta.edit',compact('empleados','renta','clientes','vehiculos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RentaUpdateValidation $request, $slug)
    {
        $renta = Renta::where('slug',$slug)->firstOrFail();
        $vehiculo = Vehiculo::find($request->vehiculo);
        $cliente = Cliente::find($request->cliente);

        if($renta->cliente_id != $request->cliente){
            $renta->slug = str_slug($cliente->full_name.' '.'renta'.' '.time(),'-');
        }
        
        $renta->empleado_id = $request->empleado;
        $renta->vehiculo_id = $request->vehiculo;
        $renta->cliente_id = $request->cliente;
        $renta->fecha_renta = $request->fecha_renta;
        $renta->fecha_devolucion = $request->fecha_devolucion;
        $renta->monto = $request->monto;
        $renta->dias = $request->dias;
        $renta->comentario = $request->comentario;
        $renta->estado = $request->estado;

        if($request->estado == false){
            $vehiculo->estado = true;
        }else{
            $this_renta = Renta::where('vehiculo_id',$vehiculo->id)->where('estado',true)->count();
            if ($this_renta == 0) {
                $vehiculo->estado = false;
            } else {
               return redirect()->back()->with('status','Este vehiculo ya esta en renta.');
            }
        }
        
        //$vehiculo->estado = false;

        $renta->save();
        $vehiculo->save();

        return redirect()->route('show-renta',$renta->slug)->with('status','Renta actualuzada exitosamente!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $renta = Renta::where('slug',$slug)->firstOrFail();
        $inspeccion = Inspeccion::where('renta_id',$renta->id)->firstOrFail();
        $vehiculo = Vehiculo::find($renta->vehiculo_id);
        $vehiculo->estado = true;

        $vehiculo->save();
        $inspeccion->delete();
        $renta->delete();

        return redirect()->route('index-renta')->with('delete','El vehiculo ha sido eliminado exitosamente!');
    }
}
