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
            @php
            $var = 1;
            @endphp
            <div class="col">
                <div class="row p-0 mt-1 ml-0 mr-0 mb-0">
                    <!--div class="col-9">
                    <form class="form-row" method=get action="{{url('venta?codigo=5')}}" enctype="multipart/form-data"-->
                    <div class="col-4 m-0 px-0 pt-2 pb-0 ">
                        <label for="nombre" class="font-weight-bold " style="color:#3366FF">
                            <h4>CODIGO DEL PRODUCTO</h4>
                        </label>
                    </div>
                    {{ csrf_field() }}
                    <div class="col m-0 px-0 pt-1 pb-0 ">
                        <input type="text" class="form-control @error('claveE') is-invalid @enderror"
                            name="codigoBarras" id="codigoBarras" value="{{ old('claveE') }}"
                            placeholder="Ingresar codigo de barras" required autocomplete="claveE" autofocus>
                        @error('claveE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col m-1 ">
                        <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                            onclick="agregarPorCodigo()" value="informacion" id="botonAgregar">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            AGREGAR PRODUCTO
                        </button>
                    </div>
                    <!--form>
                    </div-->
                    <div class="col m-1">
                        <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                            onclick="codigo()" data-toggle="modal" data-target="#exampleModal" value="informacion" id="boton">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            BUSCAR PRODUCTO
                        </button>
                    </div>
                </div>
                <div class="row m-0 px-0 border border-dark" style="height:300px;overflow-y:auto;">
                    <table class="table" id="productos">
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
                        <tbody id="info">
                            @if(isset($_GET["datosP"]))
                            {{$_GET["datosP"]}}
                            @endif
                            @if(isset($_GET["datosPs"]))
                            @php
                            $datosP =array();
                            $datosP=$_GET["datosP"];
                            @endphp
                            @endif
                            @if(isset($p))
                            @foreach($p as $productos)
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="busquedaProducto">
                </div>
                <div class="row" style="height:200px;overflow:auto;" id="resultados">
                   <div class="col" id="busqueda">
                   <div class="row">
                    <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " onclick="codigo()">
                        <!--button class="row w-100 btn btn-secondary mx-2 p-1"-->
                        <div class="row">
                            <div class="col-6">
                                Sigo siendo un
                            </div>
                            <div class="col-6">
                                Que buen boton soy :v
                            </div>
                        </div>
                        <!--/button-->
                    </a>
                    </div>
                    <!--/div-->
                    <div class="row">
                    <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " onclick="codigo()">
                        <div class="row">
                            <div class="col-6">
                                Sigo siendo un
                            </div>
                            <div class="col-6">
                                Que buen boton soy :v
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="row">
                    <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " onclick="codigo()">
                        <div class="row">
                            <div class="col-6">
                                Sigo siendo un
                            </div>
                            <div class="col-6">
                                Que buen boton soy :v
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let productosVenta = [];
const productos = @json($datosP);

function venta()
{
    let cuerpo = "";
    for (count in productosVenta) {
        cuerpo = cuerpo + `
        <tr>
            <th scope="row">` + count + `</th>
            <td>` + productosVenta[count].codigoBarras + `</td>
            <td>` + productosVenta[count].nombre + `</td>
            <td>5</td>
            <td>` + productosVenta[count].nombre + `</td>
            <td><input type="number"/></td>
            <td>55</td>
        </tr>
        `;
    }

    document.getElementById("info").innerHTML = cuerpo;
}

function agregarPorCodigo() {
    const codigo = document.querySelector('#codigoBarras');
    //document.getElementById("info").innerHTML = codigo.value;//$var}}` ;
    //location.href= location.href+'?codigo='+codigo.value;
    
    for (count in productos) {
        if (productos[count].codigoBarras === codigo.value)
            productosVenta.push(productos[count]);
        //alert(productos[count].nombre);
    }

    //alert(productosVenta);
    venta();

    /*fetch(`/venta/productos?`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("productos").innerHTML = html
        })
    /*$.ajax(
                {
                    url: 'http://localhost:8000/venta?datosNuevos='+codigo.value,
                    success: function( data ) {
                        alert( 'El servidor devolvio "' + data. + '"' );
                        document.getElementById("info").innerHTML = data;
                    }
                }
            )
    php
        if(isset($_POST["caja_valor"]))
            $valor = $_POST["caja_valor"];
        
    endphp*/
    //alert('si funciona');
};

function codigo() {
    
    let productosInfo = ""; 
    var contador = 1;
    for(count in productos)
    {
        productosInfo = productosInfo +
        `
        <div class="row">
        <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " 
        data-dismiss="modal" onclick="agregarProducto(`+productos[count].id+`)">
            <div class="row">
                <div class="col-1">`+(contador++)+`</div>
                <div class="col-3">`+productos[count].codigoBarras+`</div>
                <div class="col-4">`+productos[count].nombre+`</div>
                <div class="col-1">`+productos[count].existencia+`</div>
                <div class="col-3">`+productos[count].idDepartamento+`</div>
            </div>
        </a>
        </div>
        `;
    }
    document.getElementById("busqueda").innerHTML= productosInfo;
    
};

function agregarProducto(id)
{
    for (count in productos) {
        if (productos[count].id === id)
            productosVenta.push(productos[count]);
        //alert(productos[count].nombre);
    }
    venta();
};

const busqueda = document.querySelector('#busquedaProducto');
function busquedaProducto() 
{
    let productosInfo = "";
    var contador = 1;
    //alert(productos[0].nombre);
    for(count in productos)
    {

        if(productos[count].nombre.toUpperCase().includes(busqueda.value.toUpperCase()))
        {
            productosInfo = productosInfo +
        `
        <div class="row">
        <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " 
        data-dismiss="modal" onclick="agregarProducto(`+productos[count].id+`)">
            <div class="row">
                <div class="col-1">`+(contador++)+`</div>
                <div class="col-3">`+productos[count].codigoBarras+`</div>
                <div class="col-4">`+productos[count].nombre+`</div>
                <div class="col-1">`+productos[count].existencia+`</div>
                <div class="col-3">`+productos[count].idDepartamento+`</div>
            </div>
        </a>
        </div>
        `;
        }
        /*productosInfo = productosInfo +
        `
        <div class="row">
        <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " 
        data-dismiss="modal" onclick="agregarProducto(`+productos[count].id+`)">
            <div class="row">
                <div class="col-1">`+(contador++)+`</div>
                <div class="col-3">`+productos[count].codigoBarras+`</div>
                <div class="col-4">`+productos[count].nombre+`</div>
                <div class="col-1">`+productos[count].existencia+`</div>
                <div class="col-3">`+productos[count].idDepartamento+`</div>
            </div>
        </a>
        </div>
        `;*/
    }
    document.getElementById("busqueda").innerHTML= productosInfo;
    
}

busqueda.addEventListener('keyup', busquedaProducto);

</script>
@endsection