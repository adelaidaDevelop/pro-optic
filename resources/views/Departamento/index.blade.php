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
                            <form method="post" action="{{url('/departamento/'.$departamento->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button type="submit" onclick="return confirm('¿Esta seguro de borrar este departamento?')">
                                    Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="col">
            <form method="post" action="{{url('departamento')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="Nombre">{{'Nombre'}}</label>
                <label for="Nombre">{{'Nombre'}}</label>
                <input type="text" name="nombre" id="nombre" value="">
                <input type="submit" value="Agregar">
            </form>
        </div>
    </div>
</div>
</body>
</html>