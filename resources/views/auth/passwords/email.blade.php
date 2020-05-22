@extends('layouts.app-login')
@section('content')
<!--div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div-->
<div class="card">
    <h4 class="l-login">¿OLVIDASTE TU CONTRASEÑA?<div class="msg">Introduzca su dirección de correo electrónico para restablecer su contraseña.</div></h4>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form class="col-md-12" id="sign_in" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group form-float">
            <div class="form-line">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                <label class="form-label">Correo electrónico</label>
            </div>
            @error('email')
                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>            
        <div class="row">                    
            <div class="col-sm-12">
                <button type="submit" class="btn btn-raised waves-effect g-bg-cyan">
                    Restablecer contraseña
                </button>
            </div>
            <div class="col-sm-12"> <a href="{{url('/')}}">Iniciar Sesión</a> </div>
        </div>
    </form>
</div>
@endsection
