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
        <div class="card">
            <div class="header">
                <h2>
                    EDITAR VEHICULO - {{$vehiculo->marca_name}} {{$vehiculo->modelo_name}} {{$vehiculo->anio}}
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
                <form action="/vehiculo/{{$vehiculo->slug}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                    <div class="col-md-12">
                        <b>Tipo de vehiculo </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">library_books</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="tipo_vehiculo">
                                    <option value="">-- Seleccionar tipo de vehiculo --</option>
                                    @foreach ($tipo_vehiculos as $tipo_vehiculo)
                                        <option value="{{$tipo_vehiculo->id}}" @if($vehiculo->tipo_id == $tipo_vehiculo->id) selected @endif>{{$tipo_vehiculo->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tipo_vehiculo')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <b>Marca </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">collections_bookmark</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="marca" id="marca">
                                    <option value="">-- Seleccionar marca --</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{$marca->id}}" @if($vehiculo->marca_id == $marca->id) selected @endif>{{$marca->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('marca')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <b>Modelo </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">dialpad</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="modelo" id="modelo">
                                    <option value="">-- Seleccionar modelo --</option>
                                </select>
                            </div>
                            @error('modelo')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <b>Año </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="number" class="form-control key" name="anio" id="anio" value="{{ $vehiculo->anio }}" placeholder="Ex: XXXX">
                            </div>
                            @error('anio')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <b>No. de chasis</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">vpn_key</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="chasis" value="{{ $vehiculo->chasis }}" placeholder="Ex: XXX0X0X0XX0X00XXX">
                            </div>
                            @error('chasis')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <b>No. de motor</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">vpn_key</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="motor" value="{{ $vehiculo->motor }}" placeholder="Ex: XXX0-XXXX-XX00-X">
                            </div>
                            @error('motor')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <b>No. de placa</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">vpn_key</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="placa" value="{{ $vehiculo->placa }}" placeholder="Ex: XXX0-XXXX-XX00">
                            </div>
                            @error('placa')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Combustible </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">local_gas_station</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="combustible">
                                    <option value="">-- Seleccionar combustible --</option>
                                    @foreach ($combustibles as $combustible)
                                        <option value="{{$combustible->id}}" @if($vehiculo->combustible_id == $combustible->id) selected @endif>{{$combustible->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('combustible')
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
                                <input name="estado" @if($vehiculo->estado == true) checked @endif value="1" type="radio" class="with-gap" id="radio_1" />
                                <label for="radio_1">Activo</label>
                                <input name="estado" @if($vehiculo->estado == false) checked @endif value="0" type="radio" id="radio_2"  class="with-gap" />
                                <label for="radio_2">Inactivo</label>
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
                        <b>Descripcion</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">reorder</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="descripcion" value="{{ $vehiculo->descripcion }}" placeholder="Ex: XXX0-XXXX-XX00-X">
                            </div>
                            @error('descripcion')
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
                            <button type="submit" class="btn btn-block btn-lg btn-success waves-effect">ACTUALIZAR VEHICULO</button>
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

<input type="hidden" value="{{$vehiculo->modelo_id}}" id="modelo_id">

<script type="text/javascript">

    $(document).ready(function() {
        getModelos($('#marca').children("option:selected").val(),$('#modelo_id').val());
    });

    $('#marca').change(function(){
        getModelos($('#marca').val(),null);
    });

    function getModelos(thisModelo,thisModeloId) {
        $.ajax({
            url:'/vehiculos/get-modelos',
            type:'POST',
            data:{
                _token: $('input[name=_token]').val(),
                marca_id: thisModelo,
            },
            success: function(modelos) {
                let modeloSelect = $('#modelo').html('');

                if (thisModelo == "") {
                    modeloSelect.append(`<option value="">-- Seleccionar modelo --</option>`);
                }else{
                    modelos.forEach(modelo => {
                        if (thisModeloId == modelo.id) {
                            modeloSelect.append(`<option value="${modelo.id}" selected>${modelo.name}</option>`);
                        }else{
                            modeloSelect.append(`<option value="${modelo.id}">${modelo.name}</option>`);
                        }
                    });
                }
            }
        });
    }
    //Solo 4 caracteres
    let inputAnio = document.getElementById('anio');
    inputAnio.addEventListener('input',function(){
    if (this.value.length > 4) 
        this.value = this.value.slice(0,4); 
    });
</script>
@endsection