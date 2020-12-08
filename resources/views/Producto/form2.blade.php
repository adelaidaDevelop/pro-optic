<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
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
</body>
</html>