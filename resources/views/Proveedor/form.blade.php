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
    @if (count($proveedorB)) 
    @foreach($proveedorB as $proveedor)
    @if($proveedor->status == true)
    <a href="{{url('/puntoVenta/proveedor/'.$proveedor->id.'/edit/')}}" class="btn btn-light btn-block my-2 mx-1 border border-dark">{{$proveedor->nombre}}</a-->
    @endif
    @endforeach
    @else
    <div class="row">
        <h5>No hay proveedores</h5>
    </div>
    @endif
</body>

</html>