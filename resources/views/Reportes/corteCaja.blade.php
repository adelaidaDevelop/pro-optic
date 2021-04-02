@extends('header2')
@section('contenido')
@section('subtitulo')
CORTE DE CAJA
@endsection
@section('opciones')
<div class="col-9 "></div>
<div class=" my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>
@endsection


<!--CONSULTAR PRODUCTO -->

<div class="PrintArea" id="PrintArea" name="PrintArea">
    <div class="row col border border-dark ml-0 mr-0 mb-4 mt-2 ">
        <h4 class=" row col-5 ml-1 mt-2 mb-4 mx-auto text-primary ">
            <strong>
                CORTE DE CAJA
            </strong>
        </h4>
        <br />
        <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
        <div class="row w-100   mr-2 ">
            <div class="row  form-group input-group  ml-4">
                <div class="row col-4 form-group input-group mx-4">
                    <h5 class=" my-0 mr-3">FECHA CORTE:</h5>
                    <input type="date" min="" id="fechaCorte" name="fechaCorte" class="form-control my-0" />
                </div>
                <div class="col-6 mx-4 form-group input-group ">
                    <h5 class="mr-3 mx-3 my-0">CAJERO</h5>
                    <select class="col-4 mt-1" name="idCajero" id="idCajero" onchange="" required>
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
            </div>
            <!-- BOTON CORTE-->
            <div class="row col-5 ml-1 mt-2 mx-auto">
                <button class="btn btn-outline-primary text-dark" onclick="calcularCorte()">
                    CALCULAR
                    <img src="{{ asset('img\corte.png') }}" alt="Editar" width="35px" height="35px">
                </button>
            </div>
        </div>
        <div class="row col-9 mt-1 ">
            <div id="sinRegistros" class="col">
            </div>
        </div>
        <div class="row w-100 mx-4 ">
            <div class="col-1 "></div>
            <div>
                <h6 class="text-primary">+ENTRADAS</h6>
                <h6 class="ml-3">+TOTAL VENTAS</h6>
                <h6 class="ml-3">+ABONO DEUDORES</h6>
                <h6 class="ml-4 mt-3 font-weight-bold"> SUBTOTAL ENTRADAS:</h6>
                <h6 class="text-primary mt-3">-SALIDAS</h6>
                <h6 class="mt-3 ml-3 ">-TOTAL DEVOLUCIONES</h6>
                <!--<h6 class="ml-3">-ABONO PROVEEDORES</h6>
            <h6 class="ml-3">-COMPRAS AL CONTADO</h6>
            -->
                <h6 class="ml-3 font-weight-bold">SUBTOTAL SALIDAS:</h6>
            </div>
            <div class="col-3 ml-3">
                <div class=" mt-4 my-0 input-group">
                    <h6>$</h6><input type="number" style="height:23px" id="totalVentas" disabled />
                </div>
                <div class=" mt-1 my-0  input-group">
                    <h6>$</h6><input type="number" id="abonoD" style="height:23px" disabled />
                </div>
                <div class="mt-2 my-0  input-group">
                    <h6>$</h6><input type="number" id="subtotalE" style="height:23px" disabled />
                </div>
                <div class=" mt-5 my-0 input-group">
                    <h6>$</h6><input type="number" id="devolucionT" class="" style="height:23px" disabled />
                </div>
                <!--<input type="number" onchange="filtrarCompras()" id="fechaFinal" class=" mt-1 my-0" style="height:23px" />
            <input type="number" onchange="filtrarCompras()" id="fechaFinal" class=" mt-1 my-0" style="height:23px" />
            -->
                <div class=" mt-1 my-0 input-group">
                    <h6>$</h6><input type="number" id="subtotalS" style="height:23px" disabled />
                </div>
            </div>
            <div class="col-4  ">
                <div class="form-group input-group text-primary mt-4 mb-5">
                    <h5>TOTAL:</h5>
                    <h5 class="ml-2">$</h5><input type="number" id="total" style="height:23px" disabled />
                </div>

                <button id="btnCrearPdf"  class="btn btn-secondary ml-4 mb-5 mx-auto mt-5">IMPRIMIR CORTE
                </button>


                <!--
            <div class="row form-group input-group">
                <h6 class="mt-3 text-primary">GANANCIA DEL DIA:</h6>
                <input type="number" id="fechaFinal" class="ml-2 mt-3 my-0" style="height:23px" />
            </div>
            -->
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
<script src="{{ asset('js\jquery.PrintArea.js') }}" type="text/JavaScript" language="javascript"></script>
<script src="{{ asset('js\html2pdf.bundle.min.js')}}"></script>
<script>
    const ventas = @json($ventas);
    const pagos = @json($pagos);
    const devoluciones = @json($devoluciones);
    const pagoCompras = @json($pagoCompras);
    const compras = @json($compras);
    let sucursalEmpleado = @json($sucursalEmpleados);

    function validarCamposFechas() {
        // let selectFecha = document.querySelector('input[name="fechaCorte"]:checked');
        //  let opcFecha = selectFecha.value;
        let fechaDia = document.querySelector('#fechaCorte');
        if (fechaDia.value.length > 0) {
            return true;
        }
        return false;
    };


    function calcularCorte() {
        document.getElementById("sinRegistros").innerHTML = "";

        console.log("si");
        let cuerpo = "";
        let contador = 1;
        let cont = 0;
        let emple = "";
        let fecha = "";
        let totalVentas = 0;
        let abonos = 0;
        let entradas = 0;
        let totalDev = 0;
        let abonoProveedores = 0;
        let comprasContado = 0;
        let salidas = 0;
        let total = 0;
        let idCajeroOK = 0;
        if (validarCamposFechas()) {
            //VERIFIAR CAJERO
            let fechaC = document.querySelector('#fechaCorte');
            let fechaCorte = new Date(fechaC.value);
            fechaCorte.setDate(fechaCorte.getDate() + 1);
            let idCajer = document.querySelector('#idCajero');
            if (idCajer.value != "0") {
                idCajeroOK = parseInt(idCajer.value);
                for (let j in ventas) {
                    //TOTAL VENDIDO
                    if (ventas[j].tipo.toUpperCase().includes('EFECTIVO')) {
                        let fechaVC = new Date(ventas[j].created_at);
                        if (comparacionFecha(fechaCorte, fechaVC)) {
                            let idSucEmp = ventas[j].idSucursalEmpleado;
                            for (let h in sucursalEmpleado) {
                                if (sucursalEmpleado[h].id == idSucEmp) {
                                    if (sucursalEmpleado[h].idEmpleado == idCajeroOK) {
                                        {
                                            totalVentas = totalVentas + ventas[j].pago;
                                        }

                                    }
                                }
                            }

                        }
                    }
                    //ABONO COMPLETADOS
                    for (let z in pagos) {
                        let fechaP = new Date(pagos[z].created_at);
                        if (ventas[j].id == pagos[z].idVenta) {
                            if (comparacionFecha(fechaCorte, fechaP)) {
                                let idSucEmp = ventas[j].idSucursalEmpleado;
                                for (let h in sucursalEmpleado) {
                                    if (sucursalEmpleado[h].id == idSucEmp) {
                                        if (sucursalEmpleado[h].idEmpleado == idCajeroOK) {
                                            {
                                                abonos = abonos + pagos[z].monto;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        for (let x in devoluciones) {
                            let fechaD = new Date(devoluciones[x].created_at);
                            if (devoluciones[x].idVenta === ventas[j].id) {
                                if (comparacionFecha(fechaCorte, fechaD)) {
                                    let idSucEmp = ventas[j].idSucursalEmpleado;
                                    for (let h in sucursalEmpleado) {
                                        if (sucursalEmpleado[h].id == idSucEmp) {
                                            if (sucursalEmpleado[h].idEmpleado == idCajeroOK) {
                                                {
                                                    totalDev = totalDev + devoluciones[x].totalDevolucion;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                for (let j in ventas) {
                    let idSucEmp = ventas[j].idSucursalEmpleado;
                    for (let h in sucursalEmpleado) {
                        if (sucursalEmpleado[h].id == idSucEmp) {
                            if (ventas[j].tipo.toUpperCase().includes('EFECTIVO')) {
                                let fechaVC = new Date(ventas[j].created_at);
                                if (comparacionFecha(fechaCorte, fechaVC)) {

                                    totalVentas = totalVentas + ventas[j].pago;

                                }
                            }
                            //ABONO COMPLETADOS
                            for (let z in pagos) {
                                let fechaP = new Date(pagos[z].created_at);
                                if (ventas[j].id == pagos[z].idVenta) {
                                    if (comparacionFecha(fechaCorte, fechaP)) {

                                        abonos = abonos + pagos[z].monto;
                                    }
                                }
                            }
                            for (let x in devoluciones) {
                                let fechaD = new Date(devoluciones[x].created_at);
                                if (devoluciones[x].idVenta === ventas[j].id) {
                                    if (comparacionFecha(fechaCorte, fechaD)) {

                                        let total2 = devoluciones[x].precio * devoluciones[x].cantidad;
                                        totalDev = totalDev + total2;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            entradas = totalVentas + abonos;
            // salidas = totalDev + abonoProveedores + comprasContado;
            salidas = totalDev;
            total = entradas - salidas;
            console.log("Llega aqui");
            // let tv= Number(totalVentas.toFixed(2));
            $("input[id='totalVentas']").val(Number(totalVentas.toFixed(2)));
            $("input[id='abonoD']").val(Number(abonos.toFixed(2)));
            $("input[id='subtotalE']").val(Number(entradas.toFixed(2)));
            $("input[id='devolucionT']").val(Number(totalDev.toFixed(2)));
            $("input[id='subtotalS']").val(Number(salidas.toFixed(2)));
            $("input[id='total']").val(Number(total.toFixed(2)));
            console.log(totalVentas);
            if (totalVentas == 0 && abonos == 0 && entradas == 0 && totalDev == 0 && salidas == 0) {
                let sin = `<h5 class= "text-dark text-center mx-auto"> NO SE ENCONTRARON REGISTROS </h5>`;
                document.getElementById("sinRegistros").innerHTML = sin;

            }
            //document.getElementById("totalVentas").innerHTML = cuerpo;
        } else {
            return alert("ELEGIR UNA FECHA");
        }
    };

    function comparacionFecha(fechaI, fechaF) {
        console.log("si compara");
        if (fechaI.getFullYear() == fechaF.getFullYear()) {
            if (fechaI.getMonth() == fechaF.getMonth()) {
                if (fechaI.getDate() == fechaF.getDate())
                    return true;
            }
        }
        return false;
    };

    function imprimirOK() {
        console.log("entra aqui");
        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: close
        };
        $("#PrintArea").printArea([options]);

    }

    //imprimir reporte
    /*
    $(document).ready(function() {
        $("#printButton").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });



    $("#print_button").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.PrintArea").printArea([options]);
            }
            */
    jQuery.downloadReporte = function(url, data) {

        url = "reportes/" + url;

        $.ajax({

            url: url,

            data: data,

            type: 'post',

            success: function(datar) {

                var randomDivImpresion = Math.floor(Math.random()); //Numero aleatorio

                var nombreDivImpresion = 'recibeImpresion' + randomDivImpresion; //Div temporal con numero aleatorio en el nombre

                var div_impresion = '<div id="' + nombreDivImpresion + '"></div>'; //codigo html del div

                $(div_impresion).appendTo('body'); //se agrega al elemento body, para hacerlo funcional.

                $("#" + nombreDivImpresion).html(datar); //se asigna la pagina que viene desde el servidor.

                $("#" + nombreDivImpresion).jqprint(); //se invoca la impresion.

                $("#" + nombreDivImpresion).remove(); //se remueve el div temporal despues de la impresion.

            }

        });
    }


    document.addEventListener("DOMContentLoaded", () => {
        // Escuchamos el click del botón
        const $boton = document.querySelector("#btnCrearPdf");
        $boton.addEventListener("click", () => {
            const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
            html2pdf()
                .set({
                    margin: 1,
                    filename: 'documento.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 3, // A mayor escala, mejores gráficos, pero más peso
                        letterRendering: true,
                    },
                    jsPDF: {
                        unit: "in",
                        format: "a4",
                        orientation: 'landscape' // landscape o portrait
                    }
                })
                .from($elementoParaConvertir)
                .save()
                .catch(err => console.log(err));
        });
    });
</script>

@endsection