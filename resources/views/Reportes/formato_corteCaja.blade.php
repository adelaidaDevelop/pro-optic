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
    <div class="row w-100 " id="impDiv">

        <div class="col-8 text-center">
            <br /><br /> <br />
            <h2 class="font-weight-bold"> FARMACIAS GI ZIMATLAN</h2>
            <h3> {{session('sucursalNombre')}} </h3>
            <h3> {{$suc_act->telefono}}</h3>
            <br /> <br />
            <h2 class="font-weight-bold"> CORTE DEL DIA</h2>
           
            <h2>DEL: {{ $fecha }}</h2>
            <h3 class="mb-1"> REALIZADO: {{ $hoy}}</h3>
            <br/>  
            <h2>CAJERO: {{ $cajero }}</h2>
            <br/>
            <h2 class="font-weight-bold" class="font-weight-bold"> === CANT. VENTAS DEL DIA === </h2>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h3 class="row">VENTAS EN EL DIA: </h3>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h3> {{ $cantVenta}} </h3>
                </div>
            </div>

            <br />
            <h2 class="font-weight-bold"> === DINERO EN CAJA === </h2>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h3 class="row">+VENTAS EFECTIVO: </h3>
                    <h3 class="row">+ABONOS EFECTIVO: </h3>
                    <h3 class="row">-DEVOLUCION EFECTIVO: </h3>
                    <h3 class="row">TOTAL CAJA: </h3>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h3> +${{ $ventaEfectivo }}  </h3>
                    <h3> +${{ $abonosEfectivo}} </h3>
                    <h3> -${{ $dev_efectivo }}</h3>
                    <h3> ${{$totalCaja }} </h3>
                </div>
            </div>
            
            <br /> <br />
            <h2 class="font-weight-bold"> === VENTAS DEL DIA === </h2>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h3 class="row">EFECTIVO: </h3>
                    <h3 class="row">CREDITO: </h3>
                    <h3 class="row">ECOMMERCE: </h3>
                    <h3 class="row">DEV VENTAS: </h3>
                    <h3 class="row">VENTAS TOTALES: </h3>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h3> ${{ +$efectivoV}} </h3>
                    <h3> ${{ +$creditoV}} </h3>
                    <h3> ${{ +$ecommerceV}} </h3>
                    <h3> ${{ -$devolucionV}} </h3>
                    <h3> ${{ $totalVentas}}</h3>
                </div>
            </div>

            <br /> <br />
            <h2 class="font-weight-bold"> === TOTAL === </h2>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h3 class="row">TOTAL: </h3>
                </div>
                <div class="col-4 mx-auto px-auto">
                    <h3> ${{ $total }} </h3>
                </div>
            </div>
 <!--AQUI-->
            <!--
            <h1 class="font-weight-bold"> === VENTAS POR DEPTOS === </h1>
            <div class="col-6 mx-auto px-auto  ">
                <h2 class="row">TOTAL :</h2>
            </div>
            -->
            
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
        </div>

    </div>
</body>
<script>
    function imprimir() {

        window.print();
        myWindow.blur(); //
        myWindow.close(); //
        // document.getElementById("totalV").innerHTML = 
    }
    imprimir();
    //let productos =json($productos);
    //alert(productos);
    //let fecha = new Date();
    //alert(fecha.toLocaleDateString();

    // impFinal();
    function impFinal() {
        var WinPrint = window.open('', '', 'width=900,height=650 ');
        WinPrint.document.write(document.getElementById('impDiv').outerHTML); //printContent.outerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
</script>

</html>