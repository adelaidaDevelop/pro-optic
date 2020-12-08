<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
<br/><br />

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <h3 class="p-3 mb-6  text-white" style="background:#ED4D46">SUBPRODUCTO</h3>
    </div>
    <div class="col-md-1"> </div>
</div>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="background:#D5DBDB">
        <h5 class="blockquote text-center"> <strong>Consultar subroducto</strong></h5>
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
                <input type="text" size="50" name="buscar" id="buscar" value="" placeholder="Buscar subproducto">
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
    <div class="col-md-2"style="background:#0CC6CC"></div>
    <div class="col-md-8" style="background:#0CC6CC">
        <div class="scrollable">
        <table class=" table-bordered table-hover">
                    <!--"table table-hover" "table table-bordered table-dark" "table-active" -->
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Producto</th>
                            <th>Total piezas</th>
                            <th>Precio individual</th>
                            <th>Existencia</th>
                            <th>Descripcion</th>
                            <th>Medida</th>
                            <th>Ganancia</th>
                           <!-- <th>Acciones</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subproducto as $subproducto)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$subproducto->idProductos}}</td>
                          
                            <td>{{$subproducto->piezas}}</td>
                            <td>{{$subproducto->precio_ind}} </td>
                            <td>{{$subproducto->descripcion}} </td>
                            <td>{{$subproducto->medida}} </td>
                            <td>{{$subproducto->existencia}} </td>
                            <td>{{$subproducto->ganancia}} </td>
                          <!--  <td>
                                <a class="btn btn-primary" href="{{ url('/subproducto/'.$subproducto->idProductos.'/edit')}}"> Editar </a>
                                <form method="post" action="{{ url('/subproducto/'.$subproducto->idProductos)}}" style="display:inline">
                                    {{csrf_field()}}

                                    {{method_field('DELETE')}}
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">
                                        Borrar</button>
                                </form>
                            </td>-->
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
                    <a title="Agregar" href="{{url('subproducto/create')}}" class="text-dark">
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