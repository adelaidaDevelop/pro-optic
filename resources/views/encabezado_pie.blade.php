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
        <div class="row mx-2 position-relative">
            <img class=" text-left mt-3" src="{{ asset('img\farmaciagilogo.png') }}" alt="Editar" height="50px">
            <div class="row w-100  mt-3 mx-auto text-center position-absolute">
                <p class="row h4 text-uppercase text-center mx-auto  my-auto"> Farmacias Gi S.A. de C.V.</p>
            </div>
        </div>
    </header>

    <main>
        <div class="col p-4 mx-4 " id="contenido">
        </div>
        <!-- TABLA -->
        <div id="tablaR" class="row col-12 mb-3">
            <div id="tabla2" class="row col-12 " style="height:400px;overflow-y:auto;">
                <table class="table table-bordered border-primary  ml-3  w-100">
                    <thead class="table-secondary text-dark">
                        <tr>
                            <th>#</th>
                            <th>MOVIMIENTO</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>CAJERO</th>
                            <th>PRODUCTO</th>
                            <th>DEPTO</th>
                        </tr>
                    </thead>
                    <tbody id="consultaBusqueda">
                        @foreach($div as $ele)
                        <tr>
                            <th scope="row"> {{$ele['contador']}} </th>
                            <td> {{$ele['movimientoTxt']}}</td>
                            <td> {{$ele['fechaCol']}}</td>
                            <td> {{$ele['horaCol']}}</td>
                            <td> {{$ele['empleado']}}</td>
                            <td> {{$ele['productoCol']}}</td>
                            <td> {{$ele['depto']}}</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer>

    </footer>

</body>


</html>