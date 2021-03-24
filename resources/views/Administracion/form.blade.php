
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
@php
use App\Models\Sucursal_empleado;
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));  
$vS = ['veriSucursal','modificarSucursal','eliminarSucursal','admin'];
        $mS= ['modificarSucursal','admin'];
        $cS= ['crearSucursal','admin'];
        $eS= ['eliminarSucursal','admin'];
        $modificarS = $sE->hasAnyRole($mS);
        $crearS = $sE->hasAnyRole($cS);
        $eliminarS = $sE->hasAnyRole($eS);
        $verS = $sE->hasAnyRole($vS);
@endphp
    @if (count($sucursalB)) 
    @foreach($sucursalB as $sucursal)
    @if($sucursal->status === 1)
        @if($verS)
        <a href="{{url('/puntoVenta/administracion/'.$sucursal->id.'/edit/')}}" class="btn btn-light btn-block border border-dark  my-2 mx-1">{{$sucursal->direccion}}</a>
        @else
        <button onclick="alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')" class="btn btn-light btn-block border border-dark  my-2 mx-1">{{$sucursal->direccion}}</button> 
        @endif
    @endif
    @endforeach
    @else
    <div class="row">
        <h5>NO HAY SUCURSALES</h5>
    </div>
    @endif
</body>

</html>