<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Farmacias GI') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--Recursos de Bootstrap-->
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Estilos Login-->
    <link href="{{ asset('css/login_punto_venta.css')}}" rel="stylesheet">
    <!--Estilo de letra Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Azeret+Mono:wght@600&display=swap" rel="stylesheet">
</head>

<body class="p-0 p-sm-4 ">
    <div class="container  d-flex justify-content-center py-sm-2 my-auto p-0">
        <div class="row w-100 rounded align-self-center" style="background:#4388CC" id="div1">
            <div class="row col-12 mx-auto pl-sm-0 pl-md-0">
                <img src="{{ asset('img\logo.png') }}"
                    class="img-fluid position-relative mx-auto mx-sm-auto  ml-md-4 ml-lg-4 pl-lg-3 ml-xl-5 pl-xl-5 mr-auto my-2 py-0 rounded-pill" alt="Inicio" />
            </div>
            <div class="row col-12 col-md-11 col-lg-11 col-xl-10 d-flex justify-content-center mb-5 mx-auto p-2 rounded"
                style="background:#7FB3D5">
                <img src="{{ asset('img\login.png') }}" class="col-auto position-relative my-auto mx-auto" alt=" Inicio"
                    height="100px" />
                <form class="col-auto col-md-9 col-lg-9 m-1 rounded p-0" method="POST" action="{{ url('puntoVenta/login') }}"
                    style="background:#A9CCE3">
                    @csrf
                    <div class="col-12 col-md-11 mx-auto p-0 px-1" style="background:#A9CCE3">
                        <div class="d-flex justify-content-center p-3">
                            <h4 class="text-center" style="font-family: 'Azeret Mono', monospace;"><strong> INICIO DE
                                    SESION </strong></h4>
                        </div>
                        <div class="form-group text-left p-1 mb-0">
                            <!--label for="opcionSucursal" class="font-weight-bolder "
                                style="font-family: 'Open Sans', sans-serif;">Sucursal</label-->
                            <div class="input-group mb-3 align-self-center text-center">
                                <div class="input-group-prepend text-right">
                                    <span class="input-group-text bg-transparent" id="basic-addon1">
                                        <img src="{{ asset('img\icon_farmacia.png') }}" class="position-relative"
                                            alt="Inicio" height="20px" />
                                    </span>
                                </div>
                                <select name="opcionSucursal"
                                    class="form-control @error('farmacia') is-invalid @enderror" id="opcionSucursal"
                                    required autocomplete="farmacia" autofocus>
                                    @foreach($sucursales as $s)

                                    <!--option value="0">PROVEEDOR</option-->
                                    <option value="{{$s->id}}">{{$s->direccion}}</option>
                                    @endforeach
                                </select>
                                @error('farmacia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-left p-1 my-0">
                            <!--label for="email" class="font-weight-bolder "
                                style="font-family: 'Open Sans', sans-serif;">Usuario</label-->
                            <div class="input-group mb-3 align-self-center text-center ">
                                <div class="input-group-prepend text-right ">
                                    <span class="input-group-text bg-transparent" id="basic-addon1">
                                        <img src="{{ asset('img\usuario1.png') }}" class="position-relative"
                                            alt="Inicio" height="20px" />
                                    </span>
                                </div>
                                <!--<input type="text" size="35" placeholder="USUARIO" aria-label="Username" aria-describedby="basic-addon1">-->
                                <input id="email" type="email" size="35"
                                    class="form-control text-uppercase @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="USUARIO" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-left p-1 mt-0">
                            <!--label for="password" class="font-weight-bolder "
                                style="font-family: 'Open Sans', sans-serif;">Password</label-->
                            <div class="input-group mb-3 text-right">
                                <div class="input-group-prepend text-center">
                                    <span class="input-group-text bg-transparent" id="basic-addon1">
                                        <img src="{{ asset('img\contra.png') }}" class="position-relative" alt="Inicio"
                                            height="20px" />
                                    </span>
                                </div>
                                <!--<input type="password" size="35" placeholder="CONTRASEÑA" aria-label="Username" aria-describedby="basic-addon1">-->

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="CONTRASEÑA" name="password" required autocomplete="current-password">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" onclick="mostrarPasswordClave()" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="m-0" viewBox="0 0 16 16" id="iconPasswordClave">
                                            <path
                                                d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                            <path
                                                d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <button id="btn_login" type="submit"
                            class="btn btn-outline-dark  d-flex justify-content-center my-2 mb-3 mx-auto"><strong>INICIAR
                                SESION</strong></button>
                                <a href="{{url('password/reset')}}" class="d-flex justify-content-center my-2 mb-3 mx-auto">¿Olvidaste tu contraseña?</a>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login_punto_venta.js') }}"></script>
</body>

</html>
