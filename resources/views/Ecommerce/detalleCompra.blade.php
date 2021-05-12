@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12 my-2 mx-auto border">
    aqui va el proceso de compra
</div>
<div class="row col-12 mx-auto">
    <div class="col-9 ">
        <div class="row col-12 mr-auto px-0 mb-auto border-bottom border-dark">
            <div class="col-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="row col-auto my-auto px-0 text-left">Dirección De Envío</h5>
        </div>
        <div class="row col-12 mt-0 mx-auto mb-auto">
            <div class="row col-12">
                <p><strong class="">Nombre de la persona</strong></p>
            </div>
            <div class="row col-12">
                <p class="">Valerio Trujano #318, San Juan, zimatlan de alvarez</p>
            </div>
            <div class="row col-12">
                <p class="">Tel: 951547350</p>
            </div>
        </div>
        <div class="row col-12 mr-auto px-0 mb-auto border-bottom border-dark">
            <div class="col-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\camion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="row col-auto my-auto px-0 text-left">Detalle De Envío</h5>
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
        <div class="col-12 text-right py-1 ">
            <button class="btn btn-success btn-lg">Continuar</button>
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
@endsection