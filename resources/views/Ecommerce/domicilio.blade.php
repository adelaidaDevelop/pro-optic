@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12 my-2 mx-auto border">
    aqui va el proceso de compra
</div>
<div class="row col-12 mx-auto">
    <div class="row col-9 mr-auto px-0 border border-dark">
        <div class="row col-12 mx-0 mb-auto border-bottom border-dark">
            <div class="col-1 my-1 mx-0 p-0">
                <img class="row col-10 img-fluid ml-auto" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="col-auto my-auto text-left">Dirección De Envío</h5>
        </div>
        <div class="row col-12 mt-0 mx-auto  mb-auto  border border-success">
            <p class="">Indica la dirección donde quieres recibir tu compra</p>
        </div>
        <div class="row col-12 mx-auto">
            <form>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre(s)</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row col-3 ml-auto border border-warning">
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