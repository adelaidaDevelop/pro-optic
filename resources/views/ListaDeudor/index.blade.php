@extends('header2')
@section('contenido')
@section('subtitulo')
CREDITOS
@endsection
@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row col-12 mx-2 w-100">
        <h4 class="text-primary">
            <strong>
                LISTA DEUDORES
            </strong>
        </h4>

    </div>
    <div class="row border border-dark m-2 w-100 ">
        <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
        <div class="row   mt-1 mb-4 ml-4 mr-2">
            <div class="row col-6  form-group input-group my-4 ml-3">
                <input type="text" class="form-control border-primary " size="15" placeholder="BUSCAR CLIENTE" id="busquedaCliente" onkeyup="buscarCliente()">
                <a title="buscar" href="" class="text-dark  ml-2 ">
                    <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
            </div>


            <!-- TABLA -->
            <div class="row w-100 " style="height:350px;overflow-y:auto;">
                <table class="table table-bordered border-primary ml-5  ">
                    <thead class="table-secondary text-primary">
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>FECHA VENTA</th>
                            <th>DEBE</th>
                            <th> FOLIO</th>
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
                                <th scope="col">SUBTOTAL</th>
                                <th scope="col">PRECIO IND.</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="cuerpoModal">
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
                            <button onclick="" class="btn nav-link mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
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
                                        <input type="number" oninput="calcularDeudaCredito()" id="abono" data-decimals="2" value=0 class="form-control" />
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
                    <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR E IMPRIMIR
                        TICKET</button>
                    <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">SOLO COBRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT-->
<script>
    const creditos = @json($credito);
    const clientes = @json($cliente);
    const ventas = @json($ventas);
    const detalleVentas = @json($detalleVentas);
    const productos = @json($productos);
    const pagos = @json($pagos);

    let idVent = 0;
    let idVent2 = 0;
    let restoFinal = 0;
    let totalCompra = 0;

    buscarCreditos();

    function buscarCreditos() {
        const palabraBusqueda = document.querySelector('#busquedaCliente');
        let cuerpo = "";
        let contador = 0;
        let cont = 0;
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
                idVent = id;
                cont = cont + 1;
                name = name2;
                fechaVenta = fechaVenta2;
                debe = debe2;
                folio = folio2;
                cuerpo = cuerpo + `
        <tr onclick="" data-dismiss="modal">
            <td>` + cont + `</td>    
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
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        };
    }

    let totalResta = 0;

    function calcularDeudaCredito() {
        const abono2 = document.querySelector('#abono');
        const debe = document.querySelector('#restoDeuda');
        if (parseFloat(abono2.value) > 0) {
            //alert('si entra');
            let diferencia = parseFloat(totalResta) - parseFloat(abono2.value);

            debe.innerHTML = "$ " + '<strong>' + diferencia + '</strong>';
            //cambio.textContent ="$" + '<strong>'+diferencia+'</strong>';
            //cambio.value = parseFloat(pago.value)-total;
        } else {
            debe.textContent = "$ 0.00"
        }
    }

    function modalVerMas(id) {
        let cant = 0;
        let subtotal = 0;
        let precioUni = 0;
        let nombreP = "";
        let cuerpo2 = "";
        let cont2 = 0;
        for (count6 in detalleVentas) {
            if (detalleVentas[count6].idVentas == id) {
                cant = detalleVentas[count6].cantidad;
                subtotal = detalleVentas[count6].subtotal;
                precioUni = detalleVentas[count6].precio_ind;
                for (count7 in productos) {
                    if (productos[count7].id == detalleVentas[count6].idProductos) {
                        nombreP = productos[count7].nombre;
                    }

                }
            }

        }
        cont2 = cont2 + 1;
        cuerpo2 = cuerpo2 + `
        <tr onclick="" data-dismiss="modal">
            <th scope="row">` + cont2 + `</th>
            <td>` + nombreP + `</td>    
            <td>` + cant + `</td>
            <td>` + subtotal + `</td>
            <td>` + precioUni + `</td>
        </tr>
        `;
        document.getElementById("cuerpoModal").innerHTML = cuerpo2;
    };

    function modalAbonar(id) {
        idVent2 = id;
        $("input[id='abono']").val(0);
        document.getElementById("restoDeuda").textContent = "$ " + 0.00;
        let pagado = 0;
        let total2 = 0;
        for (count8 in pagos) {
            if (pagos[count8].idVenta == id) {
                pagado = pagado + pagos[count8].monto;
            }
        }
        for (count9 in detalleVentas) {
            if (detalleVentas[count9].idVentas == id) {
                total2 = total2 + detalleVentas[count9].subtotal;
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
        } else {
            restoFinal = diferencia;

        }
    };

    function buscarCliente() {

        const palabraBusqueda = document.querySelector('#busquedaCliente');
        let cuerpo = "";
        let cont = 0;
        let idCliente = 0;
        let nombre = "";
        let folio = 0;
        let total = 0;
        let pago = 0;
        let fechaVenta = "";
        let debe = 0;
        descripcion2 = 0
        for (count11 in clientes) {
            if (clientes[count11].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                cont = cont + 1;
                nombre = clientes[count11].nombre;
                idCliente = clientes[count11].id;
                for (count12 in creditos) {
                    if (creditos[count12].idCliente == clientes[count11].id) {
                        folio = creditos[count12].idVenta;
                        for (count13 in detalleVentas) {
                            if (detalleVentas[count13].idVentas == folio) {
                                total = total + detalleVentas[count13].subtotal;
                            }
                        }
                        for (count14 in ventas) {
                            if (ventas[count14].id == folio) {
                                fechaVenta = new Date(ventas[count14].created_at);
                                fechaVenta.getTime();
                            }
                        }
                        for (count13 in pagos) {
                            if (pagos[count13].idVenta == folio) {
                                pago = pago + pagos[count13].monto;
                            }
                        }
                        descripcion2 = ventas[count2].id;

                        debe = total - pago;
                        if (debe > 0) {

                            cuerpo = cuerpo + `
                    <tr onclick="" data-dismiss="modal">
                    <th scope="row">` + cont + `</th>
                        <td>` + nombre + `</td>    
                        <td>` + fechaVenta.toLocaleDateString() + `</td>

                        <td id="d">` + debe + `</td>
                        <td>` + folio + `</td>
                        <td>` +
                                `<button class="btn btn-light" onclick="modalVerMas(` + folio + `)" data-toggle="modal" data-target="#detalleCompraModal"
                            type="button">VER MAS</button>
                        </td>
                        <td>` +
                                `<button class="btn btn-light" onclick="modalAbonar(` + folio + `)" data-toggle="modal" data-target="#confirmarVentaModal" 
                            type="button">ABONAR</button>
                        </td>

                    </tr>
                    `;

                        }

                    }

                }

            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    };



    //PAGO

    async function realizarVentaCredito() {
        // let json = JSON.stringify(productosVenta);
        const pago = document.querySelector('#abono');
        // const cliente = document.querySelector('#clientes');
        //if (pago.value.length == 0)
        //  return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
        if (parseFloat(pago.value) === 0)
            return alert('EL ABONO DEBE SER MAYOR A CERO');
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
                url: '/pago',
                // los datos que voy a enviar para la relación
                data: {
                    // datos: json,
                    totalCompra: parseFloat(totalCompra),
                    totalResta: parseFloat(totalResta),
                    // restoFinal: restoFinal,
                    idVenta: idVent2,
                    monto: parseFloat(pago.value),
                    _token: "{{ csrf_token() }}"
                }
            }).done(function(respuesta) {
                //  mostrarProductos();
                // console.log("fall1");
                //  buscarProducto();
                $('#confirmarVentaModal').modal('hide');
                $("input[id='abono']").val(0);
                location.reload();
                console.log(respuesta); //JSON.stringify(respuesta));
            });
            console.log(funcion);
            //  await cargarCredito();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
</script>

<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
    let valor = $("input[type='number']").inputSpinner();
    console.log(valor);
</script>

@endsection