<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row" style="background:#ED4D46">
        <h1>DEPARTAMENTOS</h1>
    </div>
    <div class="row">
        <div class="col" style="background:#0CC6CC">
            <table class="table table-striped">
                <thead>
                    <!--tr>
                        <th>Departamento</th>
                    </tr-->
                </thead>
                <tbody>
                    @foreach($departamentos as $departamento)
                    <tr style="background:#FFFFFF"><div style="background:#FFFFFF">
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <h4>{{$departamento->nombre}}</h4>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id.'/edit/')}}">
                                {{csrf_field()}}
                                {{ method_field('GET')}}
                                <button class="btn btn-light" type="submit">
                                <!--img src="{{ asset('img\editar.png') }}"/-->
                                <img src="{{ asset('img\editar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                <h6>Editar</h6>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-light" type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                <h6>Eliminar</h6>
                                </button>
                            </form>
                        </td>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col" style="background:#FFFBF2">
        @if(isset($d))
            
            <form method="post" action="{{url('/departamento/'.$d->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <label for="Nombre"><h2>Editar Departamento</h2></label>
                <br/>
                <label for="Nombre"><h3>{{$d->nombre}}</h3></label>
                <input type="text" name="nombre" id="nombre" value="{{$d->nombre}}">
                <br/>
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Guardar Departamento
                                </button>
                <!--input type="submit" value="Agregar"-->
            </form>
            @else
            <form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="Nombre"><h2>Nuevo Departamento</h2></label>
                <br/>
                <label for="Nombre"><h3>{{'Nombre'}}</h3></label>
                <br/>
                <input type="text" name="nombre" id="nombre" value="">
                <br/>
                <!--input type="submit" value="Guardar Departamento"-->
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                    Agregar Departamento
                </button>
            </form>
        @endif
        </div>
    </div>
</div>
<script></script>

</body>
</html>