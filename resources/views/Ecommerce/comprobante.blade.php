<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pdfs.css') }}" rel="stylesheet">
</head>
<!--EMPIEZA-->

<body class="container">
    <header>
        <div class="row col-11 mx-auto position-relative ">
            <img class="mx-0 text-left mt-3 " src="{{ asset('img\farmaciagilogo.png') }}" alt="Editar" height="50px">
            <div class="row col-12  mt-4 mx-auto text-center position-absolute">
                <p class="row h2 text-uppercase text-center mx-auto  my-auto"> Farmacias Gi S.A. de C.V.</p>
            </div>
        </div>
    </header>

    <main>
        <div class="col p-4 mx-3 " id="impDiv">
            <div class="col text-center mt-4">
                <h3 class="alert-primary"> COMPROBANTE DE ENTREGA</h3>
            </div>
            <br /><br />
            <div class="col mb-4">
                <h3 class="text-left mb-4"> ESTIMADO CLIENTE:</h3>
                <p class="h4 mt-4" style="text-align:justify"> FARMACIAS GI ZIMATLAN, AGRADECE SU PREFERENCIA. A CONTINUACION, SE
                    DETALLA INFORMACION DE SU PEDIDO.</p>
            </div>

            <div class="col-12 mx-auto  h4 mt-4 border  rounded my-4">
                <div class="col-8 mx-auto">
                    <p class=""> FOLIO: {{$venta->id}} </p>
                    <p class=""> SUCURSAL: {{$sucursal->direccion}} </p>

                    <p>FECHA Y HORA GENERADO PEDIDO: {{$venta->created_at->isoFormat('H:mm:ss A')}} {{$venta->created_at->format('d-m-Y')}}</p>
                    <p>HORA PROGRAMADA DE ENTREGA: {{$venta->created_at->addMinutes(60)->isoFormat('H:mm:ss A')}}</p>
                    @if($ventaCliente->estado == 'PAGADO')
                    <h6>ENTREGADO: {{$ventaCliente->updated_at->format('d-m-Y')}} {{$ventaCliente->updated_at->isoFormat('H:mm:ss A')}}</h6>
                    @endif
                    <p>ESTADO DEL PEDIDO: {{$ventaCliente->estado}}</p>
                    <p>DIRECCION DE ENTREGA: {{$ventaCliente->direccion }}</p>
                    <p>CLIENTE: {{$cliente->nombre}} {{$cliente->apellidoPaterno}} {{$cliente->apellidoMaterno}}</p>
                    <p class="my-4">PRODUCTOS:</p>
                    <p class=""> CANTIDAD </p>
                    <ul>

                    </ul>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">CODIGO BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">RECETA</th>
                                <th scope="col">CANTIDAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosPedido as producto)
                            <tr>
                                <td>{{producto->codigoBarras}}</td>
                                <td>{{producto->nombre}}</td>
                                <td>{{producto->receta}}</td>
                                <td>{{ productos->cantidad}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br /><br />
            <div class="col text-center  h4 text-center">
                <p class="h3">ATENTAMENTE</p>
                <br /><br />
                <p> FARMACIAS GI SA DE C.V ZIMATLAN</p>
                <p class=""> SUCURSAL: {{$sucursal->direccion}} </p>
                <p class=""> SUCURSAL: {{$sucursal->telefono}} </p>
                <a href="">farmaciasgizimatlan.epizy.com</a>
            </div>
        </div>
    </main>

    <footer>

    </footer>
</body>

<!--ACABA-->
<script>

</script>

</html>