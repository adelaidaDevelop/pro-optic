<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    
</head>
<body>
<div class="container-fluid">
    <div class="row mb-2" style="background:#ED4D46">
        <h1 class="font-weight-bold m-4" style="color:#FFFFFF">DEPARTAMENTOS</h1>
    </div>
    <div class="row">
        <div class="col-4 mr-2" style="background:#0CC6CC">
            <div class="row">
            <!--input type="text" id="buscador" class="form-control my-2">
            <button class="btn btn-info mb-2" id="boton">Buscar</button-->

            <div class="input-group">
                <input type="text" class="form-control mx-2 my-3" placeholder="Buscar departamento" id="texto">
                <!--div class="input-group-append">
                    <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                </div-->
            </div>

            </div>
            <div class="row" style="height:200px;overflow-y:auto;">
                <div id="resultados" class="col btn-block h-100">
                </div>
            </div>
        </div>
        <div class="col" style="background:#edeadb"><!--#FFFBF2"-->
        @if(isset($d))
        <div class="row mx-1">
            <div class="col-4">
                <form method="get" action="{{url('/departamento')}}">
                    <button class="btn btn-outline-secondary my-3 ml-0" type="submit">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Nuevo Departamento
                    </button>
                </form>
            </div>
            <div class="col-4">
                <form method="post" action="{{url('/departamento/'.$d->id)}}">
                    {{csrf_field()}}
                    {{ method_field('DELETE')}}
                    <button class="btn btn-outline-secondary my-3" type="submit">
                         <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                        Eliminar Departamento
                    </button>
                </form>
            </div>
        </div>
        <div class="row mx-3">
            <form method="post" action="{{url('/departamento/'.$d->id)}}" enctype="multipart/form-data">
            <div class="form-group">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <label for="Nombre"><h2>Editar Departamento</h2></label>
                <br/>
                <label for="Nombre"><h3>{{$d->nombre}}</h3></label>
                <br>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{$d->nombre}}">
                <br/>
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Guardar Departamento
                </button>
            </div>
            </form>
            </div>
            @else
            <form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
            <div class="form-group">
                {{ csrf_field() }}
                <label for="Nombre"><h2>Nuevo Departamento</h2></label>
                <br/>
                <label for="Nombre"><h3>{{'Nombre'}}</h3></label>
                <br/>
                <input type="text" class="form-control" name="nombre" id="nombre" value="">
                <br/>
                <!--input type="submit" value="Guardar Departamento"-->
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Guardar Departamento
                </button>
            </div>
            </form>
        @endif
        </div>
    </div>
</div>
<script>
    
    const texto = document.querySelector('#texto');
    function filtrar()
    {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/departamento/buscador?texto=${texto.value}`,{ method:'get' })
                .then(response  =>  response.text() )
                .then(html      =>  {   document.getElementById("resultados").innerHTML = html  })   
    }
    texto.addEventListener('keyup',filtrar);
    filtrar();
</script>


</body>
</html>