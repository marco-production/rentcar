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
<div class="block-header">
    <h2>DASHBOARD</h2>
</div>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">directions_car</i>
            </div>
            <div class="content">
                <div class="text">VEHICULOS</div>
                <div class="number count-to" data-from="0" data-to="{{$vehiculos}}" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people</i>
            </div>
            <div class="content">
                <div class="text">CLIENTES</div>
                <div class="number count-to" data-from="0" data-to="{{$clientes}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">shopping_cart</i>
            </div>
            <div class="content">
                <div class="text">RENTAS ACTIVAS</div>
                <div class="number count-to" data-from="0" data-to="{{$rentas_activa}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">shopping_cart</i>
            </div>
            <div class="content">
                <div class="text">RENTAS COMPLETADAS</div>
                <div class="number count-to" data-from="0" data-to="{{$rentas_inactiva}}" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->
<!-- CPU Usage -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-6">
                        <h2>CPU UTILIZADO (%)</h2>
                    </div>
                    <div class="col-xs-12 col-sm-6 align-right">
                        <div class="switch panel-switch-btn">
                            <span class="m-r-10 font-12">REAL TIME</span>
                            <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                        </div>
                    </div>
                </div>
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
                <div id="real_time_chart" class="dashboard-flot-chart"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# CPU Usage -->
<div class="row clearfix">
    <!-- Visitors -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-pink">
                <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                     data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                     data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                     data-fill-Color="rgba(0, 188, 212, 0)">
                    12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                </div>
                <ul class="dashboard-stat-list">
                    <li>
                        TODAY
                        <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                    </li>
                    <li>
                        YESTERDAY
                        <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                    </li>
                    <li>
                        LAST WEEK
                        <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Visitors -->
    <!-- Latest Social Trends -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-cyan">
                <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                <ul class="dashboard-stat-list">
                    <li>
                        #socialtrends
                        <span class="pull-right">
                            <i class="material-icons">trending_up</i>
                        </span>
                    </li>
                    <li>
                        #materialdesign
                        <span class="pull-right">
                            <i class="material-icons">trending_up</i>
                        </span>
                    </li>
                    <li>#adminbsb</li>
                    <li>#freeadmintemplate</li>
                    <li>#bootstraptemplate</li>
                    <li>
                        #freehtmltemplate
                        <span class="pull-right">
                            <i class="material-icons">trending_up</i>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Latest Social Trends -->
    <!-- Answered Tickets -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="body bg-teal">
                <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                <ul class="dashboard-stat-list">
                    <li>
                        TODAY
                        <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                    </li>
                    <li>
                        YESTERDAY
                        <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                    </li>
                    <li>
                        LAST WEEK
                        <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                    </li>
                    <li>
                        LAST MONTH
                        <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                    </li>
                    <li>
                        LAST YEAR
                        <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                    </li>
                    <li>
                        ALL
                        <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Answered Tickets -->
</div>

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
