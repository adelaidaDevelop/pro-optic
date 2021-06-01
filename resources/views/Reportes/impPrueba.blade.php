<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/ticket.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
</head>

<body>
    @php
    $ventaEfectivo= $_GET['ventasEfectivo'];
    $abonosEfectivo= json_decode($_GET['abonoEfectivo']);
    $dev_efectivo= json_decode($_GET['devEfectivo']);
    $totalCaja= json_decode($_GET['totalCaja']);
    $efectivoV= json_decode($_GET['efectivoV']);
    $creditoV= $_GET['creditoV'];
    $ecommerceV= $_GET['ecommerceV'];
    $devolucionV= $_GET['devolucionV'];
    $totalVentas= $_GET['totalV'];
    $total= $_GET['total'];
    $pagoProv= $_GET['pagoProv'];
    $fecha= $_GET['fecha'];
    $hoy = date('d/m/Y H:i:s');
    $ganancia= $_GET['gananciaId'];
    $cantVenta= $_GET['cantVenta'];
    $cajero= $_GET['cajero'];
    @endphp
    <div class="row w-100 " id="main1">
        <div class="col-8 text-center">
            <br/><br/> <br/>
            <h1 class="font-weight-bold"> FARMACIAS GI ZIMATLAN</h1>
            <h2> {{session('sucursalNombre')}} </h2>
            <h2> {{$suc_act->telefono}}</h2>
            <br /> <br />
            <h1 class="font-weight-bold"> CORTE DEL DIA</h1>
            <div class="row col-3  mx-auto px-auto ">
                <div class="col-6 mx-auto px-auto text-left">
                    <h2 class="row">DEL: </h2>
                </div>
                <div class="col-6 mx-auto px-auto">
                    <h2> {{ $fecha}} </h2>
                </div>
            </div>
            <br />
            <h2 class="mb-1"> REALIZADO: {{ $hoy}}</h2>
            <h2>CAJERO: {{$cajero}}</h2>
            <br /><br />
            <h1 class="font-weight-bold" class="font-weight-bold"> === CANT. VENTAS DEL DIA === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">VENTAS EN EL DIA: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h2> {{ $cantVenta}} </h2>
                </div>
            </div>
            <br />
            <h1 class="font-weight-bold"> === DINERO EN CAJA === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">+VENTAS EFECTIVO: </h2>
                    <h2 class="row">+ABONOS EFECTIVO: </h2>
                    <h2 class="row">-DEVOLUCION EFECTIVO: </h2>
                    <h2 class="row text-dark">TOTAL CAJA: </h2>

                </div>

                <div class="col-4 mx-auto px-auto">
                    <h2> +${{ $ventaEfectivo }} </h2>
                    <h2> +${{ $abonosEfectivo}} </h2>
                    <h2> -${{ $dev_efectivo }} </h2>
                    <h2> ${{$totalCaja }}</h2>
                </div>
            </div>
            <br /> <br />
            <h1 class="font-weight-bold"> === VENTAS DEL DIA === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">EFECTIVO: </h2>
                    <h2 class="row">CREDITO: </h2>
                    <h2 class="row">ECOMMERCE: </h2>
                    <h2 class="row">DEV VENTAS: </h2>
                    <h2 class="row">VENTAS TOTALES: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h2> ${{ +$efectivoV}} </h2>
                    <h2> ${{ +$creditoV}} </h2>
                    <h2> ${{ +$ecommerceV}} </h2>
                    <h2> ${{ -$devolucionV}} </h2>
                    <h2> ${{ $totalVentas}}</h2>
                </div>
            </div>

            <br /> <br />
            <h1 class="font-weight-bold"> === TOTAL === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">TOTAL: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h2> ${{ $total }} </h2>
                </div>
            </div>

            <h1 class="font-weight-bold"> === PAGO A PROVEEDORES === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">PAGOS A PROVEEDORES: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h2> ${{ $pagoProv }} </h2>
                </div>
            </div>
            <br /><br />

            <h1 class="font-weight-bold"> === GANANCIAS DEL DIA === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">GANANCIA: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h2> ${{ $ganancia}} </h2>
                </div>
            </div>
            <br /><br />
            <!--
            <h1 class="font-weight-bold"> === VENTAS POR DEPTOS === </h1>
            <div class="col-6 mx-auto px-auto  ">
                <h2 class="row">TOTAL :</h2>
            </div>
            -->
        </div>

    </div>
</body>

<script src="Scripts/jquery-1.10.2.min.js"></script>
<script>
/*
    $(document).ready(function() {
        $("input#imprime").on('click', function(ev) {
            CallPrint();
            //clickimprime();
        });
    });
    */

    CallPrint();
    function CallPrint() {
        var divToPrint = document.getElementById('main1');
        var newWin = window.open('width=100,height=100', '_blank');
        newWin.focus();
        newWin.document.open();
        newWin.document.write(divToPrint.innerHTML);
        newWin.document.close();
        setTimeout(function() {
            newWin.close();
        }, 10);
    }
/*
    function clickimprime() {
        $("button.print").click();
    }
    */

    //////////////////////////
   // $('button.print').click();

   
</script>

</html>