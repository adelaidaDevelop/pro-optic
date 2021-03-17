@extends('header2')
@section('contenido')
@section('subtitulo')
REPORTES
@endsection
@section('opciones')
<div class="col-0  p-1 ml-4">
    <form method="get" action="{{url('/puntoVenta/reporteInventario/')}}">
        <button class="btn btn-outline-secondary  p-1 border-0" type="submit">
            <img src="{{ asset('img\inventario.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto mx-2 text-dark"><small>INVENTARIO</small></p>
        </button>
    </form>
</div>
<div class="col-0  p-1 ml-4">
    <form method="get" action="{{url('/puntoVenta/reporteVentas/')}}">
        <button class="btn btn-outline-secondary  p-1 border-0" type="submit">
            <img src="{{ asset('img\ventas.png') }}" alt="Editar" width="30px" height="30px">
            <p class="h6 my-auto mx-2 text-dark"><small>VENTAS</small></p>
        </button>
    </form>
</div>
@endsection


<!--CONSULTAR PRODUCTO -->

<div class="row  border border-dark ml-0 mr-0  mt-2 ">
    <h5 class=" row col-5 ml-1 mt-2 mb-2 mx-auto text-primary ">
        <strong>
            INVENTARIO
        </strong>
    </h5>
    <br />
    <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
    <div class="row w-100   mr-2 ml-5">
        <h5 class="text-primary ml-3 ">BUSCAR POR:</h5>
        <div class="row form-group input-group  ml-3 ">
            <h6 class=" my-auto mr-1">
                MOVIMIENTOS
            </h6>
            <input class="my-auto" type="radio" value="movimiento" name="opcBuscar" id="opcMovimiento" onchange="opcBuscarHabilitar()" checked>

            <select class="form-control col-2 my-0 ml-3 mr-3" name="movimientoID" id="movimientoID" onchange="" required>
                <option value="1" selected>ENTRADAS</option>
                <option value="2">SALIDAS</option>
                <option value="3">DEVOLUCIONES</option>
                <option value="4">TODOS</option>
            </select>
            <!--
            <h6 class="my-auto mr-1">
                PRODUCTOS
            </h6>
            <input class="my-auto" type="radio" value="productos" name="opcBuscar" id="opcProductos" onchange="opcBuscarHabilitar()">

            <select class="col-2 form-control  my-0 ml-3 mr-3" name="productoID" id="productoID" required disabled>
                <option value="1" selected>MAS VENDIDOS</option>
                <option value="2">EN OFERTA</option>
            </select>
            -->
            <h6 class=" my-auto mr-1">CAJERO:</h6>
            <select class="form-control col-2 ml-3 mr-3 my-0" name="idCajero" id="idCajero" onchange="" required>
                <option value="0">TODOS</option>
                @foreach($sucursalEmpleados as $cajero)
                @foreach($empleados as $emp)
                @if($cajero->idEmpleado == $emp->id)
                <option value="{{$cajero['id']}}"> {{$emp['primerNombre']}} {{ $emp['segundoNombre']}} {{ $emp['apellidoPaterno']}} {{ $emp['apellidoMaterno'] }}</option>
                @endif
                @endforeach
                @endforeach
            </select>
        </div>
        <h6 class="text-primary ml-3">FECHA:</h6>

        <div class="form-group input-group  ">
            <div class="col-1 form-group input-group">
                <h6 class="text-primary  my-auto mr-1">
                    DIA
                </h6>
                <input class="my-auto" type="radio" value="dia" name="fecha" id="fechaDia" onchange="habilitarFecha()" checked>
            </div>
            <div class="col-1 form-group input-group">
                <h6 class="text-primary ml-1 my-auto mr-1">
                    MES
                </h6>
                <input class="my-auto" type="radio" value="mes" name="fecha" id="fechaMes" onchange="habilitarFecha()">
            </div>
            <div class="col-1 form-group input-group">
                <h6 class="text-primary ml-1 my-auto mr-1">
                    AÑO
                </h6>
                <input class="my-auto" type="radio" value="anio" name="fecha" id="fechaAnio" onchange="habilitarFecha()">
            </div>
            <div class="col-2 form-group input-group">
                <h6 class="text-primary ml-1 my-auto mr-1">
                    PERIODO
                </h6>
                <input class="my-auto" type="radio" value="periodo" name="fecha" id="fechaPeriodo" onchange="habilitarFecha()">
            </div>
        </div>

        <div class="  form-group input-group ml-3 ">
            <input type="date" min="" onchange="" id="fechaXDia" class="form-control my-0 col-2" />
            <select class="form-control col-1 my-0 ml-2 mr-2" name="meses" id="fechaXmeses" required disabled>
                <option value="0" selected>MES</option>
                <option value="1">ENERO</option>
                <option value="2">FEBRERO</option>
                <option value="3">MARZO</option>
                <option value="4">ABRIL</option>
                <option value="5">MAYO</option>
                <option value="6">JUNIO</option>
                <option value="7">JULIO</option>
                <option value="8">AGOSTO</option>
                <option value="9">SEPTIEMBRE</option>
                <option value="10">OCTUBRE</option>
                <option value="11">NOVIEMBRE</option>
                <option value="12">DICIEMBRE</option>
            </select>
            <select class="form-control col-1 my-0 mr-2" name="anio" id="fechaXanio" disabled>
                <option value="2021" selected>2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <!--Escribir manualmente el anio-->
            </select>
            <input type="date" min="" onchange="" id="fechaPInicio" class="form-control my-0 col-2 mr-2" disabled />
            <input type="date" min="" onchange="" id="fechaPFinal" class="form-control my-0 col-2 mr-2" disabled />
            <button class="btn btn-secondary" onclick="generaReportes()">GENERAR REPORTE</button>
            <button id="imp" name="imp" class="btn btn-primary ml-1 "> IMPRIMIR REPORTE</button>

        </div>

        <!-- TABLA -->
        <div id="tablaR" class="row col-12 mb-3">
            <div id="tabla2" class="row col-12 " style="height:200px;overflow-y:auto;">
                <table class="table table-bordered border-primary ml-3  w-100">
                    <thead class="table-secondary text-primary">
                        <tr>
                            <th>#</th>
                            <th>MOVIMIENTO</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>CAJERO</th>
                            <th>PRODUCTO</th>
                            <th>DEPTO</th>
                            <th>CANT. ANTES</th>
                            <th>CANT. ACTUAL</th>
                        </tr>
                    </thead>
                    <tbody id="consultaBusqueda">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    let compras = @json($compras);
    let detalle_compras = @json($detalleCompra);
    let productos = @json($productos);
    let devoluciones = @json($devoluciones);
    let departamentos = @json($departamentos);
    let ventas = @json($ventas);
    let detalle_ventas = @json($detalle_ventas);
    let sucursal_productos = @json($sucursal_productos);
    let sucursalEmpleados = @json($sucursalEmpleados);
    let empleados = @json($empleados);
    let banderaMovimiento = true;
    let fechaDia = "";
    let tabla2 = document.querySelector('#tablaR').outerHTML;

    function validarCamposFechas() {
        let selectFecha = document.querySelector('input[name="fecha"]:checked');
        let opcFecha = selectFecha.value;
        if (opcFecha === 'dia') {
            fechaDia = document.querySelector('#fechaXDia');
            if (fechaDia.value.length > 0) {
                return true;
            }
            return false;
        } else if (opcFecha === 'mes') {
            fechaDia = document.querySelector('#fechaXmeses');
            if (fechaDia.value.length > 0) {
                return true;
            }
            return false;
        } else if (opcFecha === 'anio') {
            fechaDia = document.querySelector('#fechaXanio');
            if (fechaDia.value.length > 0) {
                return true;
            }
            return false;
        } else if (opcFecha === 'periodo') {
            let fechaIni = document.getElementById('fechaPInicio');
            fechaDia = document.getElementById('fechaPFinal');
            if (fechaDia.value.length > 0 && fechaIni.value.length > 0) {
                //VALIRDAR QUE INI SEA MENOR QUE FIN
                fechaDia.min = fechaIni.value;
                let fechaI = new Date(fechaIni.value);
                let fechaF = new Date(fechaDia.value);
                if (fechaI.getTime() > fechaF.getTime()) {
                    $("input[id='fechaPFinal']").val(fechaIni.value);
                }
                return true;
            }
            return false;
        }
    };

    function habilitarFecha() {
        //Desabilitar los inputs y no los radios butons
        let dia = document.getElementById('fechaXDia');
        let mes = document.getElementById('fechaXmeses');
        let anio = document.getElementById('fechaXanio');
        let periodoIni = document.getElementById('fechaPInicio');
        let periodoFin = document.getElementById('fechaPFinal');

        let selectFecha = document.querySelector('input[name="fecha"]:checked');
        let opcFecha = selectFecha.value;
        if (opcFecha === 'dia') {
            dia.disabled = false;
            mes.disabled = true;
            anio.disabled = true;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
        } else if (opcFecha === 'mes') {
            dia.disabled = true;
            mes.disabled = false;
            anio.disabled = true;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
        } else if (opcFecha === 'anio') {
            dia.disabled = true;
            mes.disabled = true;
            anio.disabled = false;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
        } else if (opcFecha === 'periodo') {
            dia.disabled = true;
            mes.disabled = true;
            anio.disabled = true;
            periodoIni.disabled = false;
            periodoFin.disabled = false;
        }
    };

    function opcBuscarHabilitar() {
        let selectBuscar = document.querySelector('input[name="opcBuscar"]:checked');
        let movimiento = document.getElementById('movimientoID');
        let producto = document.getElementById('productoID');
        let opc = selectBuscar.value;
        if (opc === 'productos') {
            movimiento.disabled = true;
            producto.disabled = false;
            banderaMovimiento = false;
        } else if (opc === 'movimiento') {
            movimiento.disabled = false;
            producto.disabled = true;
            banderaMovimiento = true;
        }
    };

    function compraProductos(fechaXDia2) {
        entradaCompraProduct = "";
        //COMPRA DE PRODUCTOS AGREGADAS EN ESA FECHA
        for (let c in compras) {

            let fechaCompra = new Date(compras[c].created_at);
            console.log(fechaCompra);
            // console.log(fechaXDia);
            //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
            //  fechaCompra.setDate(fechaCompra.getDate() + 1);
            if (comparacionFecha(fechaXDia2, fechaCompra)) {
                fechaCol = fechaCompra.toLocaleDateString();
                horaCol = fechaCompra.toLocaleTimeString();
                let movi = document.querySelector('#idCajero');
                let moviName = parseInt(movi.value);
                if (moviName == 0) {
                    //TODOS LOS CAJEROS
                    emple = "TODOS";
                    // para buscar por cajero
                    //Buscar compras que hubieron en esa fecha en detalle_compras
                    for (let x in detalle_compras) {
                        if (detalle_compras[x].idCompra == compras[c].id) {
                            for (let i in productos) {
                                //Encontrar productos que aparecen en compra produtos
                                // console.log(productos[i].id);
                                if (productos[i].id == detalle_compras[x].idProducto) {
                                    productoCol = productos[i].nombre;
                                    for (let t in sucursal_productos) {
                                        if (sucursal_productos[t].idProducto == productos[i].id) {
                                            existencia = sucursal_productos[t].existencia;
                                        }
                                    }
                                    //Encontrar nombre departamento 
                                    for (let d in departamentos) {
                                        if (productos[i].idDepartamento == departamentos[d].id) {
                                            depto = departamentos[d].nombre;
                                        }
                                    }
                                    cantidad = detalle_compras[x].cantidad;
                                    cant_anterior = existencia;
                                    cant_actual = existencia + cantidad;
                                    movimientoTxt = "ENTRADAS: COMPRA PRODUCTOS";
                                    // console.log("RELLENANDO");
                                    //AQUI HACER LAS FILAS PARA LA TABLA PASANDOLE LOS DATOS
                                    entradaCompraProduct = entradaCompraProduct + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + emple + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + depto + `</td> 
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                            </tr>
                                            `;
                                }
                            }
                        }
                    }


                } else {
                    //CON CAJERO
                    for (let z in sucursalEmpleados) {
                        if (sucursalEmpleados[z].id == compras[c].idSucursalEmpleado) {
                            if (sucursalEmpleados[z].id == moviName) {
                                for (count6 in empleados) {
                                    if (empleados[count6].id == sucursalEmpleados[z].idEmpleado) {
                                        emple = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                                    }
                                }
                                // para buscar por cajero
                                //Buscar compras que hubieron en esa fecha en detalle_compras
                                for (let x in detalle_compras) {
                                    if (detalle_compras[x].idCompra == compras[c].id) {
                                        for (let i in productos) {
                                            //Encontrar productos que aparecen en compra produtos
                                            // console.log(productos[i].id);
                                            if (productos[i].id == detalle_compras[x].idProducto) {
                                                productoCol = productos[i].nombre;
                                                for (let t in sucursal_productos) {
                                                    if (sucursal_productos[t].idProducto == productos[i].id) {
                                                        existencia = sucursal_productos[t].existencia;
                                                    }
                                                }
                                                //Encontrar nombre departamento 
                                                for (let d in departamentos) {
                                                    if (productos[i].idDepartamento == departamentos[d].id) {
                                                        depto = departamentos[d].nombre;
                                                    }
                                                }
                                                cantidad = detalle_compras[x].cantidad;
                                                cant_anterior = existencia;
                                                cant_actual = existencia + cantidad;
                                                movimientoTxt = "ENTRADAS: COMPRA PRODUCTOS";
                                                // console.log("RELLENANDO");
                                                //AQUI HACER LAS FILAS PARA LA TABLA PASANDOLE LOS DATOS
                                                entradaCompraProduct = entradaCompraProduct + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + emple+ `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + depto + `</td> 
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                            </tr>
                                            `;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

    };

    function nuevosProductos(fechaXDia2) {
        //Entradas: NUEVOS PRODUCTOS
        entradaNuevosProductos = "";
        console.log("nuevos pprod")
        for (let p in productos) {
            let fechaNuevoProd = new Date(productos[p].created_at);
            if (comparacionFecha(fechaXDia2, fechaNuevoProd)) {
                fechaCol = fechaNuevoProd.toLocaleDateString();
                horaCol = fechaNuevoProd.toLocaleTimeString();
                empleadoNombre = "NO ESPECIFICADO"; // NO SE SABE QUE EMPLEADO AGREGA NUEVOS PRODUCTOS
                productoCol = productos[p].nombre;
                for (let d in departamentos) {
                    if (departamentos[d].id == productos[p].idDepartamento) {
                        depto = departamentos[d].nombre;
                    }
                }
                cant_anterior = 0;
                cant_actual = 0; // checar existencia si es x sucursal
                movimientoTxt = "ENTRADA: NUEVOS PRODUCTOS";
                //AGREGAR FILAS
                entradaNuevosProductos = entradaNuevosProductos + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + "NO ESPECIFICADO" + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + depto + `</td> 
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                            </tr>
                                            `;

            }
        }
    };

    function ventasRealizadas(fechaXDia) {
        salidaVP = "";
        cant_anterior = 0;
        cant_actual = 0;
        empleadoNombre = "";
        //BUSCAR SALIDAS
        //VENTA DE PRODUCTOS
        for (let v in ventas) {
            let fechaVenta = new Date(ventas[v].created_at);
            //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
            if (comparacionFecha(fechaXDia, fechaVenta)) {
                fechaCol = fechaVenta.toLocaleDateString();
                horaCol = fechaVenta.toLocaleTimeString();
                let movi = document.querySelector('#idCajero');
                let moviName = parseInt(movi.value);
                if (moviName == 0) {
                    for (let z in detalle_ventas) {
                        if (detalle_ventas[z].idVenta == ventas[v].id) {
                            for (let e in productos) {
                                if (productos[e].id == detalle_ventas[z].idProducto) {
                                    // existencia = productos[e].existencia;
                                    productoCol = productos[e].nombre;
                                    for (let d in departamentos) {
                                        if (departamentos[d].id == productos[e].idDepartamento) {
                                            depto = departamentos[d].nombre;
                                        }
                                    }
                                    movimientoTxt = "SALIDA: VENTA DE PRODUCTOS";
                                    cantidad = detalle_ventas[z].cantidad;
                                    cant_anterior = 0;
                                    cant_actual = 0;
                                    salidaVP = salidaVP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + "TODOS" + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + depto + `</td>  
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                            </tr>
                                            `;
                                }
                            }
                        }




                    }

                } else {
                    for (let y in sucursalEmpleados) {
                        if (sucursalEmpleados[y].id == ventas[v].idSucursalEmpleado) {
                            //BUSCAR EMPLEADOS
                            if (sucursalEmpleados[y].id == moviName) {
                                let empleado ="";
                                for (count6 in empleados) {
                                    if (empleados[count6].id == sucursalEmpleados[y].idEmpleado) {
                                        empleado = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                                    }
                                }
                                for (let z in detalle_ventas) {
                                    if (detalle_ventas[z].idVenta == ventas[v].id) {
                                        for (let e in productos) {
                                            if (productos[e].id == detalle_ventas[z].idProducto) {
                                                // existencia = productos[e].existencia;
                                                productoCol = productos[e].nombre;
                                                for (let d in departamentos) {
                                                    if (departamentos[d].id == productos[e].idDepartamento) {
                                                        depto = departamentos[d].nombre;
                                                    }
                                                }
                                                movimientoTxt = "SALIDA: VENTA DE PRODUCTOS";
                                                cantidad = detalle_ventas[z].cantidad;
                                                cant_anterior = 0;
                                                cant_actual = 0;
                                                salidaVP = salidaVP + `
                                                        <tr>
                                                                <th scope="row">` + "No" + `</th>
                                                                <td>` + movimientoTxt + `</td>
                                                                <td>` + fechaCol + `</td>
                                                                <td>` + horaCol + `</td>
                                                                <td>` + empleado + `</td>
                                                                <td>` + productoCol + `</td>
                                                                <td>` + depto + `</td>  
                                                                <td>` + cant_anterior + `</td>
                                                                <td>` + cant_actual + `</td>
                                                        </tr>
                                                        `;

                                            }
                                        }
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
        console.log(salidaVP);
    };

    function devolucionesRealizadas() {
        cant_anterior = 0;
        cant_actual = 0;
        empleadoNombre = 0;
        cuerpo = "";
        devolucionFila = "";
        //BUSCAR DEVOLUCIONES
        for (let f in devoluciones) {
            console.log("entra al for de devoluciones")
            let fechaDevolucion = new Date(devoluciones[f].created_at);
            //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
            if (comparacionFecha(fechaXDia, fechaDevolucion)) {
                fechaCol = fechaDevolucion.toLocaleDateString();
                horaCol = fechaDevolucion.toLocaleTimeString();
                //  idEmpleado = ventas[v].idEmpleado; // para buscar por cajero
                for (let p in productos) {
                    //console.log("entra a for de productos");
                    if (productos[p].id == devoluciones[f].idProducto) {
                        console.log("encuentra un producto en devolucion");
                        productoCol = productos[p].nombre;
                        for (let d in departamentos) {
                            if (departamentos[d].id == productos[p].idDepartamento) {
                                depto = departamentos[d].nombre;
                            }
                        }
                        movimientoTxt = "DEVOLUCIONES";
                        devolucionFila = devolucionFila + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + "NO ESPECIFICADO" + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;
                    }
                }

            }
        }
    };

    function generaReportes() {
        let devolucionFila = "";
        //  let salidaVP = "";
        //let entradaNuevosProductos = "";
        // let entradaCompraProduct = "";
        let empleadoNombre = "";
        let filaprod_caducados = "";
        let cant_actual = 0;
        let fechaXDia = "";
        let cuerpo = "";
        if (validarCamposFechas()) {
            fechaXDia = new Date(fechaDia.value);
            fechaXDia.setDate(fechaXDia.getDate() + 1);
            if (banderaMovimiento == true) { // == o ===
                console.log("entro a movimiento");
                let movi = document.querySelector('#movimientoID');
                let moviName = movi.value;
                if (moviName == "1") {
                    // OPCION UNO: ENTRADAS
                    nuevosProductos(fechaXDia);
                    compraProductos(fechaXDia);
                    cuerpo = entradaCompraProduct + entradaNuevosProductos;
                    if (cuerpo === "") {
                        let sin = `<h3 class= "text-danger text-center mx-auto mt-4"> NO SE ENCONTRARON REGISTROS </h3>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                } else if (moviName == "2") {
                    //OPCION 2: SALIDAS
                    ventasRealizadas(fechaXDia);
                    //SALIDAS: PRODUCTOS CADUCADOS //AUN NO SE AGREGA
                    cuerpo = salidaVP;
                    if (cuerpo === "") {
                        // tabla2 = document.querySelector('#tablaR');
                        let sin = ` <h3 class= "text-danger my-auto"> NO SE ENCONTRARON REGISTROS </h3>`;
                        document.getElementById("tablaR").innerHTML = sin;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                } else if (moviName == "3") {
                    devolucionesRealizadas(fechaXDia);
                    cuerpo = devolucionFila;
                    if (cuerpo === "") {
                        // tabla2 = document.querySelector('#tablaR');
                        let sin = ` <h3 class= "text-danger my-auto"> NO SE ENCONTRARON REGISTROS </h3>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                } else if (moviName == "4") {
                    //uno
                    //BUSCAR ENTRADAS
                    //COMPRA DE PRODUCTOS
                    compraProductos(fechaXDia);
                    //Entradas: nueevos productos: 
                    nuevosProductos(fechaXDia);
                    //DOS
                    //BUSCAR SALIDAS
                    //VENTA DE PRODUCTOS
                    ventasRealizadas(fechaXDia);
                    //SALIDAS: PRODUCTOS CADUCADOS //AUN NO SE AGREGA
                    //tres
                    devolucionesRealizadas(fechaXDia);
                    //BUSCAR TODOS
                    cuerpo = devolucionFila + salidaVP + entradaNuevosProductos + entradaCompraProduct;
                    if (cuerpo === "") {
                        // tabla2 = document.querySelector('#tablaR');
                        let sin = ` <h3 class= "text-danger my-auto"> NO SE ENCONTRARON REGISTROS </h3>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        console.log(tabla2);
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                }
            } else {
                //REPORTES PRODUCTOS
                let movi = document.querySelector('#productoID');
            }
        } else {
            return alert("ELEGIR UNA FECHA");
        }
    };

    function compararMes(fecha1, fecha2) {
        if (fecha1.getMonth() == fecha2.getMonth()) {
            return true;
        }
        return false;
    };

    function compararAnio(fecha1, fecha2) {
        if (fecha1.getFullYear() == fecha2.getFullYear()) {
            return true;
        }
        return false;
    };


    function compararFechaDia(fecha1, fecha2) {
        console.log("si compara");
        if (fecha1.getFullYear() == fecha2.getFullYear()) {
            if (fecha1.getMonth() == fecha2.getMonth()) {
                if (fecha1.getDate() == fecha2.getDate()) {
                    return true;
                }
            }
        }
        return false;
    };

    function compararPeriodoMenor(fecha1, fecha2) {
        if (fecha2.getFullYear() >= fecha1.getFullYear()) {
            if (fecha2.getMonth() >= fecha1.getMonth()) {
                if (fecha2.getDate() >= fecha1.getDate())
                    return true;
            }
        }
        return false;
    }

    function compararPeriodoMayor(fecha3, fecha2) {
        if (fecha2.getFullYear() <= fecha3.getFullYear()) {
            if (fecha2.getMonth() <= fecha3.getMonth()) {
                if (fecha2.getDate() <= fecha3.getDate())
                    return true;
            }
        }
        return false;
    };

    function fechaInicioMenorQueMayor() {
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

    function comparacionFecha(fecha1, fecha2) {
        let selectFecha = document.querySelector('input[name="fecha"]:checked');
        let opcFecha = selectFecha.value;
        if (opcFecha === 'dia') {
            if (compararFechaDia(fecha1, fecha2)) {
                return true;
            }
        } else if (opcFecha === 'mes') {
            if (compararMes(fecha1, fecha2)) {
                return true;
            }
        } else if (opcFecha === 'anio') {
            if (compararAnio(fecha1, fecha2)) {
                return true;
            }
        } else if (opcFecha === 'periodo') {
            let periodoInicio = document.getElementById('fechaPInicio');
            //  let periodoFin = document.getElementById('fechaPFinal');
            let fechaInicioP = "";
            if (periodoInicio.value.length > 0) {
                fechaInicioP = new Date(periodoInicio.value);
                fechaInicioP.setDate(fechaInicioP.getDate() + 1);
                if (compararPeriodoMenor(fechaInicioP, fecha2)) {
                    if (compararPeriodoMayor(fecha1, fecha2)) {
                        return true;
                    } else return false;
                }
            } else {
                //  console.log(" fecha no elegida");
            }
        }
        return false;
    };
</script>

@endsection