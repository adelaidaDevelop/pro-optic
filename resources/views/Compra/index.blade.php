@extends('header2')
@section('contenido')
@section('subtitulo')
COMPRAS
@endsection
@section('opciones')
<div class="col my-2 ml-5 pl-1">
    <form method="get" action="{{url('/compra/create/')}}">
        <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            CREAR COMPRA
        </button>
    </form>
</div>
@endsection
<!--div class="row p-1 "-->
<!--CONSULTAR PRODUCTO -->
<div class="row border border-dark my-2 ml-2 mr-2 pr-3">
    <div class="row col-12 mx-2 mt-2">
        <label for="">
            <h5 class="text-primary">
                <strong>
                    CONSULTAR COMPRA
                </strong>
            </h5>
        </label>
    </div>
    <div class="row col-12 ml-2 mr-0 mt-2">
        <div class="col-3 border border-primary mt-0 mb-4 ml-0">
            <label for="" class="col-form-label font-weight-bold">FILTRAR:</label>
            <select class="form-control my-2" name="opcionProveedor" id="opcionProveedor" onchange="filtrarCompras()"
                required>
                <option value="0">PROVEEDOR</option>
                @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor['nombre']}}"> {{$proveedor['nombre']}}</option>
                @endforeach
            </select>
            <!--div class="input-group">
                <div class="input-group-text">
                    <input type="checkbox" value="" id="pagado" checked>
                    <label class="ml-1 my-0" for="pagado">
                        PAGADO
                    </label>
                </div>
            </div-->
            <select class="form-control my-2" name="pagoCompra" id="pagoCompra" onchange="filtrarCompras()" required>
                <option value="0">ESTADO</option>
                <option value="pagado">PAGADO</option>
                <option value="credito">CREDITO</option>
            </select>
            <div class="form-group border border-secondary my-auto p-1">
                <div class="input-group-text">
                    <input type="checkbox" name="fechaCompra" id="fechaCompra" onchange="filtrarCompras()">
                    <label class="ml-1 my-0" for="fechaCompra">
                        FECHA COMPRA
                    </label>

                </div>
                <div class="input-group my-1 mx-0">
                    <div class="input-group-prepend">
                        <label for="fechaInicioC" class="input-group-text">DE: </label>
                    </div>
                    <input type="date" min="" id="fechaInicioC" onchange="filtrarCompras()" class="form-control" />
                </div>
                <div class="input-group my-1 mx-0">
                    <div class="input-group-prepend">
                        <label for="fechaFinalC" class="input-group-text">A: </label>
                    </div>
                    <input type="date" min="" onchange="filtrarCompras()" id="fechaFinalC" class="form-control" />
                </div>
            </div>
            <div class="form-group border border-secondary my-auto p-1">
                <div class="input-group-text">
                    <input type="checkbox" name="fechaRegistro" id="fechaRegistro" onchange="filtrarCompras()">
                    <label class="ml-1 my-0" for="fechaRegistro">
                        FECHA REGISTRO
                    </label>

                </div>
                <div class="input-group my-1 mx-0">
                    <div class="input-group-prepend">
                        <label for="fechaInicioR" class="input-group-text">DE: </label>
                    </div>
                    <input type="date" min="" id="fechaInicioR" onchange="filtrarCompras()" class="form-control" />
                </div>
                <div class="input-group my-1 mx-0">
                    <div class="input-group-prepend">
                        <label for="fechaFinalR" class="input-group-text">A: </label>
                    </div>
                    <input type="date" min="" onchange="filtrarCompras()" id="fechaFinalR" class="form-control" />
                </div>
            </div>
        </div>
        <!--
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    BAJOS DE EXISTENCIA
                </label>
            </div>
            -->
        <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
        <div class="col-9 border border-secondary mt-0 mb-4 ml-0 mr-0 pb-1">
            <div class="form-group row m-0 p-0">
                <div class="row col my-2 ml-0 p-0">
                    <div class="col input-group ml-0 px-0">
                        <!-- <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR PRODUCTO" id="texto">-->
                        <input type="text" class="form-control border-primary ml-0 mr-1" placeholder="BUSCAR COMPRA"
                            id="busquedaCompra" onkeyup="mostrarCompras()">
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>
                    <!--a title="buscar" href="" class="text-dark "-->
                    <img class="ml- p-1" src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar"
                        width="40px" height="40px" for="busquedaCompra" />
                    <!---/a-->
                    <!--div class="mt-2 mx-2"-->

                </div>
                <div class="row col my-2 ml-2 p-0" id="modoBusqueda">
                    <label for="modoBusqueda" class="mx-3 mt-2">
                        <h6> BUSCAR POR:</h6>
                    </label>

                    <!--div class="input-group-prepend m-0"-->
                    <div class="input-group-text my-auto">
                        <input type="radio" value="producto" onchange="seleccion()" name="btnRadio" id="btnProducto">
                        <label class="ml-1 my-0" for="btnProducto">PRODUCTO
                        </label>
                    </div>
                    <!--/div-->
                    <div class="input-group-text ml-1 my-auto">
                        <input type="radio" value="folio" onchange="seleccion()" name="btnRadio" id="btnFolio" checked>
                        <label class="ml-1 my-0" for="btnFolio">
                            FOLIO
                        </label>
                    </div>
                </div>
            </div>

            <!-- TABLA -->
            <div class="row mx-0 mt-0 mb-2 p-0 border border-dark" style="height:350px;overflow-y:auto;">
                <table class="table table-bordered table-bordered" id="productos">
                    <thead class="table-secondary text-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>FOLIO</th>
                            <th>PROVEEDOR</th>
                            <th>FECHA COMPRA</th>
                            <th>FECHA REGISTRO</th>
                            <th>ESTADO</th>
                            <th>COSTO TOTAL</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="consultaBusqueda">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!--/div-->

<!--POP UP-->
<div class="modal fade" id="detalleCompraModal" tabindex="-1" aria-labelledby="detalleCompraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="detalleCompraModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">COSTO</th>
                                <th scope="col">GANANCIA</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CADUCIDAD</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="detalle_compra">
                        </tbody>
                    </table>
                </div>
                <div class="row" id ="creditoCompra">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!--div class="modal fade" id="detalleCompraModal" tabindex="-1" aria-labelledby="detalleCompraModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="detalleCompraModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">COSTO</th>
                                <th scope="col">GANANCIA</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CADUCIDAD</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="detalle_compra">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div-->
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
const texto = document.querySelector('#ver');

function info($id) {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/producto/buscarProducto?texto=${$id}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
//texto.addEventListener('onclick', info);
</script>

<!-- SCRIPT-->

<script>
let productosVenta = [];
const compras = @json($compras);
const proveedores = @json($proveedores);
const compra_producto = @json($compra_producto);
const productos = @json($productos);
let comprasActuales = [];

let tipoBusqueda = "";

function cargarCompras() {
    //let contador = 1;
    comprasActuales = [];
    for (let i in compras) {
        //if (compras[i].id.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
        //if (compras[i].id == palabraBusqueda.value) {
        const fechaCreacion = new Date(compras[i].created_at);
        const fechaCompra = new Date(compras[i].fecha_compra)
        fechaCompra.setDate(fechaCompra.getDate() + 1);
        let proveedor = "";
        for (let p in proveedores) {
            if (proveedores[p].id === compras[i].idProveedor)
                proveedor = proveedores[p].nombre;
        }

        let costoTotal = 0;
        for (let p in compra_producto) {
            if (compra_producto[p].idCompras === compras[i].id) {
                let subtotal = parseFloat(compra_producto[p].cantidad) *
                    parseFloat(compra_producto[p].costo_unitario);
                costoTotal = parseFloat(costoTotal) + parseFloat(subtotal);
            }

        }
        let compra = {
            id: compras[i].id,
            proveedor: proveedor,
            fechaCompra: fechaCompra, //.toLocaleDateString(),
            fechaRegistro: fechaCreacion, //.toLocaleDateString(),
            estado: compras[i].estado,
            costoTotal: costoTotal
        };

        comprasActuales.push(compra);

        //}
    }


};
let comprasAuxiliar = []

function mostrarCompras() {
    const busquedaCompra = document.querySelector('#busquedaCompra');

    comprasAuxiliar = []; //comprasActuales;
    if (busquedaCompra.value.length > 0) {
        for (let i in comprasActuales) {

            if (tipoBusqueda === 'producto') {
                for (let p in productos) {
                    if (productos[p].nombre.toUpperCase().includes(busquedaCompra.value.toUpperCase())) {
                        for (let cp in compra_producto) {
                            if (compra_producto[cp].idProductos === productos[p].id) {
                                if (compra_producto[cp].idCompras === comprasActuales[i].id)
                                    if (!comprasAuxiliar.includes(comprasActuales[i]))
                                        comprasAuxiliar.push(comprasActuales[i]);
                            }
                        }
                    }
                }
            }
            if (tipoBusqueda === 'folio') {
                if (busquedaCompra.value == comprasActuales[i].id)
                    comprasAuxiliar.push(comprasActuales[i]);
            }

        }
    } else {
        comprasAuxiliar = comprasActuales;
    }

    filtrarCompras();

}
cargarCompras();
mostrarCompras();

function seleccion() {
    let btn = document.querySelector('input[name="btnRadio"]:checked');
    tipoBusqueda = btn.value;
    mostrarCompras();
    //console.log(btn);
    //alert(btn.value);
}
$('input[id="fechaInicioC"]').prop('disabled', true);
$('input[id="fechaFinalC"]').prop('disabled', true);
$('input[id="fechaInicioR"]').prop('disabled', true);
$('input[id="fechaFinalR"]').prop('disabled', true);

function comparacionFecha(fechaC, fechaI, fechaF) {
    if (fechaC.getFullYear() >= fechaI.getFullYear() && fechaC.getFullYear() <= fechaF.getFullYear()) {
        if (fechaC.getMonth() >= fechaI.getMonth() && fechaC.getMonth() <= fechaF.getMonth()) {
            if (fechaC.getDate() >= fechaI.getDate() && fechaC.getDate() <= fechaF.getDate())
                return true;
        }
    }
    return false;
}

function verificarFechasCompra() {
    let btn = document.querySelector('input[name="fechaCompra"]:checked');

    if (btn != null) {
        let fechaInicio = document.querySelector('#fechaInicioC');
        let fechaFin = document.querySelector('#fechaFinalC');
        $('input[id="fechaInicioC"]').prop('disabled', false);
        if (fechaInicio.value.length > 0) {
            fechaFin.min = fechaInicio.value;
            $('input[id="fechaFinalC"]').prop('disabled', false);

            if (fechaFin.value.length > 0) {
                let fechaI = new Date(fechaInicio.value);
                let fechaF = new Date(fechaFin.value);
                if (fechaI.getTime() > fechaF.getTime()) {
                    $("input[id='fechaFinalC']").val(fechaInicio.value);
                }
                return true;
            }
        }
    } else {
        $('input[id="fechaInicioC"]').prop('disabled', true);
        $('input[id="fechaFinalC"]').prop('disabled', true);
    }
    return false;
}

function verificarFechasRegistro() {
    let btn = document.querySelector('input[name="fechaRegistro"]:checked');

    if (btn != null) {
        let fechaInicio = document.querySelector('#fechaInicioR');
        let fechaFin = document.querySelector('#fechaFinalR');
        $('input[id="fechaInicioR"]').prop('disabled', false);
        if (fechaInicio.value.length > 0) {
            fechaFin.min = fechaInicio.value;
            $('input[id="fechaFinalR"]').prop('disabled', false);

            if (fechaFin.value.length > 0) {
                let fechaI = new Date(fechaInicio.value);
                let fechaF = new Date(fechaFin.value);
                if (fechaI.getTime() > fechaF.getTime()) {
                    $("input[id='fechaFinalR']").val(fechaInicio.value);
                }
                return true;
            }
        }
    } else {
        $('input[id="fechaInicioR"]').prop('disabled', true);
        $('input[id="fechaFinalR"]').prop('disabled', true);
    }
    return false;
}

seleccion();

function filtrarCompras() {
    let opcionProveedor = document.querySelector('#opcionProveedor');
    let opcionPago = document.querySelector('#pagoCompra');
    let comprasRespaldo = comprasActuales;
    let comprasAuxiliar2 = [];
    let cuerpo = "";
    let contador = 1;
    if (opcionProveedor.value != "0") {
        for (let i in comprasAuxiliar) {
            if (comprasAuxiliar[i].proveedor === opcionProveedor.value) {
                comprasAuxiliar2.push(comprasAuxiliar[i]);

            }
        }
        comprasAuxiliar = comprasAuxiliar2;
        comprasAuxiliar2 = [];
        /*for (let i in comprasAuxiliar2) {
            cuerpo = cuerpo + `
            <tr>
                <th scope="row">` + contador++ + `</th>
                <td>` + comprasAuxiliar2[i].id + `</td>
                <td>` + comprasAuxiliar2[i].proveedor + `</td>
                <td>` + comprasAuxiliar2[i].fechaCompra + `</td>
                <td>` + comprasAuxiliar2[i].fechaRegistro + `</td>
                <td>` + comprasAuxiliar2[i].estado + `</td>
                <td>` + comprasAuxiliar2[i].costoTotal + `</td>
                <td><button class="btn btn-light" onclick="verDetalleCompra(` +
                comprasAuxiliar2[i].id + `)" data-toggle="modal" data-target="#detalleCompraModal"
                type="button">VER MAS</button></td>
            </tr>
        `;
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        */
    }
    if (opcionPago.value != "0") {
        for (let i in comprasAuxiliar) {
            if (comprasAuxiliar[i].estado === opcionPago.value) {
                comprasAuxiliar2.push(comprasAuxiliar[i]);

            }

        }
        comprasAuxiliar = comprasAuxiliar2;
        comprasAuxiliar2 = [];
    }

    if (verificarFechasCompra()) {
        let fechaInicio = document.querySelector('#fechaInicioC');
        let fechaFin = document.querySelector('#fechaFinalC');
        let fechaI = new Date(fechaInicio.value);
        let fechaF = new Date(fechaFin.value);
        fechaI.setDate(fechaI.getDate() + 1);
        fechaF.setDate(fechaF.getDate() + 1);
        for (let i in comprasAuxiliar) {
            //
            let fechaC = comprasAuxiliar[i].fechaCompra;

            //if(fechaC.getTime()>=fechaI.getTime() && fechaC.getTime()<=fechaF.getTime())
            if (comparacionFecha(fechaC, fechaI, fechaF)) {
                comprasAuxiliar2.push(comprasAuxiliar[i]);
            }

        }
        comprasAuxiliar = comprasAuxiliar2;
        comprasAuxiliar2 = [];
        /*if(fechaF.getTime()>fechaI.getTime())
            alert('es mayor');
        if(fechaF.getTime()==fechaI.getTime())
            alert('es igual');
        console.log(fechaF)*/
    }
    if (verificarFechasRegistro()) {
        let fechaInicio = document.querySelector('#fechaInicioR');
        let fechaFin = document.querySelector('#fechaFinalR');
        let fechaI = new Date(fechaInicio.value);
        let fechaF = new Date(fechaFin.value);
        fechaI.setDate(fechaI.getDate() + 1);
        fechaF.setDate(fechaF.getDate() + 1);
        for (let i in comprasAuxiliar) {
            //console.log(comprasAuxiliar[i].fechaCompra);
            //console.log(comprasAuxiliar[i].fechaRegistro);
            let fechaR = comprasAuxiliar[i].fechaRegistro; //new Date(comprasAuxiliar[i].fechaRegistro);

            //if(fechaR.getTime()>=fechaI.getTime() && fechaR.getTime()<=fechaF.getTime())
            if (comparacionFecha(fechaR, fechaI, fechaF)) {
                comprasAuxiliar2.push(comprasAuxiliar[i]);
            }

        }
        comprasAuxiliar = comprasAuxiliar2;
        comprasAuxiliar2 = [];
        /*if(fechaF.getTime()>fechaI.getTime())
            alert('es mayor');
        if(fechaF.getTime()==fechaI.getTime())
            alert('es igual');
        console.log(fechaF)*/
    }
    for (let i in comprasAuxiliar) {
        //const fechaCreacion = new Date(comprasAuxiliar[i].created_at);
        //const fechaCompra = new Date(comprasAuxiliar[i].fecha_compra)
        //let fechaCompra = comprasAuxiliar[i].fechaCompra.getDate();
        //console.log(fechaCompra);
        //comprasAuxiliar[i].fechaCompra.setDate(comprasAuxiliar[i].fechaCompra.getDate() + 1);
        let btnVerCredito = "";
        /*if (comprasAuxiliar[i].estado == 'credito')
            btnVerCredito = `<button class="btn btn-light" onclick="verDetalleCompra(` +
            comprasAuxiliar[i].id +`)" data-toggle="modal" data-target="#detalleCompraModal"
                type="button">VER CREDITO</button>`;*/
        cuerpo = cuerpo + `
            <tr>
                <th scope="row">` + contador++ + `</th>
                <td>` + comprasAuxiliar[i].id + `</td>
                <td>` + comprasAuxiliar[i].proveedor + `</td>
                <td>` + comprasAuxiliar[i].fechaCompra.toLocaleDateString() + `</td>
                <td>` + comprasAuxiliar[i].fechaRegistro.toLocaleDateString() + ` ` +
            comprasAuxiliar[i].fechaRegistro.toLocaleTimeString() + `</td>
                <td>` + comprasAuxiliar[i].estado + `</td>
                <td>` + comprasAuxiliar[i].costoTotal + `</td>
                <td><button class="btn btn-light" onclick="verDetalleCompra(` +
            comprasAuxiliar[i].id+`,'`+comprasAuxiliar[i].estado+`'`+`)" data-toggle="modal" data-target="#detalleCompraModal"
                type="button">VER MAS</button>` + btnVerCredito + `</td>
            </tr>
        `;
    }
    //console.log(comprasAuxiliar);
    comprasAuxiliar = comprasRespaldo;
    document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    //console.log(opcionProveedor.value);
}

function verDetalleCompra(id,estado) {
    let cuerpo = "";
    let contador = 1;
    let costoTotal = 0;
    for (let c in compra_producto) {
        if (compra_producto[c].idCompras === id) {
            let producto = 0;
            for (let p in productos) {
                //console.log(productos[p].id);
                //console.log(compra_producto[c].idProductos);
                //console.log('//');
                if (productos[p].id === compra_producto[c].idProductos) {
                    //console.log(producto);
                    producto = {
                        id: productos[p].id,
                        codigoBarras: productos[p].codigoBarras,
                        nombre: productos[p].nombre
                    };
                }
            }

            let precio = parseFloat(compra_producto[c].costo_unitario) *
                parseFloat(compra_producto[c].porcentaje_ganancia);
            precio = (precio / 100) + compra_producto[c].costo_unitario;
            cuerpo = cuerpo +
                `
            <tr>
                <th scope="row">` + contador++ + `</th>
                <td>` + producto.codigoBarras + `</td>
                <td>` + producto.nombre + `</td>
                <td>` + compra_producto[c].cantidad + `</td>
                <td>` + compra_producto[c].costo_unitario + `</td>
                <td>` + compra_producto[c].porcentaje_ganancia + `</td>
                <td>` + precio + `</td>
                <td>` + compra_producto[c].fecha_caducidad + `</td>
            </tr>
            `;
            costoTotal = costoTotal + (compra_producto[c].costo_unitario * compra_producto[c].cantidad);

        }
    }
    document.getElementById("detalle_compra").innerHTML = cuerpo;
    //console.log(costoTotal);
    //document.getElementById("totalCompra").textContent = "$ ";// + costoTotal;
    //console.log(estado);
    document.getElementById("creditoCompra").innerHTML = "";
    if(estado == 'credito')
    verCreditoCompra(id,costoTotal);
}
async function verCreditoCompra(id,costoTotal)
{
    try {
        response = await fetch(`/pagoCompra/${id}`);
        let cuerpo = "";
        if (response.ok) {
            pagosCompra = await response.json();
            console.log(pagosCompra);
            let pagos = 0;
            for(let i in pagosCompra)
            {
                pagos = pagos + pagosCompra[i].monto;
            }
                cuerpo = cuerpo + `<div class="col-4 mx-auto border border-dark p-2"  >
                <div class="row my-auto">
                        <div class="col-6">
                            <p class="h5">TOTAL: </p>
                        </div>
                        <div class="col-6">
                            <p class="h5" id="totalCompra">$ `+costoTotal+`</p>
                        </div>
                    </div>
                    <div class="row my-auto">
                        <div class="col-6">
                            <p class="h5">DEBE: </p>
                        </div>
                        <div class="col-6">
                            <p class="h5" id="deuda">$ `+(costoTotal-pagos)+`</p>
                        </div>
                    </div>
                    <div class="row my-auto">
                        <div class="col-6">
                            <p class="h5">ABONAR:</p>
                        </div>
                        <div class="col-6">
                            <input type="number" data-prefix="$" id="pagoCredito" data-decimals="2"
                                value=0 class="form-control" />
                            
                        </div>
                    </div>
                    <div class="row my-auto">
                        <div class="col-6">
                            <p class="h5">AUN DEBERÍA: </p>
                        </div>
                        <div class="col-6">
                            <p class="h5" id="deudaCredito">$ 0.00</p>
                        </div>
                    </div>
                    <div class="row my-auto">
                        <div class="col-6" id="etiquetaAbonar">
                            <button class="btn border border-dark" type="button" onclick="abonarPago(`+id+`)" >ABONAR</button>
                        </div>
                    </div>
                    </div>`
                    ;
            document.getElementById("creditoCompra").innerHTML = cuerpo;
            var preProps = {
    decrementButton: "<strong>&minus;</strong>", // button text
    incrementButton: "<strong>&plus;</strong>", // ..
    groupClass: "my-0 mx-1 p-0", // css class of the resulting input-group
    buttonsClass: "btn-outline-secondary",
    buttonsWidth: "2rem",
    textAlign: "center", // alignment of the entered number
    autoDelay: 500, // ms threshold before auto value change
    autoInterval: 50, // speed of auto value change
    buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
    locale: navigator.language, // the locale, per default detected automatically from the browser
    template: // the template of the input
        '<div class="input-group ${groupClass}">' +
        '<div class="input-group-prepend"><button style="max-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus p-1" type="button">${decrementButton}</button></div>' +
        '<input type="text" inputmode="decimal" style="text-align: ${textAlign};" class="form-control form-control-text-input"/>' +
        '<div class="input-group-append"><button style="max-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
        '</div>'
}
            $("input[id='pagoCredito']").inputSpinner(preProps);
            //return productos;
            //console.log(response);

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function abonarPago(id)
{
    try {
        console.log('Entra');
        let _token =  "{{ csrf_token() }}";
        var init = {
                // el método de envío de la información será POST
                method: "POST",
                headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                        },
                // el cuerpo de la petición es una cadena de texto 
                // con los datos en formato JSON
                body:  {id:id}// convertimos el objeto a texto
            };
        let btnAux = document.getElementById("etiquetaAbonar").innerHTML;
        document.getElementById("etiquetaAbonar").innerHTML = `
        <button class="btn border border-dark" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>`;
        let respuesta = await fetch('/pagoCompra/', init);
        let cuerpo = "";
        if (respuesta.ok) {
            console.log('Si me respondió :3');
            console.log(respuesta);
            document.getElementById("etiquetaAbonar").innerHTML = btnAux;
            /*pagosCompra = await response.json();
            console.log(pagosCompra);
            let pagos = 0;
            for(let i in pagosCompra)
            {
                pagos = pagos + pagosCompra[i].monto;
            }*/

        } else {
            console.log("No responde :'v");
            console.log(respuesta);
            throw new Error(respuesta.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}
/*
        for (count4 in productos) {
            if (productos[count4].id === id) {
                  console.log(id);
                console.log(productos[count4].id);
                if (!buscarProductoEnVenta(id)) {
                    console.log(productos[count4].id);
                    agregarProductoAVenta(productos[count4].id, productos[count4].codigoBarras, productos[count4].nombre,
                        6, 22, 1, 22);
                }
                console.log(productos[count4].id);
                mostrarProductos();
            }
        }
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        palabraBusqueda.value = "";
    };
    */
</script>

@endsection