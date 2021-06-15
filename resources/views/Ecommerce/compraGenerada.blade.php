@extends('layouts.headerProcesoCompra')
@section('contenido')

<div class=" row col-12 px-4  py-2 my-2 input-group text-center mx-auto alert-secondary " style="background:#D5DBDB">
    <button id="btnGenerarPed" class="btn btn-outline-secondary col  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\posicion.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-success">Dirección de envio</p>
    </button>
    <div class=" h1 my-auto text-success">
        <p class="d-none d-md-block">..............</p>
        <p class="d-block d-md-none">.....</p>
    </div>
    <!--PASO DOS -->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\tarjeta2.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-success">Medios de pago</p>
    </button>

    <div class="h1 my-auto text-success">
        <p class="d-none d-md-block">..............</p>
        <p class="d-none d-sm-block d-md-none">.....</p>
    </div>
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\revision.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-success">Revisar y confirmar compra</p>
    </button>

    <div class="h1 my-auto text-success">
        <p class="d-none d-md-block">..............</p>
        <p class="d-block d-md-none">.....</p>
    </div>
    <!--PASO TRES-->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\pedidoConfirmado.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-success">Pedido Generado exitosamente</p>
    </button>
</div>

<div class="row col-12 mx-0 px-0">
    <div class="row col-md-9 mx-auto px-1 py-1 mb-auto border-bottom border-dark ">
        <div class="col-2 col-md-1 my-auto my-md-1 mx-md-auto px-0 py-0">
            <img class="col-12 col-md-10 mx-auto my-0 img-fluid" src="{{ asset('img\dar_alta.png') }}" alt="FORMA DE PAGO" />
        </div>
        <h4 class="row col mx-auto my-auto py-auto px-1 text-left alert-info">Pedido generado correctamente</h4>
        <h4 class="row col mx-auto my-auto py-auto px-1 text-center mx-auto alert-info" id="folio">Numero Folio: 444 </h4>
        <!--h6 class="row col mx-auto my-auto py-auto px-1 text-left alert-info d-block d-sm-none display-4">Revisión de su compra</h6-->
    </div>


    <div class="row col-md-9 mx-auto mt-1  mb-4  ">
        <div class="row col-12 mx-auto px-0 mb-auto">
            <div class="col-2 col-md-1 my-1 mx-0 px-0">
                <img class="col-12 col-md-10 mx-0 img-fluid" src="{{ asset('img\sonrisa.png') }}" alt="UBICACION" />
            </div>
            <h4 class="col-9 col-md-auto mx-auto my-auto px-0 text-success text-left">Farmacias Gi agradece su preferencia. Su pedido se ha generado exitosamente.</h4>
        </div>
    </div>

    <div class="row col-md-9 mx-auto mt-1  mb-4  ">
        <div class="row col-12 mx-auto px-0 mb-auto">
            <h5 class="col-auto my-auto px-0 text-secondary text-left"><small><strong> La solicitud de compra se ha enviando a la sucursal de Farmacias Gi elegida para su verificación y aprobación. En caso de aclaración sobre su pedido, empleados de Farmacias Gi, se estarán comunicando vía telefónica con usted.</strong> </small> </h5>
        </div>
    </div>



    <div class="row col-12 mx-auto mt-1  mb-4  ">
        <div class="col-md-9 mx-md-auto border-bottom border-dark">
            <div class="row col-12 mx-auto px-0 mb-auto">
                <div class="col-2 col-md-1 my-1 mx-0 px-0">
                    <img class="col-12 col-md-10 mx-0 img-fluid" src="{{ asset('img\tarjeta.png') }}" alt="UBICACION" />
                </div>
                <h4 class="row col-auto my-auto px-0 text-left">Forma de pago</h4>
            </div>
        </div>
    </div>
    <div class="row col-md-9 mx-md-auto px-0 py-2 mb-auto">
        <div class=" col-md-4">
            <h5 class="row col-12 input-group mx-2"> Forma de pago seleccionado: <h5> <strong>
                        <p id="opc" class="mx-4"></p>
                    </strong></h5>
            </h5>
        </div>
        <div class="col-md-3">
            <h5 class="row col-12 input-group mx-2"> Usted paga con: <h5> <strong>
                        <p id="pagando2" class="mx-4"></p>
                    </strong></h5>
            </h5>
        </div>
        <div class="col-md-5">
            <h5 class="row col-12 input-group mx-2">Cambio que usted va a recibir: <h5> <strong>
                        <p id="cambio" class="mx-4"></p>
                    </strong></h5>
            </h5>
        </div>
    </div>
</div>

<div class="row col-12 mx-0 mt-4 mb-1 px-0">
    <div class="col-md-9 mx-0 mx-md-auto">
        <div class="row col-12 mx-0 px-0 mb-auto border-bottom border-dark">
            <div class="col-2 col-md-1 my-1 mx-0 px-0">
                <img class="col-12 col-md-10 mx-0 img-fluid" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h4 class="col-auto mx-0 my-auto px-0 text-left">Dirección De Envío</h4>
        </div>
        <div class="row col-auto mx-0 px-0 py-2 ">
            <div class="col-md-10 mb-auto">
                <div class="row col-12">
                    <p><strong class="">{{$nombre}}</strong></p>
                </div>
                <div class="row col-12 mx-0 px-md-0">
                    <p class="h6">{{$domicilio->calle}} {{$domicilio->numeroExterior}},
                        @if(isset($domicilio->numeroInterior)){{$domicilio->numeroInterior}}, @else @endif
                        {{$domicilio->codigoPostal}}
                        , {{$domicilio->colonia}}, Zimatlán de Álvarez, Oaxaca
                    </p>
                </div>
                <div class="row col-12">
                    <p class="h6">Tel: {{$telefono}}</p>
                </div>
            </div>

        </div>
        <div class="row col-12 mx-auto px-0 mb-auto border-bottom border-primary">
            <div class="col-2 col-md-1 my-1 mx-0 px-0">
                <img class="col-12 col-md-10 mx-0 img-fluid" src="{{ asset('img\camion.png') }}" alt="UBICACION" />
            </div>
            <h4 class="col-9 col-md-11 mx-auto mr-md-auto ml-md-0 my-auto px-0 text-left">Detalle De Envío: productos
            </h4>
        </div>
        <div class="row col-12 mt-0 mx-auto mb-auto border-bottom border-dark">
            <div class="row col-12 mx-auto border-bottom">
                <div class="row col-8 col-md-5 mx-0">
                    <p class="my-auto mx-auto text-center"><strong> Producto </strong></p>
                </div>
                <div class="row col-4 col-md-3 mx-0">
                    <p class="my-auto mx-auto text-center"><strong>Cantidad </strong></p>
                </div>
            </div>
            @foreach($carrito as $p)
            <div class="row col-12 mx-auto border-bottom">
                <div class="row col-8 col-md-5 mx-0">
                    <p class="my-auto mx-auto text-center">{{$p['nombre']}}</p>
                </div>
                <div class="row col-4 col-md-3 mx-0">
                    <p class="my-auto mx-auto text-center">{{$p['cantidad']}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class=" row col-12  mx-auto mt-3">
        <div class="row col-md-6 mx-auto text-center mb-auto p-1 border">
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="col-12 mx-auto my-1 py-0 text-center text-primary">Resumen de compra</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h6 class="mr-auto my-1 text-center">Subtotal</h6>
                <h6 class="ml-auto my-1 text-center" id="subtotal">$ 0.00</h6>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h6 class="mr-auto my-1 text-center">Costo del envío</h6>
                <h6 class="ml-auto my-1 text-center" id="envio">*por calcular</h6>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom alert-primary">
                <h5 class="mr-auto my-1 text-center">Total</h5>
                <h5 class="ml-auto my-1 text-center" id="total">$0.00</h5>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                <h6 class="mr-auto my-1 text-center">Pagar con</h6>
                <h6 class="ml-auto my-1 text-center" id="pagaCon">$0.00</h6>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                <h6 class="mr-auto my-1 text-center">Su cambio</h6>
                <h6 class="ml-auto my-1 text-center" id="cambioR">$0.00</h6>
            </div>

        </div>
    </div>
    <div class="row col-12 my-1 my-md-4  mx-0">
        <div class="col-12 text-right  text-center mx-auto my-md-0 alert-warning">
            <p class="h6 ">
                Farmacias gi atenderá su solicitud lo más pronto posible y una vez confirmada la compra por nosotros. Usted podrá ver el estado de su paquete en la seccion ""
                incluyendo la fecha y hora estimada para hacer la entrega de su pedido.
            </p>

        </div>
        <div class="col-12 text-right  text-center mx-auto my-md-0 alert-warning">
            <p class="h6 ">
                El tiempo de entrega aproximado es de 1 hora, contando a partir de la aprobación por parte de Farmacias Gi.
            </p>

        </div>
        <div class="col-12 text-right  text-center mx-auto my-md-0 alert-warning">
            <p class="h6 ">
                Atendemos sus solicitudes de compra en un horario laboral de: 9am - 7pm.
            </p>

        </div>
    </div>
    <div class="col-12 text-right  text-center mx-auto my-4">
        <a class="btn btn-success btn-lg" href="{{url('/')}}">Ir a Inicio</a>
        <!--  <button class="btn btn-success btn-lg" onclick="{{url('/metodoPago')}}" type="submit">Cerrar</button>-->
    </div>
</div>

<script>
    let productosVenta = [];
    let formaPago = @json($formaPago);
    let pagaCon2 = @json($pagarCon);
    let folio2 = @json($folio);
    let envioCosto = 15;
    let totalCompra = 0;

    async function calcularTotal() {
        //if (carrito == null)
          //  return;
        //let totalCompra = 0;
        carrito = @json($carrito);
        totalCompra = 0;
        let cuerpoCarrito = "";
        let contador = 0;
        for (let i in carrito) {
            if (carrito[i].sucursal == sucursal) {
                contador++;
                totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
            }
        }
        // envioCosto = 15;
        carrito = [];
        if (contador != 0) {
            $('#subtotal').html(`$ ${totalCompra}`);
            $('#envio').html(`$ ${envioCosto}`);
            let suma = totalCompra + envioCosto;
            $('#total').html(`$ ${suma}`);
            $('#pagaCon').html(`$ ${pagaCon2}`);
            let cambio2 = pagaCon2 - suma;
            console.log("cambio: ", cambio);
            $('#cambioR').html(`$ ${cambio2}`);
            $('#cambio').html(`$ ${cambio2}`);
            return;
        }
    }
    calcularTotal();


    function productosCarrito() {
        console.log(carrito);
        for (let j in carrito) {
            let producto = {
                //   id: productosVenta.length + 1,
                idProducto: carrito[j].id,
                idSucursal: carrito[j].sucursal,
                cantidad: carrito[j].cantidad,
                precio: carrito[j].precio,
                subtotal: carrito[j].cantidad * carrito[j].precio
            };
            productosVenta.push(producto);

        }
    }
    document.getElementById("opc").innerHTML = formaPago;
    document.getElementById("folio").innerHTML = `Folio: ` + folio2;
    $('#pagando2').html(`$ ${pagaCon2}`);
</script>
@endsection