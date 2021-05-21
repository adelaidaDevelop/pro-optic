<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--script src="{ asset('js/app.js') }}" defer></script-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
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

        <div class="row mt-3">
            <div class="col-1"></div>

            <div class="col-10 text-center" style="background:#4388CC">
                <div class="row text-center">
                    @yield('content')
                    <img src="{{ asset('img\logo.png') }}" class="position-relative mx-auto my-2" alt="Inicio"
                        height="45px" />
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
                                        <div class="col-md-1" style="background:#A9CCE3"></div>
                                        <div class="col-md-10 text-center" style="background:#A9CCE3">
                                            <br />
                                            <div>
                                                <h4 style="font-family: 'Open Sans', sans-serif;"><strong> INICIO DE
                                                        SESION </strong></h4>
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

                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="CONTRASEÑA" name="password" required
                                                    autocomplete="current-password">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" onclick="mostrarPasswordClave()"
                                                        type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="m-0" viewBox="0 0 16 16"
                                                            id="iconPasswordClave">
                                                            <path
                                                                d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                                            <path
                                                                d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror


                                            <button type="submit" class="btn btn-outline-dark my-2"><strong>INICIAR
                                                    SESION</strong></button>
                                        </div>

                                        <div class="col-md-1" style="background:#A9CCE3"></div>

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
    <!--script>
    $("input[type='email']").on('input', function(evt) {
        //console.log('doc',document.selection);
        var input = $(this);
        
        var oldInput = input[0].type;
        input.type = 'text';
        var start = input.selectionStart;
        console.log(start); 
        //console.log('input',input[0].type);
        
        //var end = input[0].selectionEnd;
        
        
        $(this).val(function(_, val) {
            return val.toUpperCase();
        });
        console.log('pos',input[0].selectionStart)
        input[0].selectionStart = input[0].selectionEnd = start;
                
        input[0].type = oldInput;
    });
    </script-->
    <script>
    function mostrarPasswordClave() {
        var cambio = document.getElementById("password");
        if (cambio.type == "password") {
            cambio.type = "text";
            var cambioicono = document.getElementById("iconPasswordClave").innerHTML =
                `
    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
    `;
            //$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            var cambioicono = document.getElementById("iconPasswordClave").innerHTML =
                `
    <path
        d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
    <path
        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
    `;
            //$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
    </script>
</body>

</html>