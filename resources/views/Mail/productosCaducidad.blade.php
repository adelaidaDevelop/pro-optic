<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <title>Document</title>
</head>

<body>
    <p><strong>Asunto:</strong>Existencia de los productos en las sucursales</p>
    <p style="color:#ed4d46" class="text-primary text-uppercase">A continuacion se muestra
     un informe de los productos que estan a punto de caducar</p>
    @foreach($sucursales as $sucursal)
        @if($sucursal->total > 0)
        <h3 class="text-primary text-uppercase"><strong>SUCURSAL {{$sucursal->direccion}}</strong></h3>
        
        <table class="table table-bordered border-primary col-12 text-center">
        <thead class="table-secondary text-primary">
            <tr class="text-center">
                <th style="font-size:13px">CODIGO DE BARRAS</th>
                <th style="font-size:13px">PRODUCTO</th>
                <th style="font-size:13px">CANTIDAD APROXIMADA</th>
                <th style="font-size:13px">FECHA DE CADUCIDAD</th>
            </tr>
        </thead>
        <tbody class="text-center" id="productos">
        @foreach($productosCaducidad as $pC)
            <tr>
                <td style="text-align:center;font-size:12px">{{$pC->codigoBarras}}</td>
                <td style="text-align:center;font-size:12px">{{$pC->nombre}}</td>
                <td style="text-align:center;font-size:12px">{{$pC->cantidad}}</td>
                <td style="text-align:center;font-size:12px">{{$pC->fecha_caducidad}}</td>
            <tr>
        @endforeach
        </tbody>
        </table>
        @endif
    @endforeach
</body>

</html>