@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        VENTAS
        @endsection
        @section('opciones')
        <!-- BOTON DEVOLUCION-->
        <div class="ml-4">
            <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/devolucion')}}">
                <img src="{{ asset('img\devolucion.png') }}" alt="Editar" width="32px" height="32px">
                <p class="h6 my-auto mx-2 text-dark"><small>DEVOLUCION</small></p>
            </a>
        </div>
        <div class=" ml-4">
            <a  class="btn btn-outline-secondary  p-1 border-0" href="/puntoVenta/cliente">
                <img src="{{ asset('img\consumidor.png') }}" alt="Editar" width="30px" height="30px">
                <p class="h6 my-auto mx-2 text-dark"><small>CLIENTES</small></p>
            </a>
        </div>

        @endsection
    </div>
    <!--div class="row p-1 "-->
    <div class="row border border-dark m-2 w-100">
        @php
        $var = 1;
        @endphp
        <div class="col-12">
            <div class=" col row mx-0 mt-2 mb-1 px-0">
                <!--div class="col-9 m-0 px-0"-->
                <div class="form-group row col my-1 mx-0 px-0">
                    <!--div class="col"-->
                    <label for="nombre" class=" font-weight-bold my-auto pt-1" style="color:#3366FF">
                        <h4>CODIGO DEL PRODUCTO</h4>
                    </label>
                    <!--/div-->
                    <div class="col-5">
                        <input type="text" class="form-control  mx-auto @error('codigoBarras') is-invalid @enderror" name="codigoBarras" id="codigoBarras" value="{{ old('codigoBarras') }}" placeholder="Ingresar codigo de barras" required autocomplete="codigoBarras" autofocus>
                        @error('codigoBarras')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="">
                        <button class="btn btn-outline-primary  p-1" type="button" onclick="agregarPorCodigo()" value="informacion" id="botonAgregar">
                            <img src="{{ asset('img\agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                            AGREGAR
                        </button>
                    </div>
                </div>

                <div class="mx-2">
                    <button class="btn btn-outline-primary  p-1 " type="button" onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion" id="boton">
                        <img src="{{ asset('img\busqueda.png') }}" alt="Editar" width="30px" height="30px">
                        BUSCAR PRODUCTO
                    </button>
                </div>
                <div class="mx-1">
                    <button class="btn btn-outline-primary  p-1" type="button" onclick=" buscarSubproducto()" data-toggle="modal" data-target="#exampleModal2" value="informacion" id="boton">
                        <img src="{{ asset('img\busqueda.png') }}" alt="Editar" width="30px" height="30px">
                        BUSCAR SUBPRODUCTOS
                    </button>
                </div>
                <div>
                    <button class="btn btn-outline-primary  p-1" type="button" onclick="buscarOferta()" data-toggle="modal" data-target="#ofertasModal" value="informacion" id="boton">
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
                <table class="table table-hover table-bordered" id="productos">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">CODIGO_BARRAS</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">OBSERVACION</th>
                            <th scope="col">EXISTENCIA</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">IMPORTE</th>
                        </tr>
                    </thead>
                    <tbody id="info">
                    </tbody>
                </table>
            </div>
            <div class="row m-0 px-0">
                <div class="col my-2 ml-5 px-1">
                    <div class="row">
                        <form method="get" action="{{url('/empleado')}}">
                            <button class="btn btn-outline-primary  p-1" type="submit">
                                <img src="{{ asset('img\agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                                AGREGAR TICKET
                            </button>
                        </form>
                        <form method="get" action="{{url('/empleado')}}">
                            <button class="btn btn-outline-primary  p-1 ml-5" type="submit">
                                <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                ELIMINAR TICKET
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col my-2 ml-5 mr-0 pr-0 ">
                    <div class="d-flex flex-row-reverse">
                        <h4 class="border border-dark ml-2 p-1" id="total">$ 0.00</h4>
                        <!--form method="get" action="{url('/empleado')}}"-->
                        <!--{url('/departamento/'.$departamento->id.'/edit/')}}-->
                        <button class="btn btn-primary  p-1" type="button" onclick="verificarVenta()" value="informacion" id="boton">
                            <img src="{{ asset('img\dinero.png') }}" alt="Editar" width="30px" height="30px">
                            COBRAR
                        </button>
                        <!--/form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
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
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <!--button type="button" class="btn btn-primary">Agregar Producto</button-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">SUBPRODUCTOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="busquedaProducto2" onkeyup="buscarSubproducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusquedaSubp">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ofertasModal" tabindex="-1" aria-labelledby="ofertasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title text-center" id="ofertasModalLabel">OFERTAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="busquedaOferta" onkeyup="buscarOferta()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
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
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-labelledby="confirmarVentaModalLabel" aria-hidden="true">
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
                            <button onclick="modoPago('efectivo')" class="btn nav-link active mx-auto" type="button" value="informacion" id="boton" style="background-image: url(/img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <!--a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true"><img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"><h6 class="mx-auto">EFECTIVO</h6></a-->
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="modoPago('credito')" class="btn nav-link mx-auto" type="button" value="informacion" id="boton" style="background-image: url(/img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
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
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="col-6 mx-auto">
                                <div class="row my-1">
                                    <div class="col-5">
                                        <p class="h5">PAGÓ CON: </p>
                                    </div>
                                    <div class="col-7">
                                        <input type="number" class="form-control" data-decimals="2" oninput="calcularCambioEfectivo()" onchange="revisarPagoEfectivo()" id="pagoEfectivo" min=0.00 />
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
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="col-8 mx-auto">
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">CLIENTE: </p>
                                    </div>
                                    <div class="col-8">
                                        <select class="col form-control mr-3" name="clientes" id="clientes" required>
                                            <option value="0">NO HAY CLIENTES</option>
                                        </select>
                                        <!--input type="text" class="form-control" /-->
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">ABONÓ CON:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="number" oninput="calcularDeudaCredito()" id="pagoCredito" data-decimals="2" value=0 class="form-control" />
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
                        <input type="number" id="claveEmpleado" data-decimals="2" class="form-control" />
                    </div>
                </div>
            </div>
            <div id="pieModal" class="modal-footer">
                <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">COBRAR E IMPRIMIR
                    TICKET</button>
                <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">SOLO COBRAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
    let productosVenta = [];
    let subproductosVenta = [];
    let productos = @json($datosP);
    let productosSucursal = @json($productosSucursal);
    let departamentos = @json($departamentos);

    //subproducto
    let subproductosSucursal = @json($subproductos);
    //ofertas
    let ofertasSucursal = [];

    /*for(let i in ofertasSucursal)
    {
                    productosSucursal.find(p => p.id == ofertasSucursal[i].idSucursalProducto).existencia = 
                    productosSucursal.find(p => p.id == ofertasSucursal[i].idSucursalProducto).existencia - ofertasSucursal[i].existencia;
                }*/

    async function cargarProductos() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/producto/productos`);
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
    async function cargarProductosSucursal() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/sucursalProducto/{{session('sucursal')}}`);
            if (response.ok) {
                productosSucursal = await response.json();
                /*if(ofertasSucursal.length==0)
                    await cargarOfertasSucursal();
                for(let i in ofertasSucursal)
                {
                    productosSucursal.find(p => p.id == ofertasSucursal[i].idSucursalProducto).existencia = 
                    productosSucursal.find(p => p.id == ofertasSucursal[i].idSucursalProducto).existencia - ofertasSucursal[i].existencia;
                }*/
                console.log('los productos para la sucursal son', productosSucursal);

                return productosSucursal;
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
    //cargarProductosSucursal();
    async function cargarSubproductosSucursal() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/subproducto/{{session('sucursal')}}`);
            if (response.ok) {
                subproductosSucursal = await response.json();
                console.log('los productos para la sucursal son', subproductosSucursal);
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
    cargarSubproductosSucursal();
    async function cargarOfertasSucursal() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/oferta/{{session('sucursal')}}`);
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
    cargarOfertasSucursal();

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
        /*if(tipo==1)
        subproductosVenta.push(producto);
        if(tipo==2)
        ofertasVenta.push(producto);*/
        //console.log(productosVenta);
    };
    /*function agregarSubproductoAVenta(id, codigoBarras, nombre, existencia, precio, cantidad, subtotal) {
        //console.log(id);
        let subproducto = {
            id: id,
            codigoBarras: codigoBarras,
            nombre: nombre,
            existencia: existencia,
            precio: precio,
            cantidad: cantidad,
            subtotal: subtotal
        };
        subproductosVenta.push(subproducto);
        console.log(subproductosVenta);
    };
    function agregarSubproductoAVenta(id, codigoBarras, nombre, existencia, precio, cantidad, subtotal) {
        //console.log(id);
        let subproducto = {
            id: id,
            codigoBarras: codigoBarras,
            nombre: nombre,
            existencia: existencia,
            precio: precio,
            cantidad: cantidad,
            subtotal: subtotal
        };
        subproductosVenta.push(subproducto);
        console.log(subproductosVenta);
    };*/
    let total = 0;

    function calcularTotal() {
        total = 0.00;
        for (count0 in productosVenta) {
            total = parseFloat(total + productosVenta[count0].subtotal);

        }
        document.getElementById("total").innerHTML = "$ " + total;
        document.getElementById("totalCobrar").textContent = "$ " + total;

    }

    function mostrarProductos() {
        let cuerpo = "";
        let contador = 1;

        for (let count1 in productosVenta) {
            let tipo = `<strong>SIN OBSERVACION</strong>`;
            if (productosVenta[count1].tipo == 1)
                tipo = `<strong>SUBPRODUCTO</strong>`;
            if (productosVenta[count1].tipo == 2)
                tipo = `<strong>OFERTA</strong>`;
            cuerpo = cuerpo + `
        <tr class="text-center">
            <th scope="row">` + contador++ + `</th>
            <td>` + productosVenta[count1].codigoBarras + `</td>
            <td>` + productosVenta[count1].nombre + `</td>
            <td>` + tipo + `</td>
            <td>` + productosVenta[count1].existencia + `</td>
            <td>` + productosVenta[count1].precio + `</td>
            <td><input  value=` + productosVenta[count1].cantidad + ` 
                onchange="cantidad(` + productosVenta[count1].id + `)"  
                id="valor` + productosVenta[count1].id + `" min=1 max=` + productosVenta[count1].existencia +
                ` type="number"/></td>
            <td id="importe` + productosVenta[count1].id + `">` + productosVenta[count1].subtotal + `</td>
            <td><button type="button" class="btn btn-secondary" onclick="quitarProducto(` + productosVenta[count1]
                .id + `)"><i class="bi bi-trash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></i></button>
            </td>
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
                '<input type="text" inputmode="decimal" style="text-align: ${textAlign};width:20px;" class="form-control form-control-text-input"/>' +
                '<div class="input-group-append"><button style="min-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
                '</div>'
        }
        for (let i in productosVenta) {
            $("input[id='valor" + productosVenta[i].id + "']").inputSpinner(props);
        }
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
                    //console.log(idProducto);
                }
                return true;
            }
        }
        //alert('no entra a la funcion :c');
        //console.log(idProducto +'fuera');
        return false;
    };

    function agregarPorCodigo() {
        const codigo = document.querySelector('#codigoBarras');
        //location.href= location.href+'?codigo='+codigo.value;
        for (let x in productosSucursal) {
            for (count3 in productos) {
                if (productos[count3].id === productosSucursal[x].idProducto) {
                    if (productos[count3].codigoBarras === codigo.value) {

                        //agregarProductoAVenta(id,codigoBarras,nombre,existencia,precio,cantidad,subtotal)
                        /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
                        productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
                        //    if (!buscarProductoEnVenta(productos[count3].id)) {
                        //        if (productosSucursal[x].existencia > 0) {
                        agregarProducto(productos[count3].id, 0, productosSucursal[x].existencia, productosSucursal[x]
                            .precio); //, productos[count3].codigoBarras, productos[count3]
                        return;
                        //    .nombre,
                        //    productos[count3].existencia, productos[count3].precio, 1, productos[count3].precio);
                        //            mostrarProductos();
                        //        } else
                        //            alert('PRODUCTO SIN EXISTENCIA');
                        //    }
                    }
                }

            }
        }

        codigo.value = "";


    };

    function agregarProducto(id, tipo, existencia, precio) {
        for (let x in productosSucursal) {
            for (let count4 in productos) {
                if (productos[count4].id === productosSucursal[x].idProducto) {
                    if (productos[count4].id === id) {
                        if (!buscarProductoEnVenta(productos[count4].id, tipo)) {
                            if (existencia > 0) {
                                agregarProductoAVenta(productos[count4].id, productos[count4].codigoBarras,
                                    productos[count4].nombre,
                                    existencia, precio, 1, tipo);
                                mostrarProductos();
                            } else
                                alert('PRODUCTO SIN EXISTENCIA');
                        }
                    }
                }
            }
        }
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        palabraBusqueda.value = "";
        //venta();
    };
    /*function agregarSubproducto(id) {
        for (let x in subproductosSucursal) {
            for (let count4 in productos) {
                if (productos[count4].id === productosSucursal[x].idProducto) {
                    if (productos[count4].id === id) {
                        if (!buscarProductoEnVenta(productos[count4].id)) {
                            if (productosSucursal[x].existencia > 0) {
                                agregarProductoAVenta(productos[count4].id, productos[count4].codigoBarras,
                                    productos[count4].nombre,
                                    productosSucursal[x].existencia, productosSucursal[x].precio, 1, productosSucursal[
                                        x].precio,0);
                                mostrarProductos();
                            } else
                                alert('PRODUCTO SIN EXISTENCIA');
                        }
                    }
                }
            }
        }
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        palabraBusqueda.value = "";
        //venta();
    };*/


    function buscarProducto() {

        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        let contador = 1;
        let departamento = "";
        for (let x in productosSucursal) {
            for (let count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {
                    if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                        for (let d in departamentos) {
                            if (productos[count5].idDepartamento === departamentos[d].id)
                                departamento = departamentos[d].nombre;
                        }
                        cuerpo = cuerpo + `
                            <tr onclick="agregarProducto(` + productos[count5].id + `,` + 0 + `,` + productosSucursal[
                                x].existencia +
                            `,` + productosSucursal[x].precio + `)" data-dismiss="modal">
                                <th scope="row">` + productos[count5].id + `</th>
                                <td>` + productos[count5].codigoBarras + `</td>
                                <td>` + productos[count5].nombre + `</td>
                                <td>` + productosSucursal[x].existencia + `</td>
                                <td>` + departamento + `</td>
                            </tr>
                            `;
                    }
                }
            }

        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;

    };

    function buscarSubproducto() {
        let cont = 0;
        let cuerpo = "";
        for (let count in subproductosSucursal) {
            let sucursalP = productosSucursal.find(p => p.id == subproductosSucursal[count].idSucursalProducto);
            let producto = productos.find(p => p.id == sucursalP.idProducto);
            let departamento = departamentos.find(p => p.id == producto.idDepartamento);
            cuerpo = cuerpo + `
            <tr onclick="agregarProducto(` + producto.id + `,` + 1 + `,` + subproductosSucursal[count].existencia +
                `,` + subproductosSucursal[count].precio + `)" data-dismiss="modal">
                <td>` + producto.codigoBarras + `</td>
                <td>` + producto.nombre + `</td>
                <td>` + subproductosSucursal[count].existencia + `</td>
                <td>` + departamento.nombre + `</td>  
            </tr>
            `;
            /*for (count2 in sucursal_prod) {
                if (subproductos[count].idSucursalProducto == sucursal_prod[count2].id) {
                    let idProd = sucursal_prod[count2].idProducto;
                    let nombre = "";
                    let cBarras = "";
                    let depto = "";
                    for (let x in productos) {
                        if (productos[x].id == idProd) {
                            nombre = productos[x].nombre;
                            cBarras = productos[x].codigoBarras;
                            // idProd =productos[x].id;
                            for (let d in departamentos) {
                                if (productos[x].idDepartamento === departamentos[d].id)
                                    depto = departamentos[d].nombre;
                            }
                        }
                    }

                    cont = cont + 1;
                    cuerpo = cuerpo + `
                            <tr onclick="agregarProducto(` + idProd + `)" data-dismiss="modal">
                            <th >` + idProd + `</th>
                            <th >` + cBarras + `</th>
                            <td>` + nombre + `</td>
                            <td>` + subproducto[count].existencia + `</td>
                            <td>` + depto + `</td>  
                        </tr>
                        `;
                }
            }*/
        }
        document.getElementById("consultaBusquedaSubp").innerHTML = cuerpo;

    };


    function cantidad(id) {
        //alert('Si entro en la funcion'+id);
        const valorProducto = document.querySelector('#valor' + id);
        //alert(valorProducto.value);
        /*console.log(valorProducto.value);
        console.log(valorProducto.min);
        console.log(valorProducto.max);
        */
        //console.log(valorProducto.max - valorProducto.value);
        //if(valorProducto.value >= valorProducto.min)
        //  console.log(valorProducto.value - valorProducto.min);
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

        //}
        //const importeProducto = document.querySelector('#importe'+id);
    }

    /*async function confirmarClave()
    {

    }*/

    async function realizarVentaEfectivo() {
        try {

            let clave = document.querySelector('#claveEmpleado').value;
            let idSucursalEmpleado = "";
            if (!clave.length > 0) {
                return alert('POR FAVOR INGRESE UNA CLAVE PARA CONFIRMAR LA VENTA');
            }
            let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
            let valido = await respuesta.text();
            if (respuesta.ok) {
                if (valido.length > 0) {
                    idSucursalEmpleado = valido;
                    //return alert('LA CLAVE INGRESADA ES VALIDA?'+valido);
                } else {
                    return alert('LA CLAVE INGRESADA ES INVALIDA' + valido);
                }
            }
            else{
                return alert('HUBO UN ERROR');
            }
            let json = JSON.stringify(productosVenta);
            const pago = document.querySelector('#pagoEfectivo');
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: '/puntoVenta/venta',
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

                console.log(respuesta); //JSON.stringify(respuesta));
            });
            console.log(funcion);
            productosVenta = [];
            mostrarProductos();
            $('#confirmarVentaModal').modal('hide');
            $("input[id='pagoEfectivo']").val(0);
            await cargarProductos();
            await cargarProductosSucursal();
            await cargarSubproductosSucursal();
            await cargarOfertasSucursal();
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
        let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
        let valido = await respuesta.text();
        if (respuesta.ok) {
            if (valido.length > 0) {
                idSucursalEmpleado = valido;
                //return alert('LA CLAVE INGRESADA ES VALIDA?');
            } else {
                return alert('LA CLAVE INGRESADA ES INVALIDA');
            }
        }
        else{
                return alert('HUBO UN ERROR');
            }
        let json = JSON.stringify(productosVenta);
        const pago = document.querySelector('#pagoCredito');
        const cliente = document.querySelector('#clientes');
        console.log(parseFloat(pago.value));

        if (pago.value.length === 0)
            return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
        if (parseFloat(pago.value) >= parseFloat(total))
            return alert('SI EL PAGO ES MAYOR O IGUAL A LA COMPRA MEJOR USE EL PAGO CON EFECTIVO');
        try {
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: '/puntoVenta/venta',
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
            // let imp = await fetch(`/venta/ticket`);
            // let impJ = await imp.text();
            //  document.querySelector('#impresion').innerHTML = impJ;
            productosVenta = [];
            mostrarProductos();
            $('#confirmarVentaModal').modal('hide');
            $("input[id='pagoCredito']").val(0);
            await cargarProductos();
            await cargarProductosSucursal();
            await cargarSubproductosSucursal();
            await cargarOfertasSucursal();
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
        <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button>
        <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">SOLO COBRAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    `;
            calcularCambioEfectivo();

        }
        if (tipoPago === 'credito') {
            cuerpo = `
        <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button>
        <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">SOLO COBRAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    function buscarOferta() {
        const palabraBusqueda = document.querySelector('#busquedaOferta');
        let cuerpo = "";
        let contador = 1;
        let departamento = "";
        for (let x in ofertasSucursal) {
            /*for (let count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {
                    if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                        for (let d in departamentos) {
                            if (productos[count5].idDepartamento === departamentos[d].id)
                                departamento = departamentos[d].nombre;
                        }
                        cuerpo = cuerpo + `
                                <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
                                    <th scope="row">` + productos[count5].id + `</th>
                                    <td>` + productos[count5].codigoBarras + `</td>
                                    <td>` + productos[count5].nombre + `</td>
                                    <td>` + productosSucursal[x].existencia + `</td>
                                    <td>` + departamento + `</td>
                                </tr>
                                `;
                    }
                }
            }*/
            /*for (let d in departamentos) {
                if (productosOferta[x].idDepartamento === departamentos[d].id)
                    departamento = departamentos[d].nombre;
            }*/
            let sucursalP = productosSucursal.find(p => p.id == ofertasSucursal[x].idSucursalProducto);
            let producto = productos.find(p => p.id == sucursalP.idProducto);
            let departamento = departamentos.find(p => p.id == producto.idDepartamento);
            cuerpo = cuerpo + `
            <tr onclick="agregarProducto(` + producto.id + `,` + 2 + `,` +
                ofertasSucursal[x].existencia + `,` + sucursalP.costo + `)" data-dismiss="modal">
                <td>` + ofertasSucursal[x].codigoBarras + `</td>
                <td>` + ofertasSucursal[x].nombre + `</td>
                <td>` + ofertasSucursal[x].existencia + `</td>
                <td>` + departamento.nombre + `</td>
            </tr>
            `;

        }
        document.getElementById("consultaBusquedaOferta").innerHTML = cuerpo;
    }
</script>

<script>
    //let valor = $("input[type='number']").inputSpinner();
    //console.log(valor);
</script>
@endsection