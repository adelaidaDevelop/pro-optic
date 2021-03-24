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
        $vC = ['verCliente','modificarCliente','eliminarCliente','crearCliente','admin'];
        $mC= ['modificarCliente','admin'];
        $cC= ['crearCliente','admin'];
        $eC= ['eliminarCliente','admin'];
        $sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));  
        $modificarC = $sE->hasAnyRole($mC);
        $crearC = $sE->hasAnyRole($cC);
        $eliminarC = $sE->hasAnyRole($eC);
        $verC = $sE->hasAnyRole($vC);
@endphp
<body>
    @if (count($clienteB)) 
    @foreach($clienteB as $cliente)
    @if($crearC)
    <button onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')" class="btn btn-light btn-block my-2  border border-dark  mx-1">{{$cliente->nombre}}</button>
    @else
    <a href="{{url('/puntoVenta/cliente/'.$cliente->id.'/edit/')}}" class="btn btn-light btn-block my-2  border border-dark  mx-1">{{$cliente->nombre}}</a>
    @endif
    @endforeach
    @else
    <div class=" row m-0 px-0">
        <h5 class=" h-100">NO HAY CLIENTES</h5>
    </div>
    @endif
</body>

</html>