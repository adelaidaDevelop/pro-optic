@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12 my-2 mx-auto border">
    aqui va el proceso de compra
</div>
<div class="row col-12 mx-auto">
    <div class="col-9">
        <div class="row col-12 mx-0 mb-auto border-bottom border-dark">
            <div class="col-1 my-1 mx-0 p-0">
                <img class="row col-10 img-fluid ml-auto" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h5 class="col-auto my-auto text-left">Dirección De Envío</h5>
        </div>
        <div class="row col-12 mt-0 mx-auto  mb-auto">
            <p class="col-auto mr-auto">Indica la dirección donde quieres recibir tu compra</p>
            <p class="col-auto ml-auto font-italic text-danger">*Campos requeridos</p>
        </div>
        <div class="row col-12 mx-auto px-0">
            <form class="row col-12 mx-auto">
                <div class="form-row col-12 mx-auto px-0">
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="exampleInputEmail1"><p class="text-danger m-0 mr-1">*</p> Calle</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                    <div class="form-group col-3">
                        <label class="row mx-auto my-0"for="exampleInputEmail1"><p class="text-danger m-0 mr-1">*</p> Numero Exterior</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                    <div class="form-group col-3">
                        <label class="row mx-auto my-0" for="exampleInputEmail1">Numero Interior</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                </div>
                <div class="form-row col-12 mx-auto px-0">
                    <div class="form-group col-6">
                    <label class="row mx-auto my-0"for="exampleInputEmail1"><p class="text-danger m-0 mr-1">*</p>Código Postal</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="exampleInputEmail1"><p class="text-danger m-0 mr-1">*</p>Colonia</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                </div>
                <div class="form-row col-12 mx-auto px-0">
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="exampleInputEmail1"><p class="text-danger m-0 mr-1">*</p>Estado</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                    <div class="form-group col-6">
                        <label class="row mx-auto my-0"for="exampleInputEmail1"><p class="text-danger m-0 mr-1">*</p>Ciudad</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <!--small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small-->
                    </div>
                </div>
                <button class="btn btn-success ml-auto mr-1">Continuar</button>
            </form>
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