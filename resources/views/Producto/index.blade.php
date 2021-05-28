@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection
@php
use App\Models\Sucursal_empleado;
$producto= ['modificarProducto','admin'];

$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificar = $sE->hasAnyRole($producto);
$crearProducto= ['crearProducto','admin'];
$crear = $sE->hasAnyRole($crearProducto);
$eliminarProducto= ['eliminarProducto','admin'];
$eliminar = $sE->hasAnyRole($eliminarProducto);
@endphp
@section('opciones')

<div class="col-0  p-1">
    <form method="get" action="{{url('/puntoVenta/departamento/')}}">
        <button class="btn btn-outline-secondary  ml-4 p-1 border-0" type="submit">
            <img src="{{ asset('img\depto.svg') }}" alt="Editar" width="33px" height="33px">
            <br />
            <p class="h6 my-auto text-dark"><small>DEPARTAMENTOS</small></p>
        </button>
    </form>
</div>
<!--BOTON CREAR EMPLEADO-->
@if($crear)
<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/producto/create')}}">
        <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="33px" height="33px">
        <p class="h6 my-auto text-dark"><small>NUEVO PRODUCTO </small></p>
    </a>
    </a>
</div>
@endif
<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/producto/stock')}}">
        <img src="{{ asset('img/stock.svg') }}" alt="Editar" width="32px" height="32px">
        <p class="h6 my-auto text-dark"><small>AGREGAR DE STOCK</small></p>
    </a>
</div>

<div class="col-0  ml-3 p-1 ">
    <button type="button" class="btn btn-outline-secondary p-1 border-0" data-toggle="modal"
        href=".modal_altaProductos_SucursalLogeado" id="altaProd" onclick=" return productosEnBajaSucursal()" value="">
        <img src="{{ asset('img\alta2.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>DAR ALTA</small></p>
    </button>
</div>

<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary p-1 border-0" href="{{ url('/puntoVenta/productosCaducidad')}}">
        <img src="{{ asset('img\calendario.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>PROXIMOS A CADUCAR</small></p>
    </a>
</div>

<div class="col-0  ml-3 p-1 ">
    <button type="button" class="btn btn-outline-secondary p-1 border-0" data-toggle="modal"
        data-target="#modalPeticionInventario" onclick="restaurarPeticionInventario()" value="">
        <img src="{{ asset('img\inventarioRapido.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>INVENTARIO RÁPIDO</small></p>
    </button>
</div>

<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="/puntoVenta/reporteInventario">
        <img src="{{ asset('img/rep_inv.png') }}" alt="Editar" width="32px" height="32px">
        <p class="h6 my-auto text-dark"><small>REPORTE INVENTARIO</small></p>
    </a>
</div>



<!--
<div class="col-2  ml-3 p-1 ">
    <a class="btn btn-outline-secondary p-1 border-0" href="{{ url('/puntoVenta/oferta')}}">
        <img src="{{ asset('img\ofertas.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>OFERTAS</small></p>
    </a>
</div>
-->
<!-- COMENTADO TEMPORAL
<div class="col-1 my-2  p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal"  href="{{ url('/producto/create')}}" id="altaProd"  value="">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        OFERTAS
    </button>
</div>
-->
<div class="mx-auto my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">

        <div class="row col-12 mx-2 mt-2 mb-2 ">
            <h5 class="text-primary">
                <strong>
                    CONSULTAR PRODUCTOS
                </strong>
            </h5>
        </div>

        <div class="row col-12 px-4 mx-0">
            <div class="col-2 border border-primary mx-auto mb-4 px-1">
                <h6 class="text-primary mt-4">
                    FILTRAR POR:
                </h6>
                <select class="form-control mt-1" name="idDepartamento" id="idDepartamento"
                    onchange="buscarFiltroNombre2()" required>
                    <option value="">DEPARTAMENTO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                <div class="input-group-text mt-4 mx-0 py-auto ">
                    <input type="checkbox" value="existencia" name="bajosExistencia" id="bajosExistencia"
                        onchange="buscarFiltroNombre2()">
                    <label class="text-primary ml-1 mr-0 my-auto h6" for="bajosExistencia">

                        BAJOS DE
                        EXISTENCIA
                    </label>
                </div>
                <select class="form-control mt-4" name="tipo" id="tipo" onchange="filtrarTipo()">
                    <option value="">TIPO</option>
                    <option value="1">NORMAL</option>
                    <option value="2">SUBPRODUCTO</option>
                    <option value="3">OFERTA</option>
                </select>
            </div>
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-10 mx-0 mb-4 pl-1 pr-0">
                <div class="form-group mb-1 border border-primary">
                    <div class="row col-12 mx-auto my-auto ">
                        <div class=" text-center ">
                            <h6 class=" text-primary"> COSTO DEL INVENTARIO: </h6>
                            <div class=" input-group text-center  px-auto">
                                <h3 class="text-center ml-auto">$</h3>
                                <p class="h3 mr-auto" id="costoInv">0.00</p>
                            </div>
                        </div>
                        <div class="mx-4 text-center ">
                            <h6 class=" text-primary"> PRECIO DEL INVENTARIO: </h6>
                            <div class=" input-group text-center mx-auto ">
                                <h3 class="text-center ml-auto">$</h3>
                                <p class="h3 mr-auto " id="precioInv">$ 0.00</p>
                            </div>
                        </div>
                        <div class=" text-center">
                            <h6 class=" text-primary"> CANT. PRODUCTOS: </h6>
                            <div id="cantProdInv" class="h3"> 0.0</div>
                        </div>
                        <div class=" mx-4 text-center">
                            <h6 class=" text-primary"> CANT. SUBPRODUCTOS: </h6>
                            <div id="cantProdSub" class="h3"> 0.0</div>
                        </div>
                        <div class=" text-center">
                            <h6 class=" text-primary"> CANT. OFERTAS: </h6>
                            <div id="cantProdOferta" class="h3"> 0.0</div>
                        </div>
                    </div>
                    <div class="row mx-0 mt-3 mb-2">
                        <div class="input-group col-4">
                            <input class="form-control text-uppercase my-auto" type="text" placeholder="Buscar producto"
                                id="busquedaProducto" onkeyup="buscar()">
                            <div class="input-group-appendborder">
                                <button class="btn text-dark border p-0" onclick="">
                                    <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail m-0" alt="Regresar"
                                        width="38px" height="38px" /></button>
                            </div>
                        </div>
                        <div class="mt-2 mx-2"> </div>
                        <h6 class="mx-3 mt-2"> BUSCAR POR:</h6>
                        <div class=" input-group-text my-auto">
                            <input type="radio" value="folio" name="checkbox2" onchange="buscar()" id="codigoBusq">
                            <label class="ml-1 my-0" for="codigoBusq">
                                CODIGO
                            </label>
                        </div>
                        <div class=" input-group-text  ml-1 my-auto ">
                            <input type="radio" value="nombre" name="checkbox2" onchange="buscar()" id="nombreBusq"
                                checked>
                            <label class="ml-1 my-0" for="nombreBusq">
                                NOMBRE
                            </label>
                        </div>

                    </div>
                </div>

                <!-- TABLA -->
                <div class="row border my-0 mx-0 px-0 border-dark" style="height:500px;overflow-y:auto;"
                    id="tablaBusqueda">
                    <table class="table table-bordered table-responsive-lg  border-primary  text-center table-hover"
                        id="productos">
                        <thead class="table-secondary text-dark" id="cabeceraProductos">
                            <tr>
                                <th>TIPO</th>
                                <th>CODIGO BARRAS</th>
                                <th>NOMBRE</th>
                                <th>DEPARTAMENTO</th>
                                <th>COSTO</th>
                                <th>PRECIO </th>
                                <th>CANT</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda" class="text-uppercase ">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- MODAL-->

<!-- MODAL-->
<div class="modal fade bd-example-modal-lg" id="detalleProducto" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <div class="container">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 text-center mx-auto " style="color:#FFFFFF">
                            INFORMACION DEL PRODUCTO
                        </h6>
                    </div>
                    <div class="row" style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" style="color:#FFFFFF">
                            PRODUCTO
                        </h6>
                    </div>
                </div>
                <!--button type="button" class="close" data-dismiss="modal" aria-label="Close"-->
                <!-- <span aria-hidden="true">&times;</span>-->
                <!--/button-->
            </div>
            <div class="modal-body  col-12" id="">
                <div class="row" id="resultados"></div>
                <div id="subAgregar" class="col mx-auto mt-4 text-center"></div>
                <div class="col modal-footer input-group" id="pieInformacion">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL CAMBIAR PRECIO COSTO-->
<div class="modal fade modal_precio2" id="modal_precio2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-small " role="document">
        <div class="modal-content" style="width:500px;">
            <div class="modal-header  ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" id="titulo"
                            style="color:#FFFFFF">

                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-8 mx-4 text-center mx-auto" id="">
                <div class="row  " id="modiPrecio">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="actPrecio2" onclick="actPrecio();">GUARDAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>

            </div>
        </div>
    </div>
</div>
<!--MODAL CAMBIAR COSTO-->
<div class="modal fade modal_costo" id="modal_costo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-small " role="document">
        <div class="modal-content" style="width:500px;">
            <div class="modal-header  ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" id="titulo2"
                            style="color:#FFFFFF">

                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-8 mx-4 text-center mx-auto" id="">
                <div class="row  " id="modiCosto">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="actCosto2" onclick="actCosto();">GUARDAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>

            </div>
        </div>
    </div>
</div>
<!--MODAL CAMBIAR EXISTENCIA-->
<div class="modal fade modal_existencia" id="modal_existencia" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small " role="document">
        <div class="modal-content" style="width:500px;">
            <div class="modal-header  ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" id="titulo3"
                            style="color:#FFFFFF">

                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-8 mx-4 text-center mx-auto" id="">
                <div class="row  " id="modiPrecioCosto3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="actPrecioCosto3"
                    onclick="actExistencia();">GUARDAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            </div>
        </div>
    </div>
</div>
<!--MODAL CAMBIAR EXISTENCIA-->
<div class="modal fade modal_existenciaAgregar" id="modal_existenciaAgregar" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small " role="document">
        <div class="modal-content" style="width:500px;">
            <div class="modal-header  ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" id="tituloExistAgregar"
                            style="color:#FFFFFF">

                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-8 mx-4 text-center mx-auto" id="">
                <div class="row  " id="modiExistAgregar">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modificarExisAgregar"
                    onclick="agregarExistencia();">GUARDAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            </div>
        </div>
    </div>
</div>

<!--MODAL SUBPRODUCTO-->
<div class="modal fade modal_Exis_Nuevo" id="modal_Exis_Nuevo" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small " role="document">
        <div class="modal-content" style="width:500px;">
            <div class="modal-header  ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" id="titulo5"
                            style="color:#FFFFFF">

                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-8 mx-4 text-center mx-auto" id="">
                <div class="row  " id="exis_Nuevo_Subprod">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnNueva_Exis_Sub"
                    onclick="agregarSubprod();">GUARDAR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            </div>
        </div>
    </div>
</div>

<!-- END MODAL-->
<!--MODAL PARA CARGAR PRODUCTOS DADOS DE BAJA EN SUCURSAL LOGEADO-->
<div class="modal fade modal_altaProductos_SucursalLogeado" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;height:500px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid ">
                    <div class="row" style="background:#3366FF">
                        <br />
                    </div>
                    <div class="row " style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2  px-1 mx-auto " style="color:#FFFFFF">
                            PRODUCTOS DADOS DE BAJA EN ESTA SUCURSAL
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <!-- TABLA -->
                <div id="vacio" class="text-center my-auto">
                    <div class="row w-100 " style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary ml-5  ">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRA</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>RECETA</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="filaTablas">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    id="modalPeticionInventario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <h5 class="modal-title" id="exampleModalLabel">INVENTARIO RAPIDO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="cantidadProductos">CANTIDAD DE PRODUCTOS A INVENTAREAR</label>
                    <input type="number" class="form-control" id="cantidadProductos" aria-describedby="cantpro">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">CERRAR</button>
                <button type="button" class="btn btn-success" onclick="getInventarioRapido()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>
<!--MODAL PARA CARGAR INVENTARIO RAPIDO-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    id="modalInventarioRapido">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <h5 class="modal-title" id="exampleModalLabel">INVENTARIO RAPIDO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="height:400px;overflow-y:auto;" id="cuerpoInventarioRapido">
                    <!-- TABLA -->
                    AQUI VA EL INVENTARIO RAPIDO
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<!--POP UP-->

<!-- SCRIPT-->
<script>
let productos = @json($datosP);
const d = @json($depa);
let contadorRellenar = 0;
let opcFolioNombre = "";
let opcBajosE = "";
let productosSucursal = @json($productosSucursal);
let productosList = [];
let depaBandera = true;
let bajosExisBandera = true;
let folioNombreBandera = true;
let subproductos = @json($subproducto);
let ofertas = @json($ofertas);
//  let nombreBandera = true;

let prod_baja = "";

// nombreOpc();
const numPorGrupo = 100;
let grupos = 1;
let pagina = 1;
let palabraAux = "";
let productoNoEncontrado = [];

let modificarProducto = @json($modificar);
let eliminarProducto = @json($eliminar);
let productosRapidos = [];
buscarFiltroNombre2();

/*
 function folioNombreOpc() {

     filtroProducto();
 }

 function deptoOpc() {
     // folioNombreBandera = false;
     depaBandera = true;
     // bajosExisBandera = false;
     // nombreBandera = false; //checar
     filtroProducto();
 }

 function bajosExisOpc() {
     //  folioNombreBandera = false;
     //   depaBandera = false;
     bajosExisBandera = true;
     //   nombreBandera = false; //checar
     filtroProducto();
 }

 function nombreOpc() {
     //  folioNombreBandera = false;
     //  depaBandera = false;
     //  bajosExisBandera = false;
     // nombreBandera = true; //checar

     buscarFiltroNombre();
 }

 */

function comparar(palabra) {
    //const palabraBusqueda = document.querySelector('#busquedaProducto').value;
    return palabra == palabraAux;
}

/*function buscar() {

    var filtro = $("#busquedaProducto").val().toUpperCase();

    $("#productos td").each(function() {
        var textoEnTd = $(this).text().toUpperCase();
        if (textoEnTd.indexOf(filtro) >= 0) {
            $(this).addClass("existe");
        } else {
            $(this).removeClass("existe");
        }
    })

    $("#productos tbody tr").each(function() {
        if ($(this).children(".existe").length > 0) {
            $(this).show();
        } else {
            $(this).hide();
        }
    })

}
*/
function buscarFiltroNombre2() {
    productosList = [];
    //const palabraBusqueda = document.querySelector('#busquedaProducto');
    /*if (!comparar(palabraBusqueda.value)) {
        console.log("No es igual");
        console.log(palabraAux);
        palabraAux = palabraBusqueda.value;
        //const st = setTimeout(buscarFiltroNombre2(),1000);
        buscarFiltroNombre2();
        return;
    }*/
    let seleccion = document.querySelector("input[name='checkbox2']:checked");
    let opcFolioNombre = seleccion.value;
    //folioNombreBandera = true;
    //console.log(productos);
    for (let x in productosSucursal) {
        //for(let x=0;x<productosSucursal.length;x++){
        //for (count5 in productos) {
        //if (productos[count5].id === productosSucursal[x].idProducto) {

        //BUSCAR POR FOLIO NOMBRE 
        let producto = productos.find(p => p.id == productosSucursal[x].idProducto);
        if (producto != null) {

            //if (opcFolioNombre === 'nombre') {
            //$("#idDepartamento").prop('disabled', false);
            //$("#bajosExistencia").prop('disabled', false);
            //
            /*            let comparar = "";
                        if (opcFolioNombre === 'nombre')
                            comparar = producto.nombre.toUpperCase();
                        if (opcFolioNombre === 'folio')
                            comparar = producto.codigoBarras.toUpperCase();
            */
            //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRES
            //if (comparar.includes(palabraBusqueda.value.toUpperCase())) {
            //BUSCAR POR DEPARTAMENTO
            //     if (depaBandera == true) { // SI LA OPCION DEPARTAMENTO SE HABILITO 
            let depa = document.querySelector('#idDepartamento');
            if (depa.value != "") {
                if (producto.idDepartamento === parseInt(depa.value)) {
                    //Cargar datos encontrados filtrado depto, nombre
                    //BUSCAR PRODUCTOS BAJOS DE EXISTENCIA
                    let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                    if (seleccion != null) {
                        opcBajosE = seleccion.value; //VARIABLE opcBajosE?
                        if (opcBajosE === 'existencia') {
                            if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                //PRODUCTOS POR NOMBRE, DEPTO Y BAJOS EXISTENCIA
                                let departamento = "";
                                for (count21 in d) {
                                    if (producto.idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = producto.id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: producto.codigoBarras,
                                    nombre: producto.nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: producto.idDepartamento
                                };
                                productosList.push(productosAdd);


                            }
                        }
                    } else {
                        //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE, DEPTO
                        // buscarFiltroNombre();
                        let departamento = "";
                        for (count21 in d) {
                            if (producto.idDepartamento === d[count21].id) {
                                departamento = d[count21].nombre;
                            }
                        }
                        let id = producto.id;
                        let productosAdd = {
                            id: id,
                            codigoBarras: producto.codigoBarras,
                            nombre: producto.nombre,
                            existencia: productosSucursal[x].existencia,
                            idDepartamento: producto.idDepartamento
                        };
                        productosList.push(productosAdd);
                    }
                }
            } else {
                //VERIFICAR BAJOS EXISTENCIA 
                //BUSCAR PRODUCTOS POR NOMBRE, BAJOS DE EXISTENCIA
                let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                if (seleccion != null) {
                    opcBajosE = seleccion.value; //VARIABLE opcBajosE?
                    if (opcBajosE === 'existencia') {
                        if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                            //PRODUCTOS POR NOMBRE Y BAJOS EXISTENCIA
                            let departamento = "";
                            for (count21 in d) {
                                if (producto.idDepartamento === d[count21].id) {
                                    departamento = d[count21].nombre;
                                }
                            }
                            let id = producto.id;
                            let productosAdd = {
                                id: id,
                                codigoBarras: producto.codigoBarras,
                                nombre: producto.nombre,
                                existencia: productosSucursal[x].existencia,
                                idDepartamento: producto.idDepartamento
                            };
                            productosList.push(productosAdd);
                        }
                    }
                } else {
                    //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE
                    let departamento = "";
                    for (count21 in d) {
                        if (producto.idDepartamento === d[count21].id) {
                            departamento = d[count21].nombre;
                        }
                    }
                    let id = producto.id;
                    let productosAdd = {
                        id: id,
                        codigoBarras: producto.codigoBarras,
                        nombre: producto.nombre,
                        existencia: productosSucursal[x].existencia,
                        idDepartamento: producto.idDepartamento
                    };
                    productosList.push(productosAdd);
                }
            }
            //  }
            //} else {
            // MENSAJE PRODUCTOS NO ENCONTRADOS
            //}
            /*} else if (opcFolioNombre === 'folio') {
                $("#idDepartamento").prop('disabled', true);
                $("#bajosExistencia").prop('disabled', true);
                if (producto.codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                    let departamento = "";
                    for (count21 in d) {
                        if (producto.idDepartamento === d[count21].id) {
                            departamento = d[count21].nombre;
                        }
                    }
                    let id = producto.id;
                    let productosAdd = {
                        id: id,
                        codigoBarras: producto.codigoBarras,
                        nombre: producto.nombre,
                        existencia: productosSucursal[x].existencia,
                        idDepartamento: producto.idDepartamento
                    };
                    productosList.push(productosAdd);
                }
            }*/
        } else {
            productoNoEncontrado.push(productosSucursal[x]);

        }
        //}
    }

    console.log("Productos no encontrados", productoNoEncontrado);
    grupos = parseInt(productosList.length / numPorGrupo);
    pagina = 0;
    actualizarCabecera();
    rellenar();
    const palabraBusqueda = document.querySelector('#busquedaProducto');
    if (palabraBusqueda.value.length > 0)
        buscar();
};

function actualizarCabecera() {
    let contador = 0;
    let costo_inventario = 0;
    let precio_inventario = 0;
    let cantProdInventario = 0;
    let cantOfertas = 0;
    let cantSubproductos = 0;
    console.log("Actualizando cabecera");
    for (let t in productosList) {

        let productoSucursal = productosSucursal.find(p => p.idProducto == productosList[t].id);

        let costoTemporal = productoSucursal.costo * productoSucursal.existencia;
        let precioTemporal = productoSucursal.precio * productoSucursal.existencia;
        costo_inventario = costo_inventario + costoTemporal;
        precio_inventario = precio_inventario + precioTemporal;
        cantProdInventario = cantProdInventario + productoSucursal.existencia;

        let subproducto = subproductos.find(p => p.idSucursalProducto == productoSucursal.id);
        if (subproducto != null) {
            let costoSubp = productoSucursal.costo / subproducto.piezas;
            let costoTempSub = costoSubp * subproducto.existencia;
            costo_inventario = costo_inventario + costoTempSub;
            let precioTempSub = subproducto.precio * subproducto.existencia;
            precio_inventario = precio_inventario + precioTempSub;
            contador = contador + 1;
            cantSubproductos = cantSubproductos + subproducto.existencia;
        }
        let oferta = ofertas.find(p => p.idSucursalProducto == productoSucursal.id);
        if (oferta != null) {
            let costoOferta = productoSucursal.costo * oferta.existencia;
            costo_inventario = costo_inventario + costoOferta;
            let precioTempOferta = productoSucursal.precio * oferta.existencia;
            precio_inventario = precio_inventario + precioTempOferta;
            cantOfertas = cantOfertas + oferta.existencia;
        }

    }
    document.getElementById("costoInv").innerHTML = costo_inventario.toFixed(2);
    document.getElementById("precioInv").innerHTML = precio_inventario.toFixed(2);
    document.getElementById("cantProdInv").innerHTML = cantProdInventario;
    document.getElementById("cantProdSub").innerHTML = cantSubproductos;
    document.getElementById("cantProdOferta").innerHTML = cantOfertas;

}
/*

function filtroProducto() {
    productosList = [];
    const palabraBusqueda = document.querySelector('#busquedaProducto');

    //BUSCAR POR DEPARTAMENTO
    if (depaBandera == true) {
        for (let x in productosSucursal) {
            for (count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {

                    let depa = document.querySelector('#idDepartamento');
                    // if (depa.value != "0") {
                    if (depa.value != "") {
                        if (productos[count5].idDepartamento === parseInt(depa.value)) {

                            let departamento = "";
                            for (count21 in d) {
                                if (productos[count5].idDepartamento === d[count21].id) {
                                    departamento = d[count21].nombre;
                                }
                            }
                            let id = productos[count5].id;
                            let productosAdd = {
                                id: id,
                                codigoBarras: productos[count5].codigoBarras,
                                nombre: productos[count5].nombre,
                                existencia: productosSucursal[x].existencia,
                                idDepartamento: productos[count5].idDepartamento
                            };

                            productosList.push(productosAdd);

                        }
                    } else {
                        buscarFiltroNombre();
                    }
                }
            }
        }

        rellenar();

    } else if (folioNombreBandera == true) {
        for (let x in productosSucursal) {
            for (count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {

                    //BUSCAR POR FOLIO NOMBRE 
                    let seleccion = document.querySelector("input[name='checkbox2']:checked");
                    let opcFolioNombre = seleccion.value;
                    folioNombreBandera = true;
                    if (opcFolioNombre === 'nombre') {
                        //BUSCAR PRODUCTOS SUCURSAL TODOS SIN FILTRO
                        buscarFiltroNombre();
                    } else if (opcFolioNombre === 'folio') {
                        if (productos[count5].codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            let departamento = "";
                            for (count21 in d) {
                                if (productos[count5].idDepartamento === d[count21].id) {
                                    departamento = d[count21].nombre;
                                }
                            }
                            let id = productos[count5].id;
                            let productosAdd = {
                                id: id,
                                codigoBarras: productos[count5].codigoBarras,
                                nombre: productos[count5].nombre,
                                existencia: productosSucursal[x].existencia,
                                idDepartamento: productos[count5].idDepartamento
                            };
                            productosList.push(productosAdd);
                        }
                    }
                }
            }
        }
        rellenar();

    } else if (bajosExisBandera == true) {
        for (let x in productosSucursal) {
            for (count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {

                    //BUSCAR BAJOS EXISTENCIA
                    let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                    if (seleccion != null) {
                        opcBajosE = seleccion.value;
                        if (opcBajosE === 'existencia') {
                            if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                // if (productos[count20].idDepartamento.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                                let departamento = "";
                                for (count21 in d) {
                                    if (productos[count5].idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = productos[count5].id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: productos[count5].codigoBarras,
                                    nombre: productos[count5].nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: productos[count5].idDepartamento
                                };
                                productosList.push(productosAdd);
                            }
                        }
                    } else {
                        //BUSCAR PRODUCTOS SUCURSAL TODOS SIN FILTRO
                        buscarFiltroNombre();

                    }
                }
            }
        }
        rellenar();
    } else {
        buscarFiltroNombre();
    }
};
*/

/*function isSubproducto(producto)
{
    let subproducto = subproductos.find(p => p.idSucursalProducto == producto.id);
    if(subproducto != null)
        return true;
    return false;
}*/
function filtrarTipo() {
    pagina = 0;
    const palabraBusqueda = document.querySelector('#busquedaProducto');
    if (palabraBusqueda.value.length > 0)
        buscar();
    else
        rellenar();
    /*if(tipo == "1")
    {
        let productosListAux = productosList;
        const result = productosList.filter(isSubproducto);
        rellenar();
    }*/
}

function rellenar() {
    //const palabraBusqueda = document.querySelector('#busquedaProducto');
    let consulta = document.getElementById("consultaBusqueda");
    let tipo = document.querySelector('#tipo').value;

    if (pagina == 0)
        consulta.innerHTML = "";
    console.log("AQUI IMPRIME PROD VACIOS");
    let cuerpo = ""; //document.getElementById("consultaBusqueda").innerHTML;

    let oferta = null;
    let subproducto = null;
    let productoSucursal = null;

    /* let costo_inventario = 0;
     let precio_inventario = 0;
     let cantProdInventario = 0;
     let cantOfertas = 0;
     let cantSubproductos = 0;*/
    //let departamento = "";
    //for (let t in productosList) {
    //document.createElement("tr");
    /*cargando.id= "cargandoProductos";
    cargando.innerHTML =   `<tr>
        <td colspan="5">
        <div class="d-flex justify-content-center my-3">
            <button class="btn btn-info" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                CARGANDO PRODUCTOS
            </button>
        </div>
        </td>
        </tr>
    `;
    consulta.appendChild(cargando);*/
    if (pagina > grupos)
        return;
    let totalProductos = parseInt((pagina + 1) * numPorGrupo);
    if (pagina == grupos)
        totalProductos = productosList.length;

    for (let t = parseInt(pagina * numPorGrupo); t < totalProductos; t++) {

        /*for (count8 in d) {
            if (productosList[t].idDepartamento === d[count8].id) {
                departamento = d[count8].nombre;
            }
        }*/
        /*let costoTemporal = productoSucursal.costo * productosList[t].existencia;
        let precioTemporal = productoSucursal.precio * productosList[t].existencia;
        costo_inventario = costo_inventario + costoTemporal;
        precio_inventario = precio_inventario + precioTemporal;
        cantProdInventario = cantProdInventario + productosList[t].existencia;*/
        //contador = contador + 1;

        //console.log('tipo',tipo);
        productoSucursal = null;
        productoSucursal = productosSucursal.find(p => p.idProducto == productosList[t].id);
        let departamento = d.find(p => p.id == productosList[t].idDepartamento).nombre;
        if (tipo == "" || tipo == "1") {


            if (productoSucursal.status == 1) {
                //console.log('productos',productoSucursal.status);
                cuerpo = //`
                    //<tr onclick="" data-dismiss="modal">

                    `<td>` + "NORMAL" + `</td>
                                <td id="codigo${productosList[t].id}">` + productosList[t].codigoBarras + `</td>
                                <td id="nombre${productosList[t].id}">` + productosList[t].nombre + `</td>
                                <td id="departamento${productosList[t].id}">` + departamento + `</td>
                                <td id="costo${productoSucursal.id}">` + productoSucursal.costo + `</td>
                                <td id="precio${productoSucursal.id}" class="text-success">` + productoSucursal
                    .precio + `</td>
                                <td id="existenciaP${productoSucursal.id}">` + productoSucursal.existencia + `</td>
                                <td>` +
                    ` <button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` +
                    productosList[t].id + `)" value="` + productosList[t].id + `">
                                <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
                                </button>
                                </td>`;
                //</tr>
                //`;
                const tr = document.createElement("tr");
                tr.innerHTML = cuerpo;
                tr.id = "producto" + productosList[t].id;
                consulta.appendChild(tr);
                contadorRellenar++;
            }
        }

        subproducto = null;
        if (tipo == "" || tipo == 2) {
            subproducto = subproductos.find(p => p.idSucursalProducto == productoSucursal.id);
            //if(tipo == "" || tipo == "2"){
            if (subproducto != null) {
                let costoSubp = productoSucursal.costo / subproducto.piezas;
                cuerpo =
                    //<tr class="table-warning" onclick="" data-dismiss="modal">
                    `<td >` + "SUBPRODUCTO" + `</td>
                            <td id="scodigo${productosList[t].id}">` + productosList[t].codigoBarras + `</td>
                            <td id="snombre${productosList[t].id}">` + productosList[t].nombre + `</td>
                            <td id="sdepartamento${productosList[t].id}">` + departamento + `</td>
                            <td>` + Number(costoSubp.toFixed(2)) + `</td>
                            <td class="text-success">` + subproducto.precio + `</td>
                            <td id="subpExistencia${productoSucursal.id}">` + subproducto.existencia + `</td>
                            <td>` +
                    ` <button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg"  onclick=" return infoSubproducto( ` +
                    productosList[t].id + `)" value="` + productosList[t].id + `">
                            <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
                            </button>
                            </td>            
                            
                            `;
                const tr = document.createElement("tr");
                tr.innerHTML = cuerpo;
                consulta.appendChild(tr);
                contadorRellenar++;
            } else {
                subproducto = "";
            }
        }
        oferta = null;
        if (tipo == "" || tipo == "3") {
            oferta = ofertas.find(p => p.idSucursalProducto == productoSucursal.id);

            if (oferta != null) {
                //contador = contador + 1;
                cuerpo =
                    //<tr class="table-warning" onclick="" data-dismiss="modal">
                    `
                            <td >` + "OFERTA" + `</td>
                            <td id="ocodigo${productosList[t].id}">` + productosList[t].codigoBarras + `</td>
                            <td id="onombre${productosList[t].id}">` + productosList[t].nombre + `</td>
                            <td id="odepartamento${productosList[t].id}">` + departamento + `</td>
                            <td>` + productoSucursal.costo + `</td>
                            <td class="text-success">` + productoSucursal.costo + `</td>
                            <td>` + oferta.existencia + `</td>
                            `;
                const tr = document.createElement("tr");
                tr.innerHTML = cuerpo;
                consulta.appendChild(tr);
                contadorRellenar++;
            } else {
                oferta = "";
                // console.log(" ofertis", oferta);
            }
        }
        //}

        //  }
        //}
    }

    let cargando = document.querySelector('#cargandoProductos');
    if (cargando != null)
        cargando.remove();
    if (pagina < grupos && contadorRellenar >= numPorGrupo) {
        cargando = document.createElement("tr");
        cargando.id = "cargandoProductos";
        cargando.innerHTML = `
            <td colspan="8">
            <div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO PRODUCTOS
                </button>
            </div>
            </td>
        `;

        //let consulta = document.getElementById("consultaBusqueda");
        consulta.appendChild(cargando);

    }
    console.log("productosSucursal", productoSucursal);
    console.log("oferta", oferta);
    console.log("subproducto", subproducto);

    if (pagina < grupos && contadorRellenar < numPorGrupo) {
        pagina++;
        rellenar();
    } else {
        if (productoSucursal == null && oferta == null && subproducto == null) {
            console.log("06-05-21");
            const tr = document.createElement("tr");
            tr.innerHTML = "<tr><td colspan='7'><h4 class='text-center'>No se encontraron productos </h4></td></tr>";
            consulta.appendChild(tr);
        } else
        if (contadorRellenar == 0) {
            const tr = document.createElement("tr");
            tr.innerHTML = "<tr><td colspan='7'><h4 class='text-center'>No se encontraron productos </h4></td></tr>";
            consulta.appendChild(tr);
        }
        contadorRellenar = 0;

    }

    //let cargando1 = document.createElement("tr");
    //cargando1.id= "cargandoProductos1";
    //cargando1.innerHTML = cargando.innerHTML;
    //consulta.appendChild(cargando1);
    //MOSTRAR SUBPRODUCTOS
    /*for (let y in subproductos) {
        //for (let z in productosSucursal) {
            //if (subproductos[y].idSucursalProducto == productoSucursal.id) {
            let productoSucursal = productosSucursal.find(p => p.id == subproductos[y].idSucursalProducto);
                //for (let p in productos) {
                    //if (productos[p].id == productoSucursal.idProducto) {
                    let producto = productos.find(p => p.id == productoSucursal.idProducto);
                        if (producto.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            departamento = d.find(p => p.id == producto.idDepartamento);
                            for (count8 in d) {
                                if (productos[p].idDepartamento === d[count8].id) {
                                    departamento = d[count8].nombre;
                                }
                            }
                            /*let costoSubp = productoSucursal.costo / subproductos[y].piezas;
                            let costoTempSub = costoSubp * subproductos[y].existencia;
                            costo_inventario = costo_inventario + costoTempSub;
                            let precioTempSub = subproductos[y].precio * subproductos[y].existencia;
                            precio_inventario = precio_inventario + precioTempSub;
                            contador = contador + 1;
                            cantSubproductos = cantSubproductos + subproductos[y].existencia;

                            cuerpo = cuerpo + `
                        <tr class="table-warning" onclick="" data-dismiss="modal">
                            <td >` + "SUBPRODUCTO" + `</td>
                            <td>` + producto.codigoBarras + `</td>
                            <td>` + producto.nombre + `</td>
                            <td>` + departamento + `</td>
                            <td>` + Number(costoSubp.toFixed(2)) + `</td>
                            <td class="text-success">` + subproductos[y].precio + `</td>
                            <td>` + subproductos[y].existencia + `</td>
                            <td>` +
                                ` <button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg"  onclick=" return infoSubproducto( ` + producto.id + `)" value="` + producto.id + `">
                            <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
                            </button>
                            </td>            
                        </tr>
                        `;
                        }
                    //}

                //}
            //}

        //}

    }*/

    //MOSTRAR OFERTAS 
    /*for (let i in ofertas) {
        //for (let z in productosSucursal) {
            //if (ofertas[i].idSucursalProducto == productoSucursal.id) {
            let productoSucursal = productosSucursal.find(p => p.id == ofertas[i].idSucursalProducto);
                //for (let p in productos) {
                    //if (productos[p].id == productoSucursal.idProducto) {
                    let producto = productos.find(p => p.id == productoSucursal.idProducto);
                        if (producto.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            departamento = d.find(p => p.id == producto.idDepartamento);
                            /*for (count8 in d) {
                                if (producto.idDepartamento === d[count8].id) {
                                    departamento = d[count8].nombre;
                                }
                            }
                            /*let costoOferta = productoSucursal.costo * ofertas[i].existencia;
                            costo_inventario = costo_inventario + costoOferta;
                            let precioTempOferta = productoSucursal.precio * ofertas[i].existencia;
                            precio_inventario = precio_inventario + precioTempOferta;
                            cantOfertas = cantOfertas + ofertas[i].existencia;
                            contador = contador + 1;
                            cuerpo = cuerpo + `
                        <tr class="table-warning" onclick="" data-dismiss="modal">
                            <td >` + "OFERTA" + `</td>
                            <td>` + producto.codigoBarras + `</td>
                            <td>` + producto.nombre + `</td>
                            <td>` + departamento + `</td>
                            <td>` + productoSucursal.costo + `</td>
                            <td class="text-success">` + productosSucursal.precio + `</td>
                            <td>` + ofertas[i].existencia + `</td>
                            <td>`;
                        }
                    //}
                //}
            //}
        //}

    }*/
    //console.log('Ya acabo subproducto');
    //document.getElementById("consultaBusqueda").innerHTML = cuerpo;

    //    consulta.innerHTML = consulta.innerHTML + cuerpo;
    /*document.getElementById("costoInv").innerHTML = costo_inventario;
    document.getElementById("precioInv").innerHTML = precio_inventario;
    document.getElementById("cantProdInv").innerHTML = cantProdInventario;
    document.getElementById("cantProdSub").innerHTML = cantSubproductos;
    document.getElementById("cantProdOferta").innerHTML = cantOfertas;*/

};
//let imagenUrlAuxiliar = "";

function previsualizarImagen(id) {
    const seleccionImagen = document.querySelector('#' + id);
    const imagen = document.querySelector('#imagenPrevisualizacion');
    const archivos = seleccionImagen.files;
    if (!archivos || !archivos.length) {
        imagen.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    imagen.src = objectURL;
    //imagenUrlAuxiliar = objectURL;
}

function info4(id) {
    //Modal
    //let x1= 0;
    let btnAgregarSubprod = "";
    let datosProduct = "";
    let cambiarCostoPrecio = "";
    let imagen = "";
    let departamento = "";
    let idProdSuc = 0;
    let ms = 0;
    let producto = productos.find(p => p.id == id);
    let productoSucursal = productosSucursal.find(p => p.idProducto == producto.id);
    //for (let j in productosSucursal) {
    //for (count10 in productos) {
    //if (productos[count10].id === productosSucursal[j].idProducto) {
    //if (productos[count10].id === id) {
    let departamentos = "";
    for (let count11 in d) {
        if (producto.idDepartamento === d[count11].id) {
            departamentos = departamentos +
                `<option value="${d[count11].id}" selected>${d[count11].nombre}</option>`;
        } else {
            departamentos = departamentos +
                `<option value="${d[count11].id}">${d[count11].nombre}</option>`;
        }
    }
    let receta = "";
    if (producto.receta == "NO") {
        receta = `<option value="NO" selected>${producto.receta}</option>
                                      <option value="SI">SI</option>`
    } else {
        receta = `<option value="SI" selected>${producto.receta}</option>
                                      <option value="NO">NO</option>`
    }

    //x1 = producto.id;
    x = producto.id;
    idProdSuc = productoSucursal.id;
    ms = productoSucursal.minimoStock;
    let urlImagen = "";
    let cuerpoImagen = `
    <img width="200" class="mx-auto" src="${urlImagen}" alt="EL PRODUCTO NO CONTIENE IMAGEN"  id="imagenPrevisualizacion">
    <input type="file" name="imagen" id="imagen" class="form-control mx-auto"
    onchange="previsualizarImagen('imagen')">
    <br/>`;
    if (producto.imagen != null)
        if (producto.imagen.length > 0) {
            urlImagen = "{{asset('storage')}}" + "/" + producto.imagen;
            cuerpoImagen = `
        <img width="200" class="mx-auto" src="${urlImagen}" alt="${urlImagen}"  id="imagenPrevisualizacion">
        <input type="file" name="imagen" id="imagen" class="form-control mx-auto"
        onchange="previsualizarImagen('imagen')">
                                            
                                            <br/>
                                            `
        }

    btnAgregarSubprod =
        ` <a class="btn btn-outline-primary "   href="#" onclick="subproductoExiste(${productoSucursal.id},${x});">
                                             <img src="{{ asset('img/agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                                             AGREGAR A SUBPRODUCTO </a> 
                                             `;
    let btnEditar =
        `<button class="btn btn-outline-primary mb-2" id="btnEditar" onclick="habilitarEditar(${x},${idProdSuc})" value=true> 
                                            <img src="{{ asset('img/edit.png') }}" alt="Editar" width="25px" height="25px">
                                            EDITAR</button>
                                    `;
    let btnDarBaja =
        `<a class="btn btn-outline-danger mb-2" data-method="delete" onclick="return confirm('¿DESEA DAR DE BAJA ESTE PRODUCTO?. SI LO DA DE BAJA LA EXISTENCIA SERA: 0')"  href="{{ url('/puntoVenta/productoEli3/${x}')}}">` +

        `<img src="{{ asset('img/eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                             DAR DE BAJA </a> 
                                        </div>

                                        <br/>
                                    `;
    if (!eliminarProducto)
        btnDarBaja = `<a class="btn btn-outline-danger mb-2" onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')"> 
                                            <img src="{{ asset('img/eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                             DAR DE BAJA </a>
                                        </div>
                                    `;
    //botonesProducto = botonesProducto + btnDarBaja;
    if (!modificarProducto) {
        btnEditar = `<button class="btn btn-outline-primary mb-2 " onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')"> 
                                            <img src="{{ asset('img/edit.png') }}" alt="Editar" width="25px" height="25px" >
                                            EDITAR  </button>
                                            `;
        //botonesProducto = botonesProducto + btnDarBaja;
        btnAgregarSubprod =
            ` <button class="btn btn-outline-primary " onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')">
                                             <img src="{{ asset('img/agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                                             AGREGAR A SUBPRODUCTO </button>`;
    }
    let costo = productosSucursal.find(p => p.id == idProdSuc).costo;
    let precio = productosSucursal.find(p => p.id == idProdSuc).precio;
    let existencia = productosSucursal.find(p => p.id == idProdSuc).existencia;
    datosProduct = `<div class="col-12 mx-auto">
                                <fieldset disabled id="formEditar">
                                    <form id="editarProducto">
                                        <div class="form-group row">
                                            <!--El name debe ser igual al de la base de datos-->
                                            <label for="codigoBarras" class="col-4 col-form-label">
                                                <h6 class=""> {{'CODIGO DE BARRAS'}}</h6>
                                            </label>
                                            <div class="col-8">
                                                <input type="text" name="codigoBarras" id="codigoBarras" class="form-control text-uppercase "
                                                placeholder="Ingresar codigo de barras" value="${producto.codigoBarras}"
                                                required autocomplete="codigoBarras" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nombre" class="col-4 col-form-label">
                                                <h6 class="">{{'NOMBRE'}}</h6>
                                            </label>
                                            <div class="col-8">
                                                <input type="text" name="nombre" id="nombre" class="form-control text-uppercase" 
                                                placeholder="Nombre productos" value="${producto.nombre}" autofocus required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="descripcion" class="col-4 col-form-label">
                                                <h6  class=""> {{'DESCRIPCION'}} </h6>
                                            </label>
                                            <div class="col-8">
                                                <textarea name="descripcion" id="descripcion" class="form-control text-uppercase" 
                                                placeholder="Descripcion del producto" rows="3" cols="23" 
                                                required>${producto.descripcion}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="minimoStock" class="col-4 col-form-label">
                                                <h6  class=""> {{'MINIMO STOCK'}}</h6>
                                            </label>
                                            <div class="col-8">
                                                <input type="number" name="minimoStock" id="minimoStock" min="0" onkeypress="return validarEnteroPosi(event);" 
                                                class="form-control text-uppercase" placeholder="Ingrese el minimo de productos permitidos" value="${ms}" autofocus required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="receta" class="col-4 col-form-label">
                                                <h6  class=""> {{'RECETA MEDICA'}} </h6>
                                            </label>
                                            <div class="col-8">
                                                <select class="form-control text-uppercase" name="receta" id="receta">
                                                ${receta}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="departamento" class="col-4 col-form-label">
                                                <h6  class=""> {{'DEPARTAMENTO'}}</h6>
                                            </label>
                                            <div class="col-8">
                                                <select class="form-control text-uppercase" name="departamento" 
                                                id="departamento">${departamentos}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="imagen" class="col-4 col-form-label">
                                                <h6 class=""> <strong>{{'FOTO'}}</strong></h6>
                                            </label>
                                            <div class="col-8">
                                                ${cuerpoImagen}
                                            </div>
                                        </div>
                                    </form>
                                    <div class="">
                                        <div class="form-group row">
                                            <label for="costoNuevo" class="col-4 col-form-label">
                                                <h6 class="">COSTO</h6> 
                                            </label> 
                                            <div class="col-8">      
                                                <input type="number" name="costoNuevo" min="0" id="costoNuevo" class="form-control"
                                                placeholder="COSTO NUEVO" onkeypress="return validarPositivos(event);" 
                                                value="${costo}" autofocus required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="precioNuevo" class="col-4 col-form-label">
                                                <h6 class="">PRECIO</h6> 
                                            </label>      
                                            <div class="col-8">  
                                                <input type="number" name="precioNuevo" id="precioNuevo" min="0" class="form-control"
                                                placeholder="PRECIO NUEVO" onkeypress="return validarPositivos(event);"
                                                value="${precio}" autofocus required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cantidadNueva" class="col-4 col-form-label">
                                                <h6 class="">EXISTENCIA</h6> 
                                            </label> 
                                            <div class="col-8">              
                                                <input type="number" name="cantidadNueva" id="cantidadNueva" class="form-control"
                                                placeholder="CANTIDAD DE PRODUCTO" onkeypress="return validarEnteroPosi(event);" 
                                                value="${existencia}" min="0" autofocus required>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>`;
    let btnCerrar = `<button type="button" class="btn btn-secondary ml-4" 
    data-dismiss="modal" onclick="">CERRAR</button>`;
    //document.getElementById("subAgregar").innerHTML = btnAgregarSubprod;
    document.getElementById("pieInformacion").innerHTML = btnAgregarSubprod + btnEditar + btnDarBaja + btnCerrar;
    document.getElementById("resultados").innerHTML = datosProduct;
};

function modificarPrecio(idSP) {
    let cambiarPrecio = "";
    let idProd = 0;
    let idSucPro = 0;
    let nombreProd = "";
    let bandera = true;

    for (let j in productosSucursal) {
        if (bandera) {
            if (productosSucursal[j].id === idSP) {
                bandera = false;
                idProd = productosSucursal[j].idProducto;
                idSucPro = productosSucursal[j].id;
                let band_prod = true;
                for (let x in productos) {
                    if (band_prod) {
                        if (productos[x].id == idProd)
                            nombreProd = productos[x].nombre;
                        band_prod = false;
                    }
                }
                cambiarPrecio =
                    `
                                <h6>PRECIO ACTUAL DEL PRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center" placeholder="" value="` +
                    productosSucursal[j].precio + `" autofocus required disabled>
                                <h6 >INGRESAR NUEVO PRECIO DEL PRODUCTO</h6>        
                                <input type="number"   name="precio_nuevo" id="precio_nuevo" class="form-control text-center" placeholder="PRECIO NUEVO" onkeypress="return filterFloat(event,this);" value="" autofocus required>
                                    `;
            }
        }

    }
    let btnGuardar = document.getElementById("actPrecio2");
    btnGuardar.value = idSucPro;
    // $("#actPrecioCosto").removeAttr('onclick');
    /*
    $("#actPrecioCosto").click(function() {
        
    });
    */
    document.getElementById("titulo").innerHTML = nombreProd;
    document.getElementById("modiPrecio").innerHTML = cambiarPrecio;
    /*
    $("input[name='precio_nuevo']").bind('keypress', function(tecla) {
        let code = tecla.charCode;
      //  let tam = document.getElementById("precio_nuevo");
        //let tam2= tam.value.length;
        if (code == '.') { // backspace.
            return true;
        } else {
            return false;
        }
    });
    */



    /*
        $(document).ready(function() {
            $("#precio_nuevo").keyup(function() {
                $(this).val(parseFloat($(this).val()).toFixed(2));
            });
        });

    }
    */
};

function modificarCosto(idSP) {
    let cambiarCosto = "";
    let idProd = 0;
    let idSucPro = 0;
    let nombreProd = "";
    for (let j in productosSucursal) {
        if (productosSucursal[j].id === idSP) {
            idProd = productosSucursal[j].idProducto;
            idSucPro = productosSucursal[j].id;
            for (let x in productos) {
                if (productos[x].id == idProd)
                    nombreProd = productos[x].nombre;
            }
            cambiarCosto =
                `
                                <h6>COSTO ACTUAL DEL PRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center " placeholder="" value="` +
                productosSucursal[j].costo + `" autofocus required disabled>
                                <h6>INGRESAR NUEVO COSTO DEL PRODUCTO</h6>        
                                <input type="number" name="costo" id="costo_nuevo" class="form-control text-center" placeholder="COSTO NUEVO" onkeypress="return filterFloat(event,this);" value="" autofocus required>
                                    `;
        }
        /*
        $("#actPrecioCosto").click(function() {
            actCosto(idSucPro);
        });
        */
        let btnGuardar2 = document.getElementById("actCosto2");
        btnGuardar2.value = idSucPro;

        // document.getElementById("modiPrecioCosto").innerHTML = cambiarCostoPrecio;
        document.getElementById("titulo2").innerHTML = nombreProd;
        document.getElementById("modiCosto").innerHTML = cambiarCosto;
        /*
            $("input[name='costo']").bind('keypress', function(tecla) {
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
            */
    }
}

function cambiarEProducto(idSP) {

    let cambiarCantidad = "";
    let idProd = 0;
    let idSucPro = 0;
    let nombreProd = "";
    for (let j in productosSucursal) {
        if (productosSucursal[j].id === idSP) {
            idProd = productosSucursal[j].idProducto;
            idSucPro = productosSucursal[j].id;
            for (let x in productos) {
                if (productos[x].id == idProd)
                    nombreProd = productos[x].nombre;
            }
            cambiarCantidad =
                `
                                <h6>EXISTENCIA ACTUAL DEL PRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center " placeholder="" value="` +
                productosSucursal[j].existencia + `" autofocus required disabled>
                                <h6>CANTIDAD DE PRODUCTO TOTAL</h6>        
                                <input type="number" name="cantidad" id="cantidad" class="form-control text-center" placeholder="CANTIDAD DE PRODUCTO" value="" min="0" autofocus required>
                                    `;
        }
    }
    let btnGuardar3 = document.getElementById("actPrecioCosto3");
    btnGuardar3.value = idSucPro;

    // document.getElementById("modiPrecioCosto").innerHTML = cambiarCostoPrecio;
    document.getElementById("titulo3").innerHTML = nombreProd;
    document.getElementById("modiPrecioCosto3").innerHTML = cambiarCantidad;
    $("input[name='cantidad']").bind('keypress', function(tecla) {
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
};

function agregarEProducto(idSP) {

    let agregarCantidad = "";
    let idProd = 0;
    let idSucPro = 0;
    let nombreProd = "";
    for (let j in productosSucursal) {
        if (productosSucursal[j].id === idSP) {
            idProd = productosSucursal[j].idProducto;
            idSucPro = productosSucursal[j].id;
            for (let x in productos) {
                if (productos[x].id == idProd)
                    nombreProd = productos[x].nombre;
            }
            agregarCantidad =
                `
                        <h6>EXISTENCIA ACTUAL DEL PRODUCTO</h6>
                        <input type="number" name="" id="" class="form-control mb-2 text-center " placeholder="" value="` +
                productosSucursal[j].existencia + `" autofocus required disabled>
                        <h6>CANTIDAD DE PRODUCTO A AGREGAR</h6>        
                        <input type="number" name="cantidadA" id="cantidadA" class="form-control text-center" placeholder="CANTIDAD DE PRODUCTO" value="0" min="0" autofocus required>
                            `;
        }
    }
    let btnGuardar3 = document.getElementById("modificarExisAgregar");
    btnGuardar3.value = idSucPro;

    // document.getElementById("modiPrecioCosto").innerHTML = cambiarCostoPrecio;
    document.getElementById("tituloExistAgregar").innerHTML = nombreProd;
    document.getElementById("modiExistAgregar").innerHTML = agregarCantidad;
    $("input[name='cantidadA']").bind('keypress', function(tecla) {
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
};

function agregarSubproducto(idSP) {
    let cambiarCantidad = "";
    let idProd = 0;
    let idSucPro = 0;
    let nombreProd = "";
    let pS = productosSucursal.find(s => s.id == idSP);
    let subp = subproductos.find(s => s.idSucursalProducto == idSP);

    //for (let j in productosSucursal) {
    //if (productosSucursal[j].id === idSP) {
    //for (let t in subproductos) {
    //if (subproductos[t].idSucursalProducto == idSP) {
    idProd = pS.idProducto; //productosSucursal[j].idProducto;
    idSucPro = pS.id; //productosSucursal[j].id;
    let p = productos.find(s => s.id == idProd);
    //for (let x in productos) {
    //if (productos[x].id == idProd)
    nombreProd = p.nombre; //productos[x].nombre;
    //}
    cambiarCantidad =
        `
                                <h6>EXISTENCIA ACTUAL DEL SUBPRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center " placeholder="" value="` +
        subp.existencia + `" autofocus required disabled>
                                <h6 class="mx-auto text-center">NUEVA EXISTENCIA</h6>        
                                <input type="number" name="cantPiezasSub" id="cantPiezasSub" class="form-control text-center" placeholder="PIEZAS DEL SUBPRODUCTO" value="" min="0" autofocus required>
                                    `;
    //}
    //}
    //}
    //}
    /*
    $("#volverInfo4").click(function() {
        infoSubproducto(idSucPro);
    });
    */


    let btnGuardar3 = document.getElementById("btnNueva_Exis_Sub");
    btnGuardar3.value = idSucPro;

    // document.getElementById("modiPrecioCosto").innerHTML = cambiarCostoPrecio;
    document.getElementById("titulo5").innerHTML = nombreProd;
    document.getElementById("exis_Nuevo_Subprod").innerHTML = cambiarCantidad;
    /*$("input[name='cantPiezasSub']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });*/
}


async function actPrecio(idSucProd) {
    //let btnGuardar = document.getElementById("actPrecio2");
    //let idSucProd = btnGuardar.value;
    try {
        //return alert(idSucProd);
        //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
        //const precio = document.querySelector('#precio_nuevo');
        const precio = document.querySelector('#precioNuevo');

        if (precio.value.length === 0)
            return alert('EL PRECIO NO SE ACTUALIZO CORRECTAMENTE');
        /*if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
        let funcion = $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `/puntoVenta/productoSuc/actPrecio/${idSucProd}`,
            // los datos que voy a enviar para la relación
            data: {
                precio: parseFloat(precio.value),
                _token: "{{ csrf_token() }}"
                //  id: idSucProd
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //$('#modal_precio2').modal('hide');

            //alert(respuesta);
            console.log(respuesta); //JSON.stringify(respuesta));
        });
        //alert("PRECIO ACTUALIZADO CORRECTAMENTE");
        //await act_datos();
        //await buscarFiltroNombre2();

        document.getElementById(`precio${idSucProd}`).textContent = precio.value;
        productosSucursal.find(p => p.id == idSucProd).precio = precio.value;
        actualizarCabecera();
        // refrescar();
        // await cargarProductosSucursal();
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};
async function act_datos() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`/puntoVenta/act_inventario`);
        if (response.ok) {
            //productosSucursal = await response.json();
            let datos = await response.json();
            productosSucursal = datos['productosSucursal'];
            subproductos = datos['subproducto']
        } else {
            console.log("No responde :v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: X " + err.message);
    }
};

async function actCosto(idSucProd) {
    //let btnGuardar = document.getElementById("actCosto2");
    //let idSucProd = btnGuardar.value;
    try {
        //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
        //const costo = document.querySelector('#costo_nuevo');
        const costo = document.querySelector('#costoNuevo');

        if (costo.value.length === 0)
            return alert('EL COSTO NO SE ACTUALIZO CORRECTAMENTE');
        /*if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
        let funcion = $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `/puntoVenta/productoSuc/actCosto/${idSucProd}`,
            // los datos que voy a enviar para la relación
            data: {
                costo: parseFloat(costo.value),
                _token: "{{ csrf_token() }}"
                //  id: idSucProd
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            //console.log(respuesta); //JSON.stringify(respuesta));
        });
        //$('#modal_costo').modal('hide');
        //alert("COSTO ACTUALIZADO CORRECTAMENTE");
        // refrescar();
        //await act_datos();
        //await buscarFiltroNombre2();

        document.getElementById(`costo${idSucProd}`).textContent = costo.value;
        productosSucursal.find(p => p.id == idSucProd).costo = costo.value;
        actualizarCabecera();
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }

}

async function actExistencia(idSucProd) {

    //let btnGuardar = document.getElementById("actPrecioCosto3");
    //let idSucProd = btnGuardar.value;
    try {
        //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
        const existencia = document.querySelector('#cantidadNueva');
        /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
        let funcion = $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "post",
            // la URL de donde voy a hacer la petición
            url: `/puntoVenta/productoSuc/actExistencia/${idSucProd}`,
            // los datos que voy a enviar para la relación
            data: {
                cantidad: parseInt(existencia.value),
                _token: "{{ csrf_token() }}"
                //  id: idSucProd
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            console.log(respuesta); //JSON.stringify(respuesta));
        });
        //$('#modal_existencia').modal('hide');
        //alert("EXISTENCIA MODIFICADO CORRECTAMENTE");
        //  refrescar();
        //await act_datos();
        //await buscarFiltroNombre2();

        console.log(document.getElementById(`existenciaP${idSucProd}`));
        document.getElementById(`existenciaP${idSucProd}`).textContent = parseInt(existencia.value);
        productosSucursal.find(p => p.id == idSucProd).existencia = parseInt(existencia.value);
        actualizarCabecera();
        //productosList.find(p => p.id == idSucProd).existencia = parseInt(existencia.value);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};


async function agregarExistencia() {

    let btnGuardar = document.getElementById("modificarExisAgregar");
    let idSucProd = btnGuardar.value;
    try {
        //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
        const existencia = document.querySelector('#cantidadA');
        /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
        let funcion = $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "post",
            // la URL de donde voy a hacer la petición
            //  url: `/puntoVenta/productoSuc/actExistencia/${idSucProd}`,
            url: `/puntoVenta/productoSuc/agregarExistencia/${idSucProd}`,

            // los datos que voy a enviar para la relación
            data: {
                cantidad: parseInt(existencia.value),
                _token: "{{ csrf_token() }}"
                //  id: idSucProd
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            console.log(respuesta); //JSON.stringify(respuesta));
        });
        $('#modal_existenciaAgregar').modal('hide');
        alert("EXISTENCIA AGREGADO CORRECTAMENTE");
        //  refrescar();
        //await act_datos();
        //await buscarFiltroNombre2();

        console.log(document.getElementById(`existenciaP${idSucProd}`));
        let existenciaActual = productosSucursal.find(p => p.id == idSucProd).existencia;
        document.getElementById(`existenciaP${idSucProd}`).textContent = parseInt(existenciaActual) + parseInt(
            existencia.value);
        productosSucursal.find(p => p.id == idSucProd).existencia = parseInt(existenciaActual) + parseInt(existencia
            .value);
        actualizarCabecera();
        //productosList.find(p => p.id == idSucProd).existencia = parseInt(existencia.value);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};

async function agregarSubprod() {

    let btnGuardar = document.getElementById("btnNueva_Exis_Sub");
    let idSucProd = btnGuardar.value;
    console.log('idprodS', idSucProd);
    try {
        //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
        const costo = document.querySelector('#cantPiezasSub');
        /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
        let funcion = $.ajax({
            // metodo: puede ssubProdExisNuevoer POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `/puntoVenta/subProdExisNuevo/${idSucProd}`,
            // los datos que voy a enviar para la relación
            data: {
                cantidad: parseFloat(costo.value),
                _token: "{{ csrf_token() }}"
                //  id: idSucProd
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            console.log(respuesta); //JSON.stringify(respuesta));
        });
        $('#modal_Exis_Nuevo').modal('hide');
        // $('#detalleProducto').modal('hide');
        alert("EXISTENCIA AGREGADO EN SUBPRODUCTO CORRECTAMENTE");
        //refrescar();
        //await act_datos();
        //await buscarFiltroNombre2();

        document.getElementById(`subpExistencia${idSucProd}`).textContent = parseInt(costo.value);
        //document.getElementById(`cantProdSub`).textContent = costo.value;

        subproductos.find(p => p.idSucursalProducto == idSucProd).existencia = parseInt(costo.value);
        actualizarCabecera();
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function agregarExistenciaDeProducto(idSucProd) {
    try {
        let confirmacion = confirm('¿AGREGAR EXISTENCIAS DESCONTANDO DE INVENTARIO?');
        if (!confirmacion)
            return;
        let respuesta = null;
        let aux = document.getElementById(`btnSubstraer`).outerHTML;
        document.getElementById(`btnSubstraer`).outerHTML = 
        `<button id="btnSubstraer" class="btn btn-info" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                ESPERE POR FAVOR
        </button>`;
        let response = await fetch(`{{url('/puntoVenta/subProdExisStock')}}/${idSucProd}`);
        if (response.ok) {
            respuesta = await response.json();
            document.getElementById(`btnSubstraer`).outerHTML = aux;
            console.log('false: ', false);
            console.log('la respuesta si el producto confirmó es: ', respuesta);
            if (respuesta)
            {
                let sp = subproductos.find(p => p.idSucursalProducto == idSucProd);
                let nuevaExistencia = sp.existencia + sp.piezas;
                subproductos.find(p => p.idSucursalProducto == idSucProd).existencia = nuevaExistencia;
                let etiqueta0 = document.getElementById(`subpExistencia${idSucProd}`);
                if(etiqueta0!=null)
                    etiqueta0.textContent = nuevaExistencia;
                let pS = productosSucursal.find(p => p.id == idSucProd);
                let nExistencia = pS.existencia - 1;
                productosSucursal.find(p => p.id == idSucProd).existencia = nExistencia;
                let etiqueta = document.getElementById(`existenciaP${idSucProd}`);
                if(etiqueta!=null)
                    etiqueta.textContent = nExistencia;
                actualizarCabecera();
                return alert('LAS PIEZAS DE UN PRODUCTO SE HA DESCONTADO PARA AGREGAR AL SUBPRODUCTO');
            }
            return alert('EL PRODUCTO NO TIENE EXISTENCIA EN INVENTARIO');
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
    /*let spp = await $.ajax({
    // metodo: puede ser POST, GET, etc
    method: "POST",
    // la URL de donde voy a hacer la petición
    url: '/puntoVenta/sucursalProducto',
    // los datos que voy a enviar para la relación
    data: {
        datos: JSON.stringify(productos0),
        //_token: $("meta[name='csrf-token']").attr("content")
        _token: "{{ csrf_token() }}",
    }
    });*/
}

/*function editarSubproducto()
{
    document.getElementById(`btnEditarSubp`);
}*/

function infoSubproducto(id) {
    //Modal
    //let x1= 0;
    let datosProduct = "";
    // let imagen = "";
    //  let departamento = "";
    // let ms = 0;
    for (let j in productosSucursal) {
        for (let h in subproductos) {
            if (subproductos[h].idSucursalProducto == productosSucursal[j].id) {
                for (count10 in productos) {
                    if (productos[count10].id === productosSucursal[j].idProducto) {

                        if (productos[count10].id === id) {


                            //  x1 = productos[count10].id;
                            let x = productosSucursal[j].id;
                            datosProduct =
                                `
                                    <!--div class="col-3">
                                    <br/>
                                            <label for="Nombre">
                                                <h6  class="ml-4 ">{{'NOMBRE'}}</h6>
                                            </label>
                                            <br/>
                                            <label for="Receta">
                                                <h6  class="ml-4"> {{'RECETA MEDICA'}} </h6>
                                            </label>
                                            <br/>
                                            <label for="Piezas">
                                                <h6  class="ml-4 mt-1"> {{'PIEZAS'}} </h6>
                                            </label>
                                            <br/>
                                            <label for="precioSubp">
                                                <h6  class="ml-4 mt-1"> {{'PRECIO'}} </h6>
                                            </label>
                                            <br />
                                            <label for="Receta">
                                                <h6  class="ml-4 mt-1"> {{'OBSERVACION'}} </h6>
                                            </label>
                                            <br />
                                        </div-->
                                        <div class="col-8">
                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-3 col-form-label">
                                                    <h6 class="ml-4">NOMBRE</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="nombre" id="nombre" class="form-control text-uppercase"
                                                    placeholder="NOMBRE PRODUCTOS" value="${productos[count10].nombre}" 
                                                    required readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="receta" class="col-sm-3 col-form-label">
                                                    <h6 class="ml-4">RECETA</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control text-uppercase" name="receta" id="receta" disabled>
                                                        <option value="" selected>${productos[count10].receta}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="piezas" class="col-sm-3 col-form-label">
                                                    <h6 class="ml-4">PIEZAS</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="piezas" id="piezas" class="form-control text-uppercase"
                                                     placeholder="PIEZAS" value="${subproductos[h].piezas}" required disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="precioSubp" class="col-sm-3 col-form-label">
                                                    <h6 class="ml-4">PRECIO</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="precioSubp" id="precioSubp" class="form-control text-uppercase"
                                                     placeholder="PRECIO" value="${subproductos[h].precio}" required disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="observacion" class="col-sm-3 col-form-label">
                                                    <h6 class="ml-4">OBSERVACION</h6>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="observacion" id="observacion" class="form-control text-uppercase" 
                                                    placeholder="OBSERVACION" value="${subproductos[h].observacion}" required disabled>
                                                </div>
                                            </div>
                                            <div class="row col-auto mx-0 px-0">
                                                <button type="button" id="btnEditarSubp"class="btn btn-secondary ml-auto">EDITAR SUBPRODUCTO</button>
                                            </div>
                                            <!--El name debe ser igual al de la base de datos-->
                                            <br />
                                            <!--input type="text" name="nombre" id="nombre" class="form-control text-uppercase" placeholder="NOMBRE PRODUCTOS" value="` +
                                productos[count10].nombre + ` " autofocus required disabled-->
                                            <!--br />
                                             <select class="form-control text-uppercase" name="Receta" id="Receta"  disabled>
                                                <option value="" selected>` + productos[count10].receta +
                                ` </option>
                                            </select>
                                            <br />
                                            <input type="text" name="piezas" id="piezas" class="form-control text-uppercase" placeholder="PIEZAS" value="` +
                                subproductos[h].piezas +
                                ` " autofocus required disabled>
                                            <br/>
                                            <input type="text" name="precioSubp" id="precioSubp" class="form-control text-uppercase" placeholder="PRECIO" value="` +
                                subproductos[h].precio +
                                ` " autofocus required disabled>
                                            <br/>
                                            <input type="text" name="observacion" id="observacion" class="form-control text-uppercase" placeholder="OBSERVACION" value="` +
                                subproductos[h]
                                .observacion +
                                ` " autofocus required disabled>
                                            <br /-->
                                        </div>
                                        <div class="col-4 text-center">
                                            <br /><br />
                                            <a class="btn btn-outline-danger mb-4" data-method="delete" onclick="return confirm('¿DESEA ELIMINAR ESTE PRODUCTO?')"  href="{{ url('/puntoVenta/subproductoEli/` +
                                x +
                                `')}}"> 
                                            <img src="{{ asset('img/eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                             ELIMINAR </a> 
                                             <div class="mt-4 mb-4"> </div>
                                             <button class="btn btn-outline-primary" id="btnSubstraer" onclick="agregarExistenciaDeProducto(${x})"> 
                                            <img src="{{ asset('img/nuevoReg.png') }}" alt="Editar" width="25px" height="25px">
                                              EXISTENCIA INVENTARIO </button> 
                                            <br/><br/>  
                                            
                                              <button type="button" class="btn btn-outline-primary mb-4 " data-toggle="modal" href=".modal_Exis_Nuevo"  onclick=" return agregarSubproducto( ` +
                                x + `)" value="` + x + `">
                                              <img src="{{ asset('img/nuevoReg.png') }}" alt="Editar" width="25px" height="25px">
                                              ACTUALIZAR EXISTENCIA
                                            </button>
                                              @error('mensajeError')
                                                <div class="alert alert-danger my-auto" role="alert">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                        </div>
                                        <br/>
                                    `;
                        }
                    }
                }
            }
        }
    }
    let btnCerrar = `<button type="button" class="btn btn-secondary ml-4" 
    data-dismiss="modal" onclick="">CERRAR</button>`;
    document.getElementById("subAgregar").innerHTML = "";
    document.getElementById("pieInformacion").innerHTML = btnCerrar;
    document.getElementById("resultados").innerHTML = datosProduct;
};

function refrescar() {
    //console.log("refrescar");
    location.reload();
};

async function subproductoExiste(idSucProd, id) {

    let preguntar = confirm("¿AGREGAR SUBPRODUCTO?");
    if (preguntar) {
        let response = "Sin respuesta";
        let response2 = "Sin respuesta";
        let subproducto = subproductos.find(p => p.idSucursalProducto == idSucProd);
        if (subproducto != null)
            return alert("Este producto ya está activo en subproducto y no se puede volver a agregar");
        window.location = `/puntoVenta/subproducto/create/?id=${id}`;

        /*try {
            response = await fetch(`/puntoVenta/veriUniqueSubproducto/?id=${id}`);
            if (response.ok) {
                Suc_Inac = await response.json();
                // let idProd =Suc_Inac['idProd'];
                let productosNue = Suc_Inac['producto'];
                let producto_sucursal = Suc_Inac['productosSucursal']; //retornar 1 dato
                let subproductos = Suc_Inac['subproducto'];
                let bandera = true;
                //producto = producto_sucursal.find(p => p.id == sucursalP.idProducto);
                console.log('producto_sucursal',producto_sucursal);
                console.log('subproductos',subproductos);
                return;
                for (let y in producto_sucursal) {
                    for (let x in subproductos) {
                        if (subproductos[x].idSucursalProducto == producto_sucursal[y].id) {
                            bandera = false;
                            // return redirect(`/puntoVenta/subproducto/actExistencia/?idSucProd=${producto_sucursal[y].id}`);
                            return alert(
                                "Este producto ya está activo en subproducto y no se puede volver a agregar");
                        }
                    }
                }
                if (bandera) {
                    //console.log(`{url("/puntoVenta/subproducto/create/?id=${id}")}}`);
                    window.location = `/puntoVenta/subproducto/create/?id=${id}`;
                    //redirect(id);
                    // response2 = await fetch(`/puntoVenta/subproducto/create/?id=${id}`);
                }
                //console.log(Suc_Inac);
            } else {
                // Suc_Inac = "";
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }*/
    }
};



function redirect(id) {
    window.location = `/puntoVenta/subproducto/create/?id=${id}`;
}


async function productosEnBajaSucursal() {
    let cuerpo = "";
    let cont = 0;
    await productos0();
    //console.log(prod_baja);
    for (let t in prod_baja) {
        let producto = productos.find(p => p.id == prod_baja[t].idProducto);
        if (producto != null) {
            // for (let x in productos) {
            //if (productos[x].id === prod_baja[t].idProducto) {
            cont = cont + 1;
            let btnAlta = `<a class="btn btn-primary" href="{{ url('/puntoVenta/altaProducto/` + producto.id +
                `')}}"> ALTA </a>`;
            if (!modificarProducto)
                btnAlta =
                `<button class="btn btn-primary" onclick="return alert('NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')" > ALTA </button>`;
            cuerpo = cuerpo + `
                    <tr>
                    <th >` + cont + `</th>
                    <td>` + producto.codigoBarras + `</td>
                    <td>` + producto.nombre + `</td>
                    <td>` + producto.descripcion + `</td>
                    <td>` + producto.idDepartamento + `</td>
                    <td>` + producto.receta + `</td>
                    <td>` + btnAlta +
                ` 
                    </td>        
                    </tr>
                     `;
        }
    }
    if (cuerpo === "") {
        let sin = ` <h4 class= "text-dark my-auto"> NO HAY PRODUCTOS DADOS DE BAJA EN ESTA SUCURSAL </h4>`;
        document.getElementById("vacio").innerHTML = sin;
    } else {
        document.getElementById("filaTablas").innerHTML = cuerpo;
    }
};
//reucperar sucursales inactivas
async function productos0() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`/puntoVenta/productos_baja`);
        if (response.ok) {
            prod_baja = await response.json();
        } else {
            console.log("No responde :v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};

async function getInventarioRapido() {

    try {
        let cantidad = document.getElementById("cantidadProductos").value;
        //return alert(cantidad);
        if (cantidad.length == 0)
            return alert('INGRESE UNA CANTIDAD VALIDA PARA CONTINUAR')
        if (cantidad <= 0)
            return alert('INGRESE UNA CANTIDAD VALIDA PARA CONTINUAR')
        let respuesta = await fetch(`/puntoVenta/inventarioRapido/${cantidad}`);
        productosRapidos = await respuesta.json();
        mostrarInventarioRapido()
        $('#modalPeticionInventario').modal('hide');

        $('#modalInventarioRapido').modal('show');
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

function mostrarInventarioRapido() {
    let cuerpoModal = document.getElementById("cuerpoInventarioRapido");
    let cuerpo = `<table class="table">
            <thead>
            </thead>
            <tbody>`;
    for (let i in productosRapidos) {
        cuerpo = cuerpo + `
                <tr>
                    <td>` + productosRapidos[i].nombre + `</td>
                    <td>` + productosRapidos[i].existencia + `</td>
                    <td><input type="number" class="form-control" placeholder="CANTIDAD" onchange="validarCantidad(${i})"
                    id="nuevaExistencia${i}" aria-describedby="basic-addon1" min="1" pattern="^[0-9]+"></td>
                    <td><button type="button" class="btn btn-primary " onclick="actualizar(${i})">ACTUALIZAR</button></td>
                    <td><button type="button" class="btn btn-warning" onclick="ignorar(` + i + `)">IGNORAR</button></td>
                </tr>
                `;
    }
    cuerpo = cuerpo + `</tbody></table>`;
    cuerpoModal.innerHTML = cuerpo;
}

function restaurarPeticionInventario() {
    document.getElementById("cantidadProductos").value = "";
}

function ignorar(i) {
    productosRapidos.splice(i, 1);
    if (productosRapidos.length == 0)
        $('#modalInventarioRapido').modal('hide');
    else
        mostrarInventarioRapido();
}

function validarCantidad(i) {
    let valor = document.getElementById(`nuevaExistencia${i}`).value;
    if (valor < 0) {
        document.getElementById(`nuevaExistencia${i}`).value = 0;
        return;
    }
    if (valor.indexOf(".") != -1)
        document.getElementById(`nuevaExistencia${i}`).value = valor.substring(0, valor.indexOf("."))
}

async function actualizar(i) {

    try {
        let existencia = document.getElementById(`nuevaExistencia${i}`).value;

        //console.log('lgExistencia',existencia.length);
        console.log('nuevaExistencia', existencia);

        if (existencia == undefined)
            return alert('INGRESE UNA CANTIDAD VALIDA');
        existencia = parseInt(existencia);
        let idSucProd = productosRapidos[i].id;
        if (productosRapidos[i].producto) {
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "post",
                // la URL de donde voy a hacer la petición
                url: `/puntoVenta/productoSuc/actExistencia/${idSucProd}`,
                // los datos que voy a enviar para la relación
                data: {
                    cantidad: existencia,
                    _token: "{{ csrf_token() }}"
                    //  id: idSucProd
                }
                // si tuvo éxito la petición
            }).done(function(respuesta) {

                console.log(respuesta); //JSON.stringify(respuesta));
                console.log('Es producto, su id es: ', idSucProd);
                productosSucursal.find(p => p.id == idSucProd).existencia = existencia;
                let etiqueta = document.getElementById(`existenciaP${idSucProd}`);
                if (etiqueta != null)
                    etiqueta.textContent = existencia;
                actualizarCabecera();
                ignorar(i);
            });
        } else {
            let funcion = $.ajax({
                // metodo: puede ssubProdExisNuevoer POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `/puntoVenta/subProdExisNuevo/${idSucProd}`,
                // los datos que voy a enviar para la relación
                data: {
                    cantidad: existencia,
                    _token: "{{ csrf_token() }}"
                    //  id: idSucProd
                }
                // si tuvo éxito la petición
            }).done(function(respuesta) {
                //alert(respuesta);
                console.log(respuesta); //JSON.stringify(respuesta));
                subproductos.find(p => p.idSucursalProducto == idSucProd).existencia = existencia;

                let etiqueta = document.getElementById(`subpExistencia${idSucProd}`);
                if (etiqueta != null)
                    etiqueta.textContent = existencia;
                actualizarCabecera();
                ignorar(i);
            });
        }
        //$('#modal_precio_venta3').modal('hide');
        alert("EXISTENCIA ACTUALIZADA CORRECTAMENTE");
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

function habilitarEditar(x, idSucProd) {
    let btnEditar = document.getElementById("btnEditar");
    if (btnEditar.value == "true") {

        document.getElementById("formEditar").disabled = false;
        document.getElementById("btnEditar").innerHTML =
            `<img src="{{ asset('img/guardar.png') }}" alt="Editar" width="25px" height="25px">
            GUARDAR CAMBIOS`;
        btnEditar.value = false;
    } else {

        editarProducto(x, idSucProd);
    }

}
async function editarProducto(x, idSucProd) {
    try {
        //return alert("ejecuta editarProducto");
        //let datosProducto = new FormData();
        const codigoBarras = document.getElementById("codigoBarras").value;
        const nombre = document.getElementById("nombre").value;
        const descripcion = $('#descripcion').val(); //document.getElementById("descripcion").value;
        const minimoStock = parseInt(document.getElementById("minimoStock").value);
        const receta = document.getElementById("receta").value;
        const departamento = parseInt(document.getElementById("departamento").value);
        const imagen = document.getElementById("imagen");
        const costo = document.getElementById("costoNuevo").value;
        const precio = document.getElementById("precioNuevo").value;
        const cantidad = document.getElementById("cantidadNueva").value;
        const formProducto = document.getElementById("editarProducto");
        var data = new FormData(formProducto);
        data.append('_token', "{{ csrf_token() }}");
        data.append('ajax', true);
        if (codigoBarras.length == 0 || nombre.length == 0 || minimoStock.length == 0 ||
            costo.length == 0 || precio.length == 0 || cantidad.length == 0) {
            return alert('EXISTE UN ERROR CON SUS DATOS, REVISELOS POR FAVOR');
        }
        console.log('datos', data);
        let spp = await $.ajax({
            //headers: {
            //'X-CSRF-TOKEN': "{{ csrf_token() }}",
            //'Access-Control-Allow-Origin', 'http://localhost:3000'
            //},
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `/puntoVenta/producto/editar/${x}`,
            // los datos que voy a enviar para la relación
            //dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            //mode: 'no-cors',
            data: data //{
                /*codigoBarras: codigoBarras,
                nombre: nombre,
                descripcion: descripcion,
                minimoStock: minimoStock,
                receta: receta,
                idDepartamento: departamento,
                imagen: imagen,
                '_token': "{{ csrf_token() }}",
                ajax: true

            }*/
                ,
            //_token: $("meta[name='csrf-token']").attr("content")
            //_token: "{{ csrf_token() }}",
            //processData: false,  // tell jQuery not to process the data
            //contentType: false
        });
        console.log(spp);
        actCosto(idSucProd);
        actPrecio(idSucProd);
        actExistencia(idSucProd);
        if (spp.length > 0)
            alert("DATOS ACTUALIZADOS CORRECTAMENTE");
        else
            return;
        //const consulta =  document.querySelector('#consultaBusqueda');
        document.getElementById(`codigo${x}`).textContent = codigoBarras;
        document.getElementById(`nombre${x}`).textContent = nombre;
        document.getElementById(`departamento${x}`).textContent = d.find(p => p.id == departamento).nombre;

        let productoSucursal = productosSucursal.find(p => p.idProducto == x)
        if (productoSucursal != null) {
            let subproducto = subproductos.find(p => p.idSucursalProducto == productoSucursal.id);
            if (subproducto != null) {
                document.getElementById(`scodigo${x}`).textContent = codigoBarras;
                document.getElementById(`snombre${x}`).textContent = nombre;
                document.getElementById(`sdepartamento${x}`).textContent = d.find(p => p.id == departamento).nombre;
            }
            let oferta = ofertas.find(p => p.idSucursalProducto == productoSucursal.id);
            if (oferta != null) {
                document.getElementById(`ocodigo${x}`).textContent = codigoBarras;
                document.getElementById(`onombre${x}`).textContent = nombre;
                document.getElementById(`odepartamento${x}`).textContent = d.find(p => p.id == departamento).nombre;
            }
        }
        //const indice = productos.indexOf(productos.find(p => p.id == x));
        // = nombre;
        productos.find(p => p.id == x).nombre = nombre;
        productos.find(p => p.id == x).codigoBarras = codigoBarras;
        productos.find(p => p.id == x).idDepartamento = departamento;
        productos.find(p => p.id == x).receta = receta;
        productos.find(p => p.id == x).minimoStock = minimoStock;
        productos.find(p => p.id == x).receta = receta;
        if (spp.length > 1)
            productos.find(p => p.id == x).imagen = spp;


        productosList.find(p => p.id == x).nombre = nombre;
        productosList.find(p => p.id == x).codigoBarras = codigoBarras;
        productosList.find(p => p.id == x).idDepartamento = departamento;
        productosList.find(p => p.id == x).receta = receta;
        productosList.find(p => p.id == x).minimoStock = minimoStock;
        productosList.find(p => p.id == x).receta = receta;
        if (spp.length > 1)
            productosList.find(p => p.id == x).imagen = spp;
        console.log('nombre', productos.find(p => p.id == x).nombre);
        //console.log('nombreIndice',productos[indice].nombre);
        document.getElementById("formEditar").disabled = true;
        document.getElementById("btnEditar").innerHTML =
            `<img src="{{ asset('img/edit.png') }}" alt="Editar" width="25px" height="25px">
              EDITAR`;
        btnEditar.value = true;
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }

};
//$('#tablaBusqueda').scrollTop() == $('#consultaBusqueda').height() - $('#tablaBusqueda').height()
$('#tablaBusqueda').scroll(function() {
    const comparacion = ($('#consultaBusqueda').height() - $('#tablaBusqueda').height() + $(
        '#cabeceraProductos').height())
    if ($('#tablaBusqueda').scrollTop() >= comparacion) { // - $('#tablaBusqueda').height()){
        //const cargando =  document.querySelector('#cargandoProductos')
        /*if(cargando!=null)
            cargando.remove();*/
        pagina++;
        setTimeout(rellenar, 500); //rellenar();

    }
    /*console.log('tablaBusqueda',$('#tablaBusqueda').scrollTop());
            console.log('tabla',$('#tablaBusqueda').height());
            console.log('consulta',$('#consultaBusqueda').height());
            console.log('cabecera',$('#cabeceraProductos').height());
            console.log('productos',$('#productos').height());
            console.log('comparacion',($('#consultaBusqueda').height()-$('#tablaBusqueda').height()+$('#cabeceraProductos').height()+32));
        */
});
//numeros enteros con dos decimales
//float dos decimales
function filterFloat(evt, input) {
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value + chark;
    if (key >= 48 && key <= 57) {
        if (filter(tempValue) === false) {
            return false;
        } else {
            return true;
        }
    } else {
        if (key == 8 || key == 13 || key == 0) {
            return true;
        } else if (key == 46) {
            if (filter(tempValue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}

function filter(__val__) {
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if (preg.test(__val__) === true) {
        return true;
    } else {
        return false;
    }

}

// Objeto Worker
let worker = new Worker("{{ asset('js/worker.js') }}"); // Ruta del archivo JS

function buscar() {
    if (window.Worker) {
        //src="{{ asset('js\bootstrap-input-spinner.js') }}"
        //var message = {mensaje:"Hola Worker"};
        worker.terminate();
        worker = new Worker("{{ asset('js/worker.js') }}");
        let seleccion = document.querySelector("input[name='checkbox2']:checked");
        //if(seleccion)
        let palabraBusqueda = document.querySelector('#busquedaProducto');
        let depa = document.querySelector('#idDepartamento');
        let bajosExis = document.querySelector('input[name="bajosExistencia"]:checked');
        if (bajosExis != null)
            bajosExis = bajosExis.value;
        else
            bajosExis = null;
        /*var message = {productos:productos,productosSucursal:productosSucursal,
        palabra:palabraBusqueda,seleccion:seleccion,depa:depa,bajosExis:bajosExis};*/
        //palabraBusqueda = JSON.stringify(palabraBusqueda);
        var message = {
            productos: productos,
            productosSucursal: productosSucursal,
            palabra: palabraBusqueda.value,
            seleccion: seleccion.value,
            depa: depa.value,
            bajosExis: bajosExis
        };

        worker.postMessage(message);
        worker.onmessage = function(e) {

            if (document.querySelector('#busquedaProducto').value == e.data.pal) {
                console.log("Iguales");
                //buscarFiltroNombre2();
                let auxProductos = productosList;
                productosList = e.data.respuesta;
                grupos = parseInt(productosList.length / numPorGrupo);
                pagina = 0;
                //actualizarCabecera();
                rellenar();
                productosList = auxProductos;
            } else {
                console.log(document.querySelector('#busquedaProducto').value);
                console.log(e.data.pal);
            }

            //console.log(e.data.respuesta);
        };
        //worker.terminate();
    }
}

/*var worker = new Worker('script/worker.js'); // Ruta del archivo JS

// Permite mandar mensajes al Worker
worker.postMessage("Hola Mundo!");
worker.postMessage(100);
worker.postMessage({status:1,error:['ping','pong']});
  
// Termina la ejecución del Worker (esté en el estado que esté)
worker.terminate();*/
function validarPositivos(e) {
    if (!((e.keyCode > 95 && e.keyCode < 106) ||
            (e.keyCode > 47 && e.keyCode < 58) ||
            e.keyCode == 8 || e.keyCode == 46)) {
        return false;
    }
}

function validarEnteroPosi(e) {
    if (!((e.keyCode > 95 && e.keyCode < 106) ||
            (e.keyCode > 47 && e.keyCode < 58) ||
            e.keyCode == 8)) {
        return false;
    }
}
</script>

@endsection