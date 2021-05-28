@extends('header2')
@php
use App\Models\Sucursal_empleado;
$vE = ['verEmpleado','modificarEmpleado','eliminarEmpleado','crearEmpleado','admin'];
$mE= ['modificarEmpleado','admin'];
$cE= ['crearEmpleado','admin'];
$eE= ['eliminarEmpleado','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificarE = $sE->hasAnyRole($mE);
$crearE = $sE->hasAnyRole($cE);
$eliminarE = $sE->hasAnyRole($eE);
$verE = $sE->hasAnyRole($vE);

$vS = ['veriSucursal','modificarSucursal','eliminarSucursal','crearSucursal','admin'];
$mS= ['modificarSucursal','admin'];
$cS= ['crearSucursal','admin'];
$eS= ['eliminarSucursal','admin'];
$modificarS = $sE->hasAnyRole($mS);
$crearS = $sE->hasAnyRole($cS);
$eliminarS = $sE->hasAnyRole($eS);
$verS = $sE->hasAnyRole($vS);
@endphp
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        EMPLEADOS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado) || isset($admin))
        @if($crearE)
        <div class="  ml-4">
            <form method="get" action="{{url('/puntoVenta/empleado')}}">
                <button class="btn btn-outline-secondary  ml-4 p-1 border-0" type="submit">
                    <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
                    <p class="h6 my-auto text-dark"><small>AGREGAR EMPLEADO</small></p>

                </button>
            </form>
        </div>
        @endif
        @endif
        @if($verS)
        <div class=" ">
            <form method="get" action="{{url('/puntoVenta/administracion/')}}">
                <button class="btn btn-outline-secondary  p-1 border-0" type="submit">
                    <img src="{{ asset('img\sucursal2.png') }}" alt="Editar" width="30px" height="30px">
                    <p class="h6 my-auto mx-2 text-dark"><small>SUCURSALES</small></p>
                </button>
            </form>
        </div>

        @endif
        <!--div class="">
            <form method="get" action="{url('/puntoVenta/empleado/')}}">
                <button class="btn btn-outline-secondary  p-1 border-0" type="submit" >
                <img src="{ asset('img\empleado.png') }}" alt="Editar" width="30px" height="30px">
                    <p class="h6 my-auto mx-2 text-dark"><small>EMPLEADOS</small></p>
                </button>
            </form>
        </div-->
        <div class="col-6 ml-4"></div>
        <div class=" ml-3 my-auto">
            <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/administracion">
                <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="35px" height="35px">
            </a>
        </div>
        <div class=" ml-3 my-auto">
            <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
                <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
            </a>
        </div>

        @endsection
    </div>
    <div class="row p-1 ">
        <!--{ {Session::get('cambios')}}
        { {session('cambios')}}
        @ if(session()->has('cambios')) Si lo recibo @ else No lo recibo @ endif-->
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
                <!--div class="row m-0 px-0 border" style="height:300px;overflow-y:auto;"-->
                <div class="row m-0 px-0 border h-50" style="overflow-y:auto;">
                    <div id="resultados" class="col btn-block h-100">
                    </div>
                </div>
            </div>
            <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
                <!--#FFFBF2"-->
                @if(isset($admin))
                <div class="row px-3 pt-3 m-0">
                    <form class="w-100" method="post" action="{{url('puntoVenta/empleado/0')}}"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="nempleado">
                                <h4 style="color:#4388CC">ADMINISTRADOR</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5 class="text-uppercase">{{$admin->username}}</h5>
                            </label>
                            <fieldset disabled id="formEditar">

                                <div class="form-col w-100">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                USUARIO
                                            </label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror text-uppercase"
                                                name="username" id="username"
                                                value="@if(session()->has('cambios')){{old('username')}}@else{{$admin->username}}@endif"
                                                placeholder="Ingresar usuario" required autocomplete="username"
                                                autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="claveE">
                                                CLAVE
                                            </label>

                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('claveE') is-invalid @enderror"
                                                    name="claveE" id="claveE"
                                                    value="@if(session()->has('cambios')){{old('claveE')}}@else{{$admin->claveE}}@endif"
                                                    placeholder="Ingresar clave para operaciones" required
                                                    autocomplete="claveE" autofocus readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" onclick="mostrarPasswordClave()"
                                                        type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="m-0" viewBox="0 0 16 16"
                                                            id="iconPasswordClave">
                                                            <path
                                                                d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                                            <path
                                                                d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
                                                        </svg>
                                                    </button>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="button-addon2" onclick="generarClave()">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-arrow-clockwise"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                            <path
                                                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                                        </svg>
                                                        <!--img class="btn btn-outline-secondary" type="button" src="{ asset('img\recargar.svg') }}" class="img-thumbnail" alt="Editar"
                                                        fill="currentColor"-->
                                                    </button>
                                                </div>
                                            </div>
                                            @error('claveE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                EMAIL
                                            </label>
                                            <input type="text"
                                                class="form-control @error('email') is-invalid @enderror text-uppercase"
                                                name="email" id="email"
                                                value="@if(session()->has('cambios')){{old('email')}}@else{{$admin->email}}@endif"
                                                placeholder="Ingresar correo electronico" required autocomplete="email"
                                                autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                DOMICILIO DE LA SUCURSAL
                                            </label>
                                            <textarea name="domicilio" id="domicilio"
                                                class="form-control @error('domicilio') is-invalid @enderror"
                                                placeholder="Ingresar domicilio completo" value="" required
                                                autocomplete="domicilio" autofocus
                                                disabled>@if(session()->has('cambios')){{old('domicilio')}}@else{{$sucursal->direccion}}@endif</textarea>
                                            @error('domicilio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="telefono">
                                                TELEFONO DE LA SUCURSAL
                                            </label>
                                            <input type="text"
                                                class="form-control @error('telefono') is-invalid @enderror"
                                                name="telefono" id="telefono"
                                                value="@if(session()->has('cambios')){{old('telefono')}}@else{{$sucursal->telefono}}@endif"
                                                placeholder="Ingresar telefono" required autocomplete="telefono"
                                                autofocus disabled>
                                            @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                            <div class="form-row d-flex flex-row-reverse px-1">
                                @if($modificarE)
                                <a class="btn btn-outline-secondary" type="button" id="btnFormCancelar"
                                    href="{{url('puntoVenta/empleado/0/edit/')}}">
                                    <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    CANCELAR
                                </a>
                                <button class="btn btn-outline-secondary mr-auto" type="submit" id="btnForm">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR CAMBIOS
                                </button>

                                <button class="btn btn-outline-secondary mr-auto" type="button" id="btnEditar"
                                    onclick="habilitar()">
                                    <img src="{{ asset('img\edit.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    EDITAR DATOS
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row px-3 mb-4">
                    @if($modificarE)
                    <div class="col-auto ">
                        <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                            data-target="#modalPassword" value="SI">
                            <!--img src="{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px"-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path
                                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                <path fill-rule="evenodd"
                                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                            </svg>
                            CAMBIAR CONTRASEÑA
                        </button>
                    </div>
                    @endif
                    <!--div class="col-auto ml-auto mr-0">
                        <form method="post" action="{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {csrf_field()}}
                            { method_field('PUT')}}
                            <input type="" id="status" name="status" value="baja" style="display:none">
                            <button class="btn btn-outline-secondary" type="submit" value="SI">
                                <img src="{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div-->


                    <!--div class="col-4">
                        <form method="post" action="{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {csrf_field()}}
                            { method_field('PUT')}}
                            <input type="" id="status" name="status" value="alta" style="display:none">

                            <button class="btn btn-outline-secondary" type="submit" value="SI">
                                <img src="{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE ALTA?
                            </button>
                        </form>
                    </div-->
                    <!--button class="btn btn-outline-secondary my-3" type="button" onclick="habilitar()">
                        <img src="{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                            height="25px">
                        Habilitar
                    </button-->
                </div>

                @else
                @if(isset($datosEmpleado))
                <div class="row px-3 pt-3 m-0">
                    <form class="w-100" method="post" action="{{url('puntoVenta/empleado/'.$datosEmpleado->id)}}"
                        enctype="multipart/form-data">

                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="nempleado">
                                <h4 style="color:#4388CC">EMPLEADO</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5 class="text-uppercase">{{$datosEmpleado->primerNombre}}
                                    {{$datosEmpleado->segundoNombre}}
                                    {{$datosEmpleado->apellidoPaterno}} {{$datosEmpleado->apellidoMaterno}}</h5>
                            </label>
                            <fieldset disabled id="formEditar">

                                <div class="form-col w-100">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="nombre">
                                                PRIMER NOMBRE
                                            </label>
                                            <input type="text" id="primerNombre"
                                                class="form-control @error('primerNombre') is-invalid @enderror "
                                                name="primerNombre"
                                                value="@if(session()->has('cambios')){{old('primerNombre')}}@else{{$datosEmpleado->primerNombre}}@endif"
                                                placeholder="INGRESAR PRIMER NOMBRE" required autocomplete="primerNombre"
                                                autofocus>
                                            @error('primerNombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col">
                                            <label for="nombre">
                                                SEGUNDO NOMBRE
                                            </label>
                                            <input type="text" id="segundoNombre"
                                                class="form-control @error('segundoNombre') is-invalid @enderror "
                                                name="segundoNombre"
                                                value="@if(session()->has('cambios')){{old('segundoNombre')}}@else{{$datosEmpleado->segundoNombre}}@endif"
                                                placeholder="@if(isset($datosEmpleado->segundoNombre))INGRESAR SEGUNDO NOMBRE @endif"
                                                autocomplete="segundoNombre" autofocus>
                                            @error('segundoNombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="apellidoPaterno">
                                                APELLIDO PATERNO
                                            </label>
                                            <input type="text"
                                                class="form-control @error('apellidoPaterno') is-invalid @enderror "
                                                name="apellidoPaterno" id="apellidoPaterno"
                                                value="@if(session()->has('cambios')){{old('apellidoPaterno')}}@else{{$datosEmpleado->apellidoPaterno}}@endif"
                                                placeholder="INGRESAR APELLIDO PATERNO" required
                                                autocomplete="apellidoPaterno" autofocus>
                                            @error('apellidoPaterno')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="apellidoMaterno">
                                                APELLIDO MATERNO
                                            </label>
                                            <input type="text"
                                                class="form-control @error('apellidoMaterno') is-invalid @enderror "
                                                name="apellidoMaterno" id="apellidoMaterno"
                                                value="@if(session()->has('cambios')){{old('apellidoMaterno')}}@else{{$datosEmpleado->apellidoMaterno}}@endif"
                                                placeholder="INGRESAR APELLIDO MATERNO" required
                                                autocomplete="apellidoMaterno" autofocus>
                                            @error('apellidoPaterno')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="genero">
                                                GENERO
                                            </label>
                                            <select name="genero"
                                                class="form-control @error('genero') is-invalid @enderror" id="genero"
                                                required autocomplete="genero" autofocus>
                                                <option value="H">HOMBRE</option>
                                                <option value="M">MUJER</option>
                                            </select>
                                            @error('genero')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="entidadFederativa">
                                                ENTIDAD FEDERATIVA
                                            </label>
                                            <select name="entidadFederativa"
                                                class="form-control @error('entidadFederativa') is-invalid @enderror"
                                                id="entidadFederativa" required autocomplete="entidadFederativa"
                                                autofocus>
                                                <option value="AS">AGUASCALIENTES</option>
                                                <option value="BC">BAJA CALIFORNIA</option>
                                                <option value="BS">BAJA CALIFORNIA SUR</option>
                                                <option value="CC">CAMPECHE</option>
                                                <option value="CL">COAHUILA</option>
                                                <option value="CM">COLIMA</option>
                                                <option value="CS">CHIAPAS</option>
                                                <option value="CH">CHIHUAHUA</option>
                                                <option value="DF">DISTRITO FEDERAL</option>
                                                <option value="DG">DURANGO</option>
                                                <option value="GT">GUANAJUATO</option>
                                                <option value="GR">GUERRERO</option>
                                                <option value="HG">HIDALGO</option>
                                                <option value="JC">JALISCO</option>
                                                <option value="MC">MÉXICO</option>
                                                <option value="MN">MICHOACÁN</option>
                                                <option value="MS">MORELOS</option>
                                                <option value="NT">NAYARIT</option>
                                                <option value="NL">NUEVO LEÓN</option>
                                                <option value="OC">OAXACA</option>
                                                <option value="PL">PUEBLA</option>
                                                <option value="QT">QUERÉTARO</option>
                                                <option value="CS">CHIAPAS</option>
                                                <option value="QR">QUINTANA ROO</option>
                                                <option value="SP">SAN LUIS POTOSÍ </option>
                                                <option value="SL">SINALOA</option>
                                                <option value="SR">SONORA</option>
                                                <option value="TC">TABASCO</option>
                                                <option value="TS">TAMAULIPAS</option>
                                                <option value="TL">TLAXCALA</option>
                                                <option value="VZ">VERACRUZ</option>
                                                <option value="YN">YUCATÁN</option>
                                                <option value="VZ">VERACRUZ</option>
                                                <option value="ZS">ZACATECAS</option>
                                                <option value="NE">NACIDO EN EL EXTRANJERO</option>

                                            </select>
                                            @error('entidadFederativa')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="fechaNacimiento">
                                                FECHA DE NACIMIENTO
                                            </label>
                                            <input type="date" min="" max="" name="fechaNacimiento" id="fechaNacimiento"
                                                class="form-control mr-3" />

                                            <!--textarea name="fechaNacimiento" id="fechaNacimiento"
                                        class="form-control @error('fechaNacimiento') is-invalid @enderror"
                                         value="{ old('fechaNacimiento') }}"
                                        required autocomplete="fechaNacimiento" autofocus>{ old('fechaNacimiento') }}</textarea-->
                                            @error('fechaNacimiento')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="curp">
                                                CURP
                                            </label>
                                            <input type="text" class="form-control @error('curp') is-invalid @enderror "
                                                name="curp" id="curp"
                                                value="@if(session()->has('cambios')){{ old('curp') }}@else{{$datosEmpleado->curp}}@endif"
                                                placeholder="INGRESAR CURP" required autocomplete="curp" autofocus
                                                readonly>
                                            @error('curp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="domicilio">
                                                DOMICILIO
                                            </label>
                                            <textarea name="domicilio" id="domicilio"
                                                class="text-uppercase  form-control @error('domicilio') is-invalid @enderror"
                                                placeholder="INGRESAR DOMICILIO COMPLETO"
                                                value="{{$datosEmpleado->domicilio}}" required autocomplete="domicilio"
                                                autofocus>@if(session()->has('cambios')){{ old('domicilio')}}@else{{$datosEmpleado->domicilio}}@endif</textarea>
                                            @error('domicilio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!--div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="genero">
                                                GENERO
                                            </label>
                                            <select name="genero"
                                                class="form-control @error('genero') is-invalid @enderror"
                                                id="opcionSucursal" required autocomplete="genero" autofocus>
                                                <option value="H">HOMBRE</option>
                                                <option value="M">MUJER</option>
                                            </select>
                                            @error('genero')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="curp">
                                                CURP
                                            </label>
                                            <input type="text"
                                                class="form-control @error('curp') is-invalid @enderror "
                                                name="curp" id="curp"
                                                value="@if(session()->has('cambios')){{ old('curp') }}@else{{$datosEmpleado->curp}}@endif"
                                                placeholder="Ingresar curp" required autocomplete="curp" autofocus>
                                            @error('curp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div-->

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="email">
                                                EMAIL
                                            </label>
                                            <input type="text"
                                                class="form-control @error('email') is-invalid @enderror " name="email"
                                                id="email"
                                                value="@if(session()->has('cambios')){{old('email')}}@else{{$users->email}}@endif"
                                                placeholder="INGRESAR CORREO ELECTRONICO" required autocomplete="email"
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
                                            <input type="tel"
                                                class="form-control @error('telefono') is-invalid @enderror "
                                                name="telefono" id="telefono"
                                                value="@if(session()->has('cambios')){{old('telefono')}}@else{{$datosEmpleado->telefono}}@endif"
                                                placeholder="TEL 8-10 DIGITOS" pattern="[0-9]{8,10}" required autocomplete="telefono"
                                                autofocus>
                                            @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="claveE">
                                                CLAVE
                                            </label>

                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('claveE') is-invalid @enderror"
                                                    name="claveE" id="claveE"
                                                    value="@if(session()->has('cambios')){{old('claveE')}}@else{{$datosEmpleado->claveE}}@endif"
                                                    placeholder="Ingresar clave para operaciones" required
                                                    autocomplete="claveE" autofocus readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" onclick="mostrarPasswordClave()"
                                                        type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="m-0" viewBox="0 0 16 16"
                                                            id="iconPasswordClave">
                                                            <path
                                                                d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                                            <path
                                                                d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
                                                        </svg>
                                                    </button>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        id="button-addon2" onclick="generarClave()">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-arrow-clockwise"
                                                            viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                            <path
                                                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                                        </svg>
                                                        <!--img class="btn btn-outline-secondary" type="button" src="{ asset('img\recargar.svg') }}" class="img-thumbnail" alt="Editar"
                                                        fill="currentColor"-->
                                                    </button>
                                                </div>
                                            </div>
                                            @error('claveE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="username">
                                                USUARIO
                                            </label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror "
                                                name="username" id="username"
                                                value="@if(session()->has('cambios')){{old('username')}}@else{{$users->username}}@endif"
                                                placeholder="INGRESAR USUARIO" required autocomplete="username"
                                                autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                            <div class="form-row d-flex flex-row-reverse px-1">
                                @if($modificarE)
                                <a class="btn btn-outline-secondary" type="button" id="btnFormCancelar"
                                    href="{{url('puntoVenta/empleado/'.$datosEmpleado->id.'/edit/')}}">
                                    <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    CANCELAR
                                </a>
                                <button class="btn btn-outline-secondary mr-auto" type="submit" id="btnForm">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR CAMBIOS
                                </button>
                                <button class="btn btn-outline-secondary mr-auto" type="button" id="btnEditar"
                                    onclick="habilitar()">
                                    <img src="{{ asset('img\edit.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    EDITAR DATOS
                                </button>
                                @endif

                            </div>
                            @if($eliminarE)
                            <div class="col-4 px-1">
                                <button class=" btn btn-outline-danger ml-auto mt-4"
                                    onclick="eliminarEmpleado({{$datosEmpleado->id}})" type="button">
                                    <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                    ELIMINAR
                                </button>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="row px-3 mb-4">
                    @if($modificarE)
                    <div class="col-auto ">
                        <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                            data-target="#modalPassword" value="SI">
                            <!--img src="{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px"-->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path
                                    d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                <path fill-rule="evenodd"
                                    d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                            </svg>
                            CAMBIAR CONTRASEÑA
                        </button>
                    </div>
                    @endif
                    <!--div class="col-auto ml-auto mr-0">
                        <form method="post" action="{{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {{csrf_field()}}
                            {{ method_field('PUT')}}
                            <input id="status" name="status" value="baja" style="display:none">
                            <button class="btn btn-outline-secondary" type="submit" value="SI">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div-->
                    <!--div class="col-auto ml-auto mr-0">
                        <form method="post" action="{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {csrf_field()}}
                            { method_field('PUT')}}
                            <input type="" id="status" name="status" value="alta" style="display:none">

                            <button class="btn btn-outline-secondary" type="submit" value="SI">
                                <img src="{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE ALTA
                            </button>
                        </form>
                    </div-->
                    <!--div class="col-auto mr-0">
                        <form method="post" id="formEliminar" action="{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {csrf_field()}}
                            { method_field('DELETE')}}
                            <button class="btn btn-outline-danger" type="submit" value="SI">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                ELIMINAR
                            </button>
                        </form>
                    </div-->
                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('puntoVenta/empleado')}}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR EMPLEADO</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO </h5>
                        </label>
                        <div class="form-col w-100">
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="primerNombre">
                                        PRIMER NOMBRE
                                    </label>
                                    <input type="text" id="primerNombre"
                                        class="form-control @error('primerNombre') is-invalid @enderror"
                                        name="primerNombre" id="primerNombre" value="{{ old('primerNombre') }}"
                                        placeholder="INGRESAR PRIMER NOMBRE" required autocomplete="primerNombre" autofocus>
                                    @error('primerNombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="segundoNombre">
                                        SEGUNDO NOMBRE
                                    </label>
                                    <input type="text" id="segundoNombre"
                                        class="form-control @error('segundoNombre') is-invalid @enderror"
                                        name="segundoNombre" id="segundoNombre" value="{{ old('segundoNombre') }}"
                                        placeholder="INGRESAR SEGUNDO NOMBRE" autocomplete="segundoNombre" autofocus>
                                    @error('segundoNombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="apellidoPaterno">
                                        APELLIDO PATERNO
                                    </label>
                                    <input type="text"
                                        class=" form-control @error('apellidoPaterno') is-invalid @enderror"
                                        name="apellidoPaterno" id="apellidoPaterno" value="{{ old('apellidoPaterno') }}"
                                        placeholder="INGRESAR APELLIDO PATERNO" required autocomplete="apellidoPaterno"
                                        autofocus>
                                    @error('apellidoPaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="apellidoMaterno">
                                        APELLIDO MATERNO
                                    </label>
                                    <input type="text"
                                        class=" form-control @error('apellidoMaterno') is-invalid @enderror"
                                        name="apellidoMaterno" id="apellidoMaterno" value="{{ old('apellidoMaterno') }}"
                                        placeholder="INGRESAR APELLIDO MATERNO" required autocomplete="apellidoMaterno"
                                        autofocus>
                                    @error('apellidoMaterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="genero">
                                        GENERO
                                    </label>
                                    <select name="genero" class="form-control @error('genero') is-invalid @enderror"
                                        id="genero" required autocomplete="genero" value="{{ old('genero') }}"
                                        autofocus>
                                        <option value="H">HOMBRE</option>
                                        <option value="M">MUJER</option>
                                    </select>
                                    @error('genero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="entidadFederativa">
                                        ENTIDAD FEDERATIVA
                                    </label>
                                    <select name="entidadFederativa"
                                        class="form-control @error('entidadFederativa') is-invalid @enderror"
                                        id="entidadFederativa" required autocomplete="entidadFederativa"
                                        value="{{ old('entidadFederativa') }}" autofocus>
                                        <option value="AS">AGUASCALIENTES</option>
                                        <option value="BC">BAJA CALIFORNIA</option>
                                        <option value="BS">BAJA CALIFORNIA SUR</option>
                                        <option value="CC">CAMPECHE</option>
                                        <option value="CL">COAHUILA</option>
                                        <option value="CM">COLIMA</option>
                                        <option value="CS">CHIAPAS</option>
                                        <option value="CH">CHIHUAHUA</option>
                                        <option value="DF">DISTRITO FEDERAL</option>
                                        <option value="DG">DURANGO</option>
                                        <option value="GT">GUANAJUATO</option>
                                        <option value="GR">GUERRERO</option>
                                        <option value="HG">HIDALGO</option>
                                        <option value="JC">JALISCO</option>
                                        <option value="MC">MÉXICO</option>
                                        <option value="MN">MICHOACÁN</option>
                                        <option value="MS">MORELOS</option>
                                        <option value="NT">NAYARIT</option>
                                        <option value="NL">NUEVO LEÓN</option>
                                        <option value="OC">OAXACA</option>
                                        <option value="PL">PUEBLA</option>
                                        <option value="QT">QUERÉTARO</option>
                                        <option value="CS">CHIAPAS</option>
                                        <option value="QR">QUINTANA ROO</option>
                                        <option value="SP">SAN LUIS POTOSÍ </option>
                                        <option value="SL">SINALOA</option>
                                        <option value="SR">SONORA</option>
                                        <option value="TC">TABASCO</option>
                                        <option value="TS">TAMAULIPAS</option>
                                        <option value="TL">TLAXCALA</option>
                                        <option value="VZ">VERACRUZ</option>
                                        <option value="YN">YUCATÁN</option>
                                        <option value="VZ">VERACRUZ</option>
                                        <option value="ZS">ZACATECAS</option>
                                        <option value="NE">NACIDO EN EL EXTRANJERO</option>

                                    </select>
                                    @error('entidadFederativa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="fechaNacimiento">
                                        FECHA DE NACIMIENTO
                                    </label>
                                    <input type="date" min="" max="" name="fechaNacimiento" id="fechaNacimiento"
                                        class="form-control mr-3" value="{{ old('fechaNacimiento') }}" />

                                    <!--textarea name="fechaNacimiento" id="fechaNacimiento"
                                        class="form-control @error('fechaNacimiento') is-invalid @enderror"
                                         value="{ old('fechaNacimiento') }}"
                                        required autocomplete="fechaNacimiento" autofocus>{ old('fechaNacimiento') }}</textarea-->
                                    @error('fechaNacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="curp">
                                        CURP
                                    </label>
                                    <input type="text" class=" form-control @error('curp') is-invalid @enderror"
                                        name="curp" id="curp" value="{{ old('curp') }}" placeholder="INGRESAR CURP"
                                        required autocomplete="curp" autofocus readonly>
                                    @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="domicilio">
                                        DOMICILIO
                                    </label>
                                    <textarea name="domicilio" id="domicilio"
                                        class="form-control @error('domicilio') is-invalid @enderror"
                                        placeholder="INGRESAR DOMICILIO COMPLETO" value="{{ old('domicilio') }}"
                                        required autocomplete="domicilio" autofocus>{{ old('domicilio') }}</textarea>
                                    @error('domicilio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="email">
                                        EMAIL
                                    </label>
                                    <input type="text" class=" form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder="INGRESAR CORREO ELECTRONICO" required autocomplete="email"
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
                                    <input type="tel" class=" form-control @error('telefono') is-invalid @enderror"
                                        name="telefono" id="telefono" value="{{ old('telefono') }}"
                                        placeholder="TEL 8-10 DIGITOS" pattern="[0-9]{8,10}" required autocomplete="telefono" autofocus>
                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="claveE">
                                        CLAVE
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="password"
                                            class=" form-control @error('claveE') is-invalid @enderror" name="claveE"
                                            id="claveE" value="{{ old('claveE') }}"
                                            placeholder="INGRESAR CLAVE PARA OPERACIONES" required autocomplete="claveE"
                                            autofocus readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" onclick="mostrarPasswordClave()" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="m-0" viewBox="0 0 16 16"
                                                    id="iconPasswordClave">
                                                    <path
                                                        d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                                    <path
                                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />

                                                </svg>
                                            </button>
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                                onclick="generarClave()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-arrow-clockwise"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                    <path
                                                        d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                                </svg>
                                                <!--img class="btn btn-outline-secondary" type="button" src="{ asset('img\recargar.svg') }}" class="img-thumbnail" alt="Editar"
                                                        fill="currentColor"-->
                                            </button>
                                        </div>
                                    </div>
                                    @error('claveE')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="username">
                                        USUARIO
                                    </label>
                                    <input type="text" class=" form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" value="{{ old('username') }}"
                                        placeholder="INGRESAR USUARIO" required autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="password">
                                        CONTRASEÑA
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="INGRESAR CONTRASEÑA" required
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
                                        id="password-confirm" placeholder="INGRESAR CONTRASEÑA NUEVAMENTE" required
                                        autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        @if($crearE)
                        <div class="form-row w-100 d-flex flex-row-reverse">
                            <div class="form-group">
                                <button class="btn btn-outline-dark d-flex" type="submit"
                                    onclick="return confirm('DESEA AGREGAR ESTE EMPLEADO');">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    AGREGAR EMPLEADO
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="form-row w-100 d-flex flex-row-reverse">
                            <div class="form-group">
                                <button class="btn btn-outline-dark d-flex"
                                    onclick="alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')" type="button">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR EMPLEADO
                                </button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
                @endif
                @endif
            </div>
        </div>
        <!--button class="btn btn-outline-secondary" type="button" onclick="validarCURP()"> testear curp</button-->
    </div>
</div>
<div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center ml-auto" id="exampleModalLabel">@if(isset($datosEmpleado))
                    {{$datosEmpleado->nombre}} @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModal">
                <div class="form-group m-2">
                    <label for="exampleInputEmail1">NUEVA CONTRASEÑA</label>
                    <div class="input-group mb-3">
                        <input type="password" id="passwordChange" class="form-control"
                            placeholder=" Ingrese su nueva contraseña" aria-label=" Recipient's username"
                            aria-describedby="button-addon2" required>
                        <div class="input-group-append">
                            <button class="btn btn-dark" onclick="mostrarPassword()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="m-0" viewBox="0 0 16 16" id="iconPassword">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </button>
                        </div>
                        <span class="invalid-feedback ">
                            <strong id="alertaPassword"></strong>
                        </span>
                    </div>
                    <!--div class="row mx-auto" id="alertaPassword">

                    </div-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="cuerpoModalOriginal()"
                    data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" id="continuar"
                    onclick="actualizarPassword()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js\curp.js') }}"></script>
<script>
/*function eliminarEmpleado() {
    var form = document.getElementById('formEliminar');
    form.addEventListener('submit', function(event) {
        // si es false entonces que no haga el submit
        if (!confirm('¿ESTA SEGURO QUE DESEA ELIMINAR ESTE EMPLEADO?')) {
             event.preventDefault();
             event.stopPropagation();
        }
    }, false);
};*/
const texto = document.querySelector('#texto');
//$('.svg').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
let cuerpoModal = document.getElementById("cuerpoModal").innerHTML;

function cuerpoModalOriginal() {
    document.getElementById("cuerpoModal").innerHTML = cuerpoModal;
    $('#continuar').show();
}
$('input').bind('keypress', function(tecla) {
    if (this.value.length == 0 & tecla.charCode == 32)
        return false;
});
/*$("input[type='text']").bind('keyup', function(tecla) {
    this.value = this.value.toUpperCase();
    validarCURP();
    //if (this.value.length == 0 & tecla.charCode == 32)
    //  return false;
});*/
$("input[type='date']").bind('keyup', function(tecla) {
    //this.value = this.value.toUpperCase();
    validarCURP();
    //if (this.value.length == 0 & tecla.charCode == 32)
    //  return false;
});
/*$("textarea").bind('keyup', function(tecla) {
    this.value = this.value.toUpperCase();
    //if (this.value.length == 0 & tecla.charCode == 32)
    //  return false;
});*/
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


@if(isset($datosEmpleado))
let datosEmpleado = @json($datosEmpleado);
document.getElementById("genero").value = datosEmpleado.genero;
document.getElementById("fechaNacimiento").value = datosEmpleado.fechaNacimiento;
document.getElementById("entidadFederativa").value = datosEmpleado.entidadFederativa;
//alert( datosEmpleado.entidadFederativa);
@else
let generoOld = "{{ old('genero') }}";
let entidadFederativaOld = "{{ old('entidadFederativa') }}";
if (generoOld.length > 0)
    document.getElementById("genero").value = generoOld;
if (entidadFederativaOld.length > 0)
    document.getElementById("entidadFederativa").value = entidadFederativaOld;
//alert("{{ old('genero') }}");
@endif

async function actualizarPassword() {
    try {
        let cambio = document.getElementById("passwordChange");
        let respuestaCompra;
        let espacio = /\s/;
        if (espacio.test(cambio.value)) {
            document.getElementById("alertaPassword").innerHTML =
                "La contraseña no debe tener espacios"; //respuestaCompra;
            $('#passwordChange').removeClass('is-valid').addClass('is-invalid');
            return;
        }
        if (cambio.value.length > 0) {
            if (cambio.value.length >= 8) {
                @php
                    if(!isset($users))
                    $users = null;
                @endphp
                let usuario = @json($users);
                console.log('usuario',usuario);
                let id = usuario.id;
                const url = "{{url('/')}}/puntoVenta/empleado/editar/" + id;
                console.log(url);
                let datos = new FormData();
                datos.append('_token', "{{ csrf_token() }}");
                datos.append('passwordChange', cambio.value);
                respuestaCompra = await $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'passwordChange': cambio.value,
                        '_token': "{{ csrf_token() }}",
                    },
                    //processData: false,  // tell jQuery not to process the data
                    //contentType: false,
                    success: function(data) {
                        //alert(data);
                    }
                });
                console.log(respuestaCompra);   
                if (respuestaCompra == 1) {
                    console.log('Todo esta bien');
                    document.getElementById("cuerpoModal").innerHTML =
                        `<div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Contraseña actualizada</h4>
                        <p>¡Tu contraseña se ha actualizado exitosamente!</p>
                        <hr>
                        <p class="mb-0">Cierre este mensaje para continuar</p>
                    </div>`;
                    $('#continuar').hide();
                }
            } else {
                document.getElementById("alertaPassword").innerHTML =
                    "La contraseña debe tener al menos 8 caracteres"; //respuestaCompra;
                $('#passwordChange').removeClass('is-valid').addClass('is-invalid');
            }

        } else {
            document.getElementById("alertaPassword").innerHTML =
                "Por favor escriba su contraseña"; //respuestaCompra;
            $('#passwordChange').removeClass('is-valid').addClass('is-invalid');
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

function mostrarPassword() {

    var cambio = document.getElementById("passwordChange");
    if (cambio.type == "password") {
        cambio.type = "texto";
        var cambioicono = document.getElementById("iconPassword").innerHTML =
            `<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                `;
        //$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        var cambioicono = document.getElementById("iconPassword").innerHTML =
            `<path
                                        d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
            `;
        //$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

function filtrar() {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/puntoVenta/empleado/buscadorEmpleado?texto=${texto.value}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
texto.addEventListener('keyup', filtrar);
filtrar();
$('#btnForm').hide();
$('#btnFormCancelar').hide();

function habilitar() {
    let editar = document.getElementById("formEditar");
    if(editar!=null)
        editar.disabled = false;
    $('#btnForm').show()
    $('#btnFormCancelar').show()
    $('#btnEditar').hide()
    //document.getElementById("btnForm").show();
    //alert('Entra');
}
let cambios = `@json(session()->has('cambios'))`;
if (cambios.length > 0)
    habilitar();
//if(session() - > has('cambios'))
//habilitar();
//endif
function validarCURP() { //n,ap,am,fN,g,e) {
    let pn = document.getElementById("primerNombre").value;
    let sn = document.getElementById("segundoNombre").value;
    let ap = document.getElementById("apellidoPaterno").value;
    let am = document.getElementById("apellidoMaterno").value;
    let fn = document.getElementById("fechaNacimiento").value;
    let g = document.getElementById("genero").value;
    let e = document.getElementById("entidadFederativa").value;
    if (pn.length > 2 & ap.length > 2 & am.length > 2 & fn.length > 0 & g.length > 0 & e.length > 0) {
        let fechaNac = "";
        for (i = 0; i < fn.length; i++) {
            if (fn.charAt(i) != '-')
                fechaNac = fechaNac + fn.charAt(i);
            console.log(fechaNac);
        }
        /*console.log(n);
        console.log(ap);
        console.log(am);
        console.log(fechaNac);
        console.log(g);
        console.log(e);*/
        let ns = pn + sn;
        document.getElementById("curp").value = calcula(ns, ap, am, fechaNac, g, e);
    }

    //
}
async function generarClave() {
    try {
        let clave = getRandomInt(10000, 99999);
        //
        //clave = 12345;
        let respuesta = await fetch(`/puntoVenta/empleado/validarClave/${clave}`);
        let valido = await respuesta.text();
        if (respuesta.ok) {
            if (valido.length > 0) {
                document.getElementById("claveE").value = clave;
                return;
            }
            //console.log(clave);
            return generarClave();
        }
        //alert('No fu validado :`p');

    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }


    //alert(clave);
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function mostrarPasswordClave() {

    var cambio = document.getElementById("claveE");
    if (cambio.type == "password") {
        cambio.type = "text";
        var cambioicono = document.getElementById("iconPasswordClave").innerHTML =
            `<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                `;
        //$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        var cambioicono = document.getElementById("iconPasswordClave").innerHTML =
            `<path
                                        d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
            `;
        //$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}
//console.log();
async function eliminarEmpleado(id) {
    let revi = confirm("¿DESEA ELIMINAR ESTE EMPLEADO?");
    if (revi) {
        try {
            let respuesta = await $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "DELETE",
                // la URL de donde voy a hacer la petición
                url: `/puntoVenta/empleado/${id}`,
                // los datos que voy a enviar para la relación
                data: {
                    //_token: $("meta[name='csrf-token']").attr("content")
                    _token: "{{ csrf_token() }}",
                }
            });
            //response = await fetch(`/puntoVenta/destroy/${id}`);
            //if (response.ok) {
            //  let respuesta = await response.text();
            if (respuesta.length > 1) {
                return alert(respuesta)
            } else if (respuesta.length == 1) {
                //recargar la pag
                alert("EL EMPLEADO HA SIDO ELIMINADO");
                location.href = "{{url('/puntoVenta/empleado')}}";
            } else {
                return alert("NO SE PUEDE ELIMINAR, ESTE EMPLEADO YA ESTA SIENDO USADO");

            }
            /*} else {
                return confirm("ESTA SUCURSAL YA ES USADA EN OTRA PARTE. ¿DESEA ELIMINARLO?");
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }*/
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
};
</script>

@endsection