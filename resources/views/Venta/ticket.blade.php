<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">
</head>

<body>
    @php
    if(isset($_GET['productos'])){
    $productos= json_decode($_GET['productos']);
    }
    $total = 0;
    foreach($productos as $p)
    {
    $subtotal = $p->precio * $p->cantidad;
    $total = $total + $subtotal;
    }
    $cambio = $pago - $total;
    @endphp
    <div class="ticket">
        <img src="{{ asset('img\farmaciagilogo.png') }}" alt="Logotipo">
        <p class="centrado">FARMACIAS GI ZIMATLAN
            <br>{{session('sucursalNombre')}}
            <br>{{now()->format('d-m-Y h:i:s A')}}
            <br>CAJERO: {{$cajero}}
            <br>No. Folio: {{$folio}}
        </p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">PRECIO</th>
                    <th class="precio">IMPORTE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td class="cantidad">{{$producto->cantidad}}</td>
                    <td class="producto">{{$producto->nombre}}</td>
                    <td class="precio">{{$producto->precio}}</td>
                    <td class="precio">{{$producto->subtotal}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="">TOTAL: ${{$total}}
            <br>PAGÓ CON: ${{$pago}}
            <br />SU CAMBIO: ${{$cambio}}
        </p>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
            <br>farmaciasgizimatlan.epizy.com
        </p>
    </div>

</body>

</html>