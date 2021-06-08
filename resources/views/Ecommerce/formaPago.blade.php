@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12 my-2 mx-auto border">
    aqui va el proceso de compra
</div>
<div class="row col-12 mx-auto">
    <div class="col-9 ">
        <div class="row col-12 mr-auto px-0 mb-auto border-bottom border-dark">
            <div class="col-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\credit-card.svg') }}" alt="FORMA DE PAGO" />
            </div>
            <h5 class="row col-auto my-auto px-0 text-left">Elija su forma de pago</h5>
        </div>
        <div class="row col-12 mr-auto px-0 ">
            <div class="col-6 mb-auto">
                <img class="col-5 img-fluid my-2 btn btn-light border border-secondary rounded" src="{{ asset('img\PayPal-logo.png') }}" alt="FORMA DE PAGO" width="50px" height="50px" />
            </div>
            <div class="col-6 mb-auto">
                <img class="col-5 img-fluid my-2 btn btn-light border border-secondary  rounded " src="{{ asset('img\contraentrega.png') }}" alt="FORMA DE PAGO" width="50px" height="50px" />
            </div>
            <div class="col-12 mb-auto">
                <p class="">Paga de manera sencilla con tus tarjetas de débito o crédito registradas en tu cuenta
                    PayPal.</p>
            </div>
            <div class="col-9 mb-auto px-0">
                <img class="col-2 img-fluid my-2 mx-0" src="{{ asset('img\paypal.png') }}" alt="FORMA DE PAGO" />
            </div>
        </div>
        <div>

        </div>

        <div class="row col-12">
            <a class="btn btn-success btn-lg" href="">Continuar con PayPal</a>
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
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Total</h5>
                <h5 class="ml-auto my-1 text-center" id="total">$0.00</h5>
            </div>
            @if(session()->has('idCliente'))
            <a class="btn btn-outline-success my-auto btn-lg btn-block" href="http:/google.com">Pagar</a>
            @else
            <a class="btn btn-outline-success my-auto btn-lg btn-block" href="{{url('/loginCliente')}}">Pagar</a>
            @endif
        </div>
    </div>
</div>
<script>
    $('#editarDireccion').click(function() {
        location.href = "{{url('/direccionEnvio?domicilio=false')}}";
    });
</script>
@endsection