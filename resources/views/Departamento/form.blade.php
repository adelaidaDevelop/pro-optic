
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if (count($departamentosB))
@foreach($departamentosB as $departamento)
<div class="row">
    <div class="col-6"><h4>{{$departamento->nombre}}</h4></div>
    <div class="col-3">
        <form method="post" action="{{url('/departamento/'.$departamento->id.'/edit/')}}">
            {{csrf_field()}}
            {{ method_field('GET')}}
            <button class="btn btn-light" type="submit">
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
    </div>
    <div class="col-3">
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
    </div>
</div>
@endforeach
@else
<div class="row">
    <h5>Departamento no encontrado</h5>
</div>           
@endif
</body>
</html>