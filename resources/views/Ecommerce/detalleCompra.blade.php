@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent h5">
            <li class="breadcrumb-item"><a href="{{url('/')}}">INICIO</a></li>
            <li class="breadcrumb-item"><a href="{{url('/carrito')}}">CARRITO-COMPRAS</a></li>
            <li class="breadcrumb-item active" aria-current="page">DIRECCION</li>
        </ol>
    </nav>
</div>

<div class=" row col-12 px-4   my-2 input-group text-center mx-auto alert-secondary " style="background:#D5DBDB">
    <button id="btnGenerarPed" class="btn btn-outline-secondary col  text-center  p-1 border-0" type="submit" disabled>
        <img class="img-fluid" src="{{ asset('img\posicion.png') }}" alt="Editar" width="30px" height="30px" max-width="30px">
        <p class="h6 my-auto mx-2 text-success">Dirección de envio</p>
    </button>
    <div class=" h1 my-auto text-success">
        <p class="d-none d-md-block">..............</p>
        <p class="d-block d-md-none">.....</p>
    </div>
    <!--PASO DOS -->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\tarjeta2.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-secondary">Metodo de pago</p>
    </button>
    <div class="h1 my-auto text-secondary">
        <p class="d-none d-md-block">..............</p>
        <p class="d-none d-sm-block d-md-none">.....</p>
    </div>
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\revision.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-secondary">Revisar y confirmar compra</p>
    </button>

    <div class="h1 my-auto text-secondary">
        <p class="d-none d-md-block">..............</p>
        <p class="d-block d-md-none">.....</p>
    </div>
    <!--PASO TRES-->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\pedidoConfirmado.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-secondary">Pedido Generado exitosamente</p>
    </button>
</div>
<div class="row col-12 mx-0 px-0 ">
    <div class="col-12 col-md-9 mx-0 px-0 px-md-2 ml-md-0 mr-md-auto border mb-2">
        <div class="row col-12 mx-0 mr-md-2 px-0 px-md-2 mb-auto border-bottom border-dark">
            <div class="col-3 col-md-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="row col-9 col-md-11 my-auto px-0 text-left">Dirección De Envío</h5>
        </div>
        <div class="row col-12 mx-0 px-0">
            <div class="col-12 mx-auto mb-auto ">
                <div class="row col-12 mt-3">
                    <p><strong class="">{{$nombre}}</strong></p>
                </div>
                <div class="row col-12 mt-3 text-center mx-auto">
                    <p><strong class="">Seleccione una de las direcciones que usted a registrado </strong></p>
                </div>
                <div class="form-group row col-12 mx-0 px-0">
                    <label for="domicilios" class="col-auto col-md-1 mb-1 mx-0 px-0 col-form-label text-center">Domicilio</label>

                    <div class="col-12 mx-0 mt-1 mb-2 col-md-10 px-0">

                        <select class="custom-select my-auto mx-auto" onchange="getDireccion()" id="domicilios">
                            @foreach($domicilios as $domicilio)
                            <option value="{{$domicilio->id}}" selected>
                                <p class="text-white my-0 p-0"><small>
                                        {{$domicilio->calle}} {{$domicilio->numeroExterior}},
                                        @if(isset($domicilio->numeroInterior)){{$domicilio->numeroInterior}}, @else
                                        @endif
                                        {{$domicilio->codigoPostal}}, {{$domicilio->colonia}}, Zimatlán de Álvarez,
                                        Oaxaca
                                    </small></p>
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mx-auto mx-md-0">
                    <p class="h6 p-2 border" id="direccion">
                        {{$domicilios[count($domicilios)-1]->calle}}
                        {{$domicilios[count($domicilios)-1]->numeroExterior}},
                        @if(isset($domicilios[count($domicilios)-1]->numeroInterior)){{$domicilios[count($domicilios)-1]->numeroInterior}},
                        @else @endif
                        {{$domicilios[count($domicilios)-1]->codigoPostal}},
                        {{$domicilios[count($domicilios)-1]->colonia}}, Zimatlán de Álvarez, Oaxaca
                    </p>
                </div>
                <div class="row col-12 mt-md-3">
                    <p class="h6">Tel: {{$telefono}}</p>
                </div>
            </div>
            <!--div class="row col-2 mt-0 mx-auto mb-auto">
                <button class="btn btn-outline-danger border-0" id="editarDireccion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                </button>
                <form method="post" action="{{url('/eliminarDireccion')}}" class="">
                    {csrf_field()}}
                    <button class="btn btn-outline-danger border-0" id="eliminarDireccion">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>
                </form>
            </div-->
        </div>
        <!--
        <div class="row col-12 mx-0 mr-auto px-0 mb-auto border-bottom border-dark">
            <div class="col-3 col-md-1 my-1 mx-0 px-1">
                <img class="col-md-10 mx-0 img-fluid" src="{{ asset('img\camion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="row col my-auto px-0 text-left">Detalle De Envío</h5>
        </div>
        <div class="row col-12 mt-0 mx-auto mb-auto border-bottom border-dark">
            @foreach($carrito as $p)
            <div class="row col-12 border-bottom">
                <div class="row col-2 mx-0">
                    @if(!empty($p['imagen']))
                    <img src="{{ asset('storage').'/'.$p['imagen']}}" alt="" class="img-fluid">
                    @else
                    <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" class="img-fluid">
                    @endif
                </div>
                <div class="row col-3 mx-0">
                    <p class="my-auto mx-auto text-center">{{$p['nombre']}}</p>
                    <p class="my-auto mx-auto text-center">Cantidad: {{$p['cantidad']}}</p>
                </div>
            </div>
            @endforeach
        </div>
        -->

    </div>
    <div class="col-md-3 mr-md-0 ml-md-auto px-0 pl-md-2 pr-md-0">
        <div class="row mx-0 mb-auto p-1 border .hidden-md-up ">
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom  .hidden-md-up">
                <h4 class="col-12 mx-auto my-1 py-0 text-center .hidden-md-up">Resumen de compra</h4>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom .hidden-md-up">
                <h5 class="mr-auto my-1 text-center .hidden-md-up">Subtotal</h5>
                <h5 class="ml-auto my-1 text-center .hidden-md-up" id="subtotal">$ 0.00</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom .hidden-md-up">
                <h5 class="mr-auto my-1 text-center">Costo del envío</h5>
                <h5 class="ml-auto my-1 text-center" id="envio">*por calcular</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom .hidden-md-up">
                <h5 class="mr-auto my-1 text-center .hidden-md-up">Total</h5>
                <h5 class="ml-auto my-1 text-center" id="total">$0.00 </h5>
            </div>
        </div>
    </div>
    <div class="col-9 text-right py-1">
        <a class="btn btn-primary btn-lg" href="{{url('/metodoPago')}}">Continuar</a>
        <!-- <button class="btn btn-success btn-lg" onclick="{{url('/metodoPago')}}" type="submit">Continuar2</button>-->
    </div>
</div>
<script>
    let totalCompra = 0;
    $('#editarDireccion').click(function() {
        location.href = "{{url('/direccionEnvio?domicilio=false')}}";
    });

    async function calcularTotal() {
        if (carrito == null)
            return;
        //let totalCompra = 0;
        totalCompra = 0;
        let cuerpoCarrito = "";
        let contador = 0;
        for (let i in carrito) {
            if (carrito[i].sucursal == sucursal) {
                contador++;
                totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
            }
        }
        let envioCosto = 15;
        if (contador != 0) {
            $('#subtotal').html(`$ ${totalCompra}`);
            $('#envio').html(`$ ${envioCosto}`);
            let suma = totalCompra + envioCosto;
            $('#total').html(`$ ${suma}`);
            return;
        }

        if (contador != 0) {
            $('#subtotal').html(`$ ${totalCompra}`);
            $('#total').html(`$ ${totalCompra}`);
            return;
        }
    }
    calcularTotal();

    function getDireccion() {
        let id = document.getElementById('domicilios').value;
        let domicilios = @json($domicilios);
        let domicilio = domicilios.find(p => p.id == id);
        let numeroInterior = "";
        if (domicilio.numeroInterior != null)
            numeroInterior = domicilio.numeroInterior + ",";
        document.getElementById('direccion').textContent =
            `${domicilio.calle} ${domicilio.numeroExterior}, ${numeroInterior}
    ${domicilio.codigoPostal}, ${domicilio.colonia}, Zimatlán de Álvarez, Oaxaca`;
    }
    /*
        function continuar() {
            //  let tot = document.getElementById("total");
            //let total = parseFloat(tot.va);
            console.log("El total es:", totalCompra);
            location.href = `{{url('/metodoPago')}}?totalC=${totalCompra}`;
        }
        */
</script>
@endsection