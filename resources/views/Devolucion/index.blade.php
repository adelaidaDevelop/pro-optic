@extends('header2')
@section('contenido')
@section('subtitulo')
DEVOLUCION
@endsection
@section('opciones')
<div class="col-8 ml-4"></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>

@endsection
@php
use App\Models\Sucursal_empleado;
$userDevolucion= ['crearDevolucion','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$devolver = $sE->hasAnyRole($userDevolucion);
@endphp
<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <!--
    <div class="row col-12 ml-2 w-100">

        <h4 class="text-primary ml-2 my-2">
            <strong>
                DEVOLUCION
            </strong>
        </h4>
    </div>
    -->
    <div class="row border border-dark m-2 ml-4 mr-4 col ">
        <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
        <div class="col mt-1 mb-4 ml-4 mr-4">
            <div class="row  px-0 col-8 input-group my-4">
                <h4 class=" mx-0 px-0 my-auto"> FOLIO VENTA:</h4>
                <input type="number" min=0 class="form-control col-4 my-auto ml-3" size="15" placeholder="INGRESAR FOLIO VENTA" id="busquedaFolio" name="busquedaFolio" onkeyup="buscarFolio()">
                <a title="buscar" class="text-dark ml-2 mr-5 my-auto">
                    <img src="{{ asset('img\search.svg') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                <div class="col-2 ml-5"> </div>
                <button class=" btn btn-outline-info my-auto " onclick="modalVenta()" data-toggle="modal" data-target="#buscarVenta" type="button">
                    BUSCAR VENTA
                    <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="35px" height="35px" />
                </button>
            </div>
            <div id="sinResult" class="row ">
            </div>

            <!-- TABLA -->
            <div class="row ">
                <h4 class="text-primary  mx-0 px-0  mt-4"> PRODUCTOS DE LA VENTA </h4>
            </div>
            <div class="row border" style="height:350px;overflow-y:auto;">
                <table class="table table-bordered border-primary  ">

                    <thead class="table-secondary text-primary">
                        <tr>
                            <th>#</th>
                            <th>CODIGO BARRAS</th>
                            <th>PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO IND.</th>
                            <th> SUBTOTAL</th>
                            <th>CANT. DEVUELTOS</th>
                            <th>DEVOLVER</th>
                        </tr>
                    </thead>
                    <tbody id="tablaProductos">

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
<!--MODAL TABLA DE VENTAS-->
<div class="modal fade" id="buscarVenta" tabindex="-1" aria-labelledby="detalleCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="modalVerMas"> CONSULTAR VENTAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class=" row  my-auto mx-1  mb-4 ml-4">
                    <div class=" input-group-text col-3">
                        <input type="checkbox" name="fechaVenta" value="buscarVentas" id="fechaVenta" onchange="filtrarCompras()">
                        <label class="ml-1 my-0 " for="fechaVenta">
                            BUSCAR VENTAS POR FECHA
                        </label>

                    </div>
                    <div class="input-group my-1 mx-0 col-4">
                        <div class="input-group-prepend ">
                            <label for="fechaInicio" class="input-group-text">DE: </label>
                        </div>
                        <input type="date" min="" id="fechaInicio" name="fechaInicio" onchange="filtrarCompras()" class="form-control" disabled />
                    </div>
                    <div class="input-group my-1 mx-0 col-4">
                        <div class="input-group-prepend">
                            <label for="fechaFinal" class="input-group-text">A: </label>
                        </div>
                        <input type="date" min="" onchange="filtrarCompras()" id="fechaFinal" class="form-control" disabled />
                    </div>
                </div>
                <div class="row mx-1 mt-4" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="table-secondary text-dark">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">FOLIO</th>
                                <th scope="col">EMPLEADO</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">PAGO</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">HORA</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tablaVenta">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

<!--MODAL DEVOLUCION-->
<div class="modal fade" id="devolucion" tabindex="-1" aria-labelledby="detalleCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title text-primary">DEVOLUCION EFECTIVO </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">

                <div class="col-2"></div>
                <div class="row col-8">
                    <div class="col-4  mt-4">
                        <h6 class="mb-5 mt-1"> CANTIDAD PROD:</h6>
                        <h6 class="mb-5"> DETALLE:</h6>
                        <p class="h6 mb-2  ">TOTAL DEVOLUCION:</p>
                    </div>
                    <div class="col-8 mt-4 ">
                        <input type="number" class="form-control mb-2" oninput="calcularTotalD()" name="cantidad" id="cantidad" placeholder="CANTIDAD DE PRODUCTOS DEVUELTOS" value=0 autofocus required>
                        <textarea name="detalleD" class=" mb-3" id="detalleD" placeholder="ESPECIFICAR EL MOTIVO DE LA DEVOLUCION" rows="3" cols="35" required></textarea>
                        <div class="input-group">
                            <h5>$</h5>
                            <p class="h5 mb-2" id="totalD">0.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="devolver()">DEVOLVER</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- SCRIPT-->
<script>
    let ventas = @json($ventas);
    let detalleVenta = @json($detalleVenta);
    let productos = @json($productos);
    let empleados = @json($empleados);
    let devolucions = @json($devolucions);
    let idProductoD = 0;
    let idVentaD = 0;
    let cantTotal = 0;
    let productos_sucursal = @json($productX_Sucursal);
    let sucursalEmpleado = @json($sucursalEmpleado);
    console.log("imp");
    console.log(productos_sucursal);
    //let cantPD = 0;
    // let cantProd = 0;
    let diferencia = 0;




    function buscarFolio() {
        //return alert('entra a buscar folio');
        document.getElementById("sinResult").innerHTML = "";
        let cont = 0;
        let botonDev = "";
        let palabraBusqueda = document.querySelector('#busquedaFolio');
        let cuerpo = "";
        let contador = 1;
        let subtotalV = 0;
        let precioSP = 0;
        if (palabraBusqueda.value.length > 0) {
            let folio = parseInt(palabraBusqueda.value);
            //  for (count in ventas) {
            // if (ventas[count].id === folio) {
            let venta = ventas.find(v => v.id === folio);
            if (venta != null) {
                console.log("encontrado asd");
                //console.log(detalleVenta);
                //console.log(ventas);
                for (count2 in detalleVenta) {
                    if (detalleVenta[count2].idVenta == folio) {
                        // let detalleV = detalleVenta.find(p => p.idVenta == folio);
                        //  if (detalleV != null) {

                        //console.log("Entra a la funcion de buscar folio");
                        // for (count3 in productos) {
                        //  if (productos[count3].id == detalleVenta[count2].idProducto) {
                        let product = productos.find(p => p.id == detalleVenta[count2].idProducto);
                        if (product != null) {
                            cont = cont + 1;
                            document.getElementById("sinResult").innerHTML = "";
                            // idProductoD = productos[count3].id;
                            //idVentaD = ventas[count].id;
                            // cantTotal = detalleVenta[count2].cantidad;
                            console.log("De esta venta por cada producto que se vendi en esta venta entra");
                            let cantPD = 0; //CHECAR
                            console.log("dev");
                            console.log(devolucions);
                            // if (devolucions.length > 0) {
                            if (devolucions !== null) {
                                for (count51 in devolucions) {
                                    console.log("devoluNo");
                                    //if (devolucions[count51].idVenta == ventas[count].id && devolucions[count51].idProducto == productos[count3].id) {
                                    if (venta.id == devolucions[count51].idVenta) {

                                        if (devolucions[count51].idProducto == product.id) {
                                            cantPD = cantPD + devolucions[count51].cantidad;
                                            console.log("Si entra en esta parte");
                                        }
                                    }
                                }
                            }
                            if (cantPD < detalleVenta[count2].cantidad) {
                                botonDev = `<button class="btn btn-light" onclick="idProdDV(` + product.id + `,` + venta.id + `,` + detalleVenta[count2].cantidad + `,` + cantPD + `)"
                                            type="button">DEVOLVER</button>`;
                            } else {
                                botonDev = `<button class="btn btn-light" onclick="" data-toggle="modal" data-target="#devolucion"
                                            type="button" disabled >DEVOLVER</button>`;
                            }
                            subtotalV = detalleVenta[count2].cantidad * detalleVenta[count2].precioIndividual;
                            console.log("sisisi");
                            cuerpo = cuerpo + `
                                            <tr onclick="" data-dismiss="modal">
                                            <th scope="row">` + cont + `</th>
                                            <td>` + product.codigoBarras + `</td>
                                            <td>` + product.nombre + `</td>
                                            <td>` + detalleVenta[count2].cantidad + `</td>
                                            <td>` + detalleVenta[count2].precioIndividual + `</td>
                                            <td>` + subtotalV + `</td> 
                                            <td>` + cantPD + `</td> 
                                            <td>` + botonDev + `
                                            </td>        
                                                </tr>
                                                `;
                        }
                    }
                }

                // }
                //document.getElementById("sinResult").innerHTML = "Folio no encontrado";
            }
            if (cuerpo === "") {
                let sin = ` <h5 class= "text-dark  mx-0 px-0"> VENTA NO ENCONTRADA</h5>`;
                document.getElementById("sinResult").innerHTML = sin;
            }
        }
        //document.getElementById("filaTablas").innerHTML = cuerpo;
        document.getElementById("tablaProductos").innerHTML = cuerpo;

    };

    function idProdDV(idP, idV, cantDV, cPD) {
        let devolver = @json($devolver);
        if (!devolver)
            return alert('NO TIENE PERMISOS PARA REALIZAR LA DEVOLUCION');
        console.log("Entro verify");
        //idProductoD
        idProductoD = idP;
        idVentaD = idV;
        cantTotal = cantDV;
        // let cantPD2 = cPD;
        diferencia = cantTotal - cPD;

        $("input[id='cantidad']").val(0);
        document.getElementById("totalD").innerHTML = 0;
        document.getElementById("detalleD").value = "";
        $('#devolucion').modal('show');
    }

    function calcularTotalD(id) {
        console.log("esta en calcular");
        let btnGuardar = document.getElementById("cantidad");
        let c = btnGuardar.value;
        // cantidad
        // totalD
        let totalDevolver = 0;
        let bandera = true;
        //let cantidad = document.querySelector('#cantidad');
        let cant = parseInt(c); //AQUI//
        if (cant >= 1) {
            for (count9 in productos_sucursal) {
                if (bandera) {
                    console.log("hasta aqui lleg");
                    console.log(idProductoD);
                    console.log(productos_sucursal[count9].idProducto);

                    if (productos_sucursal[count9].idProducto == idProductoD) {
                        console.log("si esta calculando");
                        totalDevolver = cant * productos_sucursal[count9].precio;
                        bandera = false;
                    }
                }
            }
        } else {
            console.log(cant);
        }
        document.getElementById("totalD").innerHTML = totalDevolver;

    };
    //CREAR DEVOLUCION
    async function devolver() {

        let cantidad = document.querySelector('#cantidad');
        let detalle = document.querySelector('#detalleD');
        let total = document.querySelector('#totalD');
        let cant2 = parseInt(cantidad.value);
        let detalle2 = detalle.value;
        let pInd = 0;
        pInd = parseFloat(total.textContent) / cant2;
        if (cant2 > 0) {
            if (cant2 <= diferencia) {
                if (detalle2.length == 0) {
                    return alert('AGREGAR DETALLE DE LA DEVOLUCION');
                } else {
                    let confirmar = confirm("¿PROCESAR DEVOLUCION?");
                    if (confirmar) {
                        try {
                            let funcion = await $.ajax({
                                // metodo: puede ser POST, GET, etc
                                method: "POST",
                                // la URL de donde voy a hacer la petición
                                url: '/puntoVenta/devolucion',
                                // los datos que voy a enviar para la relación
                                data: {
                                    cantidad: cant2,
                                    detalle: detalle2,
                                    precio: parseFloat(total.textContent) / cant2,
                                    idVenta: idVentaD,
                                    idProducto: idProductoD,
                                    _token: "{{ csrf_token() }}"
                                }
                            }).done(function(respuesta) {

                                $('#devolucion').modal('hide');
                                let confirmar = alert("DEVOLUCION REALIZADO CORRECTAMENTE");
                                // location.reload();
                                console.log(respuesta); //JSON.stringify(respuesta));
                            });

                            console.log(funcion);
                        } catch (err) {
                            console.log("Error al realizar la petición AJAX: " + err.message);
                        }
                        //let cantidad = document.querySelector('#cantidad');
                        //let detalle = document.querySelector('#detalleD');
                        //let total = document.querySelector('#totalD');

                        // await cargarVentas();
                        //  await cargarDetalleVenta();
                        // await cargarProductos();
                        //  await cargarDevoluciones();
                        // await cargarEmpleados();
                        await cargarDevolucion();
                        buscarFolio();
                        $("input[id='cantidad']").val(0);
                        document.getElementById("totalD").innerHTML = 0;
                    }
                }
            } else {
                return alert('El máximo de productos a devolver es: ' + diferencia + ', ingrese una cantidad válida.');
            }
        } else {
            return alert('DEBE INGRESAR UNA CANTIDAD VALIDA DE PRODUCTOS A DEVOLVER');
        }

    };

    async function cargarDevolucion() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/datosDevoluciones`);
            if (response.ok) {
                devolucions = await response.json();
                console.log(devolucions);
                return devolucions;
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
    /*
        async function cargarDevoluciones() {
            console.log("cargo devoluciones");
            let response = "Sin respuesta";
            try {
                response = await fetch(`/devolucion/datoDev`);
                if (response.ok) {
                    devolucions = await response.json();
                    console.log(devolucions);
                } else {
                    console.log("No responde :'v");
                    console.log(response);
                    throw new Error(response.statusText);
                }
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        };
    */
    async function cargarVentas() {
        console.log("carg  ventas");
        let response = "Sin respuesta";
        try {
            response = await fetch(`/datosVentas`);
            if (response.ok) {

                ventas = await response;
            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };


    async function cargarDetalleVenta() {
        console.log("cargo detalle ventas");
        let response = "Sin respuesta";
        try {
            response = await fetch(`/datosdetalleVenta`);
            if (response.ok) {
                detalleVenta = await response.json();
            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };
    async function cargarProductos() {
        console.log("cargo productos");
        let response = "Sin respuesta";
        try {
            response = await fetch(`/datosProducto`);
            if (response.ok) {
                productos = await response.json();
            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };
    async function cargarEmpleados() {
        console.log("carg  Empl");
        let response = "Sin respuesta";
        try {
            response = await fetch(`/datosEmpleado`);
            if (response.ok) {
                empleados = await response.json();
            } else {
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };

    function modalVenta() {
        let cuerpo = "";
        let cont = 0;
        let emple = "";
        let fecha = "";
        for (count5 in ventas) {
            let total = 0;
            fecha = new Date(ventas[count5].created_at);
            cont = cont + 1;

            // for (count7 in detalleVenta) {
            // console.log("detalla V: ", detalleVenta);
            //k if (detalleVenta[count7].idVenta == ventas[count5].id) {
            let detalleV = detalleVenta.find(d => d.idVenta == ventas[count5].id);
            if (detalleV != null) {

                let subtotal = detalleV.cantidad * detalleV.precioIndividual;
                total = total + subtotal;
            }

            // }
            //  for (let s in sucursalEmpleado) {
            //  if (sucursalEmpleado[s].id == ventas[count5].idSucursalEmpleado) {
            let suc_emp = sucursalEmpleado.find(s => s.id == ventas[count5].idSucursalEmpleado);
            if (suc_emp != null) {
                for (count6 in empleados) {
                    if (empleados[count6].id == suc_emp.idEmpleado) {
                        if (empleados[count6].id == 1) {
                            emple = empleados[count6].primerNombre;
                        } else {
                            emple = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                        }
                        // emple = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                    }
                }
            }
            let pago2 = 0;
            console.log("total", total);
            if (ventas[count5].pago == null) {
                pago2 = 0;
            } else {
                pago2 = ventas[count5].pago;
            }
            //}
            cuerpo = cuerpo + `
                    <tr >
                    <th scope="row">` + cont + `</th>
                    <td>` + ventas[count5].id + `</td>
                    <td>` + emple + `</td>
                    <td>` + ventas[count5].tipo + `</td>
                    <td>` + pago2 + `</td>
                    <td>` + total + `</td> 
                    <td>` + fecha.toLocaleDateString() + `</td> 
                    <td>` + fecha.toLocaleTimeString() + `</td>   
                </tr>
                `;
        }
        document.getElementById("tablaVenta").innerHTML = cuerpo;

    };


    function filtrarCompras() {

        let cuerpo = "";
        let contador = 1;
        let cont = 0;
        let emple = "";
        let fecha = "";

        if (verificarFechas()) {
            console.log("Verifico ok");
            let fechaInicio = document.querySelector('#fechaInicio');
            let fechaFin = document.querySelector('#fechaFinal');
            let fechaI = new Date(fechaInicio.value);
            let fechaF = new Date(fechaFin.value);
            // fechaI.setDate(fechaI.getDate() + 1);
            // fechaF.setDate(fechaF.getDate() + 1);

            for (let j in ventas) {

                let total = 0;
                let fechaAux = new Date(ventas[j].created_at);
                let mesAux = fechaAux.getMonth() + 1;
                let diaAux = fechaAux.getDate();
                if (mesAux < 10)
                    mesAux = "0" + mesAux;
                if (diaAux < 10)
                    diaAux = "0" + diaAux;
                fecha = new Date(fechaAux.getFullYear() + "-" + mesAux +
                    "-" + diaAux);

                if (fecha.getTime() >= fechaI.getTime() && fecha.getTime() <= fechaF.getTime()) {
                    console.log("minimo");
                    // if (fecha.getTime() <= fechaF.getTime()) {
                    console.log("maximo");
                    // for (count7 in detalleVenta) {
                    //   console.log("detalla V: ", detalleVenta);
                    // if (detalleVenta[count7].idVenta == ventas[j].id) {
                    let detalleV = detalleVenta.find(d => d.idVenta == ventas[j].id);
                    if (detalleV != null) {
                        let subtotal = detalleV.cantidad * detalleV.precioIndividual;
                        total = total + subtotal;

                    }

                    // for (let s in sucursalEmpleado) {
                    //  if (sucursalEmpleado[s].id == ventas[j].idSucursalEmpleado) {
                    let suc_emp = sucursalEmpleado.find(s => s.id == ventas[j].idSucursalEmpleado);
                    if (suc_emp != null) {
                        for (count6 in empleados) {
                            if (empleados[count6].id == 1) {
                                empleado = empleados[count6].primerNombre;
                            } else {
                                empleado = empleados[count6].primerNombre + " " + empleados[count6].segundoNombre + " " + empleados[count6].apellidoPaterno + " " + empleados[count6].apellidoMaterno;
                            }
                        }
                    }

                    console.log(ventas[j].tipo);
                    console.log(emple);
                    cont = cont + 1;
                    fecha.setDate(fecha.getDate() + 1);
                    cuerpo = cuerpo + `
                        <tr >
                        <th >` + cont + `</th>
                        <td>` + ventas[j].id + `</td>
                        <td>` + empleado + `</td>
                        <td>` + ventas[j].tipo + `</td>
                        <td>` + ventas[j].pago + `</td>
                        <td>` + total + `</td> 
                        <td>` + fecha.toLocaleDateString() + `</td> 
                        <td>` + fecha.toLocaleTimeString() + `</td>   
                    </tr>
                    `;
                    // }
                } else {
                    console.log("no entra");
                }
            }
            document.getElementById("tablaVenta").innerHTML = cuerpo;

        } else {
            console.log("No verifico bien");
            modalVenta();
        }


    };

    function verificarFechas() {
        let btn = document.querySelector('input[name="fechaVenta"]:checked');
        if (btn != null) {
            let fechaInicio = document.querySelector('#fechaInicio');
            let fechaFin = document.querySelector('#fechaFinal');
            $('input[id="fechaInicio"]').prop('disabled', false);
            if (fechaInicio.value.length > 0) {
                fechaFin.min = fechaInicio.value;
                $('input[id="fechaFinal"]').prop('disabled', false);
                if (fechaFin.value.length > 0) {
                    let fechaI = new Date(fechaInicio.value);
                    let fechaF = new Date(fechaFin.value);
                    console.log("Heber");
                    console.log(fechaI.getTime());
                    console.log(fechaF.getTime());
                    if (fechaI.getTime() > fechaF.getTime()) {
                        $("input[id='fechaFinal']").val(fechaInicio.value);
                    }
                    return true;
                }
            }
        } else {
            $("input[id='fechaInicio']").val('');
            $("input[id='fechaFinal']").val('');
            $('input[id="fechaInicio"]').prop('disabled', true);
            $('input[id="fechaFinal"]').prop('disabled', true);
            //modalVenta();
        }
        return false;
    };

    $("input[name='busquedaFolio']").bind('keypress', function(tecla) {
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
</script>
@endsection