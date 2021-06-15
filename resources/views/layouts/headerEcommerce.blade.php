@extends('layouts.appEcommerce')
@section('headerEcommerce')
<div class="row" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark col-md-12 px-0 py-0" style="background:#3366FF">
        <div class="row col-12 my-0 mx-auto col-md-12 py-0 p-md-1">
            <button class="navbar-toggler col-2 my-3 mx-0 p-0 border" type="button" data-toggle="collapse"
                data-target="#collapseSubtitulo" aria-controls="collapseSubtitulo" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon my-0"></span>
            </button>
            <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#cabeceraPrincipal"
            aria-controls="cabeceraPrincipal" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button-->
            <a class="navbar-brand col-5 col-md-auto mx-0 mx-md-auto px-1 py-1 py-md-1 px-md-1 my-auto"
                href="{{url('/')}}">
                <img class="img-fluid ml-2 my-auto my-md-2" src="{{asset('img\farmaciagilogo.png')}}" alt="LOGO">
            </a>
            <!--div class="collapse navbar-collapse" id="cabeceraPrincipal"-->
            <div class="col my-auto d-none d-md-block">
                <div class="input-group my-auto">
                    <input class="form-control" type="search" placeholder="Buscar producto" name="buscar" id="buscar"
                        aria-label="Buscar producto" autocomplete>
                    <div class="input-group-append">
                        <img src="{{ asset('img\search.svg') }}" for="buscar" class="btn btn-secondary p-1" width="30px"
                            height="100%" alt="buscador" onclick="buscarProducto('buscar')">
                    </div>
                </div>
            </div>
            <!-- Authentication Links -->
            @guest
            <div class="dropdown col-3 col-sm-2 col-md-1 my-auto">
                <a id="invitadoDropdown" class="nav-link dropdown-toggle p-1 p-sm-3 p-md-0 p-lg-1 p-xl-3 text-white" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img\usuario.png') }}" alt="LOGO" class="img-fluid"
                        href="{{ url('/loginCliente') }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invitadoDropdown">
                    <a class="dropdown-item" href="{{ url('/loginCliente') }}">
                        <small>{{ __('IniciarSesion / Registrarse') }}</small></a>
                </div>

            </div>
            @else
            <div class="dropdown col-3 col-sm-2 col-md-1 my-auto">
                <a id="navbarDropdown" class="nav-link dropdown-toggle p-1 p-sm-3 p-md-0 p-lg-1 p-xl-3 text-white" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('img\usuario.png') }}" class="img-fluid" alt="LOGO" height="40px">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" class="text-primary" href="{{url('/menu')}}" onclick="">
                        {{ Auth::user()->username }}
                    </a>
                    <a class="dropdown-item" class="text-primary" href="{{ url('logoutCliente') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ url('logoutCliente') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            @endguest
            <div class="col-2 col-md-auto p-0 my-3 p-md-3 mx-md-2 my-md-auto">
                <button class="btn btn-outline-light position-relative border-0" data-toggle="collapse"
                    data-target="#collapseCarrito" aria-expanded="false" aria-controls="collapseCarrito">
                    <!--img src="{ asset('img\carritoCompras.png') }}" class="" alt="CARRITO" height="40px"-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="img-fluid bi bi-cart3" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <span class="badge badge-light position-absolute" id="cantidadCarrito">0</span>

                </button>

            </div>
        </div>

    </nav>
    <div class="col-md-3 ml-auto mr-0 px-0 position-relative">
        <div class="card card-body col-12 position-absolute collapse mx-0 shadow-lg" id="collapseCarrito"
            style="z-index:10;">
            <p class="text-center">Tu carrito está vacío</p>
            <p class="text-justify">Navega y descubre más variedad de productos para tu higiene y salud que
                tenemos
                para
                ti</p>
        </div>
    </div>
    <div class="row col-12 my-0 mx-0 px-0 py-2 d-block d-md-none border border-primary">
        <div class="input-group col-12 mx-auto my-auto">
            <input class="form-control" type="search" placeholder="Buscar producto" name="buscar1" id="buscar1"
                aria-label="Buscar producto" autocomplete>
            <div class="input-group-append">
                <img src="{{ asset('img\search.svg') }}" for="buscar" class="btn btn-success p-1" width="30px"
                    height="100%" alt="buscador" onclick="buscarProducto('buscar1')">
            </div>
        </div>
    </div>
    <script>
    $("input[type='search']").bind('keypress', function(e) {
        if(this.value.length == 0 && e.key === ' ')
            return false;
        if (this.value.length > 0 &&  e.charCode == 13) {
            location.href = `{{url('/buscar')}}?buscar=${this.value}`;
    }
    });

    function buscarProducto(etiqueta) {
        let producto = document.querySelector(`#${etiqueta}`).value;
        if (producto.length == 0)
            return;
        console.log('Si va redireccionar');
        location.href = `{{url('/buscar')}}?buscar=${producto}`;

    }
    </script>

    <nav class="navbar navbar-expand-lg navbar-dark col-12 mx-0 my-0 py-0 py-md-1 position-relative"
        style="background:#BDC2C5">
        <div class="collapse navbar-collapse" id="collapseSubtitulo">
            <div class="row col-auto my-1 mx-auto mx-md-1 p-1 p-md-0 border border-light">
                <img src="{{ asset('img\ubicacion.png') }}" alt="UBICACION"
                    class="col-2 col-md-1 my-auto p-2 p-md-1 img-fluid">
                <select class="custom-select col-10 my-auto mx-auto" onchange="cambiarSucursal()" id="sucursalActiva">
                    @foreach($sucursales as $sucursal)
                    @if($sucursal->id == session('sucursalEcommerce'))
                    <option value="{{ $sucursal->id}}" selected>
                        <p class="text-white my-0 p-0"><small>{{$sucursal->direccion}}</small></p>
                    </option>
                    @else
                    <option value="{{ $sucursal->id}}">
                        <p class="text-white my-0 p-0"><small>{{$sucursal->direccion}}</small></p>
                    </option>
                    @endif
                    @endforeach
                </select>

            </div>

            <div class="dropdown my-1 mx-auto ">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    DEPARTAMENTOS
                </button>
                <div class="btn btn-info dropdown-menu " aria-labelledby="dropdownMenuButton">
                    @foreach($departamentos as $departamento)
                    <a class="dropdown-item"
                        href="{{url('/departamento/'.$departamento->id)}}">{{$departamento->nombre}}</a>
                    @endforeach
                </div>
            </div>
            @php $count = 0 @endphp
            @foreach($departamentos as $departamento)
            @if($count < 3) <ul class="navbar-nav mx-auto btn-outline-info d-none d-md-block">
                <li class="nav-item">
                    <a class="nav-link text-dark"
                        href="{{url('/departamento/'.$departamento->id)}}">{{$departamento->nombre}}<span
                            class="sr-only">(current)</span></a>
                </li>
                </ul>
                @php $count++ @endphp
                @else @php break; @endphp
                @endif
                @endforeach

        </div>
    </nav>
</div>
<script>
let carrito = @json(session('carrito'));
let sucursal = @json(session('sucursalEcommerce'));
let elementoCarrito = document.querySelector('#collapseCarrito'); //"{count(session('carrito'))}}";
let cuerpoElementoCarrito = elementoCarrito.innerHTML;
async function cambiarSucursal() {
    try {
        let sucursal = document.querySelector('#sucursalActiva').value;
        let url = `{{url('/sucursal')}}/${sucursal}`;
        let respuesta = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: url,
            // los datos que voy a enviar para la relación
            data: {
                //_token: $("meta[name='csrf-token']").attr("content")
                //cantidad:cantidad,
                _token: "{{ csrf_token() }}",
            }
        });
        location.href = location.href; //"{url('/')}}";
        //console.log('sucursal',);
        //let url =`{{url('/sucursal')}}/${sucursal}`;
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }

}

function mostrarCarrito() {
    if (carrito == null || carrito.length == 0)
    {
        elementoCarrito.innerHTML = cuerpoElementoCarrito;
        return;
    }
    
    let totalCompra = 0;
    let cuerpoCarrito = "";
    let contador = 0;
    let productosExtra = 0;
    for (let i in carrito) {
        if (carrito[i].sucursal == sucursal) {
            contador++;
            totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
            if (!carrito[i].imagen.length > 0) {
                carrito[i].imagen = "{{ asset('img/imagenNoDisponible.jpg') }}";
                console.log('imagen', "No hay imagen");
            } else {
                carrito[i].imagen = `{{ asset('storage')}}/${carrito[i].imagen}`;
                console.log('imagen', carrito[i].imagen);
            }
            if(i<3)
            {
            cuerpoCarrito = cuerpoCarrito +
                `<div class="row col-12 mx-auto border-bottom">
                <div class="col-4 p-1">
                    <img src="${carrito[i].imagen}" alt="imagen" class="img-fluid">
                </div>
                <div class="col-7">
                    <div class="row"><small>${carrito[i].nombre}</small></div>
                    <div class="row"><small><strong>Precio: $ ${carrito[i].precio}</strong></small></div>
                    <div class="row"><small>Cantidad: ${carrito[i].cantidad}</small></div>
                </div>
                <div class="col-1 m-0 p-0">
                    <button type="button m-0 p-0" class="close" 
                    onclick="quitarProducto(${carrito[i].id})" aria-label="Close">
                        <span class="m-0 p-0" aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>`;
            }
            else{
                console.log('Si entra');
                productosExtra = productosExtra + 1;
            }
            console.log('productos extra', productosExtra);
        }
    }
    if(productosExtra>0)
    {
        let p = 'productos';
        if(productosExtra == 1)
            p = 'producto';
        cuerpoCarrito = cuerpoCarrito +
        `<div class="row mx-auto ><p class="text-center mx-auto border border-dark"> + ${productosExtra} ${p}</p></div>`;
    }
    document.querySelector('#cantidadCarrito').textContent = contador;
    if (contador == 0)
        return;
    cuerpoCarrito = cuerpoCarrito +
        `<div class="row mx-auto ><p class="text-center mx-auto border border-dark"><strong>Total $${totalCompra}</strong></p></div>`
    cuerpoCarrito = cuerpoCarrito + `<a class="btn btn-primary" href="{{url('/carrito')}}">Ver carrito</a>`
    elementoCarrito.innerHTML = cuerpoCarrito;
    //"Aqui se agregará el contenido de carrito";
     //respuesta.length;
}
mostrarCarrito();

async function quitarProducto(id)
{
    
    //let id = carrito[i]['id'];
    let url = `{{url('/quitarProductoCarrito')}}/${id}`;
    let respuesta = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: url,
            // los datos que voy a enviar para la relación
            data: {
                //_token: $("meta[name='csrf-token']").attr("content")
                //cantidad:cantidad,
                _token: "{{ csrf_token() }}",
            }
        });
    carrito = respuesta;
    //console.log('Hecho',i);
        
    //carrito.splice(i,1);
    console.log('carrito despues d eliminar',carrito);
    mostrarCarrito();
}
</script>
@yield('contenido')
@endsection