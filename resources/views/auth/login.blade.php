<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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

    <div class="container">

        <div class="row">
            <div class="col-1"></div>

            <div class="col-10 text-center" style="background:#4388CC">
                <br />
                <div id="app">

                    <nav class="navbar navbar-expand-lg shadow-sm">
                        <div class="container">
                            <!--
                <a class="navbar-brand" href="{{ url('/') }}">
                    { config('app.name', 'Laravel') }}
                </a> -->
                            <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent"-->

                            <!-- Left Side Of Navbar -->
                            <!--
                    <ul class="navbar-nav mr-auto">
                    </ul>-->
                            <!-- Right Side Of Navbar -->
                            <!--ul class="navbar-nav ml-auto"-->
                            <!-- Authentication Links >
                                    @ guest
                                    <li class="nav-item">
                                       < <a class="nav-link text-white" href="{ route('login') }}">{{ __('Login') }}</a>>
                                    </li>
                                    @ if (Route::has('register'))
                                    <li class="nav-item"-->
                            <!-- <a class="nav-link text-white" href="{ route('register') }}">{{ __('Register') }}</a>-->
                            <!--/li>
                                    @ endif
                                    @ else
                                    <li class="nav-item dropdown"-->
                            <!--
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                { Auth::user()->name }}
                            </a>-->

                            <!--a id="navbarDropdown" class="text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            { Auth::user()->name }}
                                        </a>


                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" class="text-white" href="{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                { __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{ route('logout') }}" method="POST" class="d-none">
                                                @ csrf
                                            </form>
                                        </div>
                                    </li>
                                    @ endguest
                                </ul>
                            </div>
                        </div>

                    </nav>

                </div-->
                            <!--<main class="py-4">-->

                            <!-- </main>-->


                            @yield('content')
                            <br />
                            <img src="{{ asset('img\logo.png') }}" class="position-relative" alt="Inicio"
                                height="45px" />
                            <br /><br />
                        </div>

                        <div class="col-1"> </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>

                    <div class="col-1" style="background:#4388CC"></div>
                    <div class="col-8" style="background:#4388CC ">

                        <div class="row" style="background:#7FB3D5">
                            <div class="col-1" style="background:#7FB3D5"></div>
                            <div class="col-10 text-center" style="background:#7FB3D5">
                                <br />
                                <img src="{{ asset('img\login.png') }}" class="position-relative" alt="Inicio"
                                    height="100px" />
                                <br /><br />

                                <form method="POST" action="{{ url('puntoVenta/login') }}">
                                    @csrf
                                    <div class="row" style="background:#A9CCE3">
                                        <div class="col-3" style="background:#A9CCE3"></div>
                                        <div class="col-6 text-center" style="background:#A9CCE3">
                                            <br />
                                            <div>
                                                <h4> INICIO DE SESION </h4>
                                            </div>
                                            <div class="input-group mb-3 align-self-center text-center">
                                                <div class="input-group-prepend text-right">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('img\icon_farmacia.png') }}"
                                                            class="position-relative" alt="Inicio" height="20px" />
                                                    </span>
                                                </div>
                                                <select name="opcionSucursal"
                                                    class="form-control @error('farmacia') is-invalid @enderror"
                                                    id="opcionSucursal" required autocomplete="farmacia" autofocus>
                                                    <!--option value="0">PROVEEDOR</option>
                                                    <option value="1">farmacia 1</option-->
                                                </select>
                                                @error('farmacia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3 align-self-center text-center">
                                                <div class="input-group-prepend text-right">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('img\usuario1.png') }}"
                                                            class="position-relative" alt="Inicio" height="20px" />
                                                    </span>
                                                </div>
                                                <!--<input type="text" size="35" placeholder="USUARIO" aria-label="Username" aria-describedby="basic-addon1">-->
                                                <input id="email" type="email" size="35"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" placeholder="USUARIO"
                                                    required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-3 text-right">
                                                <div class="input-group-prepend text-center">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('img\contra.png') }}"
                                                            class="position-relative" alt="Inicio" height="20px" />
                                                    </span>
                                                </div>
                                                <!--<input type="password" size="35" placeholder="CONTRASEÑA" aria-label="Username" aria-describedby="basic-addon1">-->
                                                <input id="password" type="password" size="35"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="CONTRASEÑA" name="password" required
                                                    autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>


                                            <button type="submit" class="btn btn-danger my-2">INICIAR SESION</button>

                                        </div>

                                        <div class="col-3" style="background:#A9CCE3"></div>

                                        <br /><br /><br /> <br />
                                        <br /><br /><br /><br /><br /><br />
                                    </div>
                                </form>
                                <br /><br />

                            </div>
                            <div class="col-1" style="background:#7FB3D5"></div>

                        </div>
                        <br /><br />
                    </div>
                    <div class="col-1" style="background:#4388CC"></div>
                    <div class="col-1"></div>

                </div>


            </div>
        </div>
    </div>
    <script>
    let sucursales;
    async function cargarSucursales() {
        try {
            let response = await fetch(`/puntoVenta/sucursal/todos`);
            if (response.ok) {
                sucursales = await response.json();

            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }

        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    function mostrarSucursales()
    {
        let cuerpo = "";
        for(let i in sucursales)
        {
            cuerpo = cuerpo +
            `<option value="`+sucursales[i].id+`">`+sucursales[i].direccion+`</option>`;
        }
        document.querySelector('#opcionSucursal').innerHTML = cuerpo;
    }

    async function iniciar()
    {
        try {
            await cargarSucursales();
            mostrarSucursales();

        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    iniciar();
    </script>
</body>

</html>