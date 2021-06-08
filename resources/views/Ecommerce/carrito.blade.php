@extends('layouts.headerEcommerce')
@section('contenido')
<domiv class="row col-12 mx-auto">
    <h4 class="text-uppercase text-primary col-12">Carrito</h4>
    @if(session()->has('carrito'))
    @php
    $carrito = session('carrito');
    $ss = array_column($carrito, 'sucursal');
    $pos = array_search(session('sucursalEcommerce'), $ss);
    @endphp
    @if($pos===false)
    <h5 class=" col-12">Tu Carrito de Compras de esta sucursal esta vacío</h5>
    @else
    <div class="col-9">
        <div class="row col-12 border-bottom">
            <div class="row col-5 mx-0">
                <p class="h5 text-center mx-auto my-0">Producto</p>
            </div>
            <div class="row col-2 mx-0">
                <p class="h5 text-center mx-auto my-0">Precio</p>
            </div>
            <div class="row col-2 mx-0">
                <p class="h5 text-center mx-auto my-0">Cantidad</p>
            </div>
            <div class="row col-2 mx-0">
                <p class="h5 text-center mx-auto my-0">Subtotal</p>
            </div>
            <div class="row col-1 mx-0"></div>
        </div>
        @foreach($carrito as $p)
        <div id="productoCarrito{{$p['id']}}" class="row col-12 border-bottom">
            <div class="row col-2 mx-0">
                @if(!empty($p['imagen']))
                <img src="{{ asset('storage').'/'.$p['imagen']}}" alt="" class="img-fluid">
                @else
                <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" class="img-fluid">
                @endif
            </div>
            <div class="row col-3 mx-0">
                <p class="my-auto mx-auto text-center">{{$p['nombre']}}</p>
            </div>
            <div class="row col-2 mx-0">
                <p class="my-auto mx-auto text-center"><strong>${{$p['precio']}}</strong></p>
            </div>
            <div class="row col-2 mx-0"><input type="number" class="form-control my-auto"
                min="1" 
                value="{{$p['cantidad']}}" onchange="setCantidad({{$p['id']}})" id="cantidad{{$p['id']}}" /></div>
            <div class="row col-2 mx-0">
                <p class="my-auto mx-auto text-center"><strong id="subtotal{{$p['id']}}">${{$p['precio'] * $p['cantidad']}}</strong></p>
            </div>
            <div class=" mx-0 my-auto">
                <button class="btn btn-outline-danger my-auto mx-0 p-0 border-0" onclick="quitarProductoCarrito(`{{$p['id']}}`)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-trash" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row col-3 pb-auto my-0">
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
            <a class="btn btn-success my-auto btn-lg btn-block" href="{{url('/direccionEnvio')}}">Pagar</a>
        </div>
    </div>
    @endif
    @else
    <h5 class=" col-12">Tu Carrito de Compras esta vacío</h5>
    @endif
</div>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
    var props = {
    decrementButton: "<strong>&minus;</strong>", // button text
    incrementButton: "<strong>&plus;</strong>", // ..
    groupClass: "my-auto", // css class of the resulting input-group
    buttonsClass: "btn-outline-secondary",
    buttonsWidth: "1rem",
    textAlign: "center", // alignment of the entered number
    autoDelay: 500, // ms threshold before auto value change
    autoInterval: 50, // speed of auto value change
    buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
    keyboardStepping: true, // set this to `false` to disallow the use of the up and down arrow keys to step
    locale: navigator.language, // the locale, per default detected automatically from the browser
    //editor: I18nEditor, // the editor (parsing and rendering of the input)
    template: // the template of the input
        '<div class="input-group ${groupClass}">' +
        '<div class="input-group-prepend"><button style="min-width: ${buttonsWidth};" class="btn btn-decrement ${buttonsClass} btn-minus" type="button">${decrementButton}</button></div>' +
        '<input type="text" inputmode="decimal" style="text-align: ${textAlign}" class="form-control form-control-text-input px-0 mx-0"/>' +
        '<div class="input-group-append"><button style="min-width: ${buttonsWidth};" class="btn btn-increment ${buttonsClass} btn-plus" type="button">${incrementButton}</button></div>' +
        '</div>'
}
$("input[type='number']").inputSpinner(props);
</script>
<script>
async function setCantidad(id) {
    let cantidad = $(`#cantidad${id}`).val();
    //console.log('El producto a cambiar es,' + id);
    //console.log('La cantidad es,' + cantidad);
    try {
        //return alert('Listo'+id);
        let respuesta = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `/actualizarCantidadCarrito/${id}`,
            // los datos que voy a enviar para la relación
            data: {
                //_token: $("meta[name='csrf-token']").attr("content")
                cantidad: cantidad,
                _token: "{{ csrf_token() }}",
            }
        });
        console.log(typeof respuesta);
        //return;
        if (typeof respuesta === 'string') {
            $(`#cantidad${id}`).val(parseInt(respuesta));
            
            return alert('La cantidad es mayor a la existencia que tenemos a la venta');
            
        }
        carrito = respuesta;
        //let productos = productosCompra.filter(p => p.id == id);
        //productos.find(p => p.sucursal =="{{session('sucursalEcommerce')}}");
        //let subtotal = carrito
        let i = 0;
        encontrado = false;
        while(i<carrito.length && !encontrado)
        {
            if(carrito[i].id == id && carrito[i].sucursal == "{{session('sucursalEcommerce')}}")
            {
                let subtotal = parseFloat(carrito[i].precio) * parseInt(carrito[i].cantidad);
                $(`#subtotal${id}`).html(`$${subtotal}`);
                encontrado = true;
            }
            i++;
        }        //$('#subtotalProducto').html(`$${})
        //document.querySelector('#cantidadCarrito').textContent = respuesta.length;
        mostrarCarrito();
        calcularTotal();
        //console.log('carrito',respuesta);
        //return alert("Listo"+ respuesta);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function quitarProductoCarrito(id)
{
    let confirmacion = confirm('¿Realmente desea quita este producto del carrito de compras?');
    if(!confirmacion)
        return;
    await quitarProducto(id);
    document.getElementById("productoCarrito"+id).remove();
}

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