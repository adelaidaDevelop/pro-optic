@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row" style="background:#3366FF">
        <div class="container-fluid align-self-center">
            <nav class="navbar navbar-expand-lg navbar-light w-100 " style="height: 20px;background-color:#3366FF;">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img\farmaciagilogo.png') }}" alt="Editar" height="50px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--cambios de ruta-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/puntoVenta/venta">
                                <button class="btn btn-light" type="submit">VENTAS

                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/puntoVenta/compra">
                                <button class="btn btn-light">
                                    COMPRAS
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <!--+
                        <li class="nav-item active">
                            <a class="nav-link" href="/puntoVenta/producto">
                                <button class="btn btn-light">
                                    PRODUCTOS
                                </button>
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        -->
                        <li class="nav-item active">
                            <form method="get" action="{{url('/puntoVenta/inventario/index')}}">
                                <button class="btn btn-secondary p-1" type="submit">
                                    <img src="{{ asset('img\usuarioEc.png') }}" class="img-thumbnail" alt="Editar" width="28px" height="28px">
                                    EMPLEADOS
                                </button>
                            </form>
                            <!--
                            <a class="nav-link" href="/puntoVenta/inventario">
                                <button class="btn btn-light">
                                    INVENTARIO
                                </button>
                                <span class="sr-only">(current)</span></a>
                                -->

                        </li>
                        <li class="nav-item active">
                            @if(session('idUsuario') == 1)
                            <a class="nav-link" href="/puntoVenta/administracion">
                                <button class="btn btn-light">
                                    ADMINISTRACION
                                </button>
                                <span class="sr-only">(current)</span></a>
                            @else
                            <!--a class="nav-link" href="/puntoVenta/empleado">
                                <button class="btn btn-light">
                                    EMPLEADOS
                                </button>
                                <span class="sr-only">(current)</span></a-->
                            @endif
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/puntoVenta/cliente">
                                <button class="btn btn-light">
                                    CLIENTES
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/puntoVenta/corteCaja">
                                <button class="btn btn-light">
                                    CORTE
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/puntoVenta/reporteInventario">
                                <button class="btn btn-light">
                                    REPORTES
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="{{ asset('img\salir.png') }}" alt="Editar" height="30px">
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>
            <br />
        </div>
    </div>
    <div class="row p-1" style="background:#ED4D46">
        <h3 class="font-weight-bold my-2 ml-4 px-1 col-2" style="color:#FFFFFF">
            @yield('subtitulo')
        </h3>
        @yield('opciones')
    </div>
    <!--BODY-->
    @yield('contenido')
</div>
@endsection