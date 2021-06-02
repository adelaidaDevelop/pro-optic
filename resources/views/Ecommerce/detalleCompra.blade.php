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
        <div class="row col-auto ">
            <div class="col-10 mb-auto ">
                <div class="row col-12">
                    <p><strong class="">{{$nombre}}</strong></p>
                </div>
                <div class="row col-12">
                    <p class="h6">{{$domicilio->calle}} {{$domicilio->numeroExterior}},
                        @if(isset($domicilio->numeroInterior)){{$domicilio->numeroInterior}}, @else @endif
                        {{$domicilio->codigoPostal}}, {{$domicilio->colonia}}, Zimatlán de Álvarez, Oaxaca</p>
                </div>
                <div class="row col-12">
                    <p class="h6">Tel: {{$telefono}}</p>
                </div>
            </div>
            <div class="row col-2 mt-0 mx-auto mb-auto">
                <button class="btn btn-outline-danger border-0" id="editarDireccion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </button>
                <form method="post" action="{{url('/eliminarDireccion')}}" class="">
                {{csrf_field()}}
                <button class="btn btn-outline-danger border-0" id="eliminarDireccion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </button>
                </form>
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
        <div class="col-12 text-right py-1">
            <a class="btn btn-success btn-lg" href="">Continuar</a>
        </div>
    </div>
    <div class="col-3">
        <div class="row mb-auto p-1 border border-primary">
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
        </div>
    </div>
</div>
<script>
    $('#editarDireccion').click(function()
    {
        location.href= "{{url('/direccionEnvio?domicilio=false')}}";
    });

    async function calcularTotal()
{
    if(carrito == null)
        return;
    let totalCompra = 0;
    let cuerpoCarrito = "";
    let contador = 0;
    for(let i in carrito)
    {
        if(carrito[i].sucursal == sucursal)
        {
            contador++;
            totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
        }
    }
    if(contador!=0)
    {
        $('#subtotal').html(`$ ${totalCompra}`);
        $('#total').html(`$ ${totalCompra}`);
        return;
    }
}
calcularTotal();
</script>
@endsection