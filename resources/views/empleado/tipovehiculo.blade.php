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
<div class="container-fluid">
    <tipo-vehiculo-component></tipo-vehiculo-component>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>

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
    <script src="{{ asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js')}}"></script>
    <script src="{{ asset('js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{ asset('js/pages/ui/modals.js')}}"></script>
    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $('html, body').animate({scrollTop:0}, 'slow');
            $('.label-up').click(function(){  //referimos el elemento ( clase o identificador de acción )
                $('html, body').animate({scrollTop:0}, 'slow'); //seleccionamos etiquetas,clase o identificador destino, creamos animación hacia top de la página.
                return false;
            });
        });
    </script>
@endsection