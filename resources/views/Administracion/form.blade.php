
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
    @if (count($sucursalB)) 
    @foreach($sucursalB as $sucursal)
    @if($sucursal->status === 1)
    <a href="{{url('/puntoVenta/administracion/'.$sucursal->id.'/edit/')}}" class="btn btn-light btn-block border border-dark  my-2 mx-1">{{$sucursal->direccion}}</a-->
    @endif
    @endforeach
    @else
    <div class="row">
        <h5>NO HAY SUCURSALES</h5>
    </div>
    @endif
</body>

</html>