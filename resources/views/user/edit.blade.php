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
                    ACTUALIZAR USUARIO - {{$user->full_name}}
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form action="/user/{{$user->slug}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row clearfix">
                    <div class="col-md-12">
                        <label for="full_name">Nombre completo</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="full_name" value="{{$user->full_name}}" name="full_name" class="form-control" placeholder="Ingresa el nombre completo">
                            </div>
                            @error('full_name')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror                            
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <b>Correo electrónico</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control email" value="{{$user->email}}" name="email" placeholder="Ingresa la dirección de correo electrónico">
                            </div>
                            @error('email')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Cédula</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">vpn_key</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control key" value="{{$user->cedula}}" name="cedula" placeholder="Ex: XXX0-XXXX-XX00-X">
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
                        <b>Tanda laboral</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">hourglass_full</i>
                            </span>
                            <span class="input-group"><br>
                                <input type="checkbox" class="filled-in" @if(is_array($tandas) && in_array('Matutina',$tandas)) checked @endif id="ig_matutina" name="tanda[]" value="Matutina">
                                <label for="ig_matutina" style="padding-right: 20px;">Matutina</label>
                                <input type="checkbox" class="filled-in" id="ig_nocturna" @if(is_array($tandas) && in_array('Nocturna',$tandas)) checked @endif name="tanda[]" value="Nocturna">
                                <label for="ig_nocturna">Nocturna</label>
                            </span>
                            @error('tanda')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                             
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b>Comisión</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">work</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" value="{{$user->comision}}" name="comision" placeholder="Ingresa porciento de comision">
                            </div>
                            @error('comision')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <b>Fecha de ingreso</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                                <input type="date" class="form-control" value="{{$user->fecha_ingreso}}" name="fecha_ingreso">
                            </div>
                            @error('fecha_ingreso')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <b>Tipo de usuario</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">work</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}" @if ($user->role_id == $role->id) selected @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                              
                        </div>
                    </div>
                    <div class="col-md-4">
                        <b>Estado</b>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">work</i>
                            </span>
                            <div class="form-line">
                                <select class="form-control show-tick" name="estado">
                                    <option value="1" @if($user->estado == true) selected @endif>Activo</option>
                                    <option value="0" @if($user->estado == false) selected @endif>Inactivo</option>
                                </select>
                            </div>
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
@endsection