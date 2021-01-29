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

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/venta">
                            
                                <button class="btn btn-light" type="submit" >VENTAS
                                    
                                </button>
                                
                                
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/compra">
                                <button class="btn btn-light" >
                                    COMPRAS
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/producto">
                                <button class="btn btn-light">
                                    PRODUCTOS
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/inventario">
                                <button class="btn btn-light">
                                    INVENTARIO
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/empleado">
                                <button class="btn btn-light">
                                    EMPLEADOS
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/cliente">
                                <button class="btn btn-light">
                                    CLIENTES
                                </button>
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/corte">
                                <button class="btn btn-light">
                                    CORTE
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
            <br/>
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