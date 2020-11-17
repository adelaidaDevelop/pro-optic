<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>

</head>

<body>

    <div class="container-fluid">
        <div class="row" style="background:#ED4D46">
            <h1 style="color:#FFFFFF">DEPARTAMENTOS</h1>
        </div>
        <div class="row">
            <div class="col-4" style="background:#0CC6CC">
                <div class="row">
                    <div class="input-group">
                        <input type="text" class="form-control mx-2 my-3" placeholder="Buscar departamento" id="texto">
                    </div>
                </div>
                <div id="resultados" class="btn-group-vertical btn-block">
                </div>
            </div>
            <div class="col" style="background:#FFFBF2">
                @if(isset($d))

                <form method="post" action="{{url('/departamento/'.$d->id)}}" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <label for="Nombre">
                            <h2>Editar Departamento</h2>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h3>{{$d->nombre}}</h3>
                        </label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$d->nombre}}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                            Guardar Departamento
                        </button>
                    </div>
                </form>
                @else
                <form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label for="Nombre">
                            <h2>Nuevo Departamento</h2>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h3>{{'Nombre'}}</h3>
                        </label>
                        <br />
                        <input type="text" class="form-control" name="nombre" id="nombre" value="">
                        <br />
                        <!--input type="submit" value="Guardar Departamento"-->
                        <button class="btn btn-outline-secondary" type="submit">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                            Agregar Departamento
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    <script>
        const texto = document.querySelector('#texto');

        function filtrar() {
            document.getElementById("resultados").innerHTML = "";
            fetch(`/departamento/buscador2?texto=${texto.value}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById("resultados").innerHTML = html
                })
        }
        texto.addEventListener('keyup', filtrar);
        filtrar();

        function verInfoDepartamento() {
            document.getElementById("impresion").innerHTML = "";
            //alert("a");
        }
        verInfoDepartamento();
    </script>


</body>

</html>