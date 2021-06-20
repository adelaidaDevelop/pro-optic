@extends('layouts.headerEcommerce')

@section('contenido')

<!--ICONO REGRESAR0-->
<div class="row col-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Descripcion-producto</li>
        </ol>
    </nav>
    <!-- 
    <div class="col-10 ml-4">
        <div class=" ml-3 my-auto">
            <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/">
                <img src="{{ asset('img\atras.png') }}" alt="Editar" width="35px" height="35px">
            </a>
        </div>
        <div class=" ml-3 my-auto">
            <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
                <img src="{{ asset('img\adelante.png') }}" alt="Editar" width="35px" height="35px">
            </a>
        </div>
    </div>
-->
</div>
@if($producto === false)
<div class="row col-12 mx-auto my-5">
    <h2 class="text-center mx-auto "><strong>El producto que busca no se encuentra en esta sucursal o no tiene
            existencia</strong></h2>
</div>
@else
<div class="row col-md-12 mx-auto my-5">
    <div class="row col-12 col-md-7 p-2 mx-auto border">
        @if(!empty($producto->imagen))
        <img src="{{ asset('storage').'/'.$producto->imagen}}" alt="" height="400" class="img-fluid col-md-5 mx-auto mb-0 p-2">
        @else
        <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" height="400" class="img-fluid col-md-7 mx-auto mb-0 p-2">
        @endif
    </div>
    <div class="form-group col-md-5 mx-auto ml-md-auto py-2">
        <h4 class="text-uppercase text-primary">{{$producto->nombre}}</h4>
        <div class="form-group">
            <p class="my-0"><strong>Codigo de barras:</strong> {{$producto->codigoBarras}}</p>
            <p class="my-0"><strong>Existencia:</strong> {{$producto->existencia}}</p>
            <p class="my-0"><strong>Departamento:</strong> {{$producto->departamento}}</p>
            
        </div>
        <h2 class="">$ {{$producto->precio}}</h2>
        <div id="divBtn" class="form-group col-10 col-md-5 mx-auto ml-md-0 mr-md-auto pl-md-0 pr-md-4">
            <input type="number" class="form-control border" id="cantidad" min="1" max="{{$producto->existencia}}" value="1">
        </div>
        <button class="btn btn-success col-12 col-auto mx-4 text-center ml-md-0 mr-md-auto" onclick="addCarritoProducto(`{{$producto->id}}`)"><strong>
                <h4>Agregar al carrito</h4>
            </strong></button>
            <div class="form-group">
            <p class="my-0"><small>* Precio exclusivo de tienda en línea.</small></p>
            <p class="my-0"><small>* Producto sujeto a disponibilidad.</small></p>
            <p class="my-0"><small>* Descuento ya incluído en precios mostrados.</small></p>
            
        </div>
        
    </div>
</div>
<!--div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
    <div id="toastAgregarCarrito" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3500">
        <div class="toast-header">
            <strong class="mr-auto">Carrito</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toastCuerpoCarrito">
        </div>
    </div>
</div-->
@endif
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
    $("input[type='number']").inputSpinner();
    //let carrito = json(session('carrito'));
    let existencia = "{{$producto->existencia}}";
    existencia = parseInt(existencia);
    console.log('carrito', carrito);
    async function addCarritoProducto(id) {

        let cantidad = $('#cantidad').val();
        console.log('cantidadPedida', cantidad);
        try {
            //return alert('Listo'+id);
            let respuesta = await $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `{{url('/agregarAlCarrito')}}/${id}`,
                // los datos que voy a enviar para la relación
                data: {
                    //_token: $("meta[name='csrf-token']").attr("content")
                    cantidad: cantidad,
                    _token: "{{ csrf_token() }}",
                }
            });
            console.log(respuesta);

            if (respuesta == 1) {
                return alert('Por el momento esta es la existencia que tenemos a la venta');
            }
            if (respuesta == 2) {
                return alert('Por el momento no tenemos este producto a la venta');
            }
            carrito = respuesta;
            $('#toastAgregarCarrito').toast('show');
            document.getElementById('toastCuerpoCarrito').textContent = "Producto agregado al carrito";
            //document.querySelector('#cantidadCarrito').textContent = respuesta.length;
            existencia = existencia - parseInt(cantidad);
            document.getElementById('divBtn').innerHTML =
                `<input type="number" class="form-control border" id="cantidad" min="1" max="${existencia}" value="1">
            `;
            $("input[type='number']").inputSpinner();
            mostrarCarrito();
            //console.log('carrito',respuesta);
            //return alert("Listo"+ respuesta);
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    /*mostrarCarrito();
    function mostrarCarrito()
    {
        if(carrito == null)
            return;
        let totalCompra = 0;
        let cuerpoCarrito = "";
        for(let i in carrito)
        {
            totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
            if(!carrito[i].imagen.length > 0)
            {
                carrito[i].imagen = "{ asset('img/imagenNoDisponible.jpg') }}";
                console.log('imagen',"No hay imagen");
            }
            else{
                carrito[i].imagen = `{ asset('storage')}}/${carrito[i].imagen}`;
                console.log('imagen',carrito[i].imagen);
            }
            cuerpoCarrito = cuerpoCarrito +
            `<div class="row col-12 mx-auto text-center">
              <p class="text-justify mx-auto"><small><strong>Los productos del carrito estan agregados de acuerdo
               a la sucursal en que se encuentra</strong></small></p>
            </div>
            <div class="row col-12 mx-auto border-bottom">
                <div class="col-4">
                    <img src="${carrito[i].imagen}" alt="imagen" class="img-fluid">
                </div>
                <div class="col-7">
                    <div class="row"><small>${carrito[i].nombre}</small></div>
                    <div class="row"><small><strong>Precio: $ ${carrito[i].precio}</strong></small></div>
                    <div class="row"><small>Cantidad: ${carrito[i].cantidad}</small></div>
                </div>
                <div class="col-1 m-0 p-0">
                    <button type="button m-0 p-0" class="close" aria-label="Close">
                        <span class="m-0 p-0" aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>`;
            //console.log('longitud imagen', carrito[i].imagen.length);
        }
        cuerpoCarrito = cuerpoCarrito + `<div class="row mx-auto ><p class="text-center mx-auto border border-dark">Total $ ${totalCompra}</p></div>`
        cuerpoCarrito = cuerpoCarrito + `<button class="btn btn-success">Pagar</button>`
        elementoCarrito.innerHTML = cuerpoCarrito;"Aqui se agregará el contenido de carrito";
    }*/
</script>
@endsection