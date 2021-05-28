@extends('header2')
@section('contenido')
@section('subtitulo')
CREDITOS
@endsection
@section('opciones')
<div class="col-7 "></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
@endsection


<!--CONSULTAR PRODUCTO -->
<div class="row col ml-1 mt-2 mb-2 ">
    <h4 class="text-primary">
        <strong>
            LISTA DEUDORES
        </strong>
    </h4>
</div>
<div class="row col border border-dark ml-0 mr-0 mb-4 ">
    <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
    <div class="row  mb-4 mx-auto">
        <div class="row col-6  form-group input-group my-4 ">
            <input type="text" class="form-control text-uppercase border-primary " size="15" placeholder="BUSCAR CLIENTE" id="busquedaCliente" onkeyup="buscarCliente()">
            <a title="buscar" href="" class="text-dark  ml-2 ">
                <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
        </div>

        <div id="tablaR" class=" w-100">
            <!-- TABLA -->
            <div class="row w-100 " style="height:300px;overflow-y:auto;">
                <table class="table table-bordered border-primary ml-3 ">
                    <thead class="table-secondary text-primary">
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>FECHA VENTA</th>
                            <th>DEBE</th>
                            <th>FOLIO</th>
                            <th>DESCRIPCION</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody id="consultaBusqueda">

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!--MODAL-->

<div class="modal fade" id="detalleCompraModal" tabindex="-1" aria-labelledby="detalleCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="modalVerMas"></h5>
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
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">PRECIO IND.</th>
                                <th scope="col">SUBTOTAL</th>

                            </tr>
                        </thead>
                        <tbody class="text-center" id="cuerpoModal">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA ABONAR-->
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-labelledby="confirmarVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="confirmarVentaModalLabel">ABONO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>ABONAR</h1>
                        </div>
                        <div class="col-12">
                            <p class="text-center">DEBE</p>
                        </div>
                        <div class="col-12">
                            <h1 class="text-center" id="totalDebe">$ 0.00</h1>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <ul class="nav nav-pills mb-3  d-flex justify-content-center" id="pills-tab" role="tablist">

                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="" class="btn nav-link mx-auto" type="button" value="informacion" id="boton" style="background-image: url(/img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true" disabled>
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="col-8 mx-auto">

                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">ABONÓ:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="number" oninput="calcularResto()" id="abono" min="0" pattern="^[0-9]+" data-decimals="2" value=0 class="form-control" />
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">AUN DEBE: </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="h5" id="restoDeuda">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pieModal" class="modal-footer">
                    <!--
                    <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR E IMPRIMIR
                        TICKET</button>
                        -->
                    <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT-->
<script>
    const venta_clientes = @json($venta_clientes);
    const clientes = @json($cliente);
    const ventas = @json($ventas);
    const detalleVentas = @json($detalleVentas);
    const productos = @json($productos);
    const pagos_ventas = @json($pagos_ventas);

    let idVent = 0;
    let idVent2 = 0;
    let restoFinal = 0;
    let totalCompra = 0;
    let totalResta = 0;
    let folio = 0;

    let tabla2 = document.querySelector('#tablaR').outerHTML;

    // buscarCreditos();
    /*
        function buscarCreditos() {

            const palabraBusqueda = document.querySelector('#busquedaCliente');
            let cuerpo = "";
            let contCred = 0;

            for (count in creditos) {

                let name = "";
                let name2 = "";
                let fechaVenta = "";
                let fechaVenta2 = "";
                // const fechaCreacion = new Date(compras[i].created_at);
                let folio = 0;
                let folio2 = 0;
                let debe = 0.0;
                let debe2 = 0.0;
                let descripcion = "";
                let descripcion2 = "";
                let total = 0;
                let pago = 0;
                let id = 0;

                //NOMBRE CLIENTE    
                for (count1 in clientes) {
                    if (creditos[count].idCliente === clientes[count1].id) {
                        name2 = clientes[count1].nombre;

                    }
                }
                //Buscar los credios en ventas
                for (count2 in ventas) {
                    if (creditos[count].idVenta === ventas[count2].id) {
                        //fechaVenta = ventas[count2].created_at;
                        fechaVenta2 = new Date(ventas[count2].created_at);
                        fechaVenta2.getTime();
                        folio2 = ventas[count2].id;
                        //CALCULAR TOTAL DE LA VENTA
                        for (count3 in detalleVentas) {
                            if (ventas[count2].id == detalleVentas[count3].idVentas) {
                                id = ventas[count2].id;
                                total = total + detalleVentas[count3].subtotal;
                            }
                        }
                        //CALCULAR PAGOS HECHOS
                        for (count4 in pagos) {
                            if (ventas[count2].id == pagos[count4].idVenta) {
                                pago = pago + pagos[count4].monto;
                            }
                        }
                        descripcion2 = ventas[count2].id;
                    }
                }
                debe2 = total - pago;
                if (debe2 > 0) {
                    contCred = contCred + 1;
                    console.log("credits");
                    console.log(contCred);
                    idVent = id;
                    //  cont = cont + 1;
                    name = name2;
                    fechaVenta = fechaVenta2;
                    debe = debe2;
                    folio = folio2;
                    cuerpo = cuerpo + `
                        <tr onclick="" data-dismiss="modal">
                            <td>` + contCred + `</td>    
                            <th scope="row">` + name + `</th>
                            <td>` + fechaVenta.toLocaleDateString() + `</td>

                            <td id="d">` + debe + `</td>
                            <td>` + folio + `</td>
                            <td>` +
                        `<button class="btn btn-light" onclick="modalVerMas(` + idVent + `)" data-toggle="modal" data-target="#detalleCompraModal"
                                type="button">VER MAS</button>
                            </td>
                            <td>` +
                        `<button class="btn btn-light" onclick="modalAbonar(` + idVent + `)" data-toggle="modal" data-target="#confirmarVentaModal" 
                                type="button">ABONAR</button>
                            </td>

                        </tr>
                        `;
                }

            }
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        };

        */



    function modalVerMas(id) {
        let cant = 0;
        let subtotal = 0;
        let precioUni = 0;
        let nombreP = "";
        let cuerpo2 = "";
        let cont2 = 0;
        for (count6 in detalleVentas) {
            if (detalleVentas[count6].idVenta == id) {
                cant = detalleVentas[count6].cantidad;
                subtotal = detalleVentas[count6].cantidad * detalleVentas[count6].precioIndividual;
                precioUni = detalleVentas[count6].precioIndividual;
                for (count7 in productos) {
                    if (productos[count7].id == detalleVentas[count6].idProducto) {
                        nombreP = productos[count7].nombre;
                    }

                }
                cont2 = cont2 + 1;
                cuerpo2 = cuerpo2 + `
                    <tr >
                        <th scope="row">` + cont2 + `</th>
                        <td>` + nombreP + `</td>    
                        <td>` + cant + `</td>
                        <td>` + precioUni + `</td>
                        <td>` + subtotal + `</td>
                    </tr>
                    `;
            }

        }

        document.getElementById("cuerpoModal").innerHTML = cuerpo2;
    };

    function calcularResto() {
        let abonoo = document.querySelector('#abono');
        if (parseFloat(abono.value) >= 0) {
            // let resto= document.getElementById("totalDebe");
            let resto2 = totalResta - parseFloat(abonoo.value);
            console.log("abono", abonoo.value);
            console.log(totalResta);

            document.getElementById("restoDeuda").textContent = "$ " + Number(resto2.toFixed(2));
        }
    }

    function modalAbonar(id, idVenta) {
        idVent2 = id;
        $("input[id='abono']").val(0);
        document.getElementById("restoDeuda").textContent = "$ " + 0.00;
        let pagado = 0;
        let total2 = 0;
        for (count8 in pagos_ventas) {
            if (pagos_ventas[count8].idVentaCliente == id) {
                pagado = pagado + pagos_ventas[count8].monto;
            }
        }
        for (count9 in detalleVentas) {
            if (detalleVentas[count9].idVenta == idVenta) {
                let subtotal = detalleVentas[count9].cantidad * detalleVentas[count9].precioIndividual;
                total2 = total2 + subtotal;
            }
        }
        if (total2 > pagado) {
            let debe = 0;
            debe = total2 - pagado;
            totalResta = debe
            totalCompra = total2;
            //console.log("si entra");
            // document.getElementById("total").innerHTML = "$ " + debe;
            console.log(debe);
            document.getElementById("totalDebe").textContent = "$ " + debe;
            document.getElementById("restoDeuda").textContent = "$ " + debe;

        } else {
            restoFinal = diferencia;
        }
    };

    buscarCliente();

    function buscarCliente() {
        const palabraBusqueda = document.querySelector('#busquedaCliente');
        let cuerpo = "";
        let cont = 0;
        for (count12 in venta_clientes) { //CREDITOS
            console.log("Entro si");
            if (venta_clientes[count12].estado === "incompleto") {

                // for (let v in ventas) {
                // if (ventas[v].id == venta_clientes[count12].idVenta) { 
                let venta = ventas.find(v => v.id == venta_clientes[count12].idVenta);
                if (venta != null) {
                    // let idSucEmp = ventas[v].idSucursalEmpleado;
                    // for (let h in sucursalEmpleados) {
                    //  console.log("entra aqui 25_03_21");
                    // if (sucursalEmpleados[h].id == ventas[v].idSucursalEmpleado) {
                    // let suc_emp = sucursalEmpleados.find(s => s.id == venta.idSucursalEmpleado);
                    //  if (suc_emp != null) {
                    let nombre = "";
                    //   let folio = 0;
                    let idVentClient = 0;
                    let total = 0;
                    let pago = 0;
                    let fechaVenta = "";
                    let debe = 0;
                    //  for (count11 in clientes) {
                    //  if (venta_clientes[count12].idCliente == clientes[count11].id) {
                    let cliente = clientes.find(c => c.id == venta_clientes[count12].idCliente);
                    if (cliente != null) {
                        if (cliente.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            nombre = cliente.nombre;
                            // idCliente = clientes[count11].id;
                            cont = cont + 1;
                            //  folio = venta_clientes[count12].idVenta;
                            folio = venta_clientes[count12].idVenta;
                            idVentClient = venta_clientes[count12].id;
                            for (count13 in detalleVentas) {
                                if (detalleVentas[count13].idVenta == folio) {
                                    // let detalleV = detalleVentas.find(d => d.idVenta == folio);
                                    // if (product != null) {
                                    let subtotal = detalleVentas[count13].cantidad * detalleVentas[count13].precioIndividual;
                                    total = total + subtotal;
                                }
                            }
                            //  for (count14 in ventas) {
                            if (venta.id == folio) {
                                fechaVenta = new Date(venta.created_at);
                                fechaVenta.getTime();
                            }
                            //  }
                            for (count13 in pagos_ventas) {
                                if (pagos_ventas[count13].idVentaCliente == idVentClient) {

                                    pago = pago + pagos_ventas[count13].monto;
                                }
                            }
                            //   descripcion2 = ventas[count2].id;
                            console.log("veri");
                            debe = total - pago;
                            console.log(total);
                            console.log(pago);
                            console.log(debe);
                            if (debe > 0) {
                                cuerpo = cuerpo + `
                                        <tr>
                                        <th >` + cont + `</th>
                                            <td>` + nombre + `</td>    
                                            <td>` + fechaVenta.toLocaleDateString() + `</td>
                                            <td id="d">` + debe + `</td>
                                            <td>` + folio + `</td>
                                            <td>` +
                                    `<button class="btn btn-light" onclick="modalVerMas(` + folio + `)" data-toggle="modal" data-target="#detalleCompraModal"
                                                type="button">VER MAS
                                                </button>
                                            </td>
                                            <td>` +
                                    `<button class="btn btn-light" onclick="modalAbonar(` + idVentClient + `,` + folio + `)" data-toggle="modal" data-target="#confirmarVentaModal" 
                                                type="button">ABONAR</button>
                                            </td>

                                        </tr>
                                        `;

                            }

                        }

                        // }

                    }

                    //  }
                    //  }
                    //  }

                }
            }
        }
        if (cuerpo == "") {
            // tabla2 = document.querySelector('#tablaR');
            let sin = ` <h4 class= "text-dark my-auto  mt-4 "> NO SE ENCONTRARON CLIENTES DEUDORES </h4>`;
            document.getElementById("tablaR").innerHTML = sin;
        } else {
            document.getElementById("tablaR").innerHTML = tabla2;
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        }
    };



    //PAGO

    async function realizarVentaCredito() {
        let confirmarA = confirm("¿AGREGAR ABONO?");
        if (confirmarA) {
            // let json = JSON.stringify(productosVenta);
            const pago = document.querySelector('#abono');
            // const cliente = document.querySelector('#clientes');
            //if (pago.value.length == 0)
            //  return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (pago.value.length === 0) {
                return alert('INGRESE UNA CANTIDAD VALIDA');
            }

            if (parseFloat(pago.value) <= 0) {
                return alert('EL ABONO DEBE SER MAYOR A CERO');
            } else if (parseFloat(pago.value) > parseFloat(totalResta)) {
                return alert('LA CANTIDAD MAXIMA A ABONAR ES: ' + totalResta);
            }
            /*
                if (pago.value.length === 0)
                    return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
                if (parseFloat(pago.value) > parseFloat(totalResta))
                    return alert('El abono es mayor al adeudo');
                    */
            try {
                let funcion = $.ajax({
                    // metodo: puede ser POST, GET, etc
                    method: "POST",
                    // la URL de donde voy a hacer la petición
                    url: '/puntoVenta/pago',
                    // los datos que voy a enviar para la relación
                    data: {
                        // datos: json,
                        totalCompra: parseFloat(totalCompra),
                        totalResta: parseFloat(totalResta),
                        // restoFinal: restoFinal,
                        idVenta: idVent2,
                        folio: folio,
                        monto: parseFloat(pago.value),
                        _token: "{{ csrf_token() }}"
                    }
                }).done(function(respuesta) {
                    //  mostrarProductos();
                    // console.log("fall1");
                    //  buscarProducto();
                    $('#confirmarVentaModal').modal('hide');
                    $("input[id='abono']").val(0);
                    pagos_ventas.push(JSON.parse(respuesta))//.find(p => p.idVentaCliente == idVent2)
                    buscarCliente();
                    //let confirmar = 
                    alert("ABONO AGREGADO CORRECTAMENTE");
                    //location.reload();
                    //  console.log(respuesta); //JSON.stringify(respuesta));
                });
                console.log(funcion);
                //  await cargarCredito();
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    };
    //validar entradas sin negativos
    // Select your input element.


    // Listen for input event on numInput.
    var number = document.getElementById('abono');
    number.onkeypress = function(e) {
        if (!((e.keyCode > 95 && e.keyCode < 106) ||
                (e.keyCode > 47 && e.keyCode < 58) ||
                e.keyCode == 8 || e.keyCode == 46)) {
            return false;
        }
    }

    
    /*
    number.onkeypress = function(e) {
        if(e.keyCode == 45 ) {
            return false;
        }
    }
    */
</script>



@endsection