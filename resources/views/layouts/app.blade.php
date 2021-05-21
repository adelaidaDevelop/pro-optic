<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FarmaciasGI') }}?</title>

    <!-- Scripts -->
    <!--script src="{ asset('js/app.js') }}"></script-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    

    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>

<body>

    <!--div id="app border" class="row w-100 border border-dark"-->
        <nav class="navbar navbar-expand-md m-0 p-0" style="background-color: #3366FF;">
            <!--  <div class="container">  -->
            <!--
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
            <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button-->

            <div class="collapse navbar-collapse m-0 p-0" id="navbarSupportedContent">

                <!--ul class="navbar-nav mr-auto">

                    </ul-->
                <ul class="navbar-nav ml-auto my-0">
                    <li class="nav-item">
                        <h5 class="text-white text-uppercase">{{session('sucursalNombre')}}
                        </h5>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto my-0 py-0">
                    <!-- Authentication Links -->

                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('puntoVenta/login') }}">{{ __('Login') }}</a>
                    </li>
                    <!--if (Roudte:d:has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{ route('register') }}">{ __('Register') }}</a>
                        </li>
                        endif-->
                    @else
                    <li class="nav-item dropdown">
                        <!--
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>-->
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <strong>{{ Auth::user()->username }}</strong>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" class="text-white" href="{{ url('puntoVenta/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <img src="{{ asset('img\salir.png') }}" alt="Editar" height="30px">
                            
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ url('puntoVenta/logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
    @yield('content')
    <script src="{{ asset('js\mayusculas.js') }}"></script>
</body>

</html>