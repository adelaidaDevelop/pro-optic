@extends('layouts.appEcommerce')
@section('headerEcommerce')
<div class="row" id="header">
    <nav class="navbar navbar-expand-lg navbar-dark col-12 py-auto" style="background:#3366FF">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img\farmaciagilogo.png') }}" alt="LOGO" height="50px">
        </a>
        <div class="input-group my-auto">
            <input class="form-control" type="search" placeholder="Buscar producto" name="buscar" id="buscar"
                aria-label="Buscar producto">
            <!--input type="text" class="form-control" placeholder="Username" aria-label="Username"
                aria-describedby="basic-addon1"-->
            <div class="input-group-append ">
                <!--button class="btn btn-outline-secondary" type="button" value="informacion" id="boton" style="background-image: url(img/search.svg);
                            background-repeat:no-repeat;background-size:100%;"-->
                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                <!--/button-->

                <img src="{{ asset('img\search.svg') }}" for="buscar" class="btn btn-secondary p-1" width="35px"
                    height="100%" alt="buscador" href="google.com">
                <!--span class="input-group-text" id="basic-addon1"for="buscar">@</span-->

            </div>
        </div>

        <!--input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Buscar producto">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button-->
        <!--button class="btn my-auto ml-2  py-0">
            <p class="text-white my-0 p-0"><small>Ubicacion</small></p>
            <img src="{ asset('img\ubicacion.png') }}" alt="UBICACION" height="35px">
            <select class="custom-select my-2 col-auto" required>
                foreach($sucursales as $sucursal)
                    if($sucursal->id == session('sucursalEcommerce'))
                        <option value="{ $sucursal->id}}" selected>
                            <p class="text-white my-0 p-0"><small>{$sucursal->direccion}}</small></p>
                        </option>
                    else
                        <option value="{ $sucursal->id}}">
                            <p class="text-white my-0 p-0"><small>{$sucursal->direccion}}</small></p>
                        </option>
                    endif
                endforeach
            </select>
            @foreach($sucursales as $sucursal)
            
            @endforeach
        </button-->
        <!--a class="navbar-brand m-0 ml-2 p-0" href="">
            <img src="{{ asset('img\ubicacion.png') }}" class="p-1" alt="UBICACION" height="40px">
        </a-->
        <ul class="navbar-nav ml-auto my-auto">
            <!-- Authentication Links -->
            @guest
            <!--a class="navbar-brand m-0 ml-2 p-0 row text-center" href="{ url('/loginCliente') }}">
                <img src="{ asset('img\usuario.png') }}" class="p-0 border" alt="LOGO" height="40px">
                <p class="text-white p-0" ><small>{ __('IniciarSesion / Registrarse') }}</small></p>
            
            </a-->
            <li class="nav-item text-center">
                <img src="{{ asset('img\usuario.png') }}" height="35px" alt="LOGO"
                href="{{ url('/loginCliente') }}"> 
                <a class="nav-link text-white my-0 py-0" href="{{ url('/loginCliente') }}">
                <small>{{ __('IniciarSesion/Registrarse') }}</small></a>
            </li>
            <!--@ if (Route:d:has('register'))
            <li class="nav-item">
                <a class="nav-link text-white" href="{ route('register') }}">{{ __('Register') }}</a>
            </li>
            endif-->
            @else
            <li class="nav-item dropdown">
                <!--
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>-->
                <!--a class="navbar-brand m-0 ml-2 p-0" href="#">
                    <img src="{{ asset('img\usuario.png') }}" class="p-1" alt="LOGO" height="40px">
                </a-->
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('img\usuario.png') }}" class="p-1" alt="LOGO" height="40px">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" class="text-primary" href="#" onclick="">
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
            </li>
            @endguest
        </ul>

        <button class="btn btn-outline-light mx-2 p-0 border-0 d-inline-block position-relative" 
        data-toggle="collapse" data-target="#collapseCarrito" aria-expanded="false" aria-controls="collapseCarrito">
            <!--img src="{ asset('img\carritoCompras.png') }}" class="" alt="CARRITO" height="40px"-->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart3 " viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span class="badge badge-light position-absolute" id="cantidadCarrito">0</span>
            
        </button>
    </nav>
    <div class="col-md-3 ml-auto mr-0 px-0 position-relative">
        <div class="card card-body col-12 position-absolute collapse mx-0 shadow-lg" id="collapseCarrito" style="z-index:10">
        <p class="text-center">Tu carrito está vacío</p>
        <p class="text-justify">Navega y descubre más variedad de productos para tu higiene y salud que tenemos para ti</p>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark w-100 position-relative" style="background:#BDC2C5">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="row col-auto my-auto mx-0 p-0   ">
            <!--p class="my-0 p-0"><small>Ubicacion</small></p-->
            <img src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" class="col-1 p-1 img-fluid">
            <select class="custom-select col-10" onchange="cambiarSucursal()" id="sucursalActiva">
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
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            DEPARTAMENTOS
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($departamentos as $departamento)
                <a class="dropdown-item" href="#">{{$departamento->nombre}}</a>
            @endforeach
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @foreach($departamentos as $departamento)
            <ul class="navbar-nav mx-auto btn-outline-secondary">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/venta">{{$departamento->nombre}}<span class="sr-only">(current)</span></a>
                </li>
            </ul>   
            @endforeach
        </div>
        <!--button class="btn btn-outline-light mx-2 p-0 border-0 d-inline-block position-relative" 
        data-toggle="collapse" data-target="#collapseCarrito" aria-expanded="false" aria-controls="collapseCarrito">
            <--img src="{ asset('img\carritoCompras.png') }}" class="" alt="CARRITO" height="40px"->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-cart3 " viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span class="badge badge-light position-absolute" id="cantidadCarrito">0</span>
            
        </button-->
        <!--div class="collapse " id="collapseCarrito"-->

            
        <!--/div-->
    </nav>
</div>
<script>
let carrito = @json(session('carrito'));
let sucursal = @json(session('sucursalEcommerce'));
let elementoCarrito = document.querySelector('#collapseCarrito');//"{count(session('carrito'))}}";

async function cambiarSucursal()
{
    try{
        let sucursal = document.querySelector('#sucursalActiva').value;
        let url =`{{url('/sucursal')}}/${sucursal}`;
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
        location.href = location.href;//"{url('/')}}";
        //console.log('sucursal',);
        //let url =`{{url('/sucursal')}}/${sucursal}`;
    }catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
   
}
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
                carrito[i].imagen = "{{ asset('img/imagenNoDisponible.jpg') }}";
                console.log('imagen',"No hay imagen");
            }
            else{
                carrito[i].imagen = `{{ asset('storage')}}/${carrito[i].imagen}`;
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
}
mostrarCarrito();
</script>
@yield('contenido')
@endsection