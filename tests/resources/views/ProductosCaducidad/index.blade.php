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
    <p><strong>Asunto:</strong>Posibles productos a caducar</p>
    <p><strong>Contenido:</strong>A continuacion se muestra un informe de los productos que
    estan posibles a caducar para ponerlos en oferta</p>
    <table class="table table-bordered border-primary col-12">
        <thead class="table-secondary text-primary">
            <tr class="text-center">
                <th>PRODUCTO</th>
                <th>#</th>
                <th>CADUCIDAD</th>
            </tr>
        </thead>
        <tbody class="text-center" id="productos">
        @foreach($productosCaducidad as $pC)
            <tr>
                @foreach($productos as $p)
                @if($p->id == $pC->idProducto)
                <td style="text-align:center">{{$p->nombre}}</td>
                @endif
                @endforeach
                <td style="text-align:center">{{$pC['cantidad']}}</td>
                <td style="text-align:center">{{$pC['fecha_caducidad']}}</td>
            <tr>
        @endforeach
        </tbody>
    </table>
</body>

</html>