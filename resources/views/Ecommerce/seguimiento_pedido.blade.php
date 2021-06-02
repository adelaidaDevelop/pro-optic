@extends('layouts.headerProcesoCompra')
@section('contenido')

<!--HASTA AQUI-->

<div class="col text-center  mx-auto mt-2 mb-4">
    <h4 class="text-dark">SEGUIMIENTO DE PEDIDO</h4>
    <h6 class="text-secondary">STATUS DE SU PEDIDO</h6>
</div>

<div class="col-12 input-group text-center mx-auto mb-4 mt-4" style="background:#F4F6F6">
    <h6 class="col-2"> PEDIDO: PEDIDO1 </h6>
    <h6 class="col-3">FECHA GENERADO: 28-05-2021 </h6>
    <h6 class="col-2"> STATUS: ENTREGADO </h6>
    <h6 class="col-4"> FECHA PROGRAMADA DE ENTREGA: 29-05-2021 </h6>
</div>
<!--
<div class=" col-12 text-right mt-3 my-1">
    <h6> FECHA PROGRAMADA DE ENTREGA: 29-05-2021 </h6>
</div>
-->

<div id="subtitulo" class="col text-center mx-auto my-2 ">
    <h6>ENTREGADO: 29 DE MAYO DE 2021</h6>
    <h6>RECIBIO: ADELAIDA MOLINA </h6>
    <br />
</div>
<div class="col-12 my-4 input-group text-center mx-auto " style="background:#D5DBDB">
    <button id="btnGenerarPed" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit">
        <img class="" src="{{ asset('img\pedidoGenerado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO GENERADO</small></p>
    </button>

    <div class=" h1 my-auto text-dark">
        <p>..........</p>
    </div>

    <!--PASO DOS -->

    <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>PEDIDO CONFIRMADO</small></p>
    </button>

    <div class="h1 my-auto text-dark">
        <p>..........</p>
    </div>
    <!--PASO TRES-->
    <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>EN PROCESO DE ENTREGA A DOMICILIO</small></p>
    </button>
    <div class="h1 my-auto text-dark">
        <p>..........</p>
    </div>
    <!--PASO CUATRO-->
    <button class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\entregado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark"><small>ENTREGADO</small></p>
    </button>
</div>


<div id="verHistorial" class="text-center mx-auto my-4 p-3" style="background:#B2BABB">
    <a href=""> VER HISTORIAL</a>
    <button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick="" value="">
        <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
    </button>
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
                <div class="row border my-0 mx-0 px-0 " style="height:300px;overflow-y:auto;" id="tablaBusqueda">
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
<script>
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