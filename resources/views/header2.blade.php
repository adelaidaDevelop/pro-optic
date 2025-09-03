@extends('layouts.app')
@php
    use App\Models\Sucursal_empleado;
    $compra = ['verCompra', 'crearCompra', 'modificarCompra', 'verPago', 'admin'];
    $inventario = ['verProducto', 'crearProducto', 'modificarProducto', 'eliminarProducto', 'admin'];
    $administracion = [
        'verSucursal',
        'crearSucursal',
        'modificarSucursal',
        'eliminarSucursal',
        'verEmpleado',
        'crearEmpleado',
        'eliminarEmpleado',
        'modificarEmpleado',
        'admin',
    ];
    $deudor = ['verDeudor', 'admin'];
    $corte = ['verCorte', 'admin'];
    $reporte = ['verReporte', 'admin'];

    $sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));

    $verCompra = $sE->hasAnyRole($compra);
    $verInventario = $sE->hasAnyRole($inventario);
    $verAdministracion = $sE->hasAnyRole($administracion);
    $verDeudor = $sE->hasAnyRole($deudor);
    $verCorte = $sE->hasAnyRole($corte);
    $verReporte = $sE->hasAnyRole($reporte);

@endphp
@section('recursos')
    @yield('recursos_internos')
@endsection
@section('content')
    <link href="{{ asset('css/header_punto_venta.css') }}" rel="stylesheet">
    <div class="container-fluid">
        <div class="row p-0" style="background-color: #3366FF;">
            <div class="col-sm-2 pr-0 py-0">
                <a class="navbar-brand mr-2 px-0 py-0" href="{{ url('/puntoVenta/home') }}">
                    <img src="{{ asset('img\logo.png') }}" width="180px" object-fit="cover" class="img-fluid px-0 py-0"
                        style="object-fit: cover; object-position: top;" alt="Logo">
                </a>
            </div>
            <div class="col-sm-10 py-0">
                <div class="row my-0 px-0 py-0 align-self-center">
                    <nav class="navbar navbar-expand-md w-100 py-0" style="background-color: #3366FF;">
                        <ul class="navbar-nav mx-auto ml-xl-auto my-xl-0 px-0 py-0">
                            <li class="nav-item">
                                <h5 class="text-white text-uppercase d-none d-md-block ">{{ session('sucursalNombre') }}
                                </h5>
                                <h6 class="text-white text-uppercase text-center mx-auto my-1 d-md-none py-0">
                                    {{ session('sucursalNombre') }}
                                </h6>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto ml-sm-0 m-1 border border-light rounded px-0 py-0">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item border">
                                    <a class="nav-link text-white" href="{{ url('puntoVenta/login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link  dropdown-toggle text-white p-1 p-sm-auto"
                                        href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        <strong>{{ Auth::user()->username }}</strong>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right border " aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item " class="text-white" href="{{ url('puntoVenta/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <img src="{{ asset('img\salir.png') }}" alt="Editar" height="30px">

                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ url('puntoVenta/logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </nav>
                </div>
                <div class="row my-0 px-0 py-0 align-self-center">
                    <nav class="navbar navbar-expand-md navbar-light w-100 mx-2 my-0 px-auto py-0 position-relative"
                        style="background-color:#3366FF;">

                        <button class="navbar-toggler ml-2" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!--cambios de ruta-->
                        <div class="collapse navbar-collapse mx-auto mx-lg-0 px-0 py-0 rounded overflow-auto"
                            id="navbarSupportedContent">
                            <ul
                                class="navbar-nav my-0 mr-0 pr-0 py-0 ml-md-auto mr-md-0 my-md-1 mx-md-1 position-sticky grupo_modulos my-md-1 py-md-1">
                                <li class="nav-item active">
                                    <a class="nav-link px-0 mx-2" href="{{ url('/puntoVenta/venta') }}">
                                        <button class="btn btn-light input-group border" type="submit">
                                            <img src="{{ asset('img\venta2.png') }}" class="mx-md-auto" alt="Editar"
                                                width="30px" height="30px">
                                            <p class="h6 my-auto"><small>VENTAS</small></p>
                                        </button>
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>

                                <li class="nav-item active">
                                    <a class="nav-link px-0 mx-2 @if (!$verCompra) disabled @endif"
                                        href="{{ url('/puntoVenta/compra') }}">
                                        <button class="btn btn-light input-group"
                                            @if (!$verCompra) disabled @endif>
                                            <img src="{{ asset('img\compra.png') }}" class="mx-md-auto" alt="Editar"
                                                width="30px" height="30px">
                                            <p class="h6 my-auto"><small>COMPRAS</small></p>
                                        </button>
                                        <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link px-0 mx-2 @if (!$verInventario) disabled @endif"
                                        href="{{ url('/puntoVenta/producto') }}">
                                        <button class="btn btn-light input-group"
                                            @if (!$verInventario) disabled @endif>
                                            <img src="{{ asset('img\inventario.png') }}" class="mx-md-auto" alt="Editar"
                                                width="30px" height="30px">
                                            <p class="h6 my-auto ml-1"><small>INVENTARIO</small></p>
                                        </button>
                                        <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active">
                                    <!--if(session('idUsuario') == 1)-->

                                    <a class="nav-link px-0 mx-2 @if (!$verAdministracion) disabled @endif"
                                        href="{{ url('/puntoVenta/administracion') }}">
                                        <button class="btn btn-light input-group"
                                            @if (!$verAdministracion) disabled @endif>
                                            <img src="{{ asset('img\administracion.png') }}" class="mx-md-auto"
                                                alt="Editar" width="30px" height="30px">

                                            <p class="h6 my-auto ml-1"><small>ADMINISTRACION</small></p>
                                        </button>
                                        <span class="sr-only">(current)</span></a>

                                    <!--a class="nav-link" href="/puntoVenta/empleado">
                                                <button class="btn btn-light">
                                                    EMPLEADOS
                                                </button>
                                                <span class="sr-only">(current)</span></a-->

                                </li>

                            </ul>
                            <ul
                                class="navbar-nav my-0 ml-0 py-0 pl-0 mr-md-auto ml-md-0 my-md-1 py-md-1 position-sticky grupo_modulos
    ">
                                <li class="nav-item active">
                                    <!--
                                        <a class="nav-link" href="/puntoVenta/cliente">
                                            <button class="btn btn-light">
                                            <img src="{{ asset('img\client.png') }}" alt="Editar" width="30px" height="30px">
                                                CLIENTES
                                            </button>
                                            <span class="sr-only">(current)</span></a>
                                            -->
                                    <a class="nav-link px-0 mx-2 @if (!$verDeudor) disabled @endif"
                                        href="{{ url('/puntoVenta/credito') }}">
                                        <button class="btn btn-light input-group"
                                            @if (!$verDeudor) disabled @endif>
                                            <img src="{{ asset('img\deudores.png') }}" class="mx-md-auto" alt="Editar"
                                                width="30px" height="30px">
                                            <p class="h6 my-auto ml-1 text-nowrap "><small>LISTA DEUDORES</small></p>
                                        </button>
                                        <span class="sr-only">(current)</span></a>


                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link px-0 mx-2 @if (!$verCorte) disabled @endif"
                                        href="{{ url('/puntoVenta/corteCaja') }}">
                                        <button class="btn btn-light input-group"
                                            @if (!$verCorte) disabled @endif>
                                            <img src="{{ asset('img\corteC.png') }}" class="mx-md-auto" alt="Editar"
                                                width="30px" height="30px">
                                            <p class="h6 my-auto"><small>CORTE</small></p>
                                        </button>
                                        <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active">
                                    @if ($verReporte)
                                        <a class="nav-link px-0 mx-2" href="{{ url('/puntoVenta/reporteInventario') }}">
                                            <button class="btn btn-light input-group">
                                                <img src="{{ asset('img\reporte.png') }}" class="mx-md-auto"
                                                    alt="Editar" width="30px" height="30px">
                                                <p class="h6 my-auto"><small>REPORTES</small></p>
                                            </button>
                                            <span class="sr-only">(current)</span></a>
                                    @else
                                        <a class="nav-link px-0 mx-2 disabled"
                                            href="{{ url('/puntoVenta/reporteInventario') }}">
                                            <button class="btn btn-light input-group"
                                                @if (!$verCorte) disabled @endif>
                                                <img src="{{ asset('img\reporte.png') }}" class="mx-md-auto"
                                                    alt="Editar" width="30px" height="30px">
                                                <p class="h6 my-auto"><small>REPORTES</small></p>
                                            </button>
                                            <span class="sr-only">(current)</span></a>
                                    @endif
                                </li>
                            </ul>
                        </div>

                    </nav>
                </div>

            </div>
        </div>
        <div class="row p-0" style="background:#BDC2C5">
            <nav class="navbar navbar-expand-md navbar-light w-100 px-0 py-0 position-relative"
                style="background:#BDC2C5">
                <h4 class="font-weight-bold mr-md-4 ml-4 px-1 pl-2 col-2 my-3">
                    @yield('subtitulo')
                </h4>
                <button class="navbar-toggler mr-4 border" type="button" data-toggle="collapse"
                    data-target="#navbarSubtitulos" aria-controls="navbarSubtitulos" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--cambios de ruta-->
                <div class="collapse navbar-collapse mx-auto ml-md-5 ml-lg-3 my-0 px-0 w-75 " id="navbarSubtitulos">
                    <ul class="navbar-nav mr-xl-auto overflow-auto mx-auto ml-md-0 pl-md-0 rounded w-75 p-1 pb-2 position-sticky"
                        id="grupo_subtitulos">
                        @yield('opciones')
                    </ul>
                </div>
            </nav>
        </div>
        @yield('contenido')
    </div>
@endsection
