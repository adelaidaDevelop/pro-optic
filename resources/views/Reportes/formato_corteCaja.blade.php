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
    $totalVentas= json_decode($_GET['totalVentas']);
    $abonoD= $_GET['abonoD'];
    $subtotalE= json_decode($_GET['subtotalE']);
    $devolucionT= json_decode($_GET['devolucionT']);
    $subtotalS= json_decode($_GET['subtotalS']);
    $total= json_decode($_GET['total']);
    $cantVenta= $_GET['cantVenta'];
    $fecha= $_GET['fecha'];
    $hoy = date('d/m/Y H:i:s');
    $ganancia= $_GET['ganancia'];
  
    @endphp
    <div class="row w-100 " id="impDiv">

        <div class="col-8 text-center">
            <br /><br /> <br />
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
            <h2>CAJERO: TODOS</h2>
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
            <h1 class="font-weight-bold"> === ENTRADAS DEL DIA === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                    <h2 class="row">TOTAL VENTAS: </h2>
                    <h2 class="row">ABONO DEUDORES: </h2>
                    <h2 class="row">SUBTOTAL ENTRADAS: </h2>
                </div>

                <div class="col-4 mx-auto px-auto">
                <h2> ${{ $totalVentas }} </h2>
                <h2> ${{ $abonoD }} </h2>
                <h2> ${{$subtotalE }}</h2>
                </div>
            </div>
            <br /> <br />
            <h1 class="font-weight-bold"> === SALIDAS DEL DIA === </h1>
            
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                <h2 class="row">TOTAL DEVOLUCIONES: </h2>
                <h2 class="row">SUBTOTAL SALIDAS: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                <h2> ${{ $devolucionT}} </h2>
                <h2> ${{ $subtotalS}}</h2>
                </div>
            </div>
            <br /> <br />
            <h1 class="font-weight-bold"> === TOTAL === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                <h2 class="row">TOTAL: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                <h2> ${{ $total }}  </h2>
                </div>
            </div>
            <br /><br />
            <h1 class="font-weight-bold"> === GANACIAS DEL DIA === </h1>
            <div class="row col-8  mx-auto px-auto ">
                <div class="col-8 mx-auto px-auto text-left">
                <h2 class="row">GANANCIA: </h2>
                </div>
                <div class="col-4 mx-auto px-auto">
                <h2> {{ $ganancia}} </h2>
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
<script>
    function imprimir() {

        window.print();
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