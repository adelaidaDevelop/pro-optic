@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12 py-1">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent h5">
            <li class="breadcrumb-item"><a href="{{url('/')}}">INICIO</a></li>
            <li class="breadcrumb-item"><a href="{{url('/menu')}}">CLIENTE</a></li>
            <li class="breadcrumb-item active" aria-current="page">SEGUIMIENTO-PEDIDO</li>
        </ol>
    </nav>
</div>
<!--HASTA AQUI-->

<div class="col text-center p-0 mx-auto  mb-2">
    <h4 class="text-dark ">SEGUIMIENTO DE PEDIDO</h4>
    <h5 class="text-secondary alert-success">ESTADO DE SU PEDIDO</h5>
</div>

<div class="row col-12 input-group text-center mx-auto  mt-4" style="background:#F4F6F6">
    <h5 class="col col-md-2"><strong> FOLIO:</strong> {{$venta->id}} </h5>
    <h5 class="col col-md-3"><strong> FECHA GENERADO: </strong>{{$venta->created_at->format('d-m-Y')}} </h5>
    <h5 class="col col-md-3"> <strong>STATUS: </strong>{{$ventaCliente->estado}} </h5>
   <!-- <h5 class="col col-md-4"> <strong>HORA PROGRAMADA DE ENTREGA:</strong> {{$venta->created_at->addMinutes(60)->isoFormat('H:mm:ss A')}} </h5>-->
</div>
<div class="row col-12 input-group text-right mb-4 mt-4" style="background:#F4F6F6">
   <h5 class="col-12 col-md-12"> <strong>HORA PROGRAMADA DE ENTREGA:</strong> {{$venta->created_at->addMinutes(60)->isoFormat('H:mm A')}} </h5>
</div>
<!--
<div class=" col-12 text-right mt-3 my-1">
    <h6> FECHA PROGRAMADA DE ENTREGA: 29-05-2021 </h6>
</div>
-->

<div id="subtitulo" class="col text-center mx-auto my-1 ">
    @if($ventaCliente->estado == 'PAGADO')
    <h6>ENTREGADO: {{$ventaCliente->updated_at->format('d-m-Y')}} {{$ventaCliente->updated_at->isoFormat('H:mm:ss A')}}</h6>
    @endif
    <br />
</div>
<div class="col-12 my-4 input-group text-center mx-auto " style="background:#D5DBDB">
    <button id="paso1" class="btn btn-success col mx-2 my-2  text-center  p-1 border-0" type="submit" value="ACEPTADO" disabled>
        <img class="" src="{{ asset('img/pedidoConfirmado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark">PEDIDO ACEPTADO</p>
    </button>
    <div id="rama1" class=" h1 my-auto text-success">
        <p>.....</p>
    </div>

    <!--PASO DOS -->
    <button id="paso2" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" value="PREPARANDO" disabled>
        <img class="" src="{{ asset('img/caja.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark">PREPARANDO PEDIDO</p>
    </button>
    <div id="rama2" class="h1 my-auto text-success">
        <p>.....</p>
    </div>
    <!--PASO TRES-->
    <button id="paso3" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" value="ENCAMINO" disabled>
        <img class="" src="{{ asset('img/procesoEntrega.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark">EN CAMINO</p>
    </button>
    <div id="rama3" class="h1 my-auto text-success">
        <p>.....</p>
    </div>
    <!--PASO CUATRO-->
    <button id="paso4" class="btn btn-outline-secondary col mx-2 my-2  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img/entregado.png') }}" alt="Editar" width="50px" height="50px">
        <p class="h6 my-auto mx-2 text-dark">ENTREGADO</p>
    </button>
    <div id="estadoDesc" class="row col-12 mx-auto mb-4 ">
     <p class="col-auto  mx-auto text-dark h5 alert-success"><small><strong> Paquete entregado.</strong> </small></p>
    </div>
<!--
    <div id="instruccion" class="row col-12 mx-auto mb-4">
                        <p class="col-auto  mx-auto text-secondary  h5"><small><strong> Presione para actualizar el
                                    estado del paquete a:</strong> </small></p>
                    </div>
                    -->
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
    <button id="btnComprobante" onclick="cargarComprobante()" class="btn btn-primary">
    <img src="{{ asset('img/Comprobante.png') }}" alt="Editar" width="40px" height="40px">
     GENERAR COMPROBANTE</button>
</div>

<!-- MODAL TABLA -->
<!-- MODAL-->
<!--
<div class="modal fade bd-example-modal-lg" id="detalleProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;">
            <div class="modal-header">
              
                <div class="container">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 text-center mx-auto " style="color:#FFFFFF">
                            HISTORIAL
                        </h6>
                    </div>
                </div>
               button type="button" class="close" data-dismiss="modal" aria-label="Close"-->
                <!-- <span aria-hidden="true">&times;</span>
                /button
            </div>
            <div class="modal-body  col-12" id="">
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

                    <button type="button" class="btn btn-primary" data-dismiss="modal">CANCELAR</button>

                </div>
            </div>
        </div>
    </div>
</div>
-->
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
            $(`#paso${i}`).removeClass('btn-outline-secondary'); //ade
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
            if(i==1){
                 document.getElementById("estadoDesc").innerHTML =
                 `<p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Pedido aceptado </strong> </small></p>`;
            }else 
            if(i==2){
                 document.getElementById("estadoDesc").innerHTML =
                 `<p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Preparando pedido para su salida </strong> </small></p>`;
            } else 
            if(i==3){
                 document.getElementById("estadoDesc").innerHTML =
                 `<p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> Pedido en camino. Por favor estar al pendiente para la entrega </strong> </small></p>`;
            }

            if (btnEstado == estado)
                return;
        }
        if (estado == 'ENTREGADO') {
            $(`#paso4`).addClass('btn-success');
            document.getElementById("estadoDesc").innerHTML =
                 `<p class="col-auto  mx-auto text-dark h5 mt-2 alert-success"><small><strong> El pedido a sido entregado </strong> </small></p>`;
            return;
        }
        if (estado == 'CANCELADO') {
            document.getElementById("estadoDesc").innerHTML =
                 `<p class="col-auto  mx-auto text-danger h5 mt-2 "><small><strong> El pedido a sido cancelado. </strong> </small></p>`;
            $(`#paso4`).addClass('btn-danger');
            return;
        }
        if (estado == 'SINLOCALIZAR') {
            document.getElementById("estadoDesc").innerHTML =
                 `<p class="col-auto  mx-auto text-dark h5 mt-2 bg-warning"><small><strong> El pedido no pudo ser entregado. Usted puede solicitar un último intento o pasar a sucursal a recogerlo en un máximo de 24 hrs.</strong> </small></p>`;
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
      //  var divTabla = document.getElementById("imp");
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
</script>

@endsection