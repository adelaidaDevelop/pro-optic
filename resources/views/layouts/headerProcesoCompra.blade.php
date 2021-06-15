@extends('layouts.appEcommerce')
@section('headerEcommerce')
<div class="row" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark col-12 py-auto" style="background:#3366FF">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ asset('img\farmaciagilogo.png') }}" alt="LOGO" height="50px">
        </a>
        <ul class="navbar-nav ml-auto my-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item text-center">
                <img src="{{ asset('img\usuario.png') }}" height="35px" alt="LOGO"
                href="{{ url('/loginCliente') }}"> 
                <a class="nav-link text-white my-0 py-0" href="{{ url('/loginCliente') }}">
                <small>{{ __('IniciarSesion/Registrarse') }}</small></a>
            </li>
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('img\usuario.png') }}" class="p-1" alt="LOGO" height="40px">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" class="text-primary" href="{{url('/menu')}}" onclick="">
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
    </nav>
</div>
<script>
let carrito = @json(session('carrito'));

let sucursal = @json(session('sucursalEcommerce')); 
</script>
@yield('contenido')
@endsection