@extends('layouts.headerProcesoCompra')
@section('contenido')

<!--HASTA AQUI-->

<div class="col text-center  mx-auto mt-2 mb-4">
    <h4 class="text-dark my-4">SEGUIMIENTO DE PEDIDO</h4>
    <h6 class="text-secondary alert-success">ESTADO DE SU PEDIDO</h6>
</div>

<div class="col-12 input-group text-center mx-auto mb-4 mt-4" style="background:#F4F6F6">
    <h6 class="col-2"> FOLIO: {{$venta->id}} </h6>
    <h6 class="col-3">FECHA GENERADO: {{$venta->created_at->format('d-m-Y')}} </h6>
    <h6 class="col-2"> STATUS: {{$ventaCliente->estado}} </h6>
    <h6 class="col-4"> HORA PROGRAMADA DE ENTREGA: {{$venta->created_at->addMinutes(60)->isoFormat('H:mm:ss A')}} </h6>
</div>
<!--
<div class=" col-12 text-right mt-3 my-1">
    <h6> FECHA PROGRAMADA DE ENTREGA: 29-05-2021 </h6>
</div>
-->

<div id="subtitulo" class="col text-center mx-auto my-2 ">
    @if($ventaCliente->estado == 'PAGADO')
    <h6>ENTREGADO: {{$ventaCliente->updated_at->format('d-m-Y')}} {{$ventaCliente->updated_at->isoFormat('H:mm:ss A')}}</h6>
    @endif
    <br />
</div>
<div class="col-12 my-4 input-group text-center mx-auto " style="background:#D5DBDB">
    <button id="paso1" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" value="ACEPTADO" disabled>
        <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO ACEPTADO</small></p>
    </button>
    <div id="rama1" class=" h1 my-auto text-success">
        <p>.....</p>
    </div>
    <!--PASO DOS -->
    <button id="paso2" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" value="PREPARANDO" disabled>
        <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>PREPARANDO PEDIDO</small></p>
    </button>
    <div id="rama2" class="h1 my-auto text-success">
        <p>.....</p>
    </div>
    <!--PASO TRES-->
    <button id="paso3" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" value="ENCAMINO" disabled>
        <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>EN PROCESO DE ENTREGA A DOMICILIO</small></p>
    </button>
    <div id="rama3" class="h1 my-auto text-success">
        <p>.....</p>
    </div>
    <!--PASO CUATRO-->
    <button id="paso4" class="btn btn-danger col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>ENTREGADO</small></p>
    </button>
    <!--Dinamico-->
    <!--
    <div class=" col-8">
        <div id="seguimientoPaq" class="col-11 mt-4 input-group text-center mx-auto " style="background:#D5DBDB">
        </div>
        <div id="estad" class="row col-12 mx-auto ">
           </div>
        <div id="estadoDesc" class="row col-12 mx-auto mb-4 ">
               </div>
        <div id="instruccion" class="row col-12 mx-auto mb-4">
              </div>
        <div class="row col-12  mx-auto" id="divActBtn">

        </div>
    </div>-->
</div>


<div id="verHistorial" class="text-center mx-auto my-4 p-3" style="background:#B2BABB">
    <!--<a class="btn btn-primary " href="{{url('/comprobante/')}}"> GENERAR COMPROBANTE</a> -->
    <button id="btnComprobante" onclick="cargarComprobante()" class="btn btn-primary"> GENERAR COMPROBANTE</button>
    <!--button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick="" value="">
        <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
    </button-->
</div>

<!-- MODAL TABLA -->
<!-- MODAL-->
<div class="modal fade bd-example-modal-lg" id="detalleProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;">
            <div class="modal-header">
                <!--ENCABEZADO -->
                <div class="container">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 text-center mx-auto " style="color:#FFFFFF">
                            HISTORIAL
                        </h6>
                    </div>
                </div>
                <!--button type="button" class="close" data-dismiss="modal" aria-label="Close"-->
                <!-- <span aria-hidden="true">&times;</span>-->
                <!--/button-->
            </div>
            <div class="modal-body  col-12" id="">
                <!-- TABLA -->
                <div id="imp" class="row border my-0 mx-0 px-0 " style="height:300px;overflow-y:auto;" id="tablaBusqueda">
                    <table class="table table-responsive-lg  border-primary  text-center " id="productos">
                        <thead class=" text-dark" id="cabeceraProductos">
                            <tr>
                                <th scope="col">FECHA</th>
                                <th scope="col">HORA</th>
                                <th scope="col">UBICACION</th>
                                <th scope="col">DESCRIPCION</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda" class="text-uppercase ">

                        </tbody>
                    </table>
                </div>



                <div id="subAgregar" class="col mx-auto mt-4 text-center"></div>
                <div class="col modal-footer input-group" id="pieInformacion">
                    <a class="" href="/puntoVenta/descComprobante">
                        GENERAR COMPROBANTE2
                    </a>

                    <button type="button" class="btn btn-primary" id="actPrecio2" onclick="generarComprobante();">GENERAR COMPROBANTE</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js\html2pdf.bundle.min.js')}}"></script>
<script>
    let elemento = "";
    let idVenta = @json($idVenta);

    function asignarEstado() {

        let ventaCliente = @json($ventaCliente);
        let estado = ventaCliente.estado;
        for (let i = 1; i <= 4; i++) {
            $(`#paso${i}`).addClass('btn-secondary');
            $(`#paso${i}`).removeClass('btn-success');
            $(`#paso${i}`).removeClass('btn-danger');
            $(`#paso${i}`).removeClass('btn-warning');
            $(`#rama${i}`).removeClass('text-success');
        }
        //return;
        console.log('Si entra');
        for (let i = 1; i <= 3; i++) {
            let btnEstado = document.getElementById(`paso${i}`).value;
            $(`#paso${i}`).addClass('btn-success');
            $(`#rama${i}`).addClass('text-success');
            console.log('btnEstado', btnEstado);
            console.log('Estado', estado);
            if (btnEstado == estado)
                return;
        }
        if (estado == 'ENTREGADO') {
            $(`#paso4`).addClass('btn-success');
            return;
        }
        if (estado == 'CANCELADO') {
            $(`#paso4`).addClass('btn-danger');
            return;
        }
        if (estado == 'SINLOCALIZAR') {
            $(`#paso4`).addClass('btn-warning');
            return;
        }
        return -1;
    }
    asignarEstado();

    function cargarComprobante() {
        console.log("entro a metodo generar comprobante");
        // document.getElementById("resultados").innerHTML = "";
        fetch(`{{url('/comprobante/')}}/${idVenta}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                elemento = html;
                descargar();
            });
    };

    async function descargar() {
        //  console.log("si entra a descargar");
        var divTabla = document.getElementById("imp");
        try {
            const $elementoParaConvertir = elemento;
           // const $elementoParaConvertir = divTabla.innerHTML;
            html2pdf()
                .set({
                    margin: 1,
                    filename: 'comprobantePedido.pdf',
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
                        format: "a2",
                        orientation: 'portrait' // landscape o portrait
                    }
                })
                .from($elementoParaConvertir)
                .save()
                .catch(err => console.log(err));

        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    //imprirmir


    // imprimir
    /*
    document.addEventListener("btnGenerarPed", () => {
        const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: 1,
                filename: 'reporteVentas.pdf',
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
                    format: "a2",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
    });
    */
</script>

@endsection