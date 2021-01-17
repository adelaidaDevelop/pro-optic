@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        VENTAS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado))
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    AGREGAR EMPLEADO
                </button>
            </form>
        </div>
        @endif
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    EMPLEADOS DADOS DE BAJA
                </button>
            </form>
        </div>
        @endsection
    </div>
    <!--div class="row p-1 "-->
    <div class="row border border-dark m-2 w-100">
        @php
        $var = 1;
        @endphp
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-4 m-0 px-0 pt-2 pb-0 ">
                            <label for="nombre" class="font-weight-bold " style="color:#3366FF">
                                <h4>CODIGO DEL PRODUCTO</h4>
                            </label>
                        </div>
                        {{ csrf_field() }}
                        <div class="col m-0 px-0 pt-1 pb-0 ">
                            <input type="text" class="form-control @error('claveE') is-invalid @enderror"
                                name="codigoBarras" id="codigoBarras" value="{{ old('claveE') }}"
                                placeholder="Ingresar codigo de barras" required autocomplete="claveE" autofocus>
                            @error('claveE')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col m-1 ">
                            <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                                onclick="agregarPorCodigo()" value="informacion" id="botonAgregar">
                                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                AGREGAR
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                    <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                        onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion"
                        id="boton">
                        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                            height="25px">
                        BUSCAR PRODUCTO
                    </button>
                    </div>
                </div>
            </div>
            <div class="row m-0 px-0 border border-dark" style="height:300px;overflow-y:auto;">
                <table class="table table-hover table-bordered" id="productos">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">CODIGO_BARRAS</th>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">EXISTENCIA</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">IMPORTE</th>
                        </tr>
                    </thead>
                    <tbody id="info">
                    </tbody>
                </table>
            </div>
            <div class="row m-0 px-0">
                <div class="col my-2 ml-5 px-1">
                    <div class="row">
                        <form method="get" action="{{url('/empleado')}}">
                            <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                AGREGAR TICKET
                            </button>
                        </form>
                        <form method="get" action="{{url('/empleado')}}">
                            <button class="btn btn-primary ml-5" type="submit" style="background-color:#3366FF">
                                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                ELIMINAR TICKET
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col my-2 ml-5 mr-0 pr-0 ">
                    <div class="d-flex flex-row-reverse">
                        <h4 class="border border-dark ml-2 p-1" id="total">$ 0.00</h4>
                        <!--form method="get" action="{{url('/empleado')}}"-->
                        <!--{url('/departamento/'.$departamento->id.'/edit/')}}-->
                        <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                            onclick="verificarVenta()" value="informacion" id="boton">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            COBRAR
                        </button>
                        <!--/form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto"
                        id="busquedaProducto" onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda">
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-labelledby="confirmarVentaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="confirmarVentaModalLabel">CONFIRMAR VENTA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>COBRAR</h1>
                        </div>
                        <div class="col-12">
                            <p class="text-center">TOTAL A COBRAR</p>
                        </div>
                        <div class="col-12">
                            <h1 class="text-center" id="totalCobrar">$ 0.00</h1>
                        </div>
                    </div>
                </div>
                <!--div class="col-12 d-flex justify-content-center">
                    <div class="row">
                        <div class="col">
                            <button class="btn mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;">
                                <--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <--img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"->
                        </div>
                        <div class="col">
                            <button class="btn mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;">
                                <--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"->
                            </button>
                            <h6 class="mx-auto">CREDITO</h6>
                            <--img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"->
                        </div>
                    </div>
                </div-->
                <div class="col-12">
                    <ul class="nav nav-pills mb-3  d-flex justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="modoPago('efectivo')" class="btn nav-link active mx-auto" type="button"
                                value="informacion" id="boton" style="background-image: url(img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <!--a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true"><img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"><h6 class="mx-auto">EFECTIVO</h6></a-->
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="modoPago('credito')" class="btn nav-link mx-auto" type="button"
                                value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">CREDITO</h6>
                            <!--a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a-->
                        </li>
                        <!--li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                        </li-->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="col-6 mx-auto">
                                <div class="row my-1">
                                    <div class="col-5">
                                        <p class="h5">PAGÓ CON: </p>
                                    </div>
                                    <div class="col-7">
                                        <input type="number" class="form-control" data-decimals="2"
                                            oninput="calcularCambioEfectivo()" onchange="revisarPagoEfectivo()"
                                            id="pagoEfectivo" min=0.00 />
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-5">
                                        <p class="h5">SU CAMBIO: </p>
                                    </div>
                                    <div class="col-7">
                                        <p class="h5" id="cambioEfectivo">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="col-8 mx-auto">
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">CLIENTE: </p>
                                    </div>
                                    <div class="col-8">
                                        <select class="col form-control mr-3" name="clientes" id="clientes" required>
                                            <option value="0">NO HAY CLIENTES</option>
                                        </select>
                                        <!--input type="text" class="form-control" /-->
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">PAGÓ CON:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="number" oninput="calcularDeudaCredito()" id="pagoCredito"
                                            data-decimals="2" value=0 class="form-control" />
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">AUN DEBE: </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="h5" id="deudaCredito">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">...</div-->
                    </div>
                </div>
                <div id="pieModal" class="modal-footer">
                    <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">COBRAR E IMPRIMIR
                        TICKET</button>
                    <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">SOLO COBRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let productosVenta = [];
let productos = @json($datosP);

async function cargarProductos() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`/producto/productos`);
        if (response.ok) {
            productos = await response.json();
            //console.log(productos);
            return productos;
            //console.log(response);

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición de productos AJAX: " + err.message);
    }
    //return response;
}


function agregarProductoAVenta(id, codigoBarras, nombre, existencia, precio, cantidad, subtotal) {
    //console.log(id);
    let productos = {
        id: id,
        codigoBarras: codigoBarras,
        nombre: nombre,
        existencia: existencia,
        precio: precio,
        cantidad: cantidad,
        subtotal: subtotal
    };
    productosVenta.push(productos);
    console.log(productosVenta);
};
let total = 0;

function calcularTotal() {
    total = 0.00;
    for (count0 in productosVenta) {
        total = parseFloat(total + productosVenta[count0].subtotal);

    }
    document.getElementById("total").innerHTML = "$ " + total;
    document.getElementById("totalCobrar").textContent = "$ " + total;

}

function mostrarProductos() {
    let cuerpo = "";
    let contador = 1;
    for (let count1 in productosVenta) {
        cuerpo = cuerpo + `
        <tr class="text-center">
            <th scope="row">` + contador++ + `</th>
            <td>` + productosVenta[count1].codigoBarras + `</td>
            <td>` + productosVenta[count1].nombre + `</td>
            <td>` + productosVenta[count1].existencia + `</td>
            <td>` + productosVenta[count1].precio + `</td>
            <td><input  value=` + productosVenta[count1].cantidad + ` 
                onchange="cantidad(` + productosVenta[count1].id + `)"  
                id="valor` + productosVenta[count1].id + `" min=1 max=` + productosVenta[count1].existencia +
            ` type="number"/></td>
            <td id="importe` + productosVenta[count1].id + `">` + productosVenta[count1].subtotal + `</td>
            <td><button type="button" class="btn btn-secondary" onclick="quitarProducto(` + productosVenta[count1]
            .id + `)"><i class="bi bi-trash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></i></button>
            </td>
        </tr>
        `;
    }
    document.getElementById("info").innerHTML = cuerpo;
    var props = {
        decrementButton: "<strong>&minus;</strong>", // button text
        incrementButton: "<strong>&plus;</strong>", // ..
        groupClass: "", // css class of the resulting input-group
        buttonsClass: "btn-outline-secondary",
        buttonsWidth: "2rem",
        textAlign: "center", // alignment of the entered number
        autoDelay: 500, // ms threshold before auto value change
        autoInterval: 50, // speed of auto value change
        buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
        locale: navigator.language, // the locale, per default detected automatically from the browser
        template: // the template of the input
            '<div class="input-group ${groupClass}">' +
            '<div class="input-group-prepend"><button style="min-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus p-1" type="button">${decrementButton}</button></div>' +
            '<input type="text" inputmode="decimal" style="text-align: ${textAlign};width:20px;" class="form-control form-control-text-input"/>' +
            '<div class="input-group-append"><button style="min-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
            '</div>'
    }
    for (let i in productosVenta) {
        $("input[id='valor" + productosVenta[i].id + "']").inputSpinner(props);
    }
    calcularTotal();
    //min="1" max="` + productosVenta[count].existencia+`"
};
//$("input[type='number']").inputSpinner();
function quitarProducto(id) {

    let confirmacion = confirm("¿QUITAR PRODUCTO DE LA VENTA?");
    if (confirmacion == true) {
        for (let i in productosVenta) {
            if (productosVenta[i].id === id)
                productosVenta.splice(i, 1);
        }
        mostrarProductos();
    }
    //var i = arr.indexOf( item );
    //if ( i !== -1 )  
}


function buscarProductoEnVenta(idProducto) {
    for (count2 in productosVenta) {
        if (productosVenta[count2].id === idProducto) {
            if (productosVenta[count2].existencia > productosVenta[count2].cantidad) {
                productosVenta[count2].cantidad++;
                productosVenta[count2].subtotal = productosVenta[count2].cantidad * productosVenta[count2].precio;
                mostrarProductos();
                //console.log(idProducto);
            }
            return true;
        }
    }
    //alert('no entra a la funcion :c');
    //console.log(idProducto +'fuera');
    return false;
};

function agregarPorCodigo() {
    const codigo = document.querySelector('#codigoBarras');
    //location.href= location.href+'?codigo='+codigo.value;

    for (count3 in productos) {
        if (productos[count3].codigoBarras === codigo.value) {

            //agregarProductoAVenta(id,codigoBarras,nombre,existencia,precio,cantidad,subtotal)
            /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
            productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
            if (!buscarProductoEnVenta(productos[count3].id)) {
                if (productos[count3].existencia > 0) {
                    agregarProductoAVenta(productos[count3].id, productos[count3].codigoBarras, productos[count3]
                        .nombre,
                        productos[count3].existencia, productos[count3].precio, 1, productos[count3].precio);
                    mostrarProductos();
                } else
                    alert('PRODUCTO SIN EXISTENCIA');
            }
        }

    }

    codigo.value = "";


};

function agregarProducto(id) {
    for (let count4 in productos) {
        if (productos[count4].id === id) {
            /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
                productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
            console.log(id);
            console.log(productos[count4].id);
            if (!buscarProductoEnVenta(productos[count4].id)) {
                if (productos[count4].existencia > 0) {
                    agregarProductoAVenta(productos[count4].id, productos[count4].codigoBarras,
                        productos[count4].nombre,
                        productos[count4].existencia, productos[count4].precio, 1, productos[count4].precio);
                    mostrarProductos();
                } else
                    alert('PRODUCTO SIN EXISTENCIA');
            }
            /*if(!buscarProductoEnVenta(id))
            {
                console.log(productos[count4].id);
                agregarProductoAVenta(productos[count4].id,productos[count4].codigoBarras,productos[count4].nombre,
                productos[count4].existencia,productos[count4].precio,1,productos[count4].precio);
            }
            console.log(productos[count4].id);  
            mostrarProductos();*/
            //productosVenta.push(productos[count]);
        }
    }
    const palabraBusqueda = document.querySelector('#busquedaProducto');
    palabraBusqueda.value = "";
    //venta();
};


function buscarProducto() {

    const palabraBusqueda = document.querySelector('#busquedaProducto');
    let cuerpo = "";
    let contador = 1;
    let departamentos = @json($departamentos);
    for (let count5 in productos) {
        if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
            for (let d in departamentos) {
                if (productos[count5].idDepartamento === departamentos[d].id)
                    departamento = departamentos[d].nombre;
            }
            cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count5].id + `</th>
            <td>` + productos[count5].codigoBarras + `</td>
            <td>` + productos[count5].nombre + `</td>
            <td>` + productos[count5].existencia + `</td>
            <td>` + departamento + `</td>
        </tr>
        `;
        }
    }
    document.getElementById("consultaBusqueda").innerHTML = cuerpo;

};

function cantidad(id) {
    //alert('Si entro en la funcion'+id);
    const valorProducto = document.querySelector('#valor' + id);
    //alert(valorProducto.value);
    /*console.log(valorProducto.value);
    console.log(valorProducto.min);
    console.log(valorProducto.max);
    */
    //console.log(valorProducto.max - valorProducto.value);
    //if(valorProducto.value >= valorProducto.min)
    //  console.log(valorProducto.value - valorProducto.min);
    if (parseInt(valorProducto.max) > parseInt(valorProducto.value))
        console.log(parseInt(valorProducto.max) - parseInt(valorProducto.value));
    //if (valorProducto.value >= valorProducto.min && valorProducto.value <= valorProducto.max) {

    for (count6 in productosVenta) {
        if (productosVenta[count6].id === id) {
            productosVenta[count6].cantidad = parseInt(valorProducto.value);
            productosVenta[count6].subtotal = productosVenta[count6].precio * productosVenta[count6].cantidad;
        }
    }
    mostrarProductos()

    //}
    //const importeProducto = document.querySelector('#importe'+id);
}

async function realizarVentaEfectivo() {
    try {
        let json = JSON.stringify(productosVenta);
        const pago = document.querySelector('#pagoEfectivo');
        if (pago.value.length === 0)
            return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
        if (parseFloat(pago.value) < parseFloat(total))
            return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
        let funcion = $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: '/venta',
            // los datos que voy a enviar para la relación
            data: {
                datos: json,
                estado: 'vendido',
                pago: parseFloat(pago.value),
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert(respuesta);
            productosVenta = [];
            mostrarProductos();
            $('#confirmarVentaModal').modal('hide');
            console.log(respuesta); //JSON.stringify(respuesta));
        });
        await cargarProductos();
        //console.log(p);
        //console.log(funcion);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function realizarVentaCredito() {
    let json = JSON.stringify(productosVenta);
    const pago = document.querySelector('#pagoCredito');
    const cliente = document.querySelector('#clientes');
    if (pago.value.length === 0)
        return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
    if (parseFloat(pago.value) > parseFloat(total))
        return alert('SI EL PAGO ES MAYOR MEJOR USE EL PAGO CON EFECTIVO');
    try {
        let funcion = $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: '/venta',
            // los datos que voy a enviar para la relación
            data: {
                datos: json,
                estado: 'credito',
                pago: parseFloat(pago.value),
                cliente: cliente.value,
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}"
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            alert(respuesta);
            console.log(respuesta); //JSON.stringify(respuesta));
        });
        await cargarProductos();
        console.log(funcion);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

function calcularCambioEfectivo() {

    const pago = document.querySelector('#pagoEfectivo');

    const cambio = document.querySelector('#cambioEfectivo');
    if (parseFloat(pago.value) > total) {
        //alert('si entra');
        let diferencia = parseFloat(pago.value) - parseFloat(total);
        console.log(parseFloat(pago.value));
        console.log(parseFloat(total));
        cambio.innerHTML = "$ " + '<strong>' + diferencia + '</strong>';
        //cambio.textContent ="$" + '<strong>'+diferencia+'</strong>';
        //cambio.value = parseFloat(pago.value)-total;
    } else {
        cambio.textContent = "$ 0.00"
    }

}

function calcularDeudaCredito() {

    const pago = document.querySelector('#pagoCredito');

    const deuda = document.querySelector('#deudaCredito');
    if (parseFloat(pago.value) > 0) {
        //alert('si entra');
        let diferencia = parseFloat(total) - parseFloat(pago.value);
        console.log(parseFloat(pago.value));
        console.log(parseFloat(total));
        deuda.innerHTML = "$ " + '<strong>' + diferencia + '</strong>';
        //cambio.textContent ="$" + '<strong>'+diferencia+'</strong>';
        //cambio.value = parseFloat(pago.value)-total;
    } else {
        deuda.textContent = "$ 0.00"
    }

}


function revisarPagoEfectivo() {
    const pago = document.querySelector('#pagoEfectivo');
    console.log(pago.value.length);
    //if(pago.value.length===0)
    //  $("input[id='pagoEfectivo']").val(total);
}


function verificarVenta() {
    if (productosVenta.length === 0) {
        alert('NO TIENE NINGUN PRODUCTO AGREGADO');
    } else {
        $("input[id='pagoEfectivo']").val(total);
        console.log(parseFloat(total));
        $('#confirmarVentaModal').modal('show');
    }

}

function modoPago(tipoPago) {
    const pieModal = document.querySelector('#pieModal');
    let cuerpo = "";
    if (tipoPago === 'efectivo') {
        cuerpo = `
        <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button>
        <button type="button" onclick="realizarVentaEfectivo()" class="btn btn-primary">SOLO COBRAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    `;


    }
    if (tipoPago === 'credito') {
        cuerpo = `
        <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button>
        <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">SOLO COBRAR</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    `;
        let clientes = document.querySelector('#clientes');;
        let opcionesCliente = "";
        let cliente = @json($clientes);
        for (let i in cliente) {
            opcionesCliente = opcionesCliente +
                `
        <option value=` + cliente[i].id + `>` + cliente[i].nombre + `</option>
        `
        }
        clientes.innerHTML = opcionesCliente;

    }
    pieModal.innerHTML = cuerpo;

}
</script>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
let valor = $("input[type='number']").inputSpinner();
console.log(valor);
</script>
@endsection