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
    <p><strong>Asunto:</strong>{{$asunto}}</p>
    <p style="color:#ed4d46" class="text-primary"><strong>Contenido:</strong>A continuacion se muestra un informe de los productos que
    tienen un stock bajo</p>
    <table class="table table-bordered border-primary col-12">
        <thead class="table-secondary text-primary">
            <tr class="text-center">
                <th>CODIGO DE BARRAS</th>
                <th>PRODUCTO</th>
                <th>STOCK</th>
            </tr>
        </thead>
        <tbody class="text-center" id="productos">
        @foreach($productos as $p)
            <tr>
                <td style="text-align:center">{{$p->codigoBarras}}</td>
                <td style="text-align:center">{{$p->nombre}}</td>
                <td style="text-align:center">{{$p->existencia}}</td>
            <tr>
        @endforeach
        </tbody>
    </table>
</body>

</html>