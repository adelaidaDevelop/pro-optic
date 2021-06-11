@extends('layouts.headerEcommerce')
@section('contenido')
@if(count($array)>0)
<div class="row col-12">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent h5">
            <li class="breadcrumb-item"><a href="{{url('/')}}">INICIO</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{$nombre}}
            </li>
        </ol>
    </nav>
</div>
<div class="col-12 mt-3 border-bottom">
    <p class="h3">{{$nombre}}</p>
</div>
<div class="row mx-0 mt-3">
    <div class="col-sm-3">
        <small>
            <p class="h6 font-weight-bolder">Filtrar búsqueda</p>
        </small>
        <div class="accordion" id="filtrarPorPrecio">
            <div class="card">
                <div class="card-header p-0" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-light btn-block text-left text-success font-weight-bolder" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Rango de precio
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#filtrarPorPrecio">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="250" id="rango1" onchange="filtrar()">
                            <label class="form-check-label" for="rango1">
                                $0 - $250
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="500" id="rango2" onchange="filtrar()">
                            <label class="form-check-label" for="rango2">
                                $251 - $500
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="501" id="rango3" onchange="filtrar()">
                            <label class="form-check-label" for="rango3">
                                más de $501
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-12 col-sm-9 ml-sm-auto mx-0">
        <div class="row col-sm-4">
            <label class="font-weight-bolder">Ordenar por</label>
            <select class="form-control" id="ordenProducto" onchange="ordenar()">
                <option value="0" selected>Nombre (Ascendente)</option>
                <option value="1">Nombre (Descendente)</option>
                <option value="2">Precio (Ascendente)</option>
                <option value="3">Precio (Descendente)</option>
            </select>
        </div>
        <div id="contenidoProductos" class="row col-12 mx-0 my-1 p-sm-2 border">
            <div class="card-deck">
                @foreach($array as $producto)

                <!--div class="col my-2"-->
                <div id="tarjeta{{$producto['id']}}" class="card my-1" style="width: 15rem;max-width: 540px;" onmouseout="seleccionProducto(false,`{{$producto['id']}}`)" onmouseover="seleccionProducto(true,`{{$producto['id']}}`)" href="{{url('/producto/'.$producto['id'])}}">

                    <!--a class="btn btn-outline-light h-100 " href="{{url('/producto/'.$producto['id'])}}"-->
                    <div class="card-header">
                        @if(!empty($producto['imagen']))
                        <img src="{{ asset('storage').'/'.$producto['imagen']}}" alt="" class="card-img-top">
                        @else
                        <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" class="card-img-top">
                        @endif
                        <!--img src="{{ asset('img\carusel.jpg') }}" class="card-img-top" alt="..."-->
                    </div>
                    <div class="card-body mx-auto mb-0">
                        <h5 class="card-title text-dark">{{$producto['nombre']}}</h5>
                        <h5 class="card-title text-dark">{{$producto['precio']}}</h5>
                        <!--p class="card-text text-dark">{$producto['descripcion']}}</p-->
                    </div>
                    <!--/a-->
                    <div class="card-footer mx-auto mt-auto bg-transparent">
                        <!--small class="text-muted">Last updated 3 mins ago</small-->
                        <button class="btn btn-primary mx-auto" id="agregarAlCarrito" onclick="addCarrito(`{{$producto['id']}}`)">Agregar al carrito</button>
                    </div>

                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    let productosFiltrados = [];

    function filtrar() {
        productosFiltrados = [];
        let productos = @json($array);
        //let departamentos = @json($departamentos);
        let dValidos = [];
        //let validarDepartamento = false;
        let validarRango = false;
        /*for (let i in departamentos) {
            let departamento = document.getElementById(`check${departamentos[i].id}`);
            if (departamento.checked) {
                dValidos.push(departamento.value);
                validarDepartamento = true;
            }
        }*/
        let rango1 = document.getElementById(`rango1`);
        let rango2 = document.getElementById(`rango2`);
        let rango3 = document.getElementById(`rango3`);
        if (rango1.checked || rango2.checked || rango3.checked)
            validarRango = true;
        for (let i in productos) {
            let valido = false;
            /*if (validarDepartamento) {
                for (let x in dValidos) {
                    if (productos[i].idDepartamento == dValidos[x])
                        valido = true;
                }
            } else {
                valido = true;
            }*/
            //if (valido) {
            if (validarRango) {
                console.log('precio', productos[i].precio);
                console.log('rango1', rango1.value);
                if (rango1.checked && parseFloat(productos[i].precio) <= parseInt(rango1.value)) {
                    productosFiltrados.push(productos[i]);
                } else {
                    if (rango2.checked && parseFloat(productos[i].precio) > parseInt(rango1.value) &&
                        parseFloat(productos[i].precio) <= parseInt(rango2.value)) {
                        productosFiltrados.push(productos[i]);
                    } else {
                        if (rango3.checked && parseFloat(productos[i].precio) >= parseInt(rango3.value)) {
                            productosFiltrados.push(productos[i]);
                        }
                    }
                }
            } else {
                productosFiltrados.push(productos[i]);
            }
            //}
        }
        ordenar(); //productosFiltrados);
        //console.log('departamentos validados',dValidos);
    }

    function ordenar() {
        let lista = productosFiltrados;
        let opcion = parseInt(document.getElementById(`ordenProducto`).value);
        let listaOrdenada = [];
        switch (opcion) {
            case 0:
                listaOrdenada = lista.sort(function(a, b) {
                    if (a.nombre.toUpperCase().localeCompare(b.nombre.toUpperCase()) == -1) {
                        return 1;
                    }
                    if (a.nombre.toUpperCase().localeCompare(b.nombre.toUpperCase()) == 1) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                });
                break;
            case 1:
                listaOrdenada = lista.sort(function(a, b) {
                    if (a.nombre.toUpperCase().localeCompare(b.nombre.toUpperCase()) == 1) {
                        return 1;
                    }
                    if (a.nombre.toUpperCase().localeCompare(b.nombre.toUpperCase()) == -1) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                });
                break;
            case 2:
                listaOrdenada = lista.sort(function(a, b) {
                    if (a.precio > b.precio) {
                        return 1;
                    }
                    if (a.precio < b.precio) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                });
                break;
            case 3:
                listaOrdenada = lista.sort(function(a, b) {
                    if (a.precio < b.precio) {
                        return 1;
                    }
                    if (a.precio > b.precio) {
                        return -1;
                    }
                    // a must be equal to b
                    return 0;
                });
                break;
            default:
                //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                break;
        }
        mostrarProductos(listaOrdenada);
    }
    //let precargar = @json($array);
    filtrar();

    function mostrarProductos(lista) {
        let cuerpo = "";
        for (let i in lista) {
            let urlImagen = "{{ asset('img/imagenNoDisponible.jpg') }}";
            if (lista[i].imagen != null && lista[i].imagen.length > 0)
                urlImagen = `{{ asset('storage')}}/${lista[i].imagen}`;
            cuerpo = cuerpo +
                `<div class="card-group mx-auto ">
            <div id="tarjeta${lista[i].id}" class="card my-1" style="width: 15rem;"
            onmouseout="seleccionProducto(false,${lista[i].id})"
            onmouseover="seleccionProducto(true,${lista[i].id})">
                <a class="btn btn-outline-light h-100 " href="{{url('/producto')}}/${lista[i].id}">
                <div class="card-header bg-transparent border-0">    
                    <img src="${urlImagen}" alt="" class="card-img-top">
                </div>
                <div class="card-body mx-auto mb-0">
                    <h5 class="card-title text-dark">${lista[i].nombre}</h5>
                    <h5 class="card-title text-success">$ ${lista[i].precio}</h5>
                </div>
                </a>
                <div class="card-footer mx-auto mt-auto bg-transparent">
                    <button class="btn btn-primary mx-auto" type="button" id="agregarAlCarrito"
                    onclick="addCarrito('${lista[i].id}')">Agregar al carrito</button>
                </div>
                
            </div>
        </div>`;

        }
        if (cuerpo.length > 0)
            document.getElementById(`contenidoProductos`).innerHTML = cuerpo;
        else {
            document.getElementById(`contenidoProductos`).innerHTML = "No hay productos con este filtro";
        }
    }

    function seleccionProducto(bandera, id) {
        if (bandera) {
            //const tarjeta = document.getElementById('tarjeta'+id).focusable = true;
            $('#tarjeta' + id).addClass('shadow-lg border border-primary');
            //console.log('class',$('#tarjeta'+id).toggleClass(' shadow'));
        } else {
            //const tarjeta = document.getElementById('tarjeta'+id).focusable = false;
            $('#tarjeta' + id).removeClass('shadow-lg border border-primary');
        }
    }
    async function addCarrito(id) {
        try {
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
            if (respuesta == 1) {
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
</script>
@else
<div class="col-9 mt-3 mx-auto">
    <label class="h2">Lo sentimos, no se encontraron resultados para tu búsqueda</label>
    <p class="">Sugerencias:</p>
    <li class="">Puede que hayas ingresado las palabras clave erróneamente - por favor checa por errores.</li>
    <li class="">Estas siendo demasiado especifico - amplie su búsqueda mediante el uso de un menor número de palabras
        clave.</li>
    <li class="">Navega por nuestros productos mediante la selección de una categoría de arriba.</li>
</div>
@endif
@endsection