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
        @if(session('status'))
            <div class="alert bg-red alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{session('status')}}
            </div>
        @endif
        <div class="card">
            <div class="header">
                <h2>
                    EDITAR RENTA
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
                <form action="/renta/{{$renta->slug}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                    <div class="col-md-12">
                        <b>Empleado </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">library_books</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="empleado">
                                    <option value="">-- Seleccionar empleado --</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{$empleado->id}}" @if($renta->empleado_id == $empleado->id) selected @elseif($empleado->id == Auth::user()->id) selected @endif>{{$empleado->full_name}} ( {{$empleado->email}} )</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('empleado')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Vehiculo </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">library_books</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="vehiculo">
                                    <option value="">-- Seleccionar vehiculo --</option>
                                    @foreach ($vehiculos as $vehiculo)
                                        <option value="{{$vehiculo->id}}" @if($renta->vehiculo_id == $vehiculo->id) selected @endif>{{$vehiculo->marca_name}} {{$vehiculo->modelo_name}} {{$vehiculo->anio}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('vehiculo')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Cliente </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">library_books</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="cliente">
                                    <option value="">-- Seleccionar cliente --</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{$cliente->id}}" @if($renta->cliente_id == $cliente->id) selected @endif>{{$cliente->full_name}} - {{$cliente->cedula}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('cliente')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Fecha de renta </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="date" class="form-control"  value="{{ $renta->fecha_renta->format('Y-m-d') }}" name="fecha_renta">
                            </div>
                            @error('fecha_renta')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Fecha de devolución </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="date" class="form-control" value="{{ $renta->fecha_devolucion->format('Y-m-d') }}" name="fecha_devolucion">
                            </div>
                            @error('fecha_devolucion')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Monto x día </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="number" class="form-control" id="monto" value="{{ $renta->monto }}" name="monto" placeholder="RD$ 00000">
                            </div>
                            @error('monto')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Cantidad de días </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="number" class="form-control" id="dia" value="{{ $renta->dias }}" name="dias" placeholder="00">
                            </div>
                            @error('dias')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Comentario</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">reorder</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="comentario" value="{{ $renta->comentario }}" placeholder="Escribe algun comentario sobre la renta">
                            </div>
                            @error('comentario')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Estado </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <div class="demo-radio-button">
                                <input name="estado" @if($renta->estado == true) checked @endif value="1" type="radio" class="with-gap" id="radio_1" />
                                <label for="radio_1">En renta</label>
                                <input name="estado" @if($renta->estado == false) checked @endif value="0" type="radio" id="radio_2"  class="with-gap" />
                                <label for="radio_2">Devuelto</label>
                            </div>
                            @error('estado')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div> 
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-lg btn-success waves-effect">ACTUALIZAR</button>
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

<script>
    let monto = document.getElementById('monto');
    let dia = document.getElementById('dia');
    monto.addEventListener('input',function(){
        if (this.value.length > 9) 
            this.value = this.value.slice(0,8); 
    });
    dia.addEventListener('input',function(){
        if (this.value.length > 8) 
            this.value = this.value.slice(0,8); 
    });
</script>
@endsection