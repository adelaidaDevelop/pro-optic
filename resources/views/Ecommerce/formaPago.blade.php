@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent h5">
            <li class="breadcrumb-item"><a href="{{url('/')}}">INICIO</a></li>
            <li class="breadcrumb-item"><a href="{{url('/carrito')}}">CARRITO-COMPRAS</a></li>
            <li class="breadcrumb-item"><a href="{{url('/direccionEnvio')}}">DIRECCION</a></li>
            <li class="breadcrumb-item active" aria-current="page">METODO DE PAGO</li>
        </ol>
    </nav>
</div>
<div class=" row col-12 px-4  mb-2 input-group text-center mx-auto alert-secondary " style="background:#D5DBDB">
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
        <p class="h6 my-auto mx-2 text-primary">Medios de pago</p>
    </button>

    <div class="h1 my-auto text-primary">
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
<div class="row col-12 mx-0 d-md-flex flex-row-reverse px-0 ">
    <div class="col-md-3 mb-3 border border-warning">
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
                <h3 class="ml-auto my-1 text-center" id="total">$0.00</h3>
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
    <div class="row col-md-9 mx-0 border">
        <div class="row col-12 mx-0 mr-auto p-1 mb-auto border-bottom border-dark ">
            <div class="col-3 col-sm-2 col-lg-2 col-xl-1 my-auto my-md-1 mx-0 px-0 px-lg-2 px-xl-0">
                <img class="col-12 col-md-10 mx-auto mx-md-0 my-auto img-fluid" src="{{ asset('img\credit-card.svg') }}" alt="FORMA DE PAGO" />
            </div>
            <h4 class="col-9 my-auto mx-0 p-1 text-left alert-info">Seleccione su forma de pago</h4>
        </div>
        <div class="row col-12 mx-auto mt-1  ">
            <p class="col-auto mx-auto text-secondary alert-warning  h5"><small><strong> Por favor escoja una de las opciones de abajo para continuar </strong> </small></p>
        </div>
        <div class="row col-12  mx-auto mr-md-auto px-0 my-4">
            <div class="col-6 col-md-auto mb-auto ml-md-auto mr-1">
                <button id="btnPaypal" class="btn btn-outline-info input-group" onclick="return pagoPaypal()">
                    <img class="img-fluid my-1 btn btn-light border-0 rounded" src="{{ asset('img\PayPal-logo3.png') }}" alt="FORMA DE PAGO" width="150px" height="150px" />
                </button>
            </div>
            <div class="col-6 col-md-auto mb-auto mr-md-auto ml-1 ">
                <button id="btnConEnt" class="btn btn-outline-info input-group" onclick="return pagoContEnt()">
                    <img class=" img-fluid my-1 btn btn-light border-0 rounded " src="{{ asset('img\contraentrega.png') }}" alt="FORMA DE PAGO" width="150px" height="150px" />
                </button>
            </div>

            <div class="col-12 mt-4 mx-2 row mt-4 h4"> Forma de pago seleccionado: <h5> <strong>
                        <p id="opc" class="h4 my-2 my-md-0"></p>
                    </strong></h5>
            </div>
            <div id="descPaypal" class=" mx-2"> </div>
            <div id="elementos" class="mx-2"></div>
        </div>
    </div>

</div>
<script>
    let envioCosto = 15;
    let totalCompra = 0;
    $('#editarDireccion').click(function() {
        location.href = "{{url('/direccionEnvio?domicilio=false')}}";
    });

    function pagoContEnt() {

        var label2 = document.getElementById("label");
        var input2 = document.getElementById("pagaCon");
        if (label2 == null || input2 == null) {
            document.getElementById("opc").innerHTML = " Contra Entrega";
            document.getElementById("descPaypal").innerHTML = "";
            // var label = document.createElement("h5");
            // var newContent = document.createTextNode("Selecciona cómo harás tu pago contra entrega");
            // var newContent = document.createTextNode("Escriba la cantidad de efectivo con la que va a pagar para preparar su cambio");
            // label.appendChild(newContent); //añade texto al div creado.
            // label.id = 'label'
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
            // document.getElementById("elementos").appendChild(label);
            //  document.getElementById("elementos").appendChild(input);
            document.getElementById("elementos").appendChild(div);

            let formulario = `
            <form method="get" onsubmit="return validarPagar()" action="{{url('/revisionCompra')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!--El name debe ser igual al de la base de datos-->
            <div class="col-12 px-md-0">
            <label for="precio_ind" class="text-justify mt-3 mx-auto">
                            <h5> Escriba la cantidad de efectivo con la que va a pagar para preparar su cambio </h5>
                        </label>
            </div>
            <div class="input-group px-3 px-md-0">
            <h5 class="my-auto mx-1"><strong>$</strong></h5>
            <input class="col-3 form-control my-auto mt-4" type="number" id="pagando" name="pago" data-decimals="" min="0" placeholder="0" value="" autofocus required>
            </div>
            <button type="submit" id="btnContinuar"  class="btn btn-success ml-3 ml-md-0 btn-lg mt-4">Continuar</button>
            </form>
            `;
            /*let boton3 = `
                <div class ="input-group">
                <h5 class="my-auto mx-1">$</h5>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando" name="pago" data-decimals="" min="0" placeholder="0" value="0" required>
                </div>
                <button type="button" id="btnContinuar" class="btn btn-success mt-4 mx-auto"><h4>Continuarp</h4></button>`;
            */
            document.getElementById("divN").innerHTML = formulario;

            //onclick="return validarPagar();"
            //Validar pago con 
            var number = document.getElementById('pagando');
            number.onkeypress = function(e) {
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 || e.keyCode == 46)) {
                    return false;
                }
            }
            let suma = totalCompra + envioCosto;
            console.log("Si los agrego ok");

            /*
            $("#btnContinuar").click(function() {
                let pago2 = $('#pagando').val();
                console.log("El pago ingresado", pago2);
                if (pago2 < suma) {
                    let conf = alert(`EL pago mínimo que usted debe preparar es: ` + suma);

                    window.history.back();
                    $("#btnContinuar").value = "Cancel"
                }
                let pagoEscogido = document.getElementById("opc").innerHTML;
                //Agregar evento ajax y enviar pagoCon y pagoEscogido;

                // return ` + validarPagar() + `
            });

            // return ` + validarPagar() +
            */

            //y por ultimo agreamos el componente creado al padre
            //  padre.appendChild(input);
        }
    }

    function validarPagar() {
        var todo_correcto = true;

        let suma = totalCompra + envioCosto;
        let pago2 = $('#pagando').val();
        console.log("El pago ingresado", pago2);
        console.log("la suma: ", suma);
        if (pago2 < suma) {
            alert(`EL pago mínimo que usted debe preparar es: ` + suma);
            // $("#btnContinuar").value = "Cancel"
            todo_correcto = false;
        }
        //else {
        // location.href = "{{url('/revisionCompra')}}";
        //   {{url('/revisionCompra')}}
        // }
        // let pagoEscogido = document.getElementById("opc").innerHTML;
        //Agregar evento ajax y enviar pagoCon y pagoEscogido;
        return todo_correcto;

    }

    function pagoPaypal() {
        var div = document.getElementById("divN");
        if (div != null) {
            document.getElementById("divN").innerHTML = "";
        }
        // let btn = document.getElementById("btnPaypal");
        // document.getElementById("btnPaypal").style.background = 'green';
        //  btn.setAttribute.class = 'btn btn-success input-group';
        document.getElementById("opc").innerHTML = " Paypal";
        /*
        var label2 = document.getElementById("label");
        var input2 = document.getElementById("pagaCon");
        var divNuevo = document.getElementById("divN");
        if (label2 != null || input2 != null || divNuevo != null) {
            document.getElementById("label").remove()
            document.getElementById("pagaCon").remove();
            document.getElementById("divN").remove();
        }
        */
        let element = `<div class="col-8 mr-md-auto mb-auto">
                <p class="h5">Paga de manera sencilla con tus tarjetas de débito o crédito registradas en tu cuenta
                    PayPal.</p>
            </div>
            <div class="col-6 col-md-9 mb-auto px-0">
                <img class="col-md-2 img-fluid my-2 mx-0" src="{{ asset('img/paypal.png') }}" alt="FORMA DE PAGO" />
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
        // envioCosto = 15;
        if (contador != 0) {
            $('#subtotal').html(`$ ${totalCompra}`);
            $('#envio').html(`$ ${envioCosto}`);
            let suma = totalCompra + envioCosto;
            $('#total').html(`$ ${suma}`);
            return;
        }
    }
    calcularTotal();
</script>
@endsection