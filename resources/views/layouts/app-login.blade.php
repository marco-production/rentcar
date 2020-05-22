<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>:: Focus Rentcar ::</title>
        <link rel="icon" type="image/ico" href="{{ asset('images/favicon.ico')}}">
        <!-- Custom Css -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('extras/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="{{ asset('extras/main.css')}}" rel="stylesheet">
        <link href="{{ asset('extras/login.css')}}" rel="stylesheet">
        <link href="{{ asset('extras/all-themes.css')}}" rel="stylesheet">
        </head>

<body class="theme-cyan">
<div class="authentication" style="background: url({{ asset('images/login-bg.jpg')}}) no-repeat center center fixed;">
    <div class="container-fluid">
        <div class="row clearfix">               
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-r-0">
                @yield('content')
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 p-l-0">
                <div class="l-detail">
                    <h5 class="position">Welcome</h5>
                    <h1 class="position"><img src="{{ asset('images/logo.svg')}}" alt="profile img"><span>Focus </span>RentCar</h1>
                    <h3 class="position">Accede para empezar SU SESIÓN</h3>
                    <p class="position">Somos una empresa que tiene como actividad principal el alquiler de vehículos durante horas o días, tanto a particulares como a empresarios, comerciantes o transportistas de diferentes sectores. En Focus RentCar se pueden alquilar coches, furgonetas de distintos tamaños, camiones, etc., diferentes vehículos dependiendo de la empresa de la que se trate. </p>                            
                    <ul class="list-unstyled l-social position">
                        <li><a href="#"><i class="zmdi zmdi-facebook-box"></i></a></li>                                
                        <li><a href="#"><i class="zmdi zmdi-linkedin-box"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-pinterest-box"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>                            
                        <li><a href="#"><i class="zmdi zmdi-google-plus-box"></i></a></li>                                     
                    </ul>
                    <ul class="list-unstyled l-menu">
                        <li><a href="#">Contact Us</a></li>                                
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js --> 
<script src="{{ asset('extras/libscripts.bundle.js') }}"></script> <!-- Bootstrap JS and jQuery v3.2.1 --> 
<script src="{{ asset('extras/vendorscripts.bundle.js') }}"></script> <!-- slimscroll, waves Scripts Plugin Js --> 
<script src="{{ asset('extras/mainscripts.bundle.js') }}"></script><!-- Custom Js --> 
</body>
</html>
