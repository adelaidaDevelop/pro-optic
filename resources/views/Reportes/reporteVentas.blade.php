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
            <p class="h6 my-auto mx-2 text-dark"><small>REPORTE INVENTARIO</small></p>
        </button>
    </form>
</div>
<div class="col-7 "></div>
<div class=" my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>
@endsection
<!--CONSULTAR PRODUCTO -->
<div class="row  border border-dark ml-0  mt-2 ">
    <h4 class=" row text-center  my-2 mb-4 mx-auto text-dark ">
        <strong>
            VENTAS
        </strong>
    </h4>
    <br />
    <div class="row w-100 mx-auto my-auto ">
        <div class="col-4  text-center mx-auto">
            <h6 class=" text-primary"> PRECIO DEL INVENTARIO: </h6>
            <div class=" input-group text-center mx-auto px-auto">
                <h3 class="text-center ml-auto">$</h3>
                <p class="h3 mr-auto" id="costoInv">0.00</p>
            </div>
        </div>
        <div id="" class="col-4 mx-auto text-center">
            <h6 class=" text-primary"> TOTAL DE ENTRADAS </h6>
            <div class=" input-group text-center mx-auto px-auto">
                <h3 class="text-center ml-auto">$</h3>
                <p class="h3 mr-auto" id="total_entradas">0.00</p>
            </div>
        </div>
        <div class="col-4 mx-auto text-center">
            <h6 class=" text-primary"> TOTAL DE SALIDAS: </h6>
            <div class=" input-group text-center mx-auto px-auto">
                <h3 class="text-center ml-auto">$</h3>
                <p class="h3 mr-auto" id="total_salidas">0.00</p>
            </div>
        </div>
    </div>
    <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
    <div class="row w-100   ml-5">
        <h5 class="text-primary ml-3 ">BUSCAR POR:</h5>
        <div class="row form-group input-group  ml-3 ">
            <h6 class=" my-auto mr-1">
                TIPO DE VENTA:
            </h6>
            <input class="my-auto" type="radio" value="movimiento" name="opcBuscar" id="opcMovimiento" onchange="opcBuscarHabilitar()" checked>

            <select class="form-control col-2 my-0 ml-3 mr-3" name="tipoVenta" id="tipoVenta" onchange="" required>
                <option value="1" selected>EFECTIVO</option>
                <option value="2">CREDITO</option>
                <option value="3">ECOMMERCE</option>
                <option value="4">TODOS</option>
            </select>
            <!-- 
            <h6 class="my-auto mr-1">
                TURNOS
            </h6>
            <input class="my-auto" type="radio" value="productos" name="opcBuscar" id="opcProductos" onchange="opcBuscarHabilitar()">
            <select class="col-2 form-control  my-0 ml-3 mr-3" name="productoID" id="productoID" required>
                <option value="1" selected>COMPLETO</option>
                <option value="2">POR TURNO</option>
            </select>
            -->
            <h6 class=" my-auto mr-1">
                CAJERO:
            </h6>
            <select class="form-control col-2 ml-3 mr-3 my-0" name="idCajero" id="idCajero" onchange="" required>
                <option value="0">TODOS</option>
                @foreach($sucursalEmpleados as $cajero)
                @foreach($empleados as $emp)
                @if($cajero->idEmpleado == $emp->id)
                @if( $cajero->idEmpleado == 1)
                <option value="{{$cajero['idEmpleado']}}">ADMINISTRADOR </option>
                @else
                <option value="{{$cajero['idEmpleado']}}"> {{$emp['primerNombre']}} {{ $emp['segundoNombre']}} {{ $emp['apellidoPaterno']}} {{ $emp['apellidoMaterno'] }}</option>
                @endif
                @endif
                @endforeach
                @endforeach
            </select>
        </div>
        <h5 class="text-primary ml-3">FECHA:</h5>
        <div class="form-group input-group border  ">
            <div class="col-1 form-group input-group">
                <h6 class="text-primary  my-auto mr-1">
                    DIA
                </h6>
                <input class="my-auto" type="radio" value="dia" name="fecha" id="fechaDia" onchange="habilitarFecha()" checked>
            </div>
            <div class="col-1 form-group input-group">
                <h6 class="text-primary  my-auto mx-1">
                    MES
                </h6>
                <input class="my-auto" type="radio" value="mes" name="fecha" id="fechaMes" onchange="habilitarFecha()">
            </div>
            <div class="col-1 form-group input-group">
                <h6 class="text-primary mx-1 my-auto ">
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
        <div class="  form-group input-group ml-3 border ">
            <input type="date" min="" onchange="" id="fechaXDia" class="form-control my-0 col-2" />
            <select class="form-control col-1 my-0 mx-2" name="meses" id="fechaXmeses" required disabled>
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
                <option value="1" selected>2021</option>
                <option value="2">2022</option>
                <option value="3">2023</option>
                <!--Escribir manualmente el anio-->
            </select>
            <input type="date" min="" onchange="minFin()" id="fechaPInicio" class="form-control my-0 col-2 mr-2" disabled />
            <input type="date" min="" onchange="" id="fechaPFinal" class="form-control my-0 col-2 mr-2" disabled />
            <button class="btn btn-outline-primary  p-1 mx-3 text-dark" onclick="generaReportes()">
                <img src="{{ asset('img\reporte.png') }}" alt="Editar" width="30px" height="30px">
                GENERAR </button>
            <button id="imp" name="imp" class="btn btn-outline-primary  p-1 text-dark">
                <img src="{{ asset('img\impresora.png') }}" alt="Editar" width="30px" height="30px"> IMPRIMIR REPORTE</button>
        </div>
        <!-- TABLA -->
        <div id="tablaR" class="row col-12 mb-3">
            <div id="tabla2" class="row col-12 " style="height:300px;overflow-y:auto;">
                <table class="table table-bordered border-primary ml-3  w-100">
                    <thead class="table-secondary text-dark">
                        <tr>
                            <th>#</th>
                            <th>MOVIMIENTO</th>
                            <th>TIPO VENTA</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>CAJERO</th>
                            <th>PRODUCTO</th>
                            <th>DEPTO</th>
                            <th>PAGOS</th>
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
    let productos = @json($productos);
    let departamentos = @json($departamentos);
    let ventas = @json($ventas);
    let detalleVenta = @json($detalle_ventas);
    let sucursal_productos = @json($sucursal_productos);
    let sucursalEmpleado = @json($sucursalEmpleados);
    let empleados = @json($empleados);
    let banderaMovimiento = true;
    let fechaDia = "";
    let tabla2 = document.querySelector('#tablaR').outerHTML;
    let cuerpo = "";

    function minFin() {
        $("input[id='fechaPFinal']").val('');
        let fechaIni = document.getElementById('fechaPInicio');
        fechaDia = document.getElementById('fechaPFinal');
        fechaDia.min = fechaIni.value;
    }

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
            // $("#fechaXmeses").selectmenu('1', true);
            $("#fechaXmeses").val('0')
            $("#fechaXanio").val('1')
            anio.disabled = true;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
            // generaReportes();
        } else if (opcFecha === 'mes') {
            dia.disabled = true;
            mes.disabled = false;
            $("#fechaXDia").val('')
            $("#fechaXanio").val('1')
            anio.disabled = true;
            periodoIni.disabled = true;
            periodoFin.disabled = true;
            // generaReportes();
        } else if (opcFecha === 'anio') {
            dia.disabled = true;
            mes.disabled = true;
            anio.disabled = false;
            $("#fechaXDia").val('')
            $("#fechaXmeses").val('0')
            periodoIni.disabled = true;
            periodoFin.disabled = true;
            // generaReportes();

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
        let movimiento = document.getElementById('tipoVenta');
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
                for (let v in sucursalEmpleado) {
                    if (sucursalEmpleado[v].id == ventas[v].idSucursalEmpleado) {
                        for (let h in empleados) {
                            if (empleados[h].id == sucursalEmpleado[v].idEmpleado) {
                                empleadoNombre = empleados[h].primerNombre + " " + empleados[h].segundoNombre + " " + empleados[h].apellidoPaterno + " " + empleados[h].apellidoMaterno;
                            }
                        }
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
                                                    <td>` + empleadoNombre + `</td>
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
        console.log(salidaVP);
    };

    function modalVenta(tipoV, fechaXDia2) {
        let cont = 0;
        let empleado = "";
        let fecha = "";
        let depto = "";
        for (count5 in ventas) {
            let idSucEmp = ventas[count5].idSucursalEmpleado;
            for (let h in sucursalEmpleado) {
                if (sucursalEmpleado[h].id == idSucEmp) {
                    let fechaVenta = new Date(ventas[count5].created_at);
                    if (comparacionFecha(fechaXDia2, fechaVenta)) {
                        let movimiento = "VENTAS";
                        fechaCol = fechaVenta.toLocaleDateString();
                        horaCol = fechaVenta.toLocaleTimeString();
                        let movi = document.querySelector('#idCajero');
                        let moviName = parseInt(movi.value);
                        if (moviName == 0) {
                            if (ventas[count5].tipo.toUpperCase() == tipoV) {
                                //SIN BUSCAR EMPLEADO
                                for (count7 in detalleVenta) {
                                    console.log("detalla V: ", detalleVenta);
                                    if (detalleVenta[count7].idVenta == ventas[count5].id) {
                                        for (let j in productos) {
                                            if (productos[j].id == detalleVenta[count7].idProducto) {
                                                nombre = productos[j].nombre;
                                                for (let z in departamentos) {
                                                    if (departamentos[z].id == productos[j].idDepartamento) {
                                                        depto = departamentos[z].nombre;
                                                    }
                                                }

                                                //empleados
                                                for (count6 in empleados) {
                                                    if (empleados[count6].id == sucursalEmpleado[h].idEmpleado) {
                                                        if (empleados[count6].id == 1) {
                                                            empleado = empleados[count6].primerNombre;
                                                        } else {
                                                            empleado = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                                                        }
                                                    }
                                                }
                                                cuerpo = cuerpo + `
                                                    <tr onclick="" data-dismiss="modal">
                                                    <th scope="row">` + cont + `</th>
                                                    <td>` + movimiento + `</td>
                                                    <td>` + ventas[count5].tipo + `</td>
                                                    <td>` + fechaCol + `</td> 
                                                    <td>` + horaCol + `</td>
                                                    <td>` + empleado + `</td>
                                                    <td>` + nombre + `</td>
                                                    <td>` + depto + `</td>
                                                    <td>` + ventas[count5].pago + `</td>
                                                </tr>
                                                `;
                                            }
                                        }
                                    }
                                }
                            } else {
                                if (sucursalEmpleado[h].id == moviName) {
                                    //BUSCAR EMPLEADOS
                                    for (count6 in empleados) {
                                        if (empleados[count6].id == sucursalEmpleado[h].idEmpleado) {
                                            if (empleados[count6].id == 1) {
                                                empleado = empleados[count6].primerNombre;
                                            } else {
                                                empleado = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                                            }
                                        }
                                    }

                                    let total = 0;
                                    //  fecha = new Date(ventas[count5].created_at);
                                    cont = cont + 1;
                                    let nombre
                                    for (count7 in detalleVenta) {
                                        console.log("detalla V: ", detalleVenta);
                                        if (detalleVenta[count7].idVenta == ventas[count5].id) {
                                            for (let j in productos) {
                                                if (productos[j].id == detalleVenta[count7].idProducto) {
                                                    nombre = productos[j].nombre;


                                                    //   let subtotal = detalleVenta[count7].cantidad * detalleVenta[count7].precioIndividual;
                                                    //     total = total + subtotal;
                                                    //   }
                                                    // }
                                                    cuerpo = cuerpo + `
                                            <tr onclick="" data-dismiss="modal">
                                            <th scope="row">` + cont + `</th>
                                            <td>` + movimiento + `</td>
                                            <td>` + fechaCol + `</td> 
                                            <td>` + horaCol + `</td>
                                            <td>` + empleado + `</td>
                                            <td>` + nombre + `</td>
                                            <td>` + ventas[count5].tipo + `</td>
                                            <td>` + ventas[count5].pago + `</td>
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
        }

    };

    function generaReportes() {
        //let devolucionFila = "";
        let empleadoNombre = "";
        // let filaprod_caducados = "";
        let cant_actual = 0;
        let fechaXDia = "";
        cuerpo = "";
        if (validarCamposFechas()) {
            fechaXDia = new Date(fechaDia.value);
            fechaXDia.setDate(fechaXDia.getDate() + 1);
            if (banderaMovimiento == true) { // == o ===
                console.log("angelo");
                let movi = document.querySelector('#tipoVenta');
                let tipo_venta = movi.value;
                if (tipo_venta == "1") {
                    modalVenta("EFECTIVO", fechaXDia);
                    if (cuerpo === "") {
                        let sin = `<h5 class= "text-dark text-center mx-auto mt-4"> NO SE ENCONTRARON REGISTROS </h5>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                } else if (tipo_venta == "2") {
                    modalVenta("CREDITO", fechaXDia);
                    if (cuerpo === "") {
                        let sin = `<h5 class= "text-dark text-center mx-auto mt-4"> NO SE ENCONTRARON REGISTROS </h5>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                } else if (tipo_venta == "3") {
                    modalVenta("ECOMMERCE", fechaXDia);
                    if (cuerpo === "") {
                        let sin = `<h5 class= "text-dark text-center mx-auto mt-4"> NO SE ENCONTRARON REGISTROS </h5>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                } else if (tipo_venta == "4") {
                    modalVenta("EFECTIVO", fechaXDia);
                    modalVenta("CREDITO", fechaXDia);
                    modalVenta("ECOMMERCE", fechaXDia);
                    // cuerpo = devolucionFila + salidaVP + entradaNuevosProductos + entradaCompraProduct;
                    if (cuerpo === "") {
                        let sin = `<h5 class= "text-dark text-center mx-auto mt-4"> NO SE ENCONTRARON REGISTROS </h5>`;
                        document.getElementById("tablaR").innerHTML = sin;
                        document.getElementById("imp").disabled = true;
                    } else {
                        document.getElementById("tablaR").innerHTML = tabla2;
                        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
                    }
                }
            } else {
                //REPORTES PRODUCTOS
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
    };

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