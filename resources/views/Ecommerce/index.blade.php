@extends('layouts.headerEcommerce')
@section('contenido')
<!--div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
</div-->
<div class="row ">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active position-relative">
                <img class="d-block w-100" src="{{ asset('img\carusel.jpg') }}" alt="First slide"
                class="img-fluid">
            </div>
            <!--div class="carousel-item">
                <img class="d-block w-100" src="{ asset('img\carusel2.jpg') }}" alt="Second slide"
                class="img-fluid">
            </div-->
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('img\carusel.jpg') }}" alt="Third slide"
                class="img-fluid">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="row mx-1">
<!--div class="collapse " id="collapseCarrito"-->
<!--/div-->
    @if(count($productosNuevos)>0)
    <div class="row col-12">
        <h4 class="text-primary mx-auto mt-1"><strong>Productos Nuevos</strong></h4>
    </div>
    <div class="row mx-auto">
        @foreach($productosNuevos as $producto)
        <div class="card-group mx-auto">
            <!--div class="col my-2"-->
            <div class="card my-3" style="width: 18rem;">
                <img src="{{ asset('img\carusel.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body mx-auto">
                    <h5 class="card-title">{{$producto->nombre}}</h5>
                    <p class="card-text">{{$producto->descripcion}}</p>
                </div>
                <div class="card-footer mx-auto">
                    <!--small class="text-muted">Last updated 3 mins ago</small-->
                    <a href="#" class="btn btn-primary">Agregar al carrito</a>
                </div>
            </div>
        </div>
        <!--div class="col my-2"-->
        @endforeach
    </div>
    @endif
</div>
<div class="row mx-1">
    @if(count($productosDestacados)>0)
    <div class="row col-12">
        <h4 class="text-primary mx-auto mt-1"><strong>Productos Destacados</strong></h4>
    </div>
    <div class="row mx-auto">
        @foreach($productosDestacados as $producto)
        <div class="card-group mx-2">
            <!--div class="col my-2"-->
            <div class="card my-3" style="width: 18rem;">
                <a class="btn btn-outline-light" href="{{url('/producto/'.$producto['id'])}}">
                <img src="{{ asset('img\carusel.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body mx-auto">
                    <h5 class="card-title text-dark">{{$producto['nombre']}}</h5>
                    <p class="card-text text-dark">{{$producto['descripcion']}}</p>
                </div>
                </a>
                <div class="card-footer mx-auto mt-auto bg-transparent">
                    <!--small class="text-muted">Last updated 3 mins ago</small-->
                    <button class="btn btn-primary mx-auto" id="agregarAlCarrito" onclick="addCarrito({{$producto['id']}})">Agregar al carrito</button>
                    
                </div>
                
            </div>
        </div>
        <!--div class="col my-2"-->
        @endforeach
    </div>
    @endif
</div>
@if(count($categorias)>0)
@foreach($departamentos as $d)
@if(isset($categorias[$d->nombre]))
@php
    $deptos = $categorias[$d->nombre];
@endphp
<div class="row mx-1">
    
    <div class="row mx-auto mt-3">
        <h4 class="text-capitalize text-primary mx-auto mt-1"><strong>{{$d->nombre}}</strong></h4>
    </div>
    <div class="row mx-auto">
        @foreach($deptos as $producto)
        <div class="card-group mx-1">
            <!--div class="col my-2"-->
            <div class="card my-3" style="width: 15rem;">
                <a class="btn btn-outline-light h-100 " href="{{url('/producto/'.$producto['id'])}}">
                @if(!empty($producto->imagen))
                <img src="{{ asset('storage').'/'.$producto->imagen}}" alt=""
                class="card-img-top">
                @else
                <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" 
                class="card-img-top">
                @endif
                <!--img src="{{ asset('img\carusel.jpg') }}" class="card-img-top" alt="..."-->
                <div class="card-body mx-auto mb-0">
                    <h5 class="card-title text-dark">{{$producto['nombre']}}</h5>
                    <!--p class="card-text text-dark">{$producto['descripcion']}}</p-->
                </div>
                </a>
                <div class="card-footer mx-auto mt-auto bg-transparent">
                    <!--small class="text-muted">Last updated 3 mins ago</small-->
                    <button class="btn btn-primary mx-auto" id="agregarAlCarrito" onclick="addCarrito({{$producto['id']}})">Agregar al carrito</button>
                    
                </div>
                
            </div>
        </div>
        <!--div class="col my-2"-->
        @endforeach
    </div>
</div>
@endif
@endforeach
@endif
<!--div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
      <img src="..." class="rounded mr-2" alt="...">
      <strong class="mr-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div-->
<script>
//let sucursal = json(session('sucursalEcommerce'))
//console.log('sucursal',sucursal);
//let carrito = json(session('carrito'));
console.log('carrito',carrito);
//if(carrito!=null)
   // document.querySelector('#cantidadCarrito').textContent = carrito.length;
async function addCarrito(id) {
    try{
        //return alert('Listo'+id);
        let respuesta = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: `/agregarAlCarrito/${id}`,
            // los datos que voy a enviar para la relación
            data: {
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}",
            }
        });
        console.log(respuesta);
        //return;
        if(respuesta == 1)
        {
          return alert('Por el momento esta es la existencia que tenemos a la venta');
        }
        carrito = respuesta;
        
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
    let contador = 0;
    for(let i in carrito)
    {
        if(carrito[i].sucursal == sucursal)
        {
            contador++;
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
            `<div class="row col-12 mx-auto border-bottom">
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
    }
    if(contador==0)
        return;
    cuerpoCarrito = cuerpoCarrito + `<div class="row mx-auto ><p class="text-center mx-auto border border-dark">Total $ ${totalCompra}</p></div>`
    cuerpoCarrito = cuerpoCarrito + `<button class="btn btn-success">Pagar</button>`
    elementoCarrito.innerHTML = cuerpoCarrito;"Aqui se agregará el contenido de carrito";
    document.querySelector('#cantidadCarrito').textContent = contador;//respuesta.length;
}*/
</script>
@endsection