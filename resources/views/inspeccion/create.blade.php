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
                    INSPECCION DE VEHICULO - {{$vehiculo->marca_name}} {{$vehiculo->modelo_name}} {{$vehiculo->anio}}
                </h2>
            </div>
            <div class="body">
                <form action="/inspeccion" method="POST">
                @csrf
                <input type="hidden" name="renta" value="{{$renta->id}}">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Fecha de inspeccion </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="date" class="form-control" value="{{ old('fecha_inspeccion') }}" name="fecha_inspeccion">
                            </div>
                            @error('fecha_inspeccion')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Empleado </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">library_books</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="empleado">
                                    <option value="">-- Seleccionar empleado --</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{$empleado->id}}" @if(old('empleado') == $empleado->id) selected @elseif($empleado->id == Auth::user()->id) selected @endif>{{$empleado->full_name}} ( {{$empleado->email}} )</option>
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
                    <div class="col-md-3">
                        <b>Tiene ralladuras </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <div class="demo-radio-button">
                                <input name="ralladura" @if(old('ralladura') == 'Si') checked @endif value="Si" type="radio" class="with-gap" id="radio_1" />
                                <label for="radio_1">Si</label>
                                <input name="ralladura" @if(old('ralladura') == 'No') checked @endif value="No" type="radio" id="radio_2"  class="with-gap" />
                                <label for="radio_2">No</label>
                            </div>
                            @error('ralladura')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>Tiene goma respuesta </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <div class="demo-radio-button">
                                <input name="goma_repuesto" @if(old('goma_repuesto') == 'Si') checked @endif value="Si" type="radio" class="with-gap" id="radio_3" />
                                <label for="radio_3">Si</label>
                                <input name="goma_repuesto" @if(old('goma_repuesto') == 'No') checked @endif value="No" type="radio" id="radio_4"  class="with-gap" />
                                <label for="radio_4">No</label>
                            </div>
                            @error('goma_repuesto')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>Tiene gato </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <div class="demo-radio-button">
                                <input name="gato" @if(old('gato') == 'Si') checked @endif value="Si" type="radio" class="with-gap" id="radio_5" />
                                <label for="radio_5">Si</label>
                                <input name="gato" @if(old('gato') == 'No') checked @endif value="No" type="radio" id="radio_6"  class="with-gap" />
                                <label for="radio_6">No</label>
                            </div>
                            @error('gato')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>Tiene roturas cristal </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <div class="demo-radio-button">
                                <input name="rotura_cristal" @if(old('rotura_cristal') == 'Si') checked @endif value="Si" type="radio" class="with-gap" id="radio_7" />
                                <label for="radio_7">Si</label>
                                <input name="rotura_cristal" @if(old('rotura_cristal') == 'No') checked @endif value="No" type="radio" id="radio_8"  class="with-gap" />
                                <label for="radio_8">No</label>
                            </div>
                            @error('rotura_cristal')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <b style="margin-bottom: 15px;">Estado de gomas </b> (<small class="col-pink">Marca las gomas que tienen algun problema o se encuentran en mal estado</small>)
                        <div class="input-group"><br>
                                <div class="demo-checkbox">
                                    <div class="col-md-3">
                                        <input type="checkbox" id="md_checkbox_1" name="gomas[]" @if(is_array(old('gomas')) && in_array('Goma-superior-izquierda', old('gomas'))) checked @endif value="Goma-superior-izquierda" class="filled-in chk-col-red"/>
                                        <label for="md_checkbox_1">Goma superior izquierda</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="md_checkbox_2" name="gomas[]" @if(is_array(old('gomas')) && in_array('Goma-superior-derecha', old('gomas'))) checked @endif value="Goma-superior-derecha" class="filled-in chk-col-red"/>
                                        <label for="md_checkbox_2">Goma superior derecha</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="md_checkbox_3" name="gomas[]" @if(is_array(old('gomas')) && in_array('Goma-inferior-izquierda', old('gomas'))) checked @endif value="Goma-inferior-izquierda" class="filled-in chk-col-red"/>
                                        <label for="md_checkbox_3">Goma inferior izquierda</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="md_checkbox_4" name="gomas[]" @if(is_array(old('gomas')) && in_array('Goma-inferior-derecha', old('gomas'))) checked @endif value="Goma-inferior-derecha" class="filled-in chk-col-red"/>
                                        <label for="md_checkbox_4">Goma inferior derecha</label>
                                    </div>
                                </div>
                            @error('gomas[]')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Cantidad de combustible </b><span class="col-pink">*</span>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">dialpad</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="combustible" id="combustible">
                                    <option value="">-- Seleccionar cantidad --</option>
                                    <option @if(old('combustible') == '1/4') selected @endif value="1/4">1/4</option>
                                    <option @if(old('combustible') == '1/2') selected @endif value="1/2">1/2</option>
                                    <option @if(old('combustible') == '3/4') selected @endif value="3/4">3/4</option>
                                    <option @if(old('combustible') == 'Tanque lleno') selected @endif value="Tanque lleno">Tanque lleno</option>
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
                                <input name="estado" @if(old('estado') == 1) checked @endif value="1" checked type="radio" class="with-gap" id="radio_11"/>
                                <label for="radio_11">Activo</label>
                                <input name="estado" @if(old('estado') == 2) checked @endif value="2" type="radio" id="radio_12"  class="with-gap" />
                                <label for="radio_12">Inactivo</label>
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
                            <button type="submit" class="btn btn-block btn-lg btn-success waves-effect">REGISTRAR</button>
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