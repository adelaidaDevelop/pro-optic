@extends('header2')
@section('contenido')
<div class="row" style="background:#ED4D46">

    @section('subtitulo')
    VENTAS
    @endsection
    @section('opciones')
    @php
    use App\Models\Sucursal_empleado;
    $userCliente= ['verCliente','crearCliente','modificarCliente','eliminarCliente','admin'];
    $userDevolucion= ['verDevolucion','crearDevolucion','admin'];
    $sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));

    @endphp
    <!-- BOTON DEVOLUCION-->
    @if($sE->hasAnyRole($userDevolucion))
    <div class="ml-4 p-1">
        <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/devolucion')}}">
            <img src="{{ asset('img\devolucion.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto mx-2 text-dark"><small>VENTAS DEL DIA Y DEVOLUCIONES</small></p>
        </a>
    </div>
    @endif
    @if($sE->hasAnyRole($userCliente))
    <div class=" ml-4 p-1">
        <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/cliente')}}">
            <img src="{{ asset('img\consumidor.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto mx-2 text-dark"><small>CLIENTES</small></p>
        </a>
    </div>
    @endif
    <div class="col-0  ml-3 p-1 ">
        <button type="button" class="btn btn-outline-secondary p-1 border-0" data-toggle="modal"
            href=".listaSolicitudVentas" id="btnSolic_Ventas" onclick="obtenerPedidosEntrega(0)" value="">
            <img src="{{ asset('img\ventas.png') }}" alt="Editar" width="30px" height="30px">
            <span id="notificacionPedidos" class="badge badge-warning">0</span>
            <p class="h6 my-auto mx-2 text-dark"><small>VENTAS ECOMMERCE</small></p>
        </button>
    </div>

    <div class="col-0  ml-3 p-1 ">
        <button type="button" class="btn btn-outline-secondary p-1 border-0" data-toggle="modal"
            href=".seguimientoPedidos" id="" onclick="return filtrar()" value="">
            <img src="{{ asset('img\camion.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto mx-2 text-dark"><small>SEGUIMIENTO PEDIDOS</small></p>
        </button>
    </div>
    @endsection
</div>
<!--div class="row p-1 "-->
<div class="row border border-dark my-1 mx-1">
    @php
    $var = 1;
    @endphp
    <div class="col-12 py-0">
        <div class=" col-12 row mx-0 my-3 px-0">
            <!--div class="col-9 m-0 px-0"-->
            <div class="input-group col-xl-6 my-2 mr-auto">
                <div class="input-group-prepend">
                    <label for="codigoBarras" class="h5 font-weight-bold my-auto py-auto d-none d-md-block"
                        style="color:#3366FF">
                        <!--h5 class="my-auto border border-primary">CODIGO DEL PRODUCTO</h5-->
                        CODIGO DEL PRODUCTO
                    </label>
                    <!--label for="codigoBarras" class="h4 font-weight-bold my-auto py-auto d-md-none" style="color:#3366FF">
                            <--h5 class="my-auto border border-primary">CODIGO DEL PRODUCTO</h5>
                            CODIGO DEL PRODUCTO
                        </label-->
                </div>
                <!--div class="col"-->
                <input type="text" class="form-control @error('codigoBarras') is-invalid @enderror my-auto mx-1"
                    name="codigoBarras" id="codigoBarras" value="{{ old('codigoBarras') }}"
                    placeholder="INGRESAR CODIGO DE BARRAS" required autocomplete="codigoBarras">
                @error('codigoBarras')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <!--/div-->
                <div class="input-group-append ">
                    <button class="btn btn-outline-primary my-auto" type="button" onclick="agregarPorCodigo()"
                        value="informacion" id="botonAgregar">
                        <!--img src="{{ asset('img\agregarReg.png') }}" class="img-fluid" alt="Editar" width="25px" height="25px"-->
                        AGREGAR
                    </button>
                </div>
            </div>

            <div class="my-auto mx-1 px-0">
                <button class="btn btn-outline-primary px-1 " type="button" onclick="buscarProducto()"
                    data-toggle="modal" data-target="#exampleModal" value="informacion" id="boton">
                    <img src="{{ asset('img\busqueda.png') }}" alt="Editar" width="25px" height="25px">
                    BUSCAR PRODUCTO
                </button>
            </div>
            <div class="my-auto mx-1 px-0">
                <button class="btn btn-outline-primary  px-1" type="button" onclick=" buscarSubproducto()"
                    data-toggle="modal" data-target="#exampleModal2" value="informacion" id="boton">
                    <img src="{{ asset('img\busqueda.png') }}" alt="Editar" width="25px" height="25px">
                    BUSCAR SUBPRODUCTO
                </button>
            </div>
            <div class="my-auto mx-1 px-0">
                <button class="btn btn-outline-primary  px-1" type="button" onclick="buscarOferta()" data-toggle="modal"
                    data-target="#ofertasModal" value="informacion" id="boton">
                    <img src="{{ asset('img\oferta.png') }}" alt="Editar" width="25px" height="25px">
                    OFERTAS
                </button>
            </div>

            <!--div>
                    <button class="btn btn-primary form-control" type="button" style="background-color:#3366FF"
                        onclick=" buscarSubproductos()" data-toggle="modal" data-target="#exampleModal2"
                        value="informacion" id="boton">
                        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                            height="25px">
                        BUSCAR SUBPRODUCTOS
                    </button>
                </div-->
            <!--/div-->
            <!--div class="col-3 m-0 px-0"-->


            <!--/div-->
        </div>
        <!--PRUE IMP DIRECTO>
            <div class="">
                <button class="btn btn-outline-primary p-1" type="button" onclick="impDirecto()" value="" id="botonImpDirecto">
                    <img src="{ asset('img\agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                    IMP DIRECTO
                </button>
            </div-->
        <!--div class="btn-toolbar" role="toolbar">
                <button class="btn btn-primary form-control" type="button" style="background-color:#3366FF"
                    onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion"
                    id="boton">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    BUSCAR PRODUCTO
                </button>
                <button class="btn btn-primary form-control" type="button" style="background-color:#3366FF"
                    onclick=" buscarSubproductos()" data-toggle="modal" data-target="#exampleModal2" value="informacion"
                    id="boton">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    BUSCAR SUBPRODUCTOS
                </button>
                <button class="btn btn-primary form-control" type="button" style="background-color:#3366FF"
                    onclick=" buscarSubproductos()" data-toggle="modal" data-target="#exampleModal2" value="informacion"
                    id="boton">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    OFERTAS
                </button>
            </div-->
        <!--
            <ul class="list-group list-group-horizontal pl-0 border-0">
                <li class="list-group-item ml-0 pl-0 border-0">
                    <button class="btn btn-outline-primary  p-1 " type="button" onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion" id="boton">
                        <img src="{{ asset('img\busqueda.png') }}" alt="Editar" width="30px" height="30px">
                        BUSCAR PRODUCTO
                    </button>
                </li>
                <li class="list-group-item border-0">
                    <button class="btn btn-outline-primary  p-1" type="button" onclick=" buscarSubproducto()" data-toggle="modal" data-target="#exampleModal2" value="informacion" id="boton">
                        <img src="{{ asset('img\busqueda.png') }}" alt="Editar" width="30px" height="30px">
                        BUSCAR SUBPRODUCTOS
                    </button>
                </li>
                <li class="list-group-item border-0">
                    <button class="btn btn-outline-primary  p-1" type="button" onclick="buscarOferta()" data-toggle="modal" data-target="#ofertasModal" value="informacion" id="boton">
                        <img src="{{ asset('img\oferta.png') }}" alt="Editar" width="25px" height="25px">
                        OFERTAS
                    </button>
                </li>
            </ul>
            -->
        <div class="row m-0 px-0 border border-dark" style="height:300px;overflow-y:auto;">
            <table class="table" id="productos">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">CODIGO_BARRAS</th>
                        <th scope="col">PRODUCTO</th>
                        <th scope="col">TIPO</th>
                        <th scope="col">EXISTENCIA</th>
                        <th scope="col">PRECIO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">IMPORTE</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="info" class="">
                </tbody>
            </table>
        </div>
        <div class="row m-0 px-0">
            <div class="col my-2 ml-5 px-1">
                <!--div class="row">
                        <form method="get" action="{url('/empleado')}}">
                            <button class="btn btn-outline-primary  p-1" type="submit">
                                <img src="{ asset('img\agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                                AGREGAR TICKET
                            </button>
                        </form>
                        <form method="get" action="{url('/empleado')}}">
                            <button class="btn btn-outline-primary  p-1 ml-5" type="submit">
                                <img src="{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                ELIMINAR TICKET
                            </button>
                        </form>
                    </div-->
            </div>
            <div class="col my-2 ml-5 mr-0 pr-0 ">
                <div class="d-flex flex-row-reverse">
                    <h4 class="border border-dark my-auto ml-2 p-2" id="total">$ 0.00</h4>
                    <!--form method="get" action="{url('/empleado')}}"-->
                    <!--{url('/departamento/'.$departamento->id.'/edit/')}}-->
                    <button class="btn btn-primary p-1" type="button" onclick="verificarVenta()" value="informacion"
                        id="boton">
                        <img src="{{ asset('img\dinero.png') }}" alt="Editar" width="30px" height="30px">
                        <strong>COBRAR</strong>
                    </button>
                    <!--/form-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalContenidoProducto">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">PRODUCTOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <h6 class="mx-2 my-0 text-secondary"> <small>BUSCAR PRODUCTO </small> </h6>
                    <input type="text" class="form-control mx-2 my-3"
                        placeholder="INGRESE EL NOMBRE DEL PRODUCTO A BUSCAR" id="busquedaProducto"
                        onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered text-center" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda">
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h6 class="text-primary col"> <small>CLIC SOBRE UN PRODUCTO PARA AGREGARLO </small> </h6>
                <div class="modal-footer ">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

                    <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalContenidoSubproducto">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">SUBPRODUCTOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h6 class="mx-2 my-0 text-secondary"> <small>INGRESE EL NOMBRE DEL SUBPRODUCTO A BUSCAR</small>
                    </h6>
                    <input type="text" class="form-control text-uppercase mx-2 my-3" placeholder="Buscar producto"
                        id="busquedaSubproducto" onkeyup="buscarSubproducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered text-center" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusquedaSubproducto">
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade listaSolicitudVentas" id="listaSolicitudVentas" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <div class="container-fluid ">
                    <div class="row" style="background:#3366FF">
                        <h5 class="font-weight-bold my-2  px-1 mx-auto " style="color:#FFFFFF">
                            NUEVAS SOLICITUDES DEL ECOMMERCE
                        </h5>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body">
                <div class="row col-4 mx-0">
                    <div class="col-12 border border-dark ml-4 mr-2 h-100">
                        <div class="row mx-auto px-3 py-3 m-0">
                            <h4 class="row my-1 mx-auto" style="color:#4388CC">SOLICITUDES</h4>
                            <div>

                                <h6 class=" text-uppercase  my-1 text-secondary"> <small>SELECCIONA UNO PARA VER
                                        INFORMACION
                                        DEL PEDIDO. </small> </h6>
                            </div>

                        </div>
                        <div class="row m-0 px-0 py-2 overflow-auto" style="height: 300px;">
                            <div id="resultadoPedidos" class="col btn-block">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-8 mx-0">
                    <div class="col-12  ">
                        <div class="row col-12 mx-auto border" style="background:#BDC2C5">
                            <div class="col-4 mx-0">
                                <p class="h5 text-center mx-auto my-0">Producto</p>
                            </div>
                            <div class="col-2 mx-0">
                                <p class="h5 text-center mx-auto my-0">Precio</p>
                            </div>
                            <div class="col-3 mx-0">
                                <p class="h5 text-center mx-auto my-0">Cantidad</p>
                            </div>
                            <div class="col-2 mx-0">
                                <p class="h5 text-center mx-auto my-0">Subtotal</p>
                            </div>
                            <div class="col-1 mx-0"></div>
                        </div>
                        <div id="detallePedido" class="row col-12 mx-auto border" style="height:300px;overflow-y:auto;">
                        </div>
                    </div>
                    <div class="row col-12 text-center mt-3 mb-1 mx-auto">
                        <div class="row col-12 h5 p-0 text-center mx-auto" style="background:#BDC2C5">
                            <p class="text-center mx-auto">Resumen de compra</p>
                        </div>
                        <div class="row col-12 mx-auto my-1 py-1 px-4 h6 border">
                            <p class="col-2"><strong>Subtotal:</strong>
                            <p id="subtotal"> </p>
                            </p>
                            <p class="col-3"><strong>Costo envío:</strong>
                            <p id="costoEnvio"> </p>
                            </p>
                            <p class="col-2"><strong>Total:</strong>
                            <p id="totalH"></p>
                            </p>
                        </div>
                        <div class="row col-12 mx-auto my-1 px-3 h6 py-1 border">
                            <p class="col-5"></p>
                            <p class="col-3"><strong>Pagar con:</strong>
                            <p id="pagarCon"></p>
                            </p>
                            <p class="col-2"><strong>Cambio:</strong>
                            <p id="cambio"></p>
                            </p>
                        </div>
                    </div>
                    <div class="row col-12 boder text-center mt-2 mx-auto">
                        <div class="row col-12 h5 p-0 text-center mx-auto" style="background:#BDC2C5">
                            <p class="text-center mx-auto">Datos de envio</p>
                        </div>

                        <div class="row col-12 mx-auto h6 border border-danger ">
                            <p class="col-9"><strong>Cliente:</strong>
                            <p id="cliente"> </p>
                            </p>
                            <!--div class="row col-9 border"><strong class="border w-100">Cliente: <p id="cliente"></p></strong></div-->
                            <div class="row col-3 text-center mx-auto border border-dark"><strong>Telefono: <p
                                        id="telefono"></p></strong></div>
                        </div>
                        <div class="row col-12 text-center h6 px-3 mx-auto border">
                            <p class="text-center mx-auto"> <strong> Direccion:</strong>
                            <p id="direccion"></p>
                            </p>
                        </div>
                    </div>
                    <!--
                    <div id="informacionCliente" class="col-12 border">
                    </div>
                    -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnAceptarPedido" class="btn btn-success">ACEPTAR PEDIDO</button>
                <button type="button" id="btnRechazarPedido" class="btn btn-danger">RECHAZAR PEDIDO</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
            </div>
        </div>
    </div>
</div>

<!--Seguimiento pedido modal de ventas-->
<div class="modal fade seguimientoPedidos" id="seguimientoPedidos" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <div class="container-fluid ">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2  px-1 mx-auto " style="color:#FFFFFF">
                            SEGUIMIENTO DE PEDIDOS ACTIVOS
                        </h6>
                    </div>
                    <div class="row p-2" style="background:#BDC2C5">
                    </div>
                </div>
                <!-- <h5 class="modal-title" id="exampleModalLabel">SEGUIMIENTO DE PEDIDOS</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body">
                <div class=" col-4 mx-auto">
                    <div class="col-12 border border-dark mb-1 mx-auto ml-4 mr-2">
                        <div class=" mx-auto">
                            <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->
                            <div class=" mt-2 py-0 mx-auto text-center">
                                <h4 class=" text-center " style="color:#4388CC">ACTIVOS</h4>
                            </div>
                            <div class=" mb-4 mx-auto  text-center ">
                                <!-- <input type="text" class=" form-control text-uppercase  my-1" placeholder="BUSCAR" id="texto">-->
                                <h6 class=" text-uppercase text-center my-1 text-secondary"> <small>SELECCIONA UNO PARA
                                        VER EL SEGUIMIENTO</small> </h6>
                                <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                            </div>
                        </div>
                        <div class="row my-2 m-0 px-0 " style="height:200px;overflow-y:auto;">
                            <div id="resultados" class="col btn-block h-100">
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-8 px-0">
                    <div id="seguimientoPaq" class="col-12 mt-4 input-group text-center mx-auto "
                        style="background:#D5DBDB">
                    </div>
                    <div id="estad" class="row col-12 mx-auto ">
                        <!--  <p class="col-auto  mx-auto text-dark h5"><small><strong> Estado actual: </strong> </small></p>-->
                    </div>
                    <div id="estadoDesc" class="row col-12 mx-auto mb-4 ">
                        <!--  <p class="col-auto  mx-auto text-dark h5 alert-success"><small><strong> Paquete entregado </strong> </small></p>-->
                    </div>
                    <div id="instruccion" class="row col-12 mx-auto mb-4">
                        <!--<p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>-->
                    </div>
                    <div class="row col-12  mx-auto" id="divActBtn">
                        <button id="paso1" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0"
                            type="submit" value="ACEPTADO" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="40px"
                                height="40px">
                            <p class="h6 my-auto mx-2 text-dark"> ACEPTADO</p>
                        </button>
                        <div id="rama1" class="3 h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="paso2" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0"
                            value="PREPARANDO" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">PREPARANDO</p>
                        </button>
                        <div id="rama2" class="h1 my-auto text-secondary">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button id="paso3" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0"
                            type="submit" value="ENCAMINO" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="40px"
                                height="40px">
                            <p class="h6 my-auto mx-2 text-dark">EN CAMINO</p>
                        </button>
                        <div id="rama3" class="h1 my-auto text-secondary">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button id="paso4" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0"
                            type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="40px"
                                height="40px">
                            <p class="h6 my-auto mx-2 text-dark">ENTREGADO</p>
                        </button>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ofertasModal" tabindex="-1" aria-labelledby="ofertasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modalContenidoOferta">
            <div class="modal-header">

                <h5 class="modal-title text-center" id="ofertasModalLabel">OFERTAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h6 class="mx-2 my-0 text-secondary"> <small>INGRESE EL NOMBRE DEL PRODUCTO A BUSCAR</small> </h6>
                    <input type="text" class="form-control text-uppercase mx-2 my-3" placeholder="Buscar producto"
                        id="busquedaOferta" onkeyup="buscarOferta()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered text-center" id="productos">
                        <thead class="thead-light text-center">
                            <tr class="">
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusquedaOferta">
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-labelledby="confirmarVentaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="confirmarVentaModalLabel">CONFIRMAR VENTA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>COBRAR</h1>
                        </div>
                        <div class="col-12">
                            <p class="text-center">TOTAL A COBRAR</p>
                        </div>
                        <div class="col-12">
                            <h1 class="text-center" id="totalCobrar">$ 0.00</h1>
                        </div>
                    </div>
                </div>
                <!--div class="col-12 d-flex justify-content-center">
                    <div class="row">
                        <div class="col">
                            <button class="btn mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;">
                                <--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <--img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"->
                        </div>
                        <div class="col">
                            <button class="btn mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;">
                                <--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"->
                            </button>
                            <h6 class="mx-auto">CREDITO</h6>
                            <--img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"->
                        </div>
                    </div>
                </div-->
                <div class="col-12">
                    <ul class="nav nav-pills mb-3  d-flex justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="modoPago('efectivo')" class="btn nav-link active mx-auto" type="button"
                                value="informacion" id="boton" style="background-image: url(/img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <!--a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true"><img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"><h6 class="mx-auto">EFECTIVO</h6></a-->
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="modoPago('credito')" class="btn nav-link mx-auto" type="button"
                                value="informacion" id="boton" style="background-image: url(/img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">CREDITO</h6>
                            <!--a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a-->
                        </li>
                        <!--li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                        </li-->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="col-6 mx-auto">
                                <div class="row my-1">
                                    <div class="col-5">
                                        <p class="h5">PAGÓ CON: </p>
                                    </div>
                                    <div class="col-7">
                                        <input type="number" class="form-control" data-decimals="2"
                                            oninput="calcularCambioEfectivo()" onchange="revisarPagoEfectivo()"
                                            id="pagoEfectivo" min=0.00 />
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-5">
                                        <p class="h5">SU CAMBIO: </p>
                                    </div>
                                    <div class="col-7">
                                        <p class="h5" id="cambioEfectivo">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="col-8 mx-auto">
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">CLIENTE: </p>
                                    </div>
                                    <div class="col-8">
                                        <select class="col form-control mr-3" name="clientes" id="clientes" required>
                                            <option value="">NO HAY CLIENTES</option>
                                        </select>
                                        <!--input type="text" class="form-control" /-->
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">ABONÓ CON:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="number" oninput="calcularDeudaCredito()" id="pagoCredito"
                                            data-decimals="2" value=0 class="form-control" />
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">AUN DEBE: </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="h5" id="deudaCredito">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">...</div-->
                    </div>
                </div>
                <div class="row col-6 mx-auto px-1 py-2 border border-primary">
                    <div class="col-4 my-auto">
                        <p class="h5">CLAVE</p>
                    </div>
                    <div class="col-8">
                        <input type="password" id="claveEmpleado" data-decimals="2" class="form-control" />
                    </div>
                </div>
            </div>
            <div id="pieModal" class="modal-footer">
                <button type="button" onclick="realizarVentaEfectivo(true)" class="btn btn-primary">COBRAR E IMPRIMIR
                    TICKET</button>
                <button type="button" onclick="realizarVentaEfectivo(false)" class="btn btn-primary">SOLO
                    COBRAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
let seguimientoPedidoActivo = "";
let productosVenta = [];
let idVentaGlobal = 0;
//let subproductosVenta = [];
//let productos = json($datosP);
let productosSucursal = []; //json($productosSucursal);
let departamentos = @json($departamentos);

//subproducto
let subproductosSucursal = []; //json($subproductos);
//ofertas
let ofertasSucursal = []; //json($ofertas);

async function cargarProductos(palabra) {
    let response = "Sin respuesta";
    try {
        response = await fetch(`{{url('/puntoVenta/producto')}}/${palabra}`);
        if (response.ok) {
            productos = await response.json();
            //console.log(productos);
            return productos;
            //console.log(response);

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
    //return response;
}
async function cargarProductosSucursal(palabra) {
    let response = "Sin respuesta";
    try {
        response = await fetch(`{{url('/puntoVenta/sucursalProducto')}}/${palabra}`); //{{session('sucursal')}}`);
        if (response.ok) {
            productosSucursal = await response.json();
            console.log('los productos para la sucursal son', productosSucursal);
            return productosSucursal;
        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
    //return response;
}
async function cargarSubproductosSucursal(palabra) {
    let response = "Sin respuesta";
    if (palabra.length == 0)
        palabra = "%";
    try {
        response = await fetch(`{{url('/puntoVenta/subproducto')}}/${palabra}`); //{{session('sucursal')}}`);
        if (response.ok) {
            subproductosSucursal = await response.json();
            console.log('subproductos', subproductosSucursal);
            //return;
            return subproductosSucursal;
            //console.log(response);

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
    //return response;
}
async function cargarOfertasSucursal(palabra) {
    if (palabra.length == 0)
        palabra = "%";
    let response = "Sin respuesta";
    try {
        response = await fetch(`{{url('/puntoVenta/oferta')}}/${palabra}`); //{{session('sucursal')}}`);
        if (response.ok) {
            ofertasSucursal = await response.json();

            console.log('los productos para las ofertas de la sucursal son', ofertasSucursal);
            return ofertasSucursal;
            //console.log(response);

        } else {
            console.log("No responden mis ofertas :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }

}

function agregarProductoAVenta(id, codigoBarras, nombre, existencia, precio, cantidad, tipo) {
    //console.log(id);
    let producto = {
        id: productosVenta.length + 1,
        idProducto: id,
        codigoBarras: codigoBarras,
        nombre: nombre,
        existencia: existencia,
        precio: precio,
        cantidad: cantidad,
        subtotal: precio,
        tipo: tipo
    };
    //if(tipo==0)
    productosVenta.push(producto);
    console.log('productosVenta', productosVenta);
};

let total = 0;

function calcularTotal() {
    total = 0.00;
    for (count0 in productosVenta) {
        total = parseFloat(total + productosVenta[count0].subtotal);

    }
    document.getElementById("total").innerHTML = "$ " + total.toFixed(2);
    document.getElementById("totalCobrar").textContent = "$ " + total.toFixed(2);

}

function mostrarProductos() {
    let cuerpo = "";
    let contador = 1;

    for (let count1 in productosVenta) {
        let tipo = `NORMAL`;
        /*let btnEliminar = `<button type="button" class="btn btn-secondary" onclick="quitarProducto(` + productosVenta[count1]
            .id + `)"><i class="bi bi-trash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></i></button>`;*/
        let btnEliminar = `<i class="btn btn-outline-danger border-0 p-0" onclick="quitarProducto(` + productosVenta[
                count1]
            .id + `)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></i>`;

        if (productosVenta[count1].tipo == 1)
            tipo = `SUBPRODUCTO`;
        if (productosVenta[count1].tipo == 2)
            tipo = `OFERTA`;
        cuerpo = cuerpo + `
        <tr class="text-center">
            <th scope="row">` + contador++ + `</th>
            <td>` + productosVenta[count1].codigoBarras + `</td>
            <td class="text-uppercase">` + productosVenta[count1].nombre + `</td>
            <td>` + tipo + `</td>
            <td>` + productosVenta[count1].existencia + `</td>
            <td>` + productosVenta[count1].precio + `</td>
            <td style="width:10rem"><input  value=` + productosVenta[count1].cantidad + ` 
                onchange="cantidad(` + productosVenta[count1].id + `)"  
                id="valor` + productosVenta[count1].id + `" min=1 max=` + productosVenta[count1].existencia +
            ` type="number"/></td>
            <td id="importe` + productosVenta[count1].id + `">` + productosVenta[count1].subtotal + `</td>
            <td>${btnEliminar}</td>
        </tr>
        `;
    }
    document.getElementById("info").innerHTML = cuerpo;
    var props = {
        decrementButton: "<strong>&minus;</strong>", // button text
        incrementButton: "<strong>&plus;</strong>", // ..
        groupClass: "", // css class of the resulting input-group
        buttonsClass: "btn-outline-secondary",
        buttonsWidth: "2rem",
        textAlign: "center", // alignment of the entered number
        autoDelay: 500, // ms threshold before auto value change
        autoInterval: 50, // speed of auto value change
        buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
        locale: navigator.language, // the locale, per default detected automatically from the browser
        template: // the template of the input
            '<div class="input-group ${groupClass}">' +
            '<div class="input-group-prepend"><button style="min-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus p-1" type="button">${decrementButton}</button></div>' +
            '<input type="text" name="number" inputmode="decimal" style="text-align: ${textAlign};width:20px;" class="form-control form-control-text-input"/>' +
            '<div class="input-group-append"><button style="min-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
            '</div>'
    }
    for (let i in productosVenta) {
        $("input[id='valor" + productosVenta[i].id + "']").inputSpinner(props);

    }
    $("input[name='number']").bind('keypress', function(tecla) {
        //if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });

    console.log(productosVenta);
    calcularTotal();
    //min="1" max="` + productosVenta[count].existencia+`"
};
//$("input[type='number']").inputSpinner();
function quitarProducto(id) {

    let confirmacion = confirm("¿QUITAR PRODUCTO DE LA VENTA?");
    if (confirmacion == true) {
        for (let i in productosVenta) {
            if (productosVenta[i].id === id)
                productosVenta.splice(i, 1);
        }
        mostrarProductos();
    }
    //var i = arr.indexOf( item );
    //if ( i !== -1 )  
}


function buscarProductoEnVenta(idProducto, tipo) {
    for (count2 in productosVenta) {
        if (productosVenta[count2].idProducto === idProducto && productosVenta[count2].tipo == tipo) {
            if (productosVenta[count2].existencia > productosVenta[count2].cantidad) {
                productosVenta[count2].cantidad++;
                productosVenta[count2].subtotal = productosVenta[count2].cantidad * productosVenta[count2].precio;
                mostrarProductos();
                const palabraBusqueda = document.querySelector('#busquedaProducto');
                palabraBusqueda.value = "";
                $('#exampleModal').modal('hide');
                $('#exampleModal2').modal('hide');
                $('#ofertasModal').modal('hide');
                //console.log(idProducto);
            }
            return true;
        }
    }
    //alert('no entra a la funcion :c');
    //console.log(idProducto +'fuera');
    return false;
};

async function agregarPorCodigo() {
    try {
        const codigo = document.querySelector('#codigoBarras');
        if (codigo.value.length == 0)
            return;
        //location.href= location.href+'?codigo='+codigo.value;
        //for (let x in productosSucursal) {
        //  for (count3 in productos) {
        //    if (productos[count3].id === productosSucursal[x].idProducto) {
        //      if (productos[count3].codigoBarras === codigo.value) {

        //agregarProductoAVenta(id,codigoBarras,nombre,existencia,precio,cantidad,subtotal)
        /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
        productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
        //    if (!buscarProductoEnVenta(productos[count3].id)) {
        //        if (productosSucursal[x].existencia > 0) {
        let response = await fetch(`{{url('/puntoVenta/sucursalProducto/buscarPorCodigo')}}/${codigo.value}`);
        let producto = await response.json();
        console.log(producto);
        if (producto != false) {
            //alert('Entra aqui');
            agregarProducto(producto.id, producto.codigoBarras, producto.nombre, 0, producto.existencia,
                producto.precio); //, productos[count3].codigoBarras, productos[count3]
            codigo.value = "";
            //return;
        } else
            alert('EL PRODUCTO NO EXISTE EN EL INVENTARIO');
        //    .nombre,
        //    productos[count3].existencia, productos[count3].precio, 1, productos[count3].precio);
        //            mostrarProductos();
        //        } else
        //            alert('PRODUCTO SIN EXISTENCIA');
        //    }
        //      }
        //    }
        //  }
        //}
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};

function agregarProducto(id, codigoBarras, nombre, tipo, existencia, precio) {
    //for (let x in productosSucursal) {
    //  for (let count4 in productos) {
    //    if (productos[count4].id === productosSucursal[x].idProducto) {
    //      if (productos[count4].id === id) {
    //return alert('No hay problema');
    if (!buscarProductoEnVenta(id, tipo)) {
        if (existencia > 0) {
            agregarProductoAVenta(id, codigoBarras,
                nombre,
                existencia, precio, 1, tipo);
            mostrarProductos();
            const palabraBusqueda = document.querySelector('#busquedaProducto');
            palabraBusqueda.value = "";
            $('#exampleModal').modal('hide');
            $('#exampleModal2').modal('hide');
            $('#ofertasModal').modal('hide');
        } else
            alert('PRODUCTO SIN EXISTENCIA');
        return;
    }
};

let worker = new Worker("{{ asset('js/workerConsultarProducto.js') }}"); // Ruta del archivo JS

async function buscarProducto() {
    if (window.Worker) {
        worker.terminate();
        let cuerpo = "";
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        if (palabraBusqueda.value.length == 0) {
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
            return;
        }
        const contenidoProducto = document.querySelector('#consultaBusqueda');
        const contenidoOriginal = contenidoProducto.innerHTML;
        contenidoProducto.innerHTML =
            `<tr>
            <td colspan="5"><div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO PRODUCTOS
                </button>
                </div>
                </td>
                </tr>
                `;
        worker = new Worker("{{ asset('js/workerConsultarProducto.js')}}");
        let url = `{{url('/puntoVenta/sucursalProducto')}}/${palabraBusqueda.value}`;
        var message = {
            url: url,
        };

        worker.postMessage(message);
        worker.onmessage = function(e) {
            productosSucursal = e.data.productos;
            contenidoProducto.innerHTML = contenidoOriginal;
            if (productosSucursal.length == 0) {
                cuerpo =
                    `<tr><td colspan="5" class="text-uppercase">No se encontró ningún producto con ese nombre</td></tr>`;
                document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                return;
            }
            for (let x in productosSucursal) {
                for (let d in departamentos) {
                    if (productosSucursal[x].idDepartamento === departamentos[d].id)
                        departamento = departamentos[d].nombre;
                }
                cuerpo = cuerpo + `<tr onclick="agregarProducto(` + productosSucursal[x].id +
                    `,'` + productosSucursal[x].codigoBarras + `','` + productosSucursal[x].nombre +
                    `',` + 0 + `,` + productosSucursal[x].existencia + `,` + productosSucursal[x].precio +
                    `)"><th scope="row">` + (parseInt(x) + 1) + `</th>
                            <td>` + productosSucursal[x].codigoBarras + `</td>
                            <td class="text-uppercase">` + productosSucursal[x].nombre + `</td>
                            <td>` + productosSucursal[x].existencia + `</td>
                            <td>` + departamento + `</td>
                        </tr>
                            `;
            }
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        };
    } else {
        try {
            const palabraBusqueda = document.querySelector('#busquedaProducto');
            let cuerpo = "";
            let contador = 1;
            let departamento = "";

            if (palabraBusqueda.value.length == 0) {
                document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                return;
            }

            //if (productosSucursal.length == 0) {

            const contenidoProducto = document.querySelector('#consultaBusqueda');
            const contenidoOriginal = contenidoProducto.innerHTML;
            contenidoProducto.innerHTML =
                `<tr>
            <td colspan="5"><div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO PRODUCTOS
                </button>
                </div>
                </td>
                </tr>
                `;
            //if (productos.length == 0)
            //    await cargarProductos();
            await cargarProductosSucursal(palabraBusqueda.value);
            contenidoProducto.innerHTML = contenidoOriginal;
            //}
            //console.log(productosSucursal);
            if (productosSucursal.length == 0) {
                cuerpo =
                    `<tr><td colspan="5" class="text-uppercase">No se encontró ningún producto con ese nombre</td></tr>`;
                document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                return;
            }
            for (let x in productosSucursal) {
                //for (let count5 in productos) {
                //if (productos[count5].id === productosSucursal[x].idProducto) {
                //  if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                for (let d in departamentos) {
                    if (productosSucursal[x].idDepartamento === departamentos[d].id)
                        departamento = departamentos[d].nombre;
                }
                cuerpo = cuerpo + `
                            <tr onclick="agregarProducto(` + productosSucursal[x].id + `,'` + productosSucursal[x]
                    .codigoBarras + `','` +
                    productosSucursal[x].nombre + `',` + 0 + `,` + productosSucursal[x].existencia +
                    `,` + productosSucursal[x].precio + `)">
                                <th scope="row">` + productosSucursal[x].id + `</th>
                                <td>` + productosSucursal[x].codigoBarras + `</td>
                                <td class="text-uppercase">` + productosSucursal[x].nombre + `</td>
                                <td>` + productosSucursal[x].existencia + `</td>
                                <td>` + departamento + `</td>
                            </tr>
                            `;
                // }
                //}
                //}

            }
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
            //console.log(cuerpo);
        } catch (err) {
            console.log("Error al realizar la petición de productos AJAX: " + err.message);
        }
    }
};

async function buscarSubproducto() {
    try {
        let cont = 0;
        let cuerpo = "";
        const palabraBusqueda = document.querySelector('#busquedaSubproducto');
        //if (subproductosSucursal.length == 0) {
        /*if (palabraBusqueda.value.length == 0) {
            document.getElementById("consultaBusquedaSubproducto").innerHTML = cuerpo;
            return;
        }*/
        const contenidoProducto = document.querySelector('#consultaBusquedaSubproducto');
        const contenidoOriginal = contenidoProducto.innerHTML;
        contenidoProducto.innerHTML =
            `<tr>
                <td colspan="5"><div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO SUBPRODUCTOS
                </button>
                </div>
                </td></tr>
                `;
        //if (productos.length == 0)
        //await cargarProductos();
        await cargarSubproductosSucursal(palabraBusqueda.value);
        //return;
        contenidoProducto.innerHTML = contenidoOriginal;
        //}
        if (subproductosSucursal.length == 0) {
            cuerpo =
                `<tr><td colspan="5" class="text-uppercase">No se encontró ningún subproducto con ese nombre</td></tr>`;
            document.getElementById("consultaBusquedaSubproducto").innerHTML = cuerpo;
            return;
        }
        for (let i in subproductosSucursal) {
            //let sucursalP = productosSucursal.find(p => p.id == subproductosSucursal[count].idSucursalProducto);
            //let producto = productos.find(p => p.id == sucursalP.idProducto);
            let departamento = departamentos.find(p => p.id == subproductosSucursal[i].idDepartamento);
            //if (producto.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
            cuerpo = cuerpo + `
                    <tr onclick="agregarProducto(${subproductosSucursal[i].id},'${subproductosSucursal[i].codigoBarras}',
                    '${subproductosSucursal[i].nombre}',` + 1 + `,` + subproductosSucursal[i].existencia +
                `,` + subproductosSucursal[i].precio + `)">
                    <td>` + subproductosSucursal[i].codigoBarras + `</td>
                    <td class="text-uppercase">` + subproductosSucursal[i].nombre + `</td>
                    <td>` + subproductosSucursal[i].existencia + `</td>
                    <td>` + departamento.nombre + `</td>  
                    </tr>
                    `;
            //}
        }
        document.getElementById("consultaBusquedaSubproducto").innerHTML = cuerpo;
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
};

async function buscarOferta() {
    try {
        const palabraBusqueda = document.querySelector('#busquedaOferta');
        let cuerpo = "";
        let contador = 1;
        let departamento = "";
        //if (ofertasSucursal.length == 0) {
        /*if (palabraBusqueda.value.length == 0) {
            document.getElementById("consultaBusquedaOferta").innerHTML = cuerpo;
            return;
        }*/
        const contenidoProducto = document.querySelector('#consultaBusquedaOferta');
        const contenidoOriginal = contenidoProducto.innerHTML;
        contenidoProducto.innerHTML =
            `<tr>
                <td colspan="5"><div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO OFERTAS
                </button>
                </div></td></tr>
                `;
        //if (productos.length == 0)

        //  await cargarProductos();
        await cargarOfertasSucursal(palabraBusqueda.value);
        console.log('ofertasSucursal', ofertasSucursal);

        contenidoProducto.innerHTML = contenidoOriginal;
        //}
        if (ofertasSucursal.length == 0) {
            cuerpo = `<tr><td colspan="5" class="text-uppercase">No hay ofertas</td></tr>`;
            document.getElementById("consultaBusquedaOferta").innerHTML = cuerpo;
            return;
        }
        for (let x in ofertasSucursal) {

            let departamento = departamentos.find(p => p.id == ofertasSucursal[x].idDepartamento);
            //if (producto.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
            cuerpo = cuerpo + `
                    <tr onclick="agregarProducto(` + ofertasSucursal[x].id + `,
                    '${ofertasSucursal[x].codigoBarras}','${ofertasSucursal[x].nombre}',` + 2 + `,` +
                ofertasSucursal[x].existencia + `,` + ofertasSucursal[x].precio + `)">
                    <td>` + ofertasSucursal[x].codigoBarras + `</td>
                    <td class="text-uppercase">` + ofertasSucursal[x].nombre + `</td>
                    <td>` + ofertasSucursal[x].existencia + `</td>
                    <td>` + departamento.nombre + `</td>
                    </tr>
                    `;
            //}

        }
        document.getElementById("consultaBusquedaOferta").innerHTML = cuerpo;
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

function cantidad(id) {
    //alert('Si entro en la funcion'+id);
    const valorProducto = document.querySelector('#valor' + id);
    if (parseInt(valorProducto.max) > parseInt(valorProducto.value))
        console.log(parseInt(valorProducto.max) - parseInt(valorProducto.value));
    //if (valorProducto.value >= valorProducto.min && valorProducto.value <= valorProducto.max) {

    for (count6 in productosVenta) {
        if (productosVenta[count6].id === id) {
            productosVenta[count6].cantidad = parseInt(valorProducto.value);
            productosVenta[count6].subtotal = productosVenta[count6].precio * productosVenta[count6].cantidad;
        }
    }
    mostrarProductos()
}
async function realizarVentaEfectivo(ticket) {
    try {

        let clave = document.querySelector('#claveEmpleado').value;
        let idSucursalEmpleado = "";
        if (!clave.length > 0) {
            return alert('POR FAVOR INGRESE UNA CLAVE PARA CONFIRMAR LA VENTA');
        }
        let respuesta = await fetch(`{{url('/puntoVenta/empleado/claveEmpleado')}}/${clave}`);
        let valido = await respuesta.text();

        if (respuesta.ok) {
            if (valido.length > 0) {
                idSucursalEmpleado = valido;
                //return alert('LA CLAVE INGRESADA ES VALIDA?'+valido);
            } else {
                return alert('LA CLAVE INGRESADA ES INVALIDA' + valido);
            }
        } else {
            return alert('HUBO UN ERROR');
        }

        let json = JSON.stringify(productosVenta);
        //return console.log('Todo bien',productosVenta);
        const pago = document.querySelector('#pagoEfectivo');
        if (pago.value.length === 0)
            return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
        if (parseFloat(pago.value) < parseFloat(total))
            return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
        let venta = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/venta')}}`,
            // los datos que voy a enviar para la relación
            data: {
                datos: json,
                estado: 'efectivo',
                idSucursalEmpleado: idSucursalEmpleado,
                pago: parseFloat(pago.value),
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            console.log("Llego hasta aqui y fallando");
            console.log('respuesta', respuesta); //JSON.stringify(respuesta));
        });

        console.log(venta);
        //return;
        if (ticket) {
            let url = `{{url('/puntoVenta/venta/${venta}?productos=')}}` + json;
            // window.open(url, "_blank");
            /////////
            //var newWin = window.open('width=100,height=100', '_parent');

            var newWin = window.open(url, '_blank');
            newWin.focus();
            newWin.document.open();
            newWin.document.close();
            setTimeout(function() {
                newWin.close();
            }, 1000);
            console.log('ticket impreso');
        }

        productosVenta = [];
        mostrarProductos();
        $('#confirmarVentaModal').modal('hide');
        $("input[id='pagoEfectivo']").val(0);
        productosSucursal = [];
        subproductosSucursal = [];
        ofertasSucursal = [];
        document.querySelector('#claveEmpleado').value = "";
        //console.log(p);
        //console.log(funcion);

    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function realizarVentaCredito() {
    let clave = document.querySelector('#claveEmpleado').value;
    let idSucursalEmpleado = "";
    if (!clave.length > 0) {
        return alert('POR FAVOR INGRESE UNA CLAVE PARA CONFIRMAR LA VENTA');
    }
    let respuesta = await fetch(`{{url('/puntoVenta/empleado/claveEmpleado')}}/${clave}`);
    let valido = await respuesta.text();
    if (respuesta.ok) {
        if (valido.length > 0) {
            idSucursalEmpleado = valido;
            //return alert('LA CLAVE INGRESADA ES VALIDA?');
        } else {
            return alert('LA CLAVE INGRESADA ES INVALIDA');
        }
    } else {
        return alert('HUBO UN ERROR');
    }


    const pago = document.querySelector('#pagoCredito');
    const cliente = document.querySelector('#clientes');
    if (cliente.value.length == 0)
        return alert("SELECCIONE UN CLIENTE POR FAVOR");
    console.log(parseFloat(pago.value));
    let json = JSON.stringify(productosVenta);
    if (pago.value.length === 0 || pago.value < 0)
        return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
    if (parseFloat(pago.value) >= parseFloat(total))
        return alert('SI EL PAGO ES MAYOR O IGUAL A LA COMPRA MEJOR USE EL PAGO CON EFECTIVO');
    try {
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/venta')}}`,
            // los datos que voy a enviar para la relación
            data: {
                datos: json,
                estado: 'credito',
                idSucursalEmpleado: idSucursalEmpleado,
                pago: parseFloat(pago.value),
                cliente: parseInt(cliente.value),
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            //  alert("perfectisimo");

            console.log(respuesta); //JSON.stringify(respuesta));

        });
        productosVenta = [];
        mostrarProductos();
        $('#confirmarVentaModal').modal('hide');
        $("input[id='pagoCredito']").val(0);
        productosSucursal = [];
        subproductosSucursal = [];
        ofertasSucursal = [];
        document.querySelector('#claveEmpleado').value = "";
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

function calcularCambioEfectivo() {

    const pago = document.querySelector('#pagoEfectivo');

    const cambio = document.querySelector('#cambioEfectivo');
    if (parseFloat(pago.value) >= total) {
        //alert('si entra');
        let diferencia = parseFloat(pago.value) - parseFloat(total);
        console.log(parseFloat(pago.value));
        console.log(parseFloat(total));
        cambio.innerHTML = "$ " + '<strong>' + diferencia + '</strong>';
        //cambio.textContent ="$" + '<strong>'+diferencia+'</strong>';
        //cambio.value = parseFloat(pago.value)-total;
    } else {
        cambio.textContent = "$ -.--";
    }

}

function calcularDeudaCredito() {

    const pago = document.querySelector('#pagoCredito');

    const deuda = document.querySelector('#deudaCredito');
    if (parseFloat(pago.value) >= 0) {
        //alert('si entra');
        let diferencia = parseFloat(total) - parseFloat(pago.value);
        console.log(parseFloat(pago.value));
        console.log(parseFloat(total));
        deuda.innerHTML = "$ " + '<strong>' + diferencia + '</strong>';
        //cambio.textContent ="$" + '<strong>'+diferencia+'</strong>';
        //cambio.value = parseFloat(pago.value)-total;
    } else {
        deuda.textContent = "$ -.--";
    }

}


function revisarPagoEfectivo() {
    const pago = document.querySelector('#pagoEfectivo');
    console.log(pago.value.length);
    //if(pago.value.length===0)
    //  $("input[id='pagoEfectivo']").val(total);
}
//IMP DIRECTO
async function impDirecto() {
    let response = "Sin respuesta";
    try {
        let contenidoT = "";
        response = await fetch(`{{url('/puntoVenta/impDirecto')}}`);
        let resp = await response.text(); //json();
        console.log('respuesta: ', resp);
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
    //return response;
}

function verificarVenta() {
    if (productosVenta.length === 0) {
        alert('NO TIENE NINGUN PRODUCTO AGREGADO');
    } else {
        $("input[id='pagoEfectivo']").val(total);
        console.log(parseFloat(total));
        calcularCambioEfectivo();
        calcularDeudaCredito();
        $('#confirmarVentaModal').modal('show');
    }

}

function modoPago(tipoPago) {
    const pieModal = document.querySelector('#pieModal');
    let cuerpo = "";
    if (tipoPago === 'efectivo') {
        cuerpo = `
        <button type="button" onclick="realizarVentaEfectivo(true)" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button>
        <button type="button" onclick="realizarVentaEfectivo(false)" class="btn btn-primary">SOLO COBRAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
    `;
        calcularCambioEfectivo();

    }
    if (tipoPago === 'credito') {
        cuerpo = `
        <!--button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button-->
        <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">SOLO COBRAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
    `;
        let clientes = document.querySelector('#clientes');;
        let opcionesCliente = "";
        let cliente = @json($clientes);
        if (cliente.length > 0) {
            for (let i in cliente) {
                opcionesCliente = opcionesCliente +
                    `
                <option value=` + cliente[i].id + `>` + cliente[i].nombre + `</option>
            `
            }
            clientes.innerHTML = opcionesCliente;
        }
        calcularDeudaCredito();
    }
    pieModal.innerHTML = cuerpo;

}
</script>
<!--script src="{ asset('js\mayusculas.js') }}"></script-->
<script>
let pedidosContraEntrega = @json($pedidosContraEntrega);
let detallePedidos = @json($detallePedidos);
let estado = "ACEPTADO";
document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;

function obtenerPedidosEntrega(idPedido) {

    let clientes = @json($clientes);
    let contador = 0;
    let cuerpo = "";
    for (let i in pedidosContraEntrega) {
        let idCliente = pedidosContraEntrega[i].idCliente;
        let cliente = clientes.find(p => p.id == idCliente);
        let direccion = pedidosContraEntrega[i].direccion;
        //console.log('direccion', direccion);

        if (idPedido == 0 && parseInt(i) == 0) {
            cuerpo = cuerpo +
                `<button id="btnPedidoEntrega${pedidosContraEntrega[i].id}"  class="btn btn-block btn-outline-primary text-white active"
            onclick="verPedidoEntrega(${pedidosContraEntrega[i].id},${idCliente})">Pedido: ${parseInt(i)+1} - Cliente: ${cliente.nombre} - Folio: ${pedidosContraEntrega[i].id}</button>`;
        } else {
            if (pedidosContraEntrega[i].id == idPedido) {
                contador = parseInt(i);
                cuerpo = cuerpo +
                    `<button id="btnPedidoEntrega${pedidosContraEntrega[i].id}"  class="btn btn-block btn-outline-primary text-white active"
                onclick="verPedidoEntrega(${pedidosContraEntrega[i].id},${idCliente})">Pedido: ${parseInt(i)+1} - Cliente: ${cliente.nombre} - Folio: ${pedidosContraEntrega[i].id}</button>`;

            } else {
                cuerpo = cuerpo +
                    `<button id="btnPedidoEntrega${pedidosContraEntrega[i].id}" class="btn btn-block btn-outline-primary text-dark"
                onclick="verPedidoEntrega(${pedidosContraEntrega[i].id},${idCliente})">Pedido: ${parseInt(i)+1} - Cliente: ${cliente.nombre} - Folio: ${pedidosContraEntrega[i].id}</button>`;

            }

        }
    }

    document.getElementById("resultadoPedidos").innerHTML = cuerpo;
    if (pedidosContraEntrega[contador] != undefined) {
        let idC = pedidosContraEntrega[contador].idCliente;
        let direccion = pedidosContraEntrega[contador].direccion;
        verPedidoEntrega(pedidosContraEntrega[contador].id, idC); //, pedidosContraEntrega[0].direccion);
    }
    if (pedidosContraEntrega.length > 0) {
        //console.log('Hay');
        $('#btnAceptarPedido').removeClass('d-none');
        $('#btnRechazarPedido').removeClass('d-none');
    } else {
        $('#btnAceptarPedido').addClass('d-none');
        $('#btnRechazarPedido').addClass('d-none');
        //console.log('No hay');
    }

}

function verPedidoEntrega(id, idCliente) {
    let direccion = pedidosContraEntrega.find(p => p.id == id).direccion;
    let clientes = @json($clientes);
    let cliente = clientes.find(p => p.id == idCliente);
    let productos = @json($productos);

    let cuerpo = "";
    let detallePedido = detallePedidos.filter(p => p.idPedido == id);
    //let productos = productosCompra.filter(p => p.id == id);
    console.log('detallePedido', detallePedido);
    var props = {
        decrementButton: "<strong>&minus;</strong>", // button text
        incrementButton: `<strong>&plus;</strong>`, // ..
        groupClass: "my-auto", // css class of the resulting input-group
        buttonsClass: "btn-outline-secondary",
        buttonsWidth: "2rem",
        textAlign: "center", // alignment of the entered number
        autoDelay: 500, // ms threshold before auto value change
        autoInterval: 50, // speed of auto value change
        buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
        keyboardStepping: true, // set this to `false` to disallow the use of the up and down arrow keys to step
        locale: navigator.language, // the locale, per default detected automatically from the browser
        //editor: I18nEditor, // the editor (parsing and rendering of the input)
        template: // the template of the input
            '<div class="input-group ${groupClass}">' +
            '<div class="input-group-prepend"><button style="width: ${buttonsWidth};" class="btn btn-decrement ${buttonsClass} btn-minus px-0 text-center" type="button">${decrementButton}</button></div>' +
            '<input type="text" inputmode="decimal" style="text-align: ${textAlign}" class="form-control form-control-text-input px-0 mx-0"/>' +
            '<div class="input-group-append"><button style="width: ${buttonsWidth};" class="btn btn-increment ${buttonsClass} btn-plus px-0 text-center" type="button">${incrementButton}</button></div>' +
            '</div>'
    }

    for (let i in pedidosContraEntrega) {
        if (pedidosContraEntrega[i].id == id)
            $(`#btnPedidoEntrega${pedidosContraEntrega[i].id}`).addClass("active");
        else
            $(`#btnPedidoEntrega${pedidosContraEntrega[i].id}`).removeClass("active");
    }
    for (let i in detallePedido) {
        let p = productos.find(p => p.id == detallePedido[i].idProducto);
        let btnQuitar =
            `<div class="row col-1 mx-0 ">
            <button class="btn btn-outline-danger my-auto mx-auto mx-md-0 p-0 d-none d-md-block border-0" 
            onclick="quitarProductoPedido(${detallePedido[i].idPedido},${detallePedido[i].idProducto})">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-trash my-auto" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
            </button>
        </div>`;
        if (detallePedido.length == 1)
            btnQuitar = `<div class="row col-1 mx-0"></div>`;
        cuerpo = cuerpo +
            `<div id="producto${detallePedido[i].idProducto}" class="row col-12 mx-0 my-1 px-0 border border-light" onmouseover="seleccionProducto(${detallePedido[i].idProducto},true)"
            onmouseout="seleccionProducto(${detallePedido[i].idProducto},false)">
            <div class="row col-4 mx-0 my-1 ">
                    <p class=" text-center mx-auto my-auto">${p.nombre}</p>
                </div>
                <div class="row col-2 mx-0">
                    <p class=" text-center mx-auto my-auto">$ ${detallePedido[i].precio}</p>
                </div>
                <div class="row col-3 mx-0 px-0">
                    <!--p class="h5 text-center mx-auto my-auto">${detallePedido[i].cantidad}</p-->
                    <input type="number" class="form-control my-auto border" min="1" value="${detallePedido[i].cantidad}" 
                    onchange="actualizarCantidadPedidoProducto(${detallePedido[i].idPedido},${detallePedido[i].idProducto})" 
                    id="cantidadProductoPedido${detallePedido[i].idPedido}${detallePedido[i].idProducto}" />
                </div>
                <div class="row col-2 mx-0">
                    <p class=" text-center mx-auto my-auto">$ ${detallePedido[i].subtotal}</p>
                </div>
                ${btnQuitar}
            </div>`;
    }

    document.getElementById("detallePedido").innerHTML = cuerpo;
    for (let i in detallePedido) {
        $(`input[id='cantidadProductoPedido${detallePedido[i].idPedido}${detallePedido[i].idProducto}']`).inputSpinner(
            props);
    }
    $('#btnAceptarPedido').val(id);
    $('#btnRechazarPedido').val(id);
    let infoPedido = pedidosContraEntrega.find(p => p.id == id);
    //Asignar valor
    document.getElementById("direccion").innerHTML = direccion;
    document.getElementById("telefono").innerHTML = cliente.telefono;
    document.getElementById("cliente").innerHTML =
        ` ${cliente.nombre} ${cliente.apellidoPaterno} ${cliente.apellidoMaterno}`;
    document.getElementById("subtotal").innerHTML = infoPedido.subtotal;
    document.getElementById("costoEnvio").innerHTML = infoPedido.costoEnvio;
    document.getElementById("totalH").innerHTML = infoPedido.total;
    document.getElementById("pagarCon").innerHTML = infoPedido.pagarCon;
    document.getElementById("cambio").innerHTML = infoPedido.cambio;

}

function seleccionProducto(idProducto, bandera) {
    //return alert('Seleccionado');
    //console.log('bandera',bandera);
    //console.log('idProducto',idProducto);
    if (bandera) {

        $(`#producto${idProducto}`).addClass("border-dark");
        $(`#producto${idProducto}`).removeClass("border-light");
    } else {
        //console.log('entra en estacondicion');
        $(`#producto${idProducto}`).addClass("border-light");
        $(`#producto${idProducto}`).removeClass("border-dark");
    }

}
/*$('#btnAceptarPedido').bind('click', async function() {
    try {
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{url('/puntoVenta/aceptarPedido')}}/${this.value}`,
            // los datos que voy a enviar para la relación
            data: {
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        console.log('respuestaAceptar', funcion);

        if (funcion == 1) {
            return alert(
                'Algunos de los productos no tienen la existencia disponible para pasar a la venta');
        }
        pedidosContraEntrega = funcion['pedidos'];
        detallePedidos = funcion['detallePedidos'];
        obtenerPedidosEntrega();
        document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;

    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
});*/
$('#btnAceptarPedido').bind('click', async function() {
    try {
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/aceptarPedido')}}/${this.value}`,
            // los datos que voy a enviar para la relación
            data: {
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        console.log('respuestaAceptar', funcion);

        if (funcion == 1) {
            return alert(
                'Algunos de los productos no tienen la existencia disponible para pasar a la venta');
        }
        console.log('respuestaRechazo', funcion);
        pedidosContraEntrega = funcion['pedidos'];
        detallePedidos = funcion['detallePedidos'];
        obtenerPedidosEntrega();
        document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
});
$('#btnRechazarPedido').bind('click', async function() {
    try {
        let confirmacion = confirm('¿Rechazar este pedido?');
        if (!confirmacion)
            return;
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/rechazarPedido')}}/${this.value}`,
            // los datos que voy a enviar para la relación
            data: {
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        console.log('respuestaRechazo', funcion);
        pedidosContraEntrega = funcion['pedidos'];
        detallePedidos = funcion['detallePedidos'];
        obtenerPedidosEntrega();
        document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;

        //if(funcion == 1)
        //  alert('El pedido se ha eliminado');

    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
});
setInterval(async function() {
    try {
        let activo = @json(Auth::check());
        console.log('activo', activo);
        if (!activo)
            return location.href = "{{url('/puntoVenta/login')}}";
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/pedidosTiempoReal')}}`,
            // los datos que voy a enviar para la relación
            data: {
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        //console.log('respuestaTiempoReal', funcion['pedidos'].length);
        //return console.log('pedidosContraEntrega', pedidosContraEntrega.length);
        if (pedidosContraEntrega.length != funcion['pedidos'].length) {

            pedidosContraEntrega = funcion['pedidos'];
            detallePedidos = funcion['detallePedidos'];
            obtenerPedidosEntrega();
            document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;
        }
        //if(funcion == 1)
        //  alert('El pedido se ha eliminado');

    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
}, 5000);

function botones() {
    console.log("Entro a botones");
    //OPCIONES A ACTUALIZAR
    // ACTUALIZAR HISTORIAL SEGUIMIENTO
    if (estado == "ACEPTADO") {
        console.log("entro a aceptado");
        aceptadoFuncion();
    }
    if (estado == "PREPARANDO") {
        preparandoFuncion();
    }
    if (estado == "ENCAMINO") {
        enCaminoFuncion();
    }
    if (estado == "ENTREGADO") {
        entregadoFuncion();
    }
    if (estado == "SINLOCALIZAR") {
        sinLocalizarFuncion();
    }
    if (estado == "CANCELADO") {
        canceladoFuncion();
    }
}

function aceptadoFuncion() {
    console.log("esta actuslizando vista estado actual aceptado");
    let btn1 = `
        <button id="btnPrepararPedido" class="btn btn-success text-center mx-auto">PREPARAR PEDIDO </button>
        `;
    // SEGUIMIENTO1
    let seguimiento1 = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark"> ACEPTADO</p>
                        </button>
                        <div class="3 h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">PREPARANDO</p>
                        </button>
                        <div class="h1 my-auto text-secondary">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">EN CAMINO</p>
                        </button>
                        <div class="h1 my-auto text-secondary">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">ENTREGADO</p>
                        </button>
        `;
    //DESCRIPCION DE ESTADOS
    let ins = `<p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>`;
    //   let estado = "PREPARANDO";
    let estadoAceptado = `
        <p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Pedido aceptado </strong> </small></p>
        `;
    document.getElementById("divActBtn").innerHTML = btn1;
    document.getElementById("seguimientoPaq").innerHTML = seguimiento1;
    document.getElementById("estadoDesc").innerHTML = estadoAceptado;
    document.getElementById("instruccion").innerHTML = ins;
    //Asignar evento a los botones
    $("#btnPrepararPedido").click(function() {
        actualizarEstadoBD(idVentaGlobal, 'PREPARANDO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "PREPARANDO";
        estado = "PREPARANDO";
        botones();
        //  revisar desde aqui
        //Llamar funcionPreparando
        //preparandoFuncion();
        //Actualizar estado de la tabla venta_clientes
        //  actualizarEstadoBD(idV, estado);


    });
};


function preparandoFuncion() {
    console.log("Actualizando vista estado acutal ");
    let btn2 = `
        <button  id="btnPedidoEnCamino" class="btn btn-success text-center mx-auto">PEDIDO EN CAMINO</button>
        `;
    // SEGUIMIENTO2
    let seguimiento2 = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark"> ACEPTADO</p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">PREPARANDO </p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">EN CAMINO</p>
                        </button>
                        <div class="h1 my-auto text-secondary">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="40px" height="40px">
                            <p class="h6 my-auto mx-2 text-dark">ENTREGADO</p>
                        </button>
        `;
    //DESCRIPCION DE ESTADOS
    //
    let ins = `<p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>`;
    let estadoPreparando = `
        <p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Preparando pedido </strong> </small></p>
        `;
    //Actualizar contenido modal
    document.getElementById("divActBtn").innerHTML = btn2;
    document.getElementById("seguimientoPaq").innerHTML = seguimiento2;
    document.getElementById("estadoDesc").innerHTML = estadoPreparando;
    document.getElementById("instruccion").innerHTML = ins;
    //Asignar evento a los botones
    $("#btnPedidoEnCamino").click(function() {
        //Llamar funcionPreparando
        actualizarEstadoBD(idVentaGlobal, 'ENCAMINO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "ENCAMINO";
        estado = "ENCAMINO";
        botones();
        //enCaminoFuncion();

        //Actualizar estado de la tabla venta_clientes
    });
    //aCTUALIZAR ESTADO A PREPARANDO EN BD

};

function enCaminoFuncion() {
    let btn4 = `
        <div class=" mx-auto">
        <button class="btn btn-success " id="btnEntregado" >ENTREGADO </button>
        <button class="btn btn-warning mx-4" id="btnSinLocalizar" > CLIENTE NO LOCALIZADO</button>
        <button class=" btn btn-danger " id="btnCancelar" > CANCELAR PEDIDO</button>
        </div>
        `;
    /*
    let btn3 = `
    <button  id="btnDarEntregado" class="btn btn-success text-center mx-auto">PEDIDO ENTREGADO</button>
    `;
    */
    // SEGUIMIENTO3
    let seguimiento3 = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"> ACEPTADO</p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">PREPARANDO </p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">EN CAMINO</p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">ENTREGADO</p>
                        </button>
        `;
    //DESCRIPCION DE ESTADOS
    //estado = "ENCAMINO";
    let ins = `<p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>`;
    let estadoEnCamino = `
        <p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Pedido en camino para su entrega </strong> </small></p>
        `;

    //Actualizar contenido modal
    document.getElementById("divActBtn").innerHTML = btn4;
    document.getElementById("seguimientoPaq").innerHTML = seguimiento3;
    document.getElementById("estadoDesc").innerHTML = estadoEnCamino;
    document.getElementById("instruccion").innerHTML = ins;
    //Asignar evento a boton Entregado
    $("#btnEntregado").click(function() {
        //Llamar funcionPreparando
        actualizarEstadoBD(idVentaGlobal, 'ENTREGADO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "ENTREGADO";
        estado = "ENTREGADO";
        botones();
        //entregadoFuncion();
        //Actualizar estado de la tabla venta_clientes
    });
    //Asignar evento a boton Cliente no Localizado
    $("#btnSinLocalizar").click(function() {
        //Llamar funcionPreparando
        //sinLocalizarFuncion();
        actualizarEstadoBD(idVentaGlobal, 'SINLOCALIZAR');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "SINLOCALIZAR";
        estado = "SINLOCALIZAR";
        botones();
        //Actualizar estado de la tabla venta_clientes
    });
    //Asignar evento a boton cancelar pedido
    $("#btnCancelar").click(function() {
        //Llamar funcionPreparando
        //canceladoFuncion();
        actualizarEstadoBD(idVentaGlobal, 'CANCELADO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "CANCELADO";
        estado = "CANCELADO";
        botones();
        //Actualizar estado de la tabla venta_clientes
    });
    // actualizarEstadoBD(idVentaGlobal, estado);
}

function entregadoFuncion() {
    // SEGUIMIENTO4
    let seguimiento4 = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">PEDIDO ACEPTADO</p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">PREPARANDO </p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">EN CAMINO></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark">ENTREGADO</p>
                        </button>
        `;
    //DESCRIPCION DE ESTADOS
    //  estado = "ENTREGADO"
    let estadoEntregado = `
        <p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Pedido entregado </strong> </small></p>
        `;
    //Actualizar contenido modal
    document.getElementById("divActBtn").innerHTML = "";
    document.getElementById("seguimientoPaq").innerHTML = seguimiento4;
    document.getElementById("estadoDesc").innerHTML = estadoEntregado;
    document.getElementById("instruccion").innerHTML = "";

    // actualizarEstadoBD(idVentaGlobal, estado);

}

function sinLocalizarFuncion() {
    let btn5 = `
        <div class=" mx-auto">
       <!-- <button class="btn btn-warning " id="btnEnCamino2" >SEGUNDO INTENTO DE ENTREGA</button>-->
        <button class="btn btn-success mx-4" id="btnEntregarSucursal"> ENTREGAR EN SUCURSAL</button>
        <button class=" btn btn-danger " id="btnCancelar2" > CANCELAR PEDIDO</button>
        </div>
        `;
    //SEGUIMIENTO: SIN LOCALIZAR
    let segui_sin_localizar = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO ACEPTADO</small></p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PREPARANDO PEDIDO</small></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>EN PROCESO DE ENTREGA A DOMICILIO</small></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-warning col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>ENTREGADO</small></p>
                        </button>
        `;
    //DESCRIPCION DE ESTADOS
    // estado = "SINLOCALIZAR";
    let ins = `<p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>`;
    let estadoSinLocalizar = `
        <p class="col-auto  mx-auto text-dark h5 mt-2 bg-warning"><small><strong> El cliente no fue localizado para la entrega </strong> </small></p>
        `;
    //Actualizar contenido modal
    document.getElementById("divActBtn").innerHTML = btn5;
    document.getElementById("seguimientoPaq").innerHTML = segui_sin_localizar;
    document.getElementById("estadoDesc").innerHTML = estadoSinLocalizar;
    document.getElementById("instruccion").innerHTML = ins;
    //Asignar evento a boton segundo intento de entrega
    /*
    $("#btnEnCamino2").click(function() {
       // actualizarEstadoBD(idVentaGlobal, 'ENCAMINO');
       // seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "ENCAMINO";
       // estado = "ENCAMINO";
       // botones();
        enCamino2Funcion();
        //Llamar funcionPreparando
        //  canceladoFuncion();
        //Actualizar estado de la tabla venta_clientes
    });
    */
    $("#btnEntregarSucursal").click(function() {
        actualizarEstadoBD(idVentaGlobal, 'ENTREGADO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "ENTREGADO";
        estado = "ENTREGADO";
        botones();
        //enCamino2Funcion();
        //Llamar funcionPreparando
        //  canceladoFuncion();
        //Actualizar estado de la tabla venta_clientes
    });
    $("#btnCancelar2").click(function() {
        actualizarEstadoBD(idVentaGlobal, 'CANCELADO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "CANCELADO";
        estado = "CANCELADO";
        botones();
        //enCamino2Funcion();
        //Llamar funcionPreparando
        //  canceladoFuncion();
        //Actualizar estado de la tabla venta_clientes
    });

}
let workerAjax = new Worker("{{ asset('js/workerAjax.js') }}");
async function actualizarCantidadPedidoProducto(idPedido, idProducto) {
    let cantidad = document.getElementById(`cantidadProductoPedido${idPedido}${idProducto}`).value;

    /*if (window.Worker) {
        //src="{{ asset('js\bootstrap-input-spinner.js') }}"
        //var message = {mensaje:"Hola Worker"};
        workerAjax.terminate();
        workerAjax = new Worker("{{ asset('js/workerAjax.js') }}");
        var message = {
            idPedido: idPedido,
            idProducto: idProducto,
            cantidad: cantidad,
            url:`{{url('/puntoVenta/actualizarCantidadPedidoProducto')}}`,
            _token: "{{ csrf_token() }}"
        };

        workerAjax.postMessage(message);
        workerAjax.onmessage = function(e) {

            let funcion = e.data.respuesta;
            
            console.log('respuestaActualizar', funcion);
            return;
            pedidosContraEntrega = funcion['pedidos'];
            detallePedidos = funcion['detallePedidos'];
            obtenerPedidosEntrega(idPedido);
            document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;

        };
        //worker.terminate();
    } else {*/
    try {
        //$(`cantidadProductoPedido${idPedido}${idProducto}`).readonly 
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/actualizarCantidadPedidoProducto')}}`,
            // los datos que voy a enviar para la relación
            data: {
                idPedido: idPedido,
                idProducto: idProducto,
                cantidad: cantidad,
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        console.log('respuestaQuitar', funcion);
        pedidosContraEntrega = funcion['pedidos'];
        detallePedidos = funcion['detallePedidos'];
        obtenerPedidosEntrega(idPedido);
        document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;

        //if(funcion == 1)
        //  alert('El pedido se ha eliminado');

    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
    //}
}
async function quitarProductoPedido(idPedido, idProducto) {
    try {
        let confirmacion = confirm('¿Quitar producto de este pedido?');
        if (!confirmacion)
            return;
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/quitarProductoPedido')}}`,
            // los datos que voy a enviar para la relación
            data: {
                idPedido: idPedido,
                idProducto: idProducto,
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        console.log('respuestaQuitar', funcion);
        pedidosContraEntrega = funcion['pedidos'];
        detallePedidos = funcion['detallePedidos'];
        obtenerPedidosEntrega(idPedido);
        document.getElementById("notificacionPedidos").textContent = pedidosContraEntrega.length;

        //if(funcion == 1)
        //  alert('El pedido se ha eliminado');

    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
}
/*setInterval(async function() {
    try {
        let funcion = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/pedidosTiempoReal')}}`,
            // los datos que voy a enviar para la relación
            data: {
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        });
        //Asignar evento a boton entregar pedido en sucursal
        $("#btnEntregarSucursal").click(function() {
            //Llamar funcionPreparando
            entregarEnSuc();
            //Actualizar estado de la tabla venta_clientes
        });
        //Asignar evento a boton cancelar pedido
        $("#btnCancelar2").click(function() {
            //Llamar funcionPreparando
            actualizarEstadoBD(idVentaGlobal, 'CANCELADO');
            seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "CANCELADO";
            estado = "CANCELADO";
            botones();
            // canceladoFuncion();
            //Actualizar estado de la tabla venta_clientes
        });
        //iNSERTAR ESTADO ACCT EN LA BD SINLOCALIZAR
        // actualizarEstadoBD(idVentaGlobal, estado);
    }*/

function canceladoFuncion() {
    //SEGUIMIENTO CANCELADO
    let segui_cancelado = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO ACEPTADO</small></p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PREPARANDO PEDIDO</small></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>EN PROCESO DE ENTREGA A DOMICILIO</small></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-danger col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>ENTREGADO</small></p>
                        </button>
        `;
    //DESCRIPCION DE ESTADOS
    // estado = "CANCELADO";
    let estadoCancelado = `
        <p class="col-auto  mx-auto text-dark h5 mt-2 alert-danger"><small><strong> El pedido a sido cancelado y no fue entregado</strong> </small></p>
        `;
    //Actualizar contenido modal
    // document.getElementById("divActBtn").innerHTML = btn4;
    document.getElementById("divActBtn").innerHTML = "";
    document.getElementById("instruccion").innerHTML = "";
    document.getElementById("seguimientoPaq").innerHTML = segui_cancelado;
    document.getElementById("estadoDesc").innerHTML = estadoCancelado;
    //iNSERTAR ESTADO ACCT EN LA BD CANCELADO
}

function enCamino2Funcion() {
    // SEGUIMIENTO3
    let seguimiento3 = `
                        <button  class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO ACEPTADO</small></p>
                        </button>
                        <div class=" h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO DOS -->
                        <button id="btnDos" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>PREPARANDO PEDIDO</small></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO TRES-->
                        <button class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>EN PROCESO DE ENTREGA A DOMICILIO</small></p>
                        </button>
                        <div class="h1 my-auto text-success">
                            <p>.....</p>
                        </div>
                        <!--PASO CUATRO-->
                        <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
                            <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
                            <p class="h6 my-auto mx-2 text-dark"><small>ENTREGADO</small></p>
                        </button>
        `;
    // estado = "ENCAMINO";
    let estadoX = `
        <p class="col-auto  mx-auto text-dark h5 alert-danger"><small><strong> El pedido está en proceso de entrega a domicilio por segunda vez </strong> </small></p>
        `;
    let btnX = `
        <div class=" mx-auto">
        <button class="btn btn-success mx-4" id="btnEntregar4" > ENTREGADO</button>
        <button class=" btn btn-danger " id="btnCancelar4" > CANCELAR PEDIDO</button>
        </div>
        `;
    let ins = `<p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>`;
    document.getElementById("seguimientoPaq").innerHTML = seguimiento3;
    document.getElementById("estadoDesc").innerHTML = estadoX;
    document.getElementById("divActBtn").innerHTML = btnX;
    document.getElementById("divActBtn").innerHTML = btnX;
    document.getElementById("instruccion").innerHTML = ins;
    //Asignar evento a boton entregar pedido 
    $("#btnEntregar4").click(function() {
        //Llamar funcionPreparando
        //entregadoFuncion();
        actualizarEstadoBD(idVentaGlobal, 'ENTREGADO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "ENTREGADO";
        estado = "ENTREGADO";
        botones();

        //Actualizar estado de la tabla venta_clientes
    });

    //Asignar evento a boton entregar pedido 
    $("#btnCancelar4").click(function() {
        //Llamar funcionPreparando
        //  canceladoFuncion();
        actualizarEstadoBD(idVentaGlobal, 'CANCELADO');
        seguimientoPedidoActivo.find(p => p.idVenta == idVentaGlobal).estado = "CANCELADO";
        estado = "CANCELADO";
        botones();


        //Actualizar estado de la tabla venta_clientes
    });
    //iNSERTAR ESTADO ACCT EN LA BD ENCAMINO
    //actualizarEstadoBD(idVentaGlobal, estado);
}

function entregarEnSuc() {
    entregadoFuncion();
    /*
            let estadoX = `
            <p class="col-auto  mx-auto text-dark h5 alert-danger"><small><strong> El pedido se a entregado en la sucursal </strong> </small></p>
            `;
            document.getElementById("estadoDesc").innerHTML = estadoX;
    */
}


async function actualizarEstadoBD(idVenta, estado) {
    try {
        //  let json = JSON.stringify(productosVenta);
        //return console.log('Todo bien',productosVenta);
        // const pago = document.querySelector('#pagoEfectivo');
        let venta = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `{{url('/puntoVenta/actEstadoPed')}}`,
            // los datos que voy a enviar para la relación
            data: {
                idV: idVenta,
                estado: estado,
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {});
        console.log(venta);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};

async function filtrar() {
    try {
        document.getElementById("resultados").innerHTML = "";
        await fetch(`{{url('/puntoVenta/seguimientoPedidosActivos')}}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            });
        await getPedidos();
        for (let i in seguimientoPedidoActivo) {

            console.log('lo recorre');
            $(`#btnVentaPedido${seguimientoPedidoActivo[i].idVenta}`).bind('click',
                function() {
                    //  document.getElementById("estad").innerHTML="";
                    //  document.getElementById("instruccion").innerHTML="";
                    estado = seguimientoPedidoActivo[i].estado;
                    idVentaGlobal = seguimientoPedidoActivo[i].idVenta;
                    botones();
                    console.log('seleccionpedido', seguimientoPedidoActivo[i].estado);
                    for (let x in seguimientoPedidoActivo) {
                        if (seguimientoPedidoActivo[x].idVenta == idVentaGlobal) {
                            $(`#btnVentaPedido${seguimientoPedidoActivo[x].idVenta}`).addClass('active');
                        } else {
                            $(`#btnVentaPedido${seguimientoPedidoActivo[x].idVenta}`).removeClass('active');
                        }
                    }
                });

        }
        if (seguimientoPedidoActivo.length > 0) {
            estado = seguimientoPedidoActivo[0].estado;
            idVentaGlobal = seguimientoPedidoActivo[0].idVenta;
            botones();
        }



    } catch (err) {

    }
};

async function getPedidos() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`{{url('/puntoVenta/ventaPedidos')}}`);
        if (response.ok) {
            seguimientoPedidoActivo = await response.json();

        } else {

            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};

/*
function asignarEstado() {
    let estado = ventaCliente.estado;
    for (let i = 1; i <= 4; i++) {
        $(`#paso${i}`).addClass('btn-secondary');
        $(`#paso${i}`).removeClass('btn-success');
        $(`#paso${i}`).removeClass('btn-danger');
        $(`#paso${i}`).removeClass('btn-warning');
        $(`#paso${i}`).removeClass('btn-outline-secondary'); //ade
        $(`#rama${i}`).removeClass('text-success');
    }
    //return;
    console.log('Si entra');
    for (let i = 1; i <= 3; i++) {
        let btnEstado = document.getElementById(`paso${i}`).value;
        $(`#paso${i}`).addClass('btn-success');
        $(`#rama${i}`).addClass('text-success');
        console.log('btnEstado', btnEstado);
        console.log('Estado', estado);
        if(i==1){
             document.getElementById("estadoDesc").innerHTML =
             `<p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Pedido aceptado </strong> </small></p>`;
        }

        if (btnEstado == estado)
            return;
    }
    if (estado == 'ENTREGADO') {
        $(`#paso4`).addClass('btn-success');
        document.getElementById("estadoDesc").innerHTML =
             `<p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> El pedido a sido entregado </strong> </small></p>`;
        return;
    }
    if (estado == 'CANCELADO') {
        document.getElementById("estadoDesc").innerHTML =
             `<p class="col-auto  mx-auto text-danger h5 mt-2 "><small><strong> El pedido a sido cancelado. </strong> </small></p>`;
        $(`#paso4`).addClass('btn-danger');
        return;
    }
    if (estado == 'SINLOCALIZAR') {
        document.getElementById("estadoDesc").innerHTML =
             `<p class="col-auto  mx-auto text-dark h5 mt-2 bg-warning"><small><strong> El pedido no pudo ser entregado. Usted puede solicitar un último intento o pasar a sucursal a recogerlo en un máximo de 24 hrs.</strong> </small></p>`;
        $(`#paso4`).addClass('btn-warning');
        return;
    }
    return -1;
}
asignarEstado();
*/
// Get the input field
var input = document.getElementById("codigoBarras");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
    // Number 13 is the "Enter" key on the keyboard
    if (event.keyCode === 13) {
        agregarPorCodigo();
        // Cancel the default action, if needed
        //event.preventDefault();
        // Trigger the button element with a click
        //document.getElementById("myBtn").click();
    }
});
</script>
@endsection