@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        EMPLEADOS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado))
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    AGREGAR EMPLEADO
                </button>
            </form>
        </div>
        @endif
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    EMPLEADOS DADOS DE BAJA
                </button>
            </form>
        </div>
        @endsection
    </div>
    <div class="row p-1 ">
        <div class="row border border-dark m-2 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">EMPLEADOS</h4>

                    <div class="input-group">
                        <input type="text" class="form-control my-1" placeholder="BUSCAR EMPLEADO" id="texto">
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>

                </div>
                <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                    <div id="resultados" class="col btn-block h-100">
                    </div>
                </div>
            </div>
            <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
                <!--#FFFBF2"-->
                @if(isset($datosEmpleado))
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/empleado/'.$datosEmpleado->id)}}"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="nempleado">
                                <h4 style="color:#4388CC">EMPLEADO</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5>{{$datosEmpleado->nombre}}</h5>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                            value="{{$datosEmpleado->nombre}}">

                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            APELLIDOS
                                        </label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos"
                                            value="{{$datosEmpleado->apellidos}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            DOMICILIO
                                        </label>
                                        <input type="text" class="form-control" name="domicilio" id="domicilio"
                                            value="{{$datosEmpleado->domicilio}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CURP
                                        </label>
                                        <input type="text" class="form-control" name="curp" id="curp"
                                            value="{{$datosEmpleado->curp}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CORREO
                                        </label>
                                        <input type="text" class="form-control" name="correo" id="correo"
                                            value="{{$datosEmpleado->correo}}">
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">
                                            TELEFONO
                                        </label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                            value="{{$datosEmpleado->telefono}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CARGO
                                        </label>
                                        <input type="text" class="form-control" name="cargo" id="cargo"
                                            value="{{$datosEmpleado->cargo}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CLAVE
                                        </label>
                                        <input type="text" class="form-control" name="claveE" id="claveE"
                                            value="{{$datosEmpleado->claveE}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            USUARIO
                                        </label>
                                        <input type="text" class="form-control" name="usuario" id="usuario"
                                            value="{{$datosEmpleado->usuario}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CONTRASEÑA
                                        </label>
                                        <input type="password" class="form-control" name="contra" id="contra"
                                            value="{{$datosEmpleado->contra}}">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row mx-1">

                    <div class="col-4">
                        <form method="post" action="{{url('/departamento/'.$datosEmpleado->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3" type="submit">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('empleado')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR EMPLEADO</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO EMPLEADO</h5>
                        </label>
                        <div class="form-col w-100">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" id="nombre"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        id="nombre" value="{{ old('nombre') }}" placeholder="Ingresar nombre(s)"
                                        required autocomplete="nombre" autofocus>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        APELLIDOS
                                    </label>
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                        name="apellidos" id="apellidos" value="{{ old('apellidos') }}"
                                        placeholder="Ingresar apellidos" required autocomplete="apellidos" autofocus>
                                    @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        DOMICILIO
                                    </label>
                                    <!--input type="text" class="form-control @error('domicilio') is-invalid @enderror"
                                    name="domicilio" id="domicilio" value="{{ old('domicilio') }}" required
                                    autocomplete="domicilio" autofocus-->
                                    <textarea name="domicilio" id="domicilio"
                                        class="form-control @error('domicilio') is-invalid @enderror"
                                        placeholder="Ingresar domicilio completo" value="{{ old('domicilio') }}"
                                        required autocomplete="domicilio" autofocus></textarea>
                                    @error('domicilio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="nombre">
                                        CURP
                                    </label>
                                    <input type="text" class="form-control @error('curp') is-invalid @enderror"
                                        name="curp" id="curp" value="{{ old('curp') }}" placeholder="Ingresar curp"
                                        required autocomplete="curp" autofocus>
                                    @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        EMAIL
                                    </label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder="Ingresar correo electronico" required autocomplete="email"
                                        autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="telefono">
                                        TELEFONO
                                    </label>
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        name="telefono" id="telefono" value="{{ old('telefono') }}"
                                        placeholder="Ingresar telefono" required autocomplete="telefono" autofocus>
                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!--div class="form-group">
                                <label for="nombre">
                                    CARGO
                                </label>
                                <input type="text" class="form-control @error('cargo') is-invalid @enderror"
                                    name="cargo" id="cargo" value="{{ old('cargo') }}" required autocomplete="cargo"
                                    autofocus>
                                @error('cargo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div-->
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        CLAVE
                                    </label>
                                    <input type="text" class="form-control @error('claveE') is-invalid @enderror"
                                        name="claveE" id="claveE" value="{{ old('claveE') }}"
                                        placeholder="Ingresar clave para operaciones" required autocomplete="claveE"
                                        autofocus>
                                    @error('claveE')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        USUARIO
                                    </label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" value="{{ old('username') }}"
                                        placeholder="Ingresar usuario" required autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        CONTRASEÑA
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Ingresar contraseña" required
                                        autocomplete="new-password" autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        {{ __('CONFIRMAR CONTRASEÑA') }}

                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password-confirm" placeholder="Ingresar de nuevo contraseña" required
                                        autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row w-100 d-flex flex-row-reverse">
                            <div class="form-group">
                                <button class="btn btn-outline-dark d-flex" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR EMPLEADO
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
const texto = document.querySelector('#texto');

function filtrar() {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/empleado/buscadorEmpleado?texto=${texto.value}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
texto.addEventListener('keyup', filtrar);
filtrar();
</script>

@endsection