<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel?') }}?</title>

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <br />
                <br />
                <label for="codigoBarras">
                    <h6> {{'CODIGO DE BARRAS'}}</h6>
                </label>
                <br />
                <label for="Nombre">
                    <h6>{{'NOMBRE'}}</h6>
                </label>
                <br />
                <label for="Descripcion">
                    <h6> {{'DESCRIPCION'}} </h6>
                </label>
                <br /><br />
                <label for="MinimoStock">
                    <h6> {{'MINIMO STOCK'}}</h6>
                </label>
                <br />
                <label for="Receta">
                    <h6> {{'RECETA MEDICA'}} </h6>
                </label>
                <br /><br />
                <label for="idDepartamento">
                    <h6> {{'DEPARTAMENTO'}}</h6>
                </label>
                <br />
            </div>
            <br />
            @foreach($productos as $productoB)
            <div class="col-md-6">
                <br />
                <!--El name debe ser igual al de la base de datos-->
                <input type="text" name="codigoBarras" id="codigoBarras" class="form-control"
                    placeholder="Ingresar codigo de barras" value="{{$productoB->codigoBarras}}" required
                    autocomplete="codigoBarras" autofocus>
                <br />
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre productos"
                    value="{{ $productoB->nombre}}" autofocus required>
                <br />
                <textarea name="descripcion" id="descripcion" class="form-control"
                    placeholder="Descripcion del producto" rows="3" cols="23" required>
                        {{ $productoB->descripcion}}</textarea>
                <br />
                <input type="number" name="minimo_stock" id="minimo_stock" class="form-control"
                    placeholder="Ingrese el minimo de productos permitidos" value="{{$productoB->minimo_stock}}"
                    autofocus required>
                <br />

                <select class="form-control" name="Receta" id="Receta" required>
                    <option value="">Elija una opcion</option>
                    <option value="si" selected>si</option>
                    <option value="no" selected>no</option>
                </select>
                <br />
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1 text-center">
                <br /><br />
                <label for="Imagen">
                    <h5> <strong>{{'FOTO'}}</strong></h5>
                </label required>
                @if(isset($productoB->imagen))
                <br />
                <img src="{{ asset('storage').'/'.$productoB->imagen}}" alt="" width="200">
                <br /><br />
                @endif

                @if(isset($productoB->imagen))
                <input type="file" name="Imagen" id="Imagen" class="form-control" value="">
                @else <input class="form-control" type="file" name="Imagen" id="Imagen" value="" autofocus required>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>