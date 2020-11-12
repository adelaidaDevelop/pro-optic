
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if (count($departamentosB))
<table class="table table-striped">
                <tbody id="contenido">
                <nav id="navbar-example2" class="navbar navbar-light bg-light">
                
                    @foreach($departamentosB as $departamento)
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
                                <div class="row">
                                <div class="col">
                                <img src="{{ asset('img\editar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                </div>
                                <div class="col"> 
                                <h6>Editar</h6>
                                </div>
                                </div>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-light" type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                <div class="row">
                                <div class="col">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                </div>
                                <div class="col">
                                <h6>Eliminar</h6>
                                </div>
                                </div>
                                </button>
                            </form>
                        </td>
                        </div>
                    </tr>
                    @endforeach
                </nav>
                <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                </div>
                </tbody>
            </table>           
@endif
</body>
</html>