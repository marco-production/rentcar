@extends('layouts.app')
@section('css')
<!-- Bootstrap Core Css -->
<link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

<!-- Animation Css -->
<link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

<!-- Colorpicker Css -->
<link href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" />

<!-- Dropzone Css -->
<link href="{{ asset('plugins/dropzone/dropzone.css') }}" rel="stylesheet">

<!-- Multi Select Css -->
<link href="{{ asset('plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

<!-- Bootstrap Spinner Css -->
<link href="{{ asset('plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

<!-- Bootstrap Tagsinput Css -->
<link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

<!-- noUISlider Css -->
<link href="{{ asset('plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />

<!-- Custom Css -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if (session('status'))
        <div class="alert bg-red alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{ session('status') }}
        </div>
        @endif
        <div class="card">
            <div class="header">
                <h2>
                    REPORTE DE RENTA - <b>EXCEL</b>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{route('index-vehiculo')}}">Listado de vehiculos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="{{route('renta-excel')}}" method="GET">
                @csrf
                <div class="row clearfix">
                    <div class="col-md-12">
                        <b>Tipo de vehiculo </b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">library_books</i>
                            </span>
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
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Empleado que registro la renta</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">vpn_key</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="empleado">
                                    <option value="">-- Seleccionar empleado --</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{$empleado->id}}">{{$empleado->full_name}} ( {{$empleado->email}} )</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Estado de renta </b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">collections_bookmark</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="estado" id="marca">
                                    <option value="">-- Seleccionar estado --</option>
                                    <option value="1">En renta</option>
                                    <option value="0">Devuelto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Fecha de renta </b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">dialpad</i>
                            </span>
                            <div class="form-line">
                                <input type="date" class="form-control" name="fecha_renta">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Fecha de devolución	 </b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="date" class="form-control" name="fecha_devolucion">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-lg btn-success waves-effect">EXPORTAR EXCEL</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<!--script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script-->

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Bootstrap Colorpicker Js -->
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

<!-- Dropzone Plugin Js -->
<script src="{{ asset('plugins/dropzone/dropzone.js')}}"></script>

<!-- Input Mask Plugin Js -->
<script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<!-- Multi Select Plugin Js -->
<script src="{{ asset('plugins/multi-select/js/jquery.multi-select.js')}}"></script>

<!-- Jquery Spinner Plugin Js -->
<script src="{{ asset('plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>

<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

<!-- noUISlider Plugin Js -->
<script src="{{ asset('plugins/nouislider/nouislider.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('plugins/node-waves/waves.js')}}"></script>

<!-- Custom Js -->
<script src="{{ asset('js/admin.js')}}"></script>
<script src="{{ asset('js/pages/forms/advanced-form-elements.js')}}"></script>

<!-- Demo Js -->
<script src="{{ asset('js/demo.js')}}"></script>
@endsection