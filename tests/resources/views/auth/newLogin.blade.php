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
    <div class="container-fluid">
        <div class="row" style="background:#4388CC">
            <div class="col-3 my-auto mx-auto">
                <img src="{{ asset('img\logo.png') }}" class="position-relative mx-auto my-2" alt="Inicio"
                    height="45px" />
            </div>
            <div class="col-6 my-auto mx-auto">
                <h3 class="text-center text-white">FARMACIAS GI</h3>
            </div>
            <div class="col-3 my-auto mx-auto">
            </div>
        </div>
        <div class="row">
            <div class="col-10 text-center" style="background:#4388CC">
                <div class="row">
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
                                        <div class="col-md-3" style="background:#A9CCE3"></div>
                                        <div class="col-md-6 text-center" style="background:#A9CCE3">
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
                                            <button type="submit" class="btn btn-outline-dark my-2"><strong>INICIAR
                                                    SESION</strong></button>
                                        </div>

                                        <div class="col-md-3" style="background:#A9CCE3"></div>

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
            let response = await fetch(`{{url('/puntoVenta/sucursal/sucursales')}}`);
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

    function mostrarSucursales() {
        let cuerpo = ""; //`<option value="0"> --SIN SUCURSAL-- </option>`;
        for (let i in sucursales) {
            cuerpo = cuerpo +
                `<option value="` + sucursales[i].id + `">` + sucursales[i].direccion + `</option>`;
        }
        document.querySelector('#opcionSucursal').innerHTML = cuerpo;
    }

    async function iniciar() {
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