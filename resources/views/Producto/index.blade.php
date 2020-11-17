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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <br/><br />

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h3 class="p-3 mb-6  text-white" style="background:#ED4D46">PRODUCTO</h3>
        </div>
        <div class="col-md-1"> </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="background:#D5DBDB">
            <h5 class="blockquote text-center"> <strong>Consultar Producto</strong></h5>
        </div>
        <div class="col-md-2"> </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-1"></div>
        <br />
        <br />
        <div class="col-md-10" style="background:#0CC6CC">
            <br />
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="background:#0CC6CC">
                    <input type="text" size="50" name="buscar" id="buscar" value="" placeholder="Buscar producto">
                    <!--placeholder="Texto por defecto"-->
                </div>
                <div class="col-md-4"></div>
            </div>
            <br />
        </div>
        <div class="col-md-1"> </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="background:#0CC6CC">
            <div class="scrollable">
                <table class=" table-bordered table-hover">
                    <!--"table table-hover" "table table-bordered table-dark" "table-active" -->
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Imagen</th>
                            <th>Codigo barras</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Minimo stock</th>
                            <th>Existencia</th>
                            <th>Departamento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producto as $producto)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <img src="{{ asset('storage').'/'.$producto->imagen}}" class="img-thumbnail img-fluid" alt="" width="100">
                            </td>
                            <td>{{$producto->codigoBarras}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td> {{$producto->descripcion}}</td>
                            <td> {{$producto->minimo_stock}} </td>
                            <td> {{$producto->existencia}} </td>

                            <td>
                                @foreach($d as $departament)
                                @if( $producto->idDepartamento == $departament->id)
                                {{$departament->nombre}} <br />
                                @endif
                                @endforeach
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ url('/producto/'.$producto->id.'/edit')}}"> Editar </a>
                                <form method="post" action="{{ url('/producto/'.$producto->id)}}" style="display:inline">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">
                                        Borrar</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <br />
        </div>
        <div class="col-md-1"> </div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="background:#0CC6CC">
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-4" style="background:#0CC6CC">
                    <!--
    <button> Editar</button>
    <button> Agregar</button>
    <button> Salir</button>
   <a title="Salir" href="{{url('producto')}}" class="text-dark">
    <img src="{{ asset('img\eliminar_usuariio.png') }}" class="img-thumbnail" alt="Salir"width="50px" height="50px" />Salir</a>-->
                    <a title="Agregar" href="{{url('producto/create')}}" class="text-dark">
                        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Agregar" width="50px" height="50px" />Agregar</a>

                    <a title="Inicio" href="{{url('producto')}}" class="text-dark">
                        <img src="{{ asset('img\inicio.png') }}" class="img-thumbnail" alt="Regreesar" width="50px" height="50px" />Inicio</a>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="col-md-1"> </div>
    </div>
</body>
</html>