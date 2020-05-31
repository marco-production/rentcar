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
        <h2>Administración de rentas y devoluciones</h2>
    </div>
    @if(session('delete'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
             {{session('delete')}}
        </div>
    @endif
    <div class="block-header">
        <a href="{{route('create-renta')}}" class="btn bg-blue-grey btn-lg waves-effect" style="color: white;">+ Nueva renta</a>
    </div>
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form action="/renta" method="GET">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12" style="margin-bottom:0px;">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <b>Tipo de vehiculo </b>
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="tipo_vehiculo">
                                            <option value="">-- Seleccionar tipo de vehiculo --</option>
                                            @foreach ($tipo_vehiculos as $tipo_vehiculo)
                                                <option value="{{$tipo_vehiculo->id}}">{{$tipo_vehiculo->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom:0px;">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <b>Fecha de renta </b>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="fecha_renta">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-bottom:0px;">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <b>Fecha de devolución</b>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="fecha_devolucion">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="margin-bottom:0px;">
                                <button type="submit" class="btn btn-success btn-lg m-l-15 waves-effect">BUSCAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        LISTADO DE RENTAS Y DEVOLUCIONES
                        <small>Gestion de rentas y devoluciones</small>
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehiculo</th>
                                <th>Tipo</th>
                                <th>Cliente</th>
                                <!--th>Empleado</th-->
                                <th>Inspección</th>
                                <th>Fecha de renta</th>
                                <th>Fecha de devolución</th>
                                <th>Precio de renta</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentas as $renta)
                            <tr>
                                <td>{{$renta->id}}</td>
                                <td>{{$renta->marca_name}} {{$renta->modelo_name}} {{$renta->anio}}</td>
                                <td>{{$renta->tipovehiculo_name}}</td>
                                <td>{{$renta->cliente_name}}</td>
                                <!--td>{{$renta->full_name}}</td-->
                                <td style="text-align: center;">
                                    @if($renta->inspeccion_count > 0)
                                        <a href="{{route('show-inspeccion',$renta->inspeccion_slug)}}" class="btn btn-warning waves-effect"><i class="material-icons">lock</i></a>
                                    @else
                                        <a href="{{route('create-inspeccion',$renta->slug)}}" class="btn bg-teal btn-sm waves-effect"><i class="material-icons">lock_open</i></a>
                                    @endif
                                </td>
                                <td>{{$renta->fecha_renta->format('d-m-Y')}}</td>
                                <td>{{$renta->fecha_devolucion->format('d-m-Y')}}</td>
                                <td>RD$ {{$renta->monto * $renta->dias}}</td>
                                <td>@if($renta->estado == 1) En renta @else Devuelto @endif</td>
                                <td>
                                    <div class="icon-button-demo">
                                        <a href="{{route('show-renta', $renta->slug)}}" class="btn bg-blue waves-effect"><svg id="i-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="17" height="17" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <circle cx="17" cy="15" r="1" />
                                            <circle cx="16" cy="16" r="6" />
                                            <path d="M2 16 C2 16 7 6 16 6 25 6 30 16 30 16 30 16 25 26 16 26 7 26 2 16 2 16 Z" />
                                        </svg></a>
                                        <a href="{{route('edit-renta', $renta->slug)}}" class="btn bg-amber waves-effect"><svg id="i-edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="17" height="17" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                                        </svg></a>
                                        <form action="/renta/{{$renta->slug}}" method="POST" style="display: contents;">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" onclick="if(confirm('¿Deseas eliminar esta renta?')){this.parentNode.submit();}" class="btn bg-red waves-effect"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="17" height="17" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                                        </svg></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Jquery Core Js -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<!--script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script-->

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