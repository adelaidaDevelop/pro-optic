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
</head>

<body>
    <a href="{{url('puntoVenta/empleado/0/edit/')}}" class="btn btn-success btn-block my-2 border border-dark text-uppercase">{{$admin->username}}</a>    
    @if (count($empleados))
    @foreach($empleados as $empleado)
        @if($empleado->id > 1)
            @if($empleado->status == 'baja')
            <a href="{{url('puntoVenta/empleado/'.$empleado->id.'/edit/')}}" class="btn btn-light btn-block my-2 border border-dark text-uppercase" style="color:white;background-color:#ED4D46">{{$empleado->nombre}} {{$empleado->apellidos}}</a>
            @else
            <a href="{{url('puntoVenta/empleado/'.$empleado->id.'/edit/')}}" class="btn btn-light btn-block my-2 border border-dark text-uppercase" style="color:#3366FF">{{$empleado->nombre}} {{$empleado->apellidos}}</a>
            @endif
        @endif
    @endforeach
    @else
    <!--div class="row">
        <h5>EMPLEADO NO ENCONTRADO</h5>
    </div-->
    @endif
</body>

</html>