@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        VENTAS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado))
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    AGREGAR EMPLEADO
                </button>
            </form>
        </div>
        @endif
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    EMPLEADOS DADOS DE BAJA
                </button>
            </form>
        </div>
        @endsection
    </div>
    <div class="row p-1 ">
        <div class="row border border-dark m-2 w-100">
            <div class="col">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="nombre">
                            BUSCAR PRODUCTO
                        </label>
                        <input type="text" class="form-control @error('claveE') is-invalid @enderror" name="claveE"
                            id="claveE" value="{{ old('claveE') }}" placeholder="Ingresar clave para operaciones"
                            required autocomplete="claveE" autofocus>
                        @error('claveE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row m-0 px-0 border border-dark" style="height:300px;overflow-y:auto;">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($_GET["datosP"]))
                            {{$_GET["datosP"]}}
                            @endif
                            @if (isset($_GET["datosPs"]))
                                @php
                                    $datosP =array();
                                    $datosP=$_GET["datosP"];
                                @endphp
                                @foreach($datosP as $productos)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$productos}}</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row m-0 px-0">
                    <div class="col my-2 ml-5 px-1">
                        <div class="row">
                            <form method="get" action="{{url('/empleado')}}">
                                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    AGREGAR TICKET
                                </button>
                            </form>
                            <form method="get" action="{{url('/empleado')}}">
                                <button class="btn btn-primary ml-5" type="submit" style="background-color:#3366FF">
                                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    ELIMINAR TICKET
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col my-2 ml-5 mr-0 pr-0 ">
                        <div class="d-flex flex-row-reverse">
                            <h4 class="border border-dark ml-2 p-1">$ 0.00</h4>
                            <!--form method="get" action="{{url('/empleado')}}"-->
                            <!--{url('/departamento/'.$departamento->id.'/edit/')}}-->
                            <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                                onclick="filtrar({{$datosP}})" value="informacion" id="boton">
                                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                COBRAR
                            </button>
                            <!--/form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//const texto = document.querySelector('#boton');
//let data = <php return redirect('/'); ?>;
function filtrar($dato) {
    var jsVar1 = "Hello";
    var jsVar2 = "World";
    let data = <?php echo json_encode($datosP);?>;
    console.log(data);
    //data.push($dato);
    alert(data);
    //window.location.href = window.location.href + "?datosP=" + data;

    fetch(`/venta`, {
        method: 'POST', // or 'PUT'
        mode: 'no-cors', // no-cors, *cors, same-origin
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(res => res.json())
    .catch(error => console.error('Error:', error))
    .then(response => console.log('Success:', response));
};
/*document.getElementById("resultados").innerHTML = "";
let data = <php echo json_encode($datosP);?>;
alert(data);
data.push(0);
alert(data);*/
/*fetch('flores.jpg').then(function(response) {
        if (response.ok) {
            response.blob().then(function(miBlob) {
                var objectURL = URL.createObjectURL(miBlob);
                miImagen.src = objectURL;
            });
        } else {
            console.log('Respuesta de red OK pero respuesta HTTP no OK');
        }
    })
    .catch(function(error) {
        console.log('Hubo un problema con la petición Fetch:' + error.message);
    });*/


/*fetch('http://example.com/movies.json')
    .then(response => response.json())
    .then(data => console.log(data));*/
//var peticion = JSON.parse($data);
//};
//texto.addEventListener('keyup', filtrar);
//texto.addEventListener('click', filtrar);
//filtrar();
</script>
@endsection