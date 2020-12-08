<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}" />
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>
</head>

<body>
    <div class="container">
    <div class="row">
            <div class="col-1">
                #
            </div>
            <div class="col-3">
                Codigo
            </div>
            <div class="col-4">
                Nombre
            </div>
            <div class="col-1">
                Existencia
            </div>
            <div class="col-3">
                Departamento
            </div>
        </div>
        @foreach($productos as $producto)
        <div class="row">
        <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12" href="{{url('/compra/create?productos='.$producto->id)}}">
        <div class="row">
            <div class="col-1">
                {{$loop->iteration}}
            </div>
            <div class="col-3">
                {{$producto->codigoBarras}}
            </div>
            <div class="col-4">
                {{$producto->nombre}}
            </div>
            <div class="col-1">
                0
            </div>
            <div class="col-3">
                {{$producto->idDepartamento}}
            </div>
        </div>
        </a>
        </div>
        @endforeach
        <button id="b">Boton</button>
    </div>
    <script>

        agregarProducto()
        {

        }
        
    </script>
</body>

</html>