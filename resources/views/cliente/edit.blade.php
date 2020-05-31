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
                    EDITAR CLIENTE - {{$cliente->full_name}}
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{route('index-cliente')}}">Listado de clientes</a></li>
                            <li><a href="{{route('show-cliente',$cliente->slug)}}">Ver detalles de cliente</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="/cliente/{{$cliente->slug}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                    <div class="col-md-6">
                        <label for="full_name">Nombre completo</label> <span class="col-pink">*</span>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="full_name" name="full_name" class="form-control" value="{{$cliente->full_name}}" placeholder="Ingresa el nombre completo">
                            </div>
                            @error('full_name')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Cédula</b> <span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">vpn_key</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="cedula" value="{{$cliente->cedula}}" placeholder="Ex: XXX0-XXXX-XX00-X">
                            </div>
                            @error('cedula')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>No. Tarjeta CR</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">credit_card</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="numero_cr" value="{{$cliente->numero_cr}}" placeholder="Ingresa el numero de tarjeta CR">
                            </div>
                            @error('numero_cr')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Límite de Credito</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">confirmation_number</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" name="limite" value="{{$cliente->limite_credito}}" placeholder="Ex: 0000">
                            </div>
                            @error('limite')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Tipo de persona </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">dialpad</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="tipo" id="tipo">
                                    <option value="">-- Seleccionar modelo --</option>
                                    <option @if($cliente->tipo == 'Física') selected @endif value="Física">Física</option>
                                    <option @if($cliente->tipo == 'Jurídica') selected @endif value="Jurídica">Jurídica</option>
                                </select>
                            </div>
                            @error('tipo')
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
                                <input name="estado" @if($cliente->estado == true) checked @endif value="1" type="radio" class="with-gap" id="radio_1" />
                                <label for="radio_1">Activo</label>
                                <input name="estado" @if($cliente->estado == false) checked @endif value="0" type="radio" id="radio_2"  class="with-gap" />
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
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-lg btn-success waves-effect">CREAR CLIENTE</button>
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
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

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
        function random() {
            return Math.random().toString(36).substr(2); // Eliminar `0.`
        };
        $( document ).ready(function() {
            $token = random()+random();
            $('#password').val($token);
            $('#password-token').html($token);
        });
    </script>
@endsection