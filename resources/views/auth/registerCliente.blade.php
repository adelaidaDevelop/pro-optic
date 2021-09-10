@extends('layouts.headerEcommerce')
@section('contenido')
<div class="row mx-auto my-3 p-1">
    <h4 class="text-primary mx-auto"><strong> Registro</strong></h4>
</div>
<div class="row col-xl-8 mx-auto p-3 border">
    <div class="card mx-auto col-xl-10 ">
        <!--div class="card-header">{{ __('Register') }}</div-->
        <div class="card-body">
            <form method="POST" action="{{ url('registerPost') }}">
                @csrf

                <div class="form-group row px-auto">
                    <label for="nombre" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row px-auto">
                    <label for="apellidoPaterno" class="col-md-4 col-form-label text-md-left">{{ __('Apellido Paterno') }}</label>

                    <div class="col-md-6">
                        <input id="apellidoPaterno" type="text" class="form-control @error('apellidoPaterno') is-invalid @enderror" name="apellidoPaterno" value="{{ old('apellidoPaterno') }}" required autocomplete="apellidoMaterno" autofocus>

                        @error('apellidoPaterno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row px-auto">
                    <label for="apellidoMaterno" class="col-md-4 col-form-label text-md-left">{{ __('Apellido Materno') }}</label>

                    <div class="col-md-6">
                        <input id="apellidoMaterno" type="text" class="form-control @error('apellidoMaterno') is-invalid @enderror" name="apellidoMaterno" value="{{ old('apellidoMaterno') }}" required autocomplete="apellidoMaterno" autofocus>

                        @error('apellidoMaterno')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefono" class="col-md-4 col-form-label text-md-left">{{ __('Telefono') }}</label>

                    <div class="col-md-6">
                        <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="TEL 8-10 DIGITOS" pattern="[0-9]{8,10}" required autocomplete="telefono" autofocus>

                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!--div class="form-group row">
                    <label for="domicilio" class="col-md-4 col-form-label text-md-left">{ __('Domicilio') }}</label>

                    <div class="col-md-6">
                        <input id="domicilio" type="text" class="form-control error('domicilio') is-invalid enderror"
                            name="domicilio" value="{ old('domicilio') }}" required autocomplete="domicilio" autofocus>

                        error('domicilio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{ $message }}</strong>
                        </span>
                        enderror
                    </div>
                </div-->

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-left">{{ __('Nombre de Usuario') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Registrarse') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("input[name='telefono']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });

    //validar texto sin numero
    
    $("input[name='nombre']").bind('keypress', function(tecla) {
        if (this.value.length >= 100) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return false;
        } else { // other keys.
            return true;
        }
    });
    
   
    $("input[name='apellidoPaterno']").bind('keypress', function(tecla) {
        if (this.value.length >= 100) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return false;
        } else { // other keys.
            return true;
        }
    });
    $("input[name='apellidoMaterno']").bind('keypress', function(tecla) {
        if (this.value.length >= 100) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return false;
        } else { // other keys.
            return true;
        }
    });
    

  
    
</script>
@endsection