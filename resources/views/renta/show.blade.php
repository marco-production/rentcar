@extends('layouts.app')
@section('css')
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DETALLES DE RENTA</h2>
    </div>
    @if(session('status'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session('status')}}
        </div>
    @endif
    <!-- Body Copy -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <b>{{$cliente->full_name}}</b> - {{$vehiculo->marca_name}} {{$vehiculo->modelo_name}} {{$vehiculo->anio}}
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('index-renta')}}">Listado de vehiculos</a></li>
                                <li><a href="{{route('edit-renta', $renta->slug)}}">Editar</a></li>
                                <li>
                                    <a href="#" onclick="if(confirm('¿Deseas eliminar esta renta?')){document.getElementById('form').submit();}">Eliminar</a>
                                    <form action="/renta/{{$vehiculo->slug}}" method="POST" id="form" style="display: contents;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <img src="{{ asset('images/rent-car.png') }}" width="200" height="200" style="border-radius:10px;" alt="User" />
                        </div>
                        <div class="col-sm-4">
                            <p><b>Veviculo:</b> <a href="{{route('show-vehiculo', $vehiculo->slug)}}">{{$vehiculo->marca_name}} {{$vehiculo->modelo_name}} {{$vehiculo->anio}}</a></p>
                            <p><b>Cliente:</b> <a href="{{route('show-cliente', $cliente->slug)}}">{{$cliente->full_name}}</a></p>
                            <p><b>Empleado:</b> {{$empleado->full_name}} ( {{$empleado->email}} )</p>
                            <p><b>Fecha de renta:</b> {{$renta->fecha_renta->format('d-m-Y')}}</p>
                            <p><b>Fecha de devolución:</b> {{$renta->fecha_devolucion->format('d-m-Y')}}</p>
                        </div>
                        <div class="col-sm-3">
                            <p><b>Monto x día:</b> RD$ {{$renta->monto}}</p>
                            <p><b>Días:</b> {{$renta->dias}}</p>
                            <p><b>Precio de renta:</b> RD$ {{$renta->monto * $renta->dias}}</p>
                            <p><b>Estado:</b> @if($renta->estado == 1) En renta @else Devuelto @endif</p>
                            <p><b>Comentario:</b> {{$renta->comentario}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@isset($inspeccion)
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Inspeccion de vehiculo</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('edit-inspeccion', $inspeccion->slug)}}">Editar</a></li>
                                <li>
                                    <a href="#" onclick="if(confirm('¿Deseas eliminar esta renta?')){document.getElementById('form').submit();}">Eliminar</a>
                                    <form action="/inspeccion/{{$inspeccion->slug}}" method="POST" id="form" style="display: contents;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <p><b>Fecha de inspección:</b> {{$inspeccion->fecha_inspeccion->format('d-m-Y')}}</p>
                            <p><b>Empleado inspección:</b> {{$inspeccion->full_name}} ( {{$inspeccion->email}} )</a></p>
                            <hr>
                            <p><b>Tiene Ralladuras:</b> @if($inspeccion->ralladura) Si @else No @endif</p>
                            <p><b>Tiene goma respuesta:</b> @if($inspeccion->goma_repuesto) Si @else No @endif</p>
                            <p><b>Tiene gato:</b> @if($inspeccion->gato) Si @else No @endif</p>
                            <p><b>Tiene roturas cristal:</b> @if($inspeccion->rotura_cristal) Si @else No @endif</p>
                        </div>
                        <div class="col-sm-6">
                            <p><b>Estado de inspección:</b> @if($inspeccion->estado) Activo @else Inactivo @endif</p>
                            <p><b>Cantidad de combustible:</b> {{$inspeccion->combustible}}</p>
                            <hr>
                            <p><b>Estado gomas </b>(<small class="col-pink">Gomas con algun problema o en mal estado</small>)</p>
                            <ul>
                            @for ($i = 0; $i < count($gomas); $i++)
                                <li>{{$gomas[$i]}}</li>
                            @endfor
                            </ul>                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endisset
@if($inspeccion == null)
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="block-header">
                <h2 style="text-align: center">ESTE VEHICULO AUN NO HA SIDO INSPECCIONADO</h2><br>
                <a href="{{route('create-inspeccion',$renta->slug)}}" class="btn btn-block btn-lg btn-success waves-effect">Realizar Inspeccion</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('scripts')
   <!-- Jquery Core Js -->
   <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

   <!-- Bootstrap Core Js -->
   <script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

   <!-- Select Plugin Js -->
   <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

   <!-- Slimscroll Plugin Js -->
   <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

   <!-- Waves Effect Plugin Js -->
   <script src="{{ asset('plugins/node-waves/waves.js')}}"></script>

   <!-- Jquery CountTo Plugin Js -->
   <script src="{{ asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>

   <!-- Morris Plugin Js -->
   <script src="{{ asset('plugins/raphael/raphael.min.js')}}"></script>
   <script src="{{ asset('plugins/morrisjs/morris.js')}}"></script>

   <!-- ChartJs -->
   <script src="{{ asset('plugins/chartjs/Chart.bundle.js')}}"></script>

   <!-- Flot Charts Plugin Js -->
   <script src="{{ asset('plugins/flot-charts/jquery.flot.js')}}"></script>
   <script src="{{ asset('plugins/flot-charts/jquery.flot.resize.js')}}"></script>
   <script src="{{ asset('plugins/flot-charts/jquery.flot.pie.js')}}"></script>
   <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js')}}"></script>
   <script src="{{ asset('plugins/flot-charts/jquery.flot.time.js')}}"></script>

   <!-- Sparkline Chart Plugin Js -->
   <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

   <!-- Custom Js -->
   <script src="{{ asset('js/admin.js')}}"></script>
   <script src="{{ asset('js/pages/index.js')}}"></script>

   <!-- Demo Js -->
   <script src="{{ asset('js/demo.js')}}"></script>
@endsection