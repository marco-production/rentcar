@extends('layouts.app-login')
@section('content')
<div class="card position">
    <h4 class="l-login">Login</h4>
    @if (session('state'))
       <div class="alert alert-danger">{{session('state')}}</div> 
    @endif
    
    <form class="col-md-12" id="sign_in" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group form-float">
            <div class="form-line">
                <input type="email" class="form-control" name="email" autocomplete="email">
                <label class="form-label">Correo electronico</label>
            </div>
            @error('email')
                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="password" class="form-control" name="password" autocomplete="current-password">
                <label class="form-label">Password</label>
            </div>
            @error('password')
                <span class="invalid-feedback" style="color:#dc3545; font-size:12px;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
             @enderror
        </div>
        <div>
            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-cyan" {{ old('remember') ? 'checked' : '' }}>
            <label for="rememberme">Recordar sesión</label>
        </div>
        <button type="submit" class="btn btn-raised bg-cyan waves-effect">
            Iniciar Sesión
        </button>
        @if (Route::has('password.request'))
            <div class="text-left"> <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a> </div>
        @endif
    </form>
</div>
@endsection
