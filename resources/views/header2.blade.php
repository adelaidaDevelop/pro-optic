@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row my-0 py-0 align-self-center" style="background:#3366FF">
        <nav class="navbar navbar-expand-lg navbar-light w-100 mx-2 px-4 py-0" style="background-color:#3366FF;">
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
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/venta">
                            <button class="btn btn-light input-group border" type="submit">
                                <img src="{{ asset('img\venta2.png') }}" alt="Editar" width="30px" height="30px">
                                <p class="h6 my-auto"><small>VENTAS</small></p>
                            </button>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/compra">
                            <button class="btn btn-light input-group">
                                <img src="{{ asset('img\compra.png') }}" alt="Editar" width="30px" height="30px">
                                <p class="h6 my-auto"><small>COMPRAS</small></p>
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <!--
                    <li class="nav-item active">
                        <a class="nav-link" href="/puntoVenta/producto">
                            <button class="btn btn-light">
                                PRODUCTOS
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    -->
                    <li class="nav-item active">
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/producto">
                            <button class="btn btn-light input-group">
                            <img src="{{ asset('img\inventario.png') }}" alt="Editar" width="30px" height="30px">
                            <p class="h6 my-auto ml-1"><small>INVENTARIO</small></p>
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <!--if(session('idUsuario') == 1)-->
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/administracion">
                            <button class="btn btn-light input-group">
                            <img src="{{ asset('img\administracion.png') }}" alt="Editar" width="30px" height="30px">
                            
                            <p class="h6 my-auto ml-1"><small>ADMINISTRACION</small></p>
                            </button>
                            <span class="sr-only">(current)</span></a>
                        
                        <!--a class="nav-link" href="/puntoVenta/empleado">
                                <button class="btn btn-light">
                                    EMPLEADOS
                                </button>
                                <span class="sr-only">(current)</span></a-->
                        
                    </li>
                    <li class="nav-item active">
                        <!--
                        <a class="nav-link" href="/puntoVenta/cliente">
                            <button class="btn btn-light">
                            <img src="{{ asset('img\client.png') }}" alt="Editar" width="30px" height="30px">
                                CLIENTES
                            </button>
                            <span class="sr-only">(current)</span></a>
                            -->
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/credito">
                            <button class="btn btn-light input-group">
                            <img src="{{ asset('img\deudores.png') }}" alt="Editar" width="30px" height="30px">
                            <p class="h6 my-auto ml-1"><small>LISTA DEUDORES</small></p>
                            </button>
                            <span class="sr-only">(current)</span></a>


                    </li>
                    <li class="nav-item active">
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/corteCaja">
                            <button class="btn btn-light input-group">
                                <img src="{{ asset('img\corteC.png') }}" alt="Editar" width="30px" height="30px">
                                <p class="h6 my-auto"><small>CORTE</small></p>
                                </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link px-0 mx-2" href="/puntoVenta/reporteInventario">
                            <button class="btn btn-light input-group">
                            <img src="{{ asset('img\reporte.png') }}" alt="Editar" width="30px" height="30px">
                            <p class="h6 my-auto"><small>REPORTES</small></p>
                                </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <!--ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="{ asset('img\salir.png') }}" alt="Editar" height="30px">
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul-->
            </div>

        </nav>
    </div>
    <div class="row p-0"  style="background:#BDC2C5">
        <h4 class="font-weight-bold  ml-4 px-1 col-2 my-3"  >
            @yield('subtitulo')
        </h4>
        @yield('opciones')
    </div>
    <!--BODY-->
    @yield('contenido')
</div>
@endsection