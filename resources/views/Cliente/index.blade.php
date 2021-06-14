@extends('header2')
@section('contenido')
@section('subtitulo')
CLIENTES
@endsection
@php
use App\Models\Sucursal_empleado;
$vC = ['verCliente','modificarCliente','eliminarCliente','crearCliente','admin'];
$mC= ['modificarCliente','admin'];
$cC= ['crearCliente','admin'];
$eC= ['eliminarCliente','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificarC = $sE->hasAnyRole($mC);
$crearC = $sE->hasAnyRole($cC);
$eliminarC = $sE->hasAnyRole($eC);
$verC = $sE->hasAnyRole($vC);
@endphp
@section('opciones')
<!-- BOTON DEVOLUCION-->

<div class="ml-3 my-auto ">
    <a class="btn btn-outline-secondary ml-2 my-auto border-0 " href="{{ url('/puntoVenta/cliente')}}">
        <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>NUEVO CLIENTE</small></p>
    </a>
</div>
<div class="col-0  ml-3 p-1 ">
    <button type="button" class="btn btn-outline-secondary p-1 border-0" data-toggle="modal" href=".seguimientoPedidos" id="" onclick="return seguimientoPedidos()" value="">
        <img src="{{ asset('img\camion.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-dark"><small>SEGUIMIENTO PEDIDOS</small></p>
    </button>
</div>

<div class="col-6 ml-4"></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>

<!--div class="ml-3 my-auto ">
    <a class="btn btn-outline-secondary ml-3 my-auto border-0 " href="{ url('/puntoVenta/credito')}}">
        <img src="{ asset('img\deudor.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>DEUDORES</small></p>
    </a>
    </a>
</div-->
@endsection


<div class="row p-1">
    <div class="row border border-dark m-2 my-4 w-100">
        <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
            <div class="px-3 py-3 m-0">
                <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                <h4 class="row my-1 mx-1" style="color:#4388CC">ACTIVOS</h4>

                <div>
                    <input type="text" class=" form-control text-uppercase  my-1" placeholder="BUSCAR" id="texto">
                    <h6 class=" text-uppercase  my-1 text-secondary"> <small>SELECCIONA UNO PARA VER INFORMACION
                            ADICIONAL, EDITAR O ELIMINAR </small> </h6>
                    <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                </div>

            </div>
            <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                <div id="resultados" class="col btn-block h-100">
                </div>
            </div>
        </div>
        <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
            <!--#FFFBF2"-->
            <!--EDIT-->
            @if(isset($d))
            <div class="row px-3 py-3 m-0">
                <form class="w-100" method="post" action="{{url('/puntoVenta/cliente/'.$d->id)}}" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <label for="ndepartamento">
                            <h4 style="color:#4388CC"> EDITAR</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h4>{{$d->nombre}}</h4>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{$d->nombre}}" required>
                                    <label for="telefono" class="mt-2">
                                        TELEFONO
                                    </label>
                                    <input type="tel" class="form-control @error('nombre') is-invalid @enderror" placeholder="TEL 8-10 DIGITOS" name="telefono" id="telefono" value="{{$d->telefono}}" pattern="[0-9]{8,10}" required>

                                    <label for="telefono" class="mt-2">
                                        DOMICILIO
                                    </label>
                                    <textarea name="domicilio" id="domicilio" class="form-control @error('nombre') is-invalid @enderror" value="" required>{{$d->domicilio}}</textarea>
                                    <!--
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="domicilio" id="domicilio" value="{{$d->domicilio}}" required>
                                    -->
                                </div>
                            </div>
                            <div class="col-4">
                                @error('mensajeError')
                                <div class="alert alert-danger my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            @if($modificarC)
                            <button class="btn btn-outline-secondary  ml-1" type="submit" onclick="return confirm('¿DESEA EDITAR ESTE CLIENTE?');">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                            <a class="btn btn-outline-secondary  ml-3 " href="{{ url('/puntoVenta/cliente')}}">
                                <img src="{{ asset('img\darBaja.png') }}" alt="Editar" width="30px" height="30px">
                                CANCELAR
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                <!--
                    <form method="post" action="{{url('/puntoVenta/cliente/'.$d->id)}}">
                        {{csrf_field()}}
                        {{ method_field('DELETE')}}
                        <button class="btn btn-outline-danger my-3 ml-1" type="submit" onclick="return confirm('DESEA ELIMINAR ESTE CLIENTE?');">
                            <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                            DAR DE BAJA
                        </button>
                    </form>
                    -->
                @if($eliminarC)
                <button class="btn btn-outline-danger my-2" onclick="veriEliminar('{{$d->id}}')" type="button">
                    <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                    ELIMINAR
                </button>
                @endif
            </div>
            @else
            <div class="row px-3 py-3 m-0">
                <form class="w-100" method="post" action="{{url('/puntoVenta/cliente')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label for="nempleado">
                        <h4 style="color:#4388CC">CREAR CLIENTE
                            <img src="{{ asset('img\agregar.png') }}" alt="Editar" width="25px" height="25px">
                        </h4>
                    </label>
                    <br />
                    <label for="Nombre">
                        <h5>NUEVO</h5>
                    </label>
                    <div class="form-row w-100">
                        <div class="col-7">
                            <div class="form-group">
                                <label for="nombre">
                                    NOMBRE
                                </label>
                                <input type="text" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="NOMBRE COMPLETO" required>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="telefono">
                                    TELEFONO
                                </label>
                                <input type="tel" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" placeholder="TEL 8-10 DIGITOS" pattern="[0-9]{8,10}" required>
                                <label for="domicilio">
                                    DOMICILIO
                                </label>
                                <!--
                                <input type="text"
                                    class="text-uppercase  form-control @error('nombre') is-invalid @enderror"
                                    name="domicilio" id="domicilio" required>
                                    -->
                                <textarea name="domicilio" id="domicilio" class="form-control @error('nombre') is-invalid @enderror" placeholder="INGRESAR DOMICILIO COMPLETO" required></textarea>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            @error('mensajeConf')
                            <div class="alert alert-success my-auto" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                    </div>
                    @if($crearC)
                    <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿AGREGAR NUEVO CLIENTE?');">
                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                        AGREGAR
                    </button>
                    @else
                    <button class="btn btn-outline-secondary" type="button" onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')">
                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                        AGREGAR
                    </button>
                    @endif
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
<!--Seguimiento pedido modal de ventas-->
<div class="modal fade seguimientoPedidos" id="seguimientoPedidos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">SEGUIMIENTO DE PEDIDOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body">
                <div class=" col-4">
                    <div class="col-12 border border-dark mt-4 mb-4 ml-4 mr-2">
                        <div class="px-3 py-3 m-0">
                            <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                            <h4 class="row my-1 mx-1" style="color:#4388CC">ACTIVOS</h4>

                            <div>
                                <input type="text" class=" form-control text-uppercase  my-1" placeholder="BUSCAR" id="texto">
                                <h6 class=" text-uppercase  my-1 text-secondary"> <small>SELECCIONA UNO PARA VER
                                        INFORMACION
                                        ADICIONAL, EDITAR O ELIMINAR </small> </h6>
                                <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                            </div>

                        </div>
                        <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                            <div id="resultados" class="col btn-block h-100">
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-8">
                    <div id="seguimientoPaq" class="col-11 mt-4 input-group text-center mx-auto " style="background:#D5DBDB">
                        <button id="btnGenerarPed" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img\pedidoGenerado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO ACEPTADO</small></p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img\pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PREPARANDO PEDIDO</small></p>
                        </button>
                        <div class="h1 my-auto text-dark">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img\procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>EN PROCESO DE ENTREGA A DOMICILIO</small></p>
                        </button>
                        <div class="h1 my-auto text-dark">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img\entregado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>ENTREGADO</small></p>
                        </button>
                    </div>
                    <div class="row col-12 mx-auto mb-2">
                        <p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el estado del paquete </strong> </small></p>
                    </div>
                    <div class="row col-12" id="divActBtn"><button id="btnActEstado" onclick="return actEstado()" class="btn btn-success text-center mx-auto">PREPARAR PEDIDO </button> </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
            </div>
        </div>
    </div>
</div>

<script>
    let presionar = 0;
    const texto = document.querySelector('#texto');

    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`{{url('/puntoVenta/cliente/buscador')}}?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    };
    $("input[name='telefono']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });

    async function veriEliminar(id) {
        let conf_Eli = confirm('¿DESEA ELIMINAR ESTE CLIENTE?');
        if (conf_Eli) {
            let response = "Sin respuesta";
            try {
                response = await fetch(`{{url('/puntoVenta/cliente/destroy2')}}/${id}`);

                if (response.ok) {
                    let respuesta = await response.text();
                    if (respuesta.length == 1) {
                        //recargar la pag
                        alert("EL CLIENTE SE HA ELIMINADO");
                        location.href = "{{url('/puntoVenta/cliente')}}";
                    } else {
                        clienOcup = alert("ESTE CLIENTE ESTÁ ACTIVO EN EL SISTEMA Y NO SE PUEDE ELIMINAR");
                        // if (clienOcup) {
                        // location.href = `{url('/puntoVenta/cliente/baja/${id}')}}`;

                        // }
                    }
                }
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    };

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    texto.addEventListener('keyup', filtrar);
    filtrar();

    function seguimientoPedidos() {

    }

    function actEstado() {
        presionar = presionar + 1;
    }

    let estado = "aceptado";// recuperar estado de tabla venta_cliente
    function botones() {
        let btn1 = `
        <button  onclick="return actEstado1()" class="btn btn-success text-center mx-auto">PREPARAR PEDIDO </button>
        `;
        let btn2 = `
        <button  onclick="return actEstado2()" class="btn btn-success text-center mx-auto">PEDIDO EN CAMINO</button>
        `;
        let btn3 = `
        <button  onclick="return actEstado2()" class="btn btn-success text-center mx-auto">PEDIDO ENTREGADO</button>
        `;
        if (estado == "aceptado") {
            document.getElementById("divActBtn").innerHTML = btn1;
        }
        if (estado == "preparando") {
            document.getElementById("divActBtn").innerHTML = btn2;
        }
        if (estado == "encamino") {
            document.getElementById("divActBtn").innerHTML = btn3;
        }
        if (estado == "entregado") {
            document.getElementById("divActBtn").innerHTML = "";
        }

    }

    function estadosPaq() {

       // seguimientoPaq
    }
</script>
@endsection