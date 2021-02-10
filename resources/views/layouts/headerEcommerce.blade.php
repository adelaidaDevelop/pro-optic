@extends('layouts.appEcommerce')
@section('headerEcommerce')
<div class="row" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark w-100 py-3" style="background:#3366FF">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\farmaciagilogo.png') }}" alt="LOGO" height="50px">
        </a>
        <div class="input-group">
            <input class="form-control" type="search" placeholder="Buscar producto" name="buscar" id="buscar"
                aria-label="Buscar producto">
            <!--input type="text" class="form-control" placeholder="Username" aria-label="Username"
                aria-describedby="basic-addon1"-->
            <div class="input-group-append">
                <!--button class="btn btn-outline-secondary" type="button" value="informacion" id="boton" style="background-image: url(img/search.svg);
                            background-repeat:no-repeat;background-size:100%;"-->
                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                <!--/button-->

                <img src="{{ asset('img\search.svg') }}" for="buscar" class="btn btn-secondary p-1" width="35px"
                    height="100%" alt="buscador">
                <!--span class="input-group-text" id="basic-addon1"for="buscar">@</span-->

            </div>
        </div>

        <!--input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Buscar producto">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button-->
        <a class="navbar-brand m-0 ml-2 p-0" href="#">
            <img src="{{ asset('img\ubicacion.png') }}" class="p-1" alt="UBICACION" height="40px">
        </a>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <a class="navbar-brand m-0 ml-2 p-0" href="#">
                <img src="{{ asset('img\usuario.png') }}" class="p-1" alt="LOGO" height="40px">
            </a>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ url('loginCliente') }}">{{ __('Login') }}</a>
            </li>
            <!--@ if (Route:d:has('register'))
            <li class="nav-item">
                <a class="nav-link text-white" href="{ route('register') }}">{{ __('Register') }}</a>
            </li>
            endif-->
            @else
            <li class="nav-item dropdown">
                <!--
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>-->
                <!--a class="navbar-brand m-0 ml-2 p-0" href="#">
                    <img src="{{ asset('img\usuario.png') }}" class="p-1" alt="LOGO" height="40px">
                </a-->
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('img\usuario.png') }}" class="p-1" alt="LOGO" height="40px">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" class="text-primary" href="#" onclick="">
                        {{ Auth::user()->username }}
                    </a>
                    <a class="dropdown-item" class="text-primary" href="{{ url('logoutCliente') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ url('logoutCliente') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>
            @endguest
        </ul>

        <a class="navbar-brand m-0 ml-2 p-0" href="#">
            <img src="{{ asset('img\carritoCompras.png') }}" class="p-1" alt="CARRITO" height="40px">
        </a>
        <!--form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Buscar producto">
            
        </form-->
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark w-100" style="background:#ED4D46">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/venta">CATEGORIAS<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
</div>

@yield('contenido')
@endsection