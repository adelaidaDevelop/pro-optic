@extends('header2')
@section('contenido')
@section('subtitulo')
REPORTES
@endsection
@section('opciones')
@endsection


<!--CONSULTAR PRODUCTO -->

<div class="row  border border-dark ml-0 mr-0  mt-2 ">
    <h5 class=" row col-5 ml-1 mt-2 mb-2 mx-auto text-primary ">
        <strong>
            REPORTE DE INVENTARIO
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

            <h6 class="my-auto mr-1">
                PRODUCTOS
            </h6>
            <input class="my-auto" type="radio" value="productos" name="opcBuscar" id="opcProductos" onchange="opcBuscarHabilitar()">

            <select class="col-2 form-control  my-0 ml-3 mr-3" name="productoID" id="productoID" required disabled>
                <option value="1" selected>MAS VENDIDOS</option>
                <option value="2">EN OFERTA</option>
            </select>
            <h6>CAJERO:</h6>
            <select class="form-control col-2 ml-3 mr-3 my-0" name="idCajero" id="idCajero" onchange="" required>
                <option value="0">TODOS</option>
                @foreach($cajero as $cajero)
                <option value="{{$cajero['id']}}"> {{$cajero['nombre'] }}</option>
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
        </div>

        <!-- TABLA -->
        <div id="tablaR" class="row w-100 ">
            <div id="tabla2" class="row col-12 " style="height:300px;overflow-y:auto;">
                <table class="table table-bordered border-primary ml-3  w-100">
                    <thead class="table-secondary text-primary">
                        <tr>
                            <th>#</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>PRODUCTO</th>
                            <th>CANT. ANTERIOR</th>
                            <th>CANT. ACTUAL</th>
                            <th>MOVIMIENTO</th>
                            <th>CAJERO</th>
                            <th>DEPTO</th>
                        </tr>
                    </thead>
                    <tbody id="consultaBusqueda">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12 form-group input-group ml-3 mt-2">
            <button id="imp" name="imp" class="btn btn-primary mx-auto "> IMPRIMIR REPORTE</button>
        </div>


    </div>


</div>



<script>
    let compras = @json($compras);
    let compra_productos = @json($compraProductos);
    let productos = @json($productos);
    let devoluciones = @json($devoluciones);
    let departamentos = @json($departamentos);
    let ventas = @json($ventas);
    let detalle_ventas = @json($detalle_ventas);
    let sucursal_productos = @json($sucursal_productos);
    let sucursalEmpleados = @json($sucursalEmpleados);
    let banderaMovimiento = true;
    let fechaDia = "";
    let tabla2 = document.querySelector('#tablaR').outerHTML;



    let registrosCompEnt = "";
    /*
        function filtrarCompras() {
            let cuerpo = "";
            let contador = 1;
            let cont = 0;
            let emple = "";
            let fecha = "";
            let banderaMovimiento = true;


            if (verificarFechas()) {
                console.log("Verifico ok");
                let fechaInicio = document.querySelector('#fechaCorte');
                let fechaFin = document.querySelector('#fechaFinal');
                let fechaI = new Date(fechaInicio.value);
                let fechaF = new Date(fechaFin.value);
                fechaI.setDate(fechaI.getDate() + 1);
                fechaF.setDate(fechaF.getDate() + 1);

                for (let j in ventas) {

                    let total = 0;
                    fecha = new Date(ventas[j].created_at);
                    fecha.setDate(fecha.getDate() + 1);
                    cont = cont + 1;
                    console.log(fecha.toLocaleDateString());
                    console.log(fechaI.toLocaleDateString());

                    if (fecha.getTime() >= fechaI.getTime()) {
                        console.log("minimo");
                        if (fecha.getTime() <= fechaF.getTime()) {
                            console.log("maximo");

                            for (count21 in detalleVenta) {
                                if (detalleVenta[count21].idVentas == ventas[j].id) {
                                    total = total + detalleVenta[count21].subtotal
                                }
                            }

                            for (count6 in empleados) {
                                if (empleados[count6].id == ventas[j].idEmpleado) {
                                    emple = empleados[count6].nombre + " " + empleados[count6].apellidos
                                }
                            }
                            cuerpo = cuerpo + `
                            <tr onclick="" data-dismiss="modal">

                            <th scope="row">` + cont + `</th>
                            <td>` + ventas[j].id + `</td>
                            <td>` + emple + `</td>
                            <td>` + ventas[j].estado + `</td>
                            <td>` + ventas[j].pago + `</td>
                            <td>  </td>
                            <td>` + total + `</td> 
                            <td>` + fecha.toLocaleDateString() + `</td> 
                            <td>` + fecha.toLocaleTimeString() + `</td>   
                        </tr>
                        `;
                        }
                    } else {
                        console.log("no entra");
                    }
                }
            } else {
                console.log("No verifico bien");
            }
            document.getElementById("tablaVenta").innerHTML = cuerpo;
        };
    */
    function validarCamposFechas() {
        //   let dia = document.getElementById('fechaXDia');
        //   let mes = document.getElementById('fechaXmeses');
        //  let anio = document.getElementById('fechaXanio');
        //   let periodoIni = document.getElementById('fechaPInicio');
        //   let periodoFin = document.getElementById('fechaPFinal');
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
    }

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
            //  fechaDia = document.querySelector('#fechaXDia');
        } else if (opcFecha === 'mes') {
            dia.disabled = true;
            mes.disabled = false;
            anio.disabled = true;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
            //   fechaDia = document.querySelector('#fechaXmeses');
        } else if (opcFecha === 'anio') {
            dia.disabled = true;
            mes.disabled = true;
            anio.disabled = false;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
            //   fechaDia = document.querySelector('#fechaXanio');
        } else if (opcFecha === 'periodo') {
            dia.disabled = true;
            mes.disabled = true;
            anio.disabled = true;
            periodoIni.disabled = false;
            periodoFin.disabled = false;
            //fechaDia = document.getElementById('fechaPFinal');
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

    function generaReportes() {
        let devolucionFila = "";
        let salidaVP = "";
        let fila_entradaNewP = "";
        let fila_entradaCP = "";
        let idEmpCol = 0;
        let filaprod_caducados = "";
        let cant_actual = 0;


        //lamar metodo 
        //habilitarFecha();
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
                    cuerpo = "";
                    fila_entradaNewP = "";
                    fila_entradaCP = "";

                    //BUSCAR ENTRADAS
                    //COMPRA DE PRODUCTOS
                    for (let c in compras) {
                        let fechaCompra = new Date(compras[c].created_at);
                        console.log(fechaCompra);
                        console.log(fechaXDia);
                        //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
                        //  fechaCompra.setDate(fechaCompra.getDate() + 1);
                        if (comparacionFecha(fechaXDia, fechaCompra)) {
                            fechaCol = fechaCompra.toLocaleDateString();
                            horaCol = fechaCompra.toLocaleTimeString();
                            for (let z in sucursalEmpleados) {
                                if (sucursalEmpleados[z].idEmpleado == compras[c].idEmpleado) {
                                    idEmpCol = compras[c].idEmpleado;
                                }
                            }
                            // para buscar por cajero
                            //Buscar ventas que hubieron en esa fecha en compra-productos
                            for (let x in compra_productos) {
                                if (compra_productos[x].idCompra == compras[c].id) {
                                    for (let i in productos) {
                                        //Encontrar productos que aparecen en compra produtos
                                        console.log(compra_productos[x].idProductos);
                                        console.log(productos[i].id);
                                        if (productos[i].id == compra_productos[x].idProducto) {
                                            productoCol = productos[i].nombre;
                                            for (let t in sucursal_productos) {
                                                if (sucursal_productos[t].idProducto == productos.id) {
                                                    existencia = sucursal_productos[t].existencia;
                                                }
                                            }


                                            //Encontrar nombre departamento 
                                            for (let d in departamentos) {
                                                if (productos[i].idDepartamento == departamentos[d].id) {
                                                    depto = departamentos[d].nombre;
                                                }
                                            }
                                            cantidad = compra_productos[x].cantidad;
                                            cant_anterior = existencia;
                                            cant_actual = existencia + cantidad;
                                            movimientoTxt = "ENTRADAS: COMPRA PRODUTOS";
                                            console.log("RELLENANDO");
                                            //AQUI HACER LAS FILAS PARA LA TABLA PASANDOLE LOS DATOS
                                            fila_entradaCP = fila_entradaCP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;

                                            //  encontradosBandera = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //Entradas: nueevos productos

                    for (let p in productos) {
                        let fechaNuevoProd = new Date(productos[p].created_at);

                        //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA

                        if (comparacionFecha(fechaXDia, fechaNuevoProd)) {
                            fechaCol = fechaNuevoProd.toLocaleDateString();
                            horaCol = fechaNuevoProd.toLocaleTimeString();
                            idEmpCol = 1 // para buscar por cajero
                            productoCol = productos[p].nombre;
                            for (let d in departamentos) {
                                if (departamentos[d].id == productos[p].idDepartamento) {
                                    depto = departamentos[d].nombre;
                                }
                            }
                            cant_anterior = 0;
                            cant_actual = productos[p].existencia;
                            movimientoTxt = "ENTRADA: NUEVOS PRODUCTOS";
                            //AGREGAR FILAS
                            fila_entradaNewP = fila_entradaNewP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;

                            // encontradosBandera = true;
                        }

                    }
                    cuerpo = fila_entradaCP + fila_entradaNewP;
                    if (cuerpo === "") {
                        // tabla2 = document.querySelector('#tablaR');
                        
                        let sin = `<h3 class= "text-danger text-center mx-auto mt-4"> NO SE ENCONTRARON REGISTROS </h3>`;
                        document.getElementById("tablaR").innerHTML = sin;
                       // document.getElementById("imp").innerHTML
                      //  $(document.getElementById("imp").outerHTML).attr("disabled");
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }

                } else if (moviName == "2") {
                    salidaVP = "";
                    cuerpo = "";
                    cant_anterior = 0;
                    cant_actual = 0;
                    idEmpCol = 0;
                    //BUSCAR SALIDAS
                    //VENTA DE PRODUCTOS
                    for (let v in ventas) {
                        let fechaVenta = new Date(ventas[v].created_at);
                        //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
                        if (comparacionFecha(fechaXDia, fechaVenta)) {
                            fechaCol = fechaVenta.toLocaleDateString();
                            horaCol = fechaVenta.toLocaleTimeString();
                            idEmpCol = ventas[v].idEmpleado; // CHECAR
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
                                            //cant_anterior
                                            // cant_actual
                                            salidaVP = salidaVP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;

                                            //  encontradosBandera = true;


                                        }


                                    }
                                }

                            }
                        }
                    }
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
                    cant_anterior = 0;
                    cant_actual = 0;
                    idEmpCol = 0;
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
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;

                                    encontradosBandera = true;
                                }
                                //
                            }

                        }
                    }
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
                    cuerpo = "";
                    fila_entradaNewP = "";
                    fila_entradaCP = "";

                    //BUSCAR ENTRADAS
                    //COMPRA DE PRODUCTOS
                    for (let c in compras) {
                        let fechaCompra = new Date(compras[c].created_at);
                        console.log(fechaCompra);
                        console.log(fechaXDia);
                        //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
                        //  fechaCompra.setDate(fechaCompra.getDate() + 1);
                        if (comparacionFecha(fechaXDia, fechaCompra)) {

                            fechaCol = fechaCompra.toLocaleDateString();
                            horaCol = fechaCompra.toLocaleTimeString();
                            //  idEmpCol = compras[c].idEmpleado; // para buscar por cajero
                            //Buscar ventas que hubieron en esa fecha en compra-productos
                            for (let x in compra_productos) {
                                if (compra_productos[x].idCompra == compras[c].id) {
                                    for (let i in productos) {
                                        //Encontrar productos que aparecen en compra produtos

                                        console.log(productos[i].id);
                                        if (productos[i].id == compra_productos[x].idProducto) {
                                            productoCol = productos[i].nombre;
                                            // existencia = productos[i].existencia;
                                            //Encontrar nombre departamento 
                                            for (let d in departamentos) {
                                                if (productos[i].idDepartamento == departamentos[d].id) {
                                                    depto = departamentos[d].nombre;
                                                }
                                            }
                                            cantidad = compra_productos[x].cantidad;
                                            // cant_anterior = existencia;
                                            //  cant_actual = existencia + cantidad;
                                            movimientoTxt = "ENTRADAS: COMPRA PRODUTOS";
                                            console.log("RELLENANDO");
                                            //AQUI HACER LAS FILAS PARA LA TABLA PASANDOLE LOS DATOS
                                            fila_entradaCP = fila_entradaCP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;

                                            // encontradosBandera = true;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //Entradas: nueevos productos
                    //AQUI
                    for (let p in productos) {
                        let fechaNuevoProd = new Date(productos[p].created_at);

                        //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA

                        if (comparacionFecha(fechaXDia, fechaNuevoProd)) {
                            fechaCol = fechaNuevoProd.toLocaleDateString();
                            horaCol = fechaNuevoProd.toLocaleTimeString();
                            // idEmpCol = 1 // para buscar por cajero
                            productoCol = productos[p].nombre;
                            for (let d in departamentos) {
                                if (departamentos[d].id == productos[p].idDepartamento) {
                                    depto = departamentos[d].nombre;
                                }
                            }
                            cant_anterior = 0;
                            // cant_actual = productos[p].existencia;
                            movimientoTxt = "ENTRADA: NUEVOS PRODUCTOS";
                            //AGREGAR FILAS
                            fila_entradaNewP = fila_entradaNewP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;

                        }

                    }
                    //  cuerpo = fila_entradaCP + fila_entradaNewP;
                    //  document.getElementById("consultaBusqueda").innerHTML = cuerpo;

                    //DOS
                    salidaVP = "";
                    cant_anterior = 0;
                    cant_actual = 0;
                    idEmpCol = 0;
                    //BUSCAR SALIDAS
                    //VENTA DE PRODUCTOS
                    for (let v in ventas) {
                        let fechaVenta = new Date(ventas[v].created_at);
                        //FECHA POR DIA //PRODUCTOS QUE SE COMPRARON EN TAL FECHA
                        if (comparacionFecha(fechaXDia, fechaVenta)) {
                            fechaCol = fechaVenta.toLocaleDateString();
                            horaCol = fechaVenta.toLocaleTimeString();
                            // idEmpCol = ventas[v].idEmpleado; // para buscar por cajero
                            for (let z in detalle_ventas) {
                                if (detalle_ventas[z].idVenta == ventas[v].id) {
                                    for (let e in productos) {
                                        if (productos[e].id == detalle_ventas[z].idProducto) {
                                            //  existencia = productos[e].existencia;
                                            productoCol = productos[e].nombre;
                                            for (let d in departamentos) {
                                                if (departamentos[d].id == productos[e].idDepartamento) {
                                                    depto = departamentos[d].nombre;
                                                }
                                            }
                                            movimientoTxt = "SALIDA: VENTA DE PRODUCTOS";
                                            cantidad = detalle_ventas[z].cantidad;
                                            //cant_anterior
                                            // cant_actual
                                            salidaVP = salidaVP + `
                                            <tr>
                                                    <th scope="row">` + "No" + `</th>
                                                    <td>` + fechaCol + `</td>
                                                    <td>` + horaCol + `</td>
                                                    <td>` + productoCol + `</td>
                                                    <td>` + cant_anterior + `</td>
                                                    <td>` + cant_actual + `</td>
                                                    <td>` + movimientoTxt + `</td>
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;


                                        }


                                    }
                                }

                            }
                        }
                    }
                    //SALIDAS: PRODUCTOS CADUCADOS //AUN NO SE AGREGA

                    //  cuerpo = salidaVP;
                    //  document.getElementById("consultaBusqueda").innerHTML = cuerpo;

                    //tres
                    cant_anterior = 0;
                    cant_actual = 0;
                    idEmpCol = 0;
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
                                                    <td>` + idEmpCol + `</td>
                                                    <td>` + depto + `</td>        
                                            </tr>
                                            `;
                                }
                                //
                            }

                        }
                    }
                    //cuerpo = devolucionFila;
                    // document.getElementById("consultaBusqueda").innerHTML = cuerpo;


                    //BUSCAR TODOS
                    cuerpo = devolucionFila + salidaVP + fila_entradaNewP + fila_entradaCP + filaprod_caducados;
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