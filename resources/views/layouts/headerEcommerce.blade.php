@extends('layouts.appEcommerce')
@section('headerEcommerce')
<div class="row" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark w-100 py-3" style="background:#3366FF">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\farmaciagilogo.png') }}" alt="LOGO" height="50px">
        </a>
        <div class="input-group position-relative">
            <input class="form-control position-relative" type="search" placeholder="Buscar producto" name="buscar" id="buscar"
                aria-label="Buscar producto">
            <!--input type="text" class="form-control" placeholder="Username" aria-label="Username"
                aria-describedby="basic-addon1"-->
            <div class="input-group-append position-relative">
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
        <ul class="navbar-nav ml-auto position-relative">
            <!-- Authentication Links -->
            @guest
            <!--a class="navbar-brand m-0 ml-2 p-0 row text-center" href="{ url('/loginCliente') }}">
                <img src="{ asset('img\usuario.png') }}" class="p-0 border" alt="LOGO" height="40px">
                <p class="text-white p-0" ><small>{ __('IniciarSesion / Registrarse') }}</small></p>
            
            </a-->
            <li class="nav-item text-center position-relative">
                <img src="{{ asset('img\usuario.png') }}" class="p-0 position-relative" alt="LOGO" height="40px"
                href="{{ url('/loginCliente') }}"> 
                <a class="nav-link text-white position-relative" href="{{ url('/loginCliente') }}">
                {{ __('IniciarSesion/Registrarse') }}</a>
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

        <button class="btn btn-outline-light mx-2 p-0 border-0 position-relative d-inline-block" 
        data-toggle="collapse" data-target="#collapseCarrito" aria-expanded="false" aria-controls="collapseCarrito">
            <!--img src="{{ asset('img\carritoCompras.png') }}" class="" alt="CARRITO" height="40px"-->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart3 position-relative" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span class="badge badge-light position-absolute" id="cantidadCarrito">0</span>
            
        </button>
        <div class="card card-body position-fixed" style="z-index:1000">
            aSome placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
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
        <!--div class="collapse " id="collapseCarrito"-->

            
        <!--/div-->
    </nav>
</div>
@yield('contenido')
@endsection