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
    <script src="{{ asset('js\app.js') }}"></script>
</head>

<body>
    @php
    $id = 'Folio: ';
    $total = 'Total: ';
    $palab = 'PEDIDO: ';
    $cont = 1;
    @endphp
    @if (count($seguimientoPedidoActivo)>0)
    @foreach($seguimientoPedidoActivo as $pedido)
    @if ($cont == 1)
    <button id="btnVentaPedido{{$pedido->idVenta}}" class="btn btn-light btn-block border border-dark  my-2 mx-1 active">{{$palab}} {{$cont}} - {{$id}}{{$pedido->idVenta}} - {{$total}} {{$pedido->totalV}}</button>
    @else
    <button id="btnVentaPedido{{$pedido->idVenta}}" class="btn btn-light btn-block border border-dark  my-2 mx-1">{{$palab}} {{$cont}} - {{$id}}{{$pedido->idVenta}} - {{$total}} {{$pedido->totalV}}</button>
    @endif
    @php
    $cont = $cont + 1;
    @endphp
    @endforeach
    @else
    <div class="col-12 text-center">
        <h5 class="mx-auto">NO ENCONTRADO</h5>
    </div>
    @endif
</body>

</html>