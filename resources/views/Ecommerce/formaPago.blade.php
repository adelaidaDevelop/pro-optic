@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class=" row col-12 px-4  py-2 my-2 input-group text-center mx-auto alert-secondary " style="background:#D5DBDB">
    <button id="btnGenerarPed" class="btn btn-outline-secondary col  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\posicion.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-success">Dirección de envio</p>
    </button>
    <div class=" h1 my-auto text-success">
        <p>..............</p>
    </div>
    <!--PASO DOS -->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\tarjeta2.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-primary">Medios de pago</p>
    </button>

    <div class="h1 my-auto text-primary">
        <p>..............</p>
    </div>
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\revision.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-secondary">Revisión compra</p>
    </button>

    <div class="h1 my-auto text-secondary">
        <p>..............</p>
    </div>
    <!--PASO TRES-->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\pedidoConfirmado.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-secondary">Confirmar compra</p>
    </button>
</div>
<div class="row col-12 mx-auto">
    <div class="col-9 ">
        <div class="row col-12 mr-auto px-0 mb-auto border-bottom border-dark ">
            <div class="col-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\credit-card.svg') }}" alt="FORMA DE PAGO" />
            </div>
            <h4 class="row col my-auto px-0 text-left alert-info">Seleccione su forma de pago</h4>
        </div>
        <div class="row col-12 mr-auto px-0 my-4 ">
            <div class=" mb-auto mx-4">
                <button id="btnPaypal" class="btn btn-outline-info input-group" onclick="return pagoPaypal()">
                    <img class="img-fluid my-1 btn btn-light border-0 rounded" src="{{ asset('img\PayPal-logo3.png') }}" alt="FORMA DE PAGO" width="150px" height="150px" />
                </button>
            </div>
            <div class="mb-auto mx-4 ">
                <button id="btnConEnt" class="btn btn-outline-info input-group" onclick="return pagoContEnt()">
                    <img class=" img-fluid my-1 btn btn-light border-0 rounded " src="{{ asset('img\contraentrega.png') }}" alt="FORMA DE PAGO" width="150px" height="150px" />
                </button>
            </div>

            <div class="col-12 mt-4 mx-2 row mt-4 h4"> Forma de pago seleccionado: <h4> <strong>
                        <p id="opc"></p>
                    </strong></h4>
            </div>
            <div id="descPaypal" class=" mx-2"> </div>
            <div id="elementos" class="mx-2 "></div>
        </div>
        <div>

        </div>


    </div>
    <div class="col-3 border border-warning">
        <div class="row mb-auto p-1 border">
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h4 class="col-12 mx-auto my-1 py-0 text-center text-primary">Resumen de compra</h4>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Subtotal</h5>
                <h5 class="ml-auto my-1 text-center" id="subtotal">$ 0.00</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Costo del envío</h5>
                <h5 class="ml-auto my-1 text-center" id="envio">*por calcular</h5>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Total</h5>
                <h5 class="ml-auto my-1 text-center" id="total">$0.00</h5>
            </div>
            <!--
            @if(session()->has('idCliente'))
            <a class="btn btn-outline-success my-auto btn-lg btn-block" href="http:/google.com">Pagar</a>
            @else
            <a class="btn btn-outline-success my-auto btn-lg btn-block" href="{{url('/loginCliente')}}">Pagar</a>
            @endif
            -->
        </div>
    </div>
</div>
<script>
    let totalCompra = 0;
    $('#editarDireccion').click(function() {
        location.href = "{{url('/direccionEnvio?domicilio=false')}}";
    });

    function pagoContEnt() {

        var label2 = document.getElementById("label");
        var input2 = document.getElementById("pagaCon");
        if (label2 == null || input2 == null) {
            document.getElementById("opc").innerHTML = "Contra Entrega";
            document.getElementById("descPaypal").innerHTML = "";
            var label = document.createElement("h5");
            // var newContent = document.createTextNode("Selecciona cómo harás tu pago contra entrega");
            var newContent = document.createTextNode("Escriba la cantidad de efectivo con la que va a pagar para preparar su cambio");
            label.appendChild(newContent); //añade texto al div creado.
            label.id = 'label'
            var input = document.createElement("INPUT");
            //aquí indicamos que es un input de tipo text
            input.type = 'number';
            input.id = 'pagaCon';

            var boton = document.createElement("button");
            boton.id = "btnSeguir";
            boton.innerHTML = 'Continuar';
            //  boton.setAttribute.class = 'btn btn-success'
            // boton.style.backgroundColor = '#009900';


            //let btn = document.getElementById("btnSeguir");
            var div = document.createElement("div");
            div.id = 'divN'

            //  input.setAttribute.require;
            //   let divPrinc = document.getElementById()
            document.getElementById("elementos").appendChild(label);
            document.getElementById("elementos").appendChild(input);
            document.getElementById("elementos").appendChild(div);

            let boton3 = `
            <input class="col-3 form-control mt-4" type="number" id="pagando" name="pago" data-decimals="" min="0" placeholder="0" value="" required>
            <button type="button" id="btnContinuar" name="pagaCon" class="btn btn-success mt-4">Continuar</button>`;
            document.getElementById("divN").innerHTML = boton3;

            //Validar pago con 
            var number = document.getElementById('pagando');
            number.onkeypress = function(e) {
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 || e.keyCode == 46)) {
                    return false;
                }
            }
            let totalCompra = 500;
            console.log("Si los agrego ok");
            $("#btnContinuar").click(function() {
                let pago2 = $('#pagando').val();
                if (pago2 < totalCompra) {
                    return alert(`EL pago mínimo que usted debe preparar es: ` + pago2);
                }
                location.href = "{{url('/puntoVenta/detalleCompra')}}";
            });

            //y por ultimo agreamos el componente creado al padre
            //  padre.appendChild(input);
        }
    }

    function pagoPaypal() {
        // let btn = document.getElementById("btnPaypal");
        // document.getElementById("btnPaypal").style.background = 'green';
        //  btn.setAttribute.class = 'btn btn-success input-group';
        document.getElementById("opc").innerHTML = " Paypal";
        var label2 = document.getElementById("label");
        var input2 = document.getElementById("pagaCon");
        var divNuevo = document.getElementById("divN");
        if (label2 != null || input2 != null || divNuevo != null) {
            document.getElementById("label").remove()
            document.getElementById("pagaCon").remove();
            document.getElementById("divN").remove();
        }
        let element = `<div class="col-8 mb-auto">
                <p class="h5">Paga de manera sencilla con tus tarjetas de débito o crédito registradas en tu cuenta
                    PayPal.</p>
            </div>
            <div class="col-9 mb-auto px-0">
                <img class="col-2 img-fluid my-2 mx-0" src="{{ asset('img/paypal.png') }}" alt="FORMA DE PAGO" />
            </div>
            <div class=" col-12">
            <a class="btn btn-success btn-lg" href="">Continuar con PayPal</a>
            </div>
            `;

        document.getElementById("descPaypal").innerHTML = element;

    };
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
        if (contador != 0) {
            $('#subtotal').html(`$ ${totalCompra}`);
            $('#total').html(`$ ${totalCompra}`);
            return;
        }
    }
    calcularTotal();
</script>
@endsection