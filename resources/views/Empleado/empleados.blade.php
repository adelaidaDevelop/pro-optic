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
@php
        use App\Models\Sucursal_empleado;
        $vE = ['verEmpleado','modificarEmpleado','eliminarEmpleado','crearEmpleado','admin'];
        $mE= ['modificarEmpleado','admin'];
        $cE= ['crearEmpleado','admin'];
        $eE= ['eliminarEmpleado','admin'];
        $sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));  
        $modificarE = $sE->hasAnyRole($mE);
        $crearE = $sE->hasAnyRole($cE);
        $eliminarE = $sE->hasAnyRole($eE);
        $verE = $sE->hasAnyRole($vE);

        $vS = ['veriSucursal','modificarSucursal','eliminarSucursal','crearSucursal','admin'];
        $mS= ['modificarSucursal','admin'];
        $cS= ['crearSucursal','admin'];
        $eS= ['eliminarSucursal','admin'];
        $modificarS = $sE->hasAnyRole($mS);
        $crearS = $sE->hasAnyRole($cS);
        $eliminarS = $sE->hasAnyRole($eS);
        $verS = $sE->hasAnyRole($vS);
        $admin = $sE->hasRole('admin');
        @endphp
<body>
    @if($admin)
    <a href="{{url('puntoVenta/empleado/0/edit/')}}" class="btn btn-success btn-block my-2 border border-dark text-uppercase">{{$admin->username}}</a>    
    @endif
    @if (count($empleados))
    @foreach($empleados as $empleado)
        @if($empleado->id > 1)
            @if($crearE)
            <button onclick="alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')" class="btn btn-light btn-block my-2 border border-dark text-uppercase" style="color:#3366FF">{{$empleado->primerNombre}} {{$empleado->segundoNombre}} {{$empleado->apellidoPaterno}} {{$empleado->apellidoMaterno}}</button>
            
            @else
            <a href="{{url('puntoVenta/empleado/'.$empleado->id.'/edit/')}}" class="btn btn-light btn-block my-2 border border-dark text-uppercase" style="color:#3366FF">{{$empleado->primerNombre}} {{$empleado->segundoNombre}} {{$empleado->apellidoPaterno}} {{$empleado->apellidoMaterno}}</a>
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