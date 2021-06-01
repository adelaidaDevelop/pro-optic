@extends('layouts.headerEcommerce')
@section('contenido')
<div class="row mx-auto my-3 p-1">
    <h4 class="text-primary mx-auto"><strong> INICIO DE SESION</strong></h4>
</div>
<div class="row col-sm-7 mx-auto p-3 border">
    @if(isset($compra))
    <form method="POST" class="col-sm-10 mx-auto" action="{{ url('loginCliente') }}?compra=1">
    @else
    <form method="POST" class="col-sm-10 mx-auto" action="{{ url('loginCliente') }}">
    @endif
        @csrf
        <div class="form-group">
            <label for="email"><strong>Correo Electronico</strong></label>
            <div class="input-group mb-3 align-self-center text-center">
                <!--div class="input-group-prepend text-right">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('img\usuario1.png') }}" class="position-relative" alt="Inicio"
                            height="20px" />
                    </span>
                </div-->
                <!--<input type="text" size="35" placeholder="USUARIO" aria-label="Username" aria-describedby="basic-addon1">-->
                <input id="email" type="email" size="35" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="USUARIO" required autocomplete="email"
                    autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="password"><strong>Contraseña</strong></label>
            <!--div class="input-group mb-3 text-right">
            <div class="input-group-prepend text-center">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('img\contra.png') }}" class="position-relative" alt="Inicio" height="20px" />
                </span>
            </div-->
            <!--<input type="password" size="35" placeholder="CONTRASEÑA" aria-label="Username" aria-describedby="basic-addon1">-->
            <input id="password" type="password" size="35" class="form-control @error('password') is-invalid @enderror"
                placeholder="CONTRASEÑA" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <button type="submit" class="btn btn-block btn-success my-2">INICIAR SESION</button>
    </form>
    <div class="row col-sm-10 mx-auto">
        <a href="" class="mx-auto mr-sm-auto ml-sm-0">¿Olvidaste tu contraseña?</a>
        <a href="{{url('registerCliente')}}" class="mx-auto ml-sm-auto mr-sm-0">Registrarse</a>
    </div>
</div>

@endsection