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
    <div class="row">
        <h1>DEPARTAMENTOS</h1>
    </div>
    <div class="row">
        <div class="col">
            <table>
                <thead>
                    <tr>
                        <th>Departamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departamentos as $departamento)
                    <tr><td>{{$loop->iteration}}</td>
                        <td>
                            <button>{{$departamento->nombre}}</button>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id.'/edit/')}}">
                                {{csrf_field()}}
                                {{ method_field('GET')}}
                                <button class="btn btn-round" type="submit">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                </svg>Editar
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-round" type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>Eliminar
                                </button>
                            </form>
                        </td>
                        <td>
                        <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('EDIT')}}
                                <button class="btn btn-round" type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                    <img src="{{ asset('farmacias_gi\resources\views\Departamento\editar.png') }}"/>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">
        @if(isset($d))
            
            <form method="post" action="{{url('/departamento/'.$d->id)}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH')}}
                <label for="Nombre">Editar Departamento</label>
                <br/>
                <label for="Nombre">{{$d->nombre}}</label>
                <input type="text" name="nombre" id="nombre" value="{{$d->nombre}}">
                <br/>
                <input type="submit" value="Agregar">
            </form>
            @else
            <form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="Nombre">Nuevo Departamento</label>
                <br/>
                <label for="Nombre">{{'Nombre'}}</label>
                <input type="text" name="nombre" id="nombre" value="">
                <br/>
                <input type="submit" value="Agregar">
            </form>
        @endif
        </div>
    </div>
</div>
</body>
</html>