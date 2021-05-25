@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row">
        @section('subtitulo')
        COMPRAS
        @endsection
        @section('opciones')
        <div class="ml-4 my-auto">
            <form method="get" action="{{url('/puntoVenta/compra/')}}">
                <button class="btn btn-outline-secondary p-1 border-0" type="submit">
                    <img src="{{ asset('img\compra2.png') }}" alt="Editar" width="32px" height="32px">
                    <p class="h6 my-auto mx-2 text-dark"><small>CONSULTAR COMPRAS</small></p>
                </button>
            </form>
        </div>
        <div class="my-auto">
            <form method="get" action="{{url('/puntoVenta/proveedor/')}}">
                <button class="btn btn-outline-secondary p-1 border-0" type="submit">
                    <img src="{{ asset('img\proveedor.png') }}" alt="Editar" width="30px" height="30px">
                    <p class="h6 my-auto mx-2 text-dark"><small>PROVEEDORES</small></p>
                </button>
            </form>
        </div>
        @endsection
    </div>
    <div class="row">
        <div class="col-12 w-100 p-0">
            <!--CONSULTAR PRODUCTO -->
            <div class="row border mt-2 mb-2 mx-0 border-dark">
                <div class="col-12">
                    <div class="row mx-1 mt-1 mb-0">
                        <label for="">
                            <h5 class="text-primary m-0 p-0">
                                <strong>
                                    INGRESAR PRODUCTOS
                                </strong>
                            </h5>
                        </label>
                    </div>
                    <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->

                    <div class="row mx-1 mb-2 py-2 border border-secondary">
                        <div class="col-3 form-group row m-auto">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="proveedor">PROVEEDOR</span>
                                </div>
                                <select class="form-control" name="proveedor" id="proveedor" required>
                                    <option value="idProveedor">PROVEEDOR</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3 form-group row m-auto ">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" for="fechaCompra">COMPRA</span>
                                </div>
                                <input type="date" min="" id="fechaCompra" class="form-control" />
                                <!--select class="form-control" name="idDepartamento" id="idDepartamento" required>
                                <option value="">10/12/2020</option>
                            </select-->
                            </div>
                        </div>

                        <div class="col-2 form-group row m-auto">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="iva" id="iva" onchange="activarIva()">
                                    </div>
                                    <span class="input-group-text" for="iva"><strong>IVA %</strong></span>
                                </div>
                                <!--div class="input-group my-0 mx-0 px-0 border"-->
                                <input type="number" id="inputIva" data-prefix="IVA %" name="inputIva" value=16 min=0
                                    class="form-control my-auto" />
                            </div>
                        </div>
                        <div class="col-4 form-group row m-auto">
                            <!--div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="credito" id="credito"
                                            onchange="activarCredito()" />
                                    </div>
                                    <span class="input-group-text" for="credito">CREDITO</span>
                                    <span class="input-group-text"><strong>ABONO $</strong></span>
                                </div>
                                <input type="number" data-prefix="" id="pagoCredito" name="pagoCredito"
                                    data-decimals="2" value=0 min=0 class="form-control" />
                            </div-->
                            <div class="col-auto ml-auto px-1 py-0 border border-secondary rounded">
                                <div class="form-check my-1">
                                <input type="checkbox" name="credito" id="credito"
                                class="form-check-input mt-2" onchange="activarCredito()" />
                                <label class="form-check-label " for="credito">
                                    CREDITO
                                </label>
                                </div>
                            </div>
                            <div class="col-8 mr-auto px-0">
                                <input type="number" data-prefix="ABONO $" id="pagoCredito" name="pagoCredito"
                                    data-decimals="2" value=0 min=0 class="form-control px-0" />
                            </div>
                        </div>
                    </div>
                    <div class="row ml-1">
                        <button type="button" class="btn btn-secondary my-auto " data-toggle="modal"
                            data-target="#exampleModal" onclick="buscarProducto()">
                            <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="25px" height="25px">
                            <p class="h6 my-auto mx-2">AGREGAR PRODUCTO</p>
                        </button>
                    </div>
                    <!-- TABLA -->
                    <div class="row m-1 border border-dark" style="height:390px;overflow-y:auto;">
                        <table class="table table-bordered border-primary col-12">
                            <thead class="table-secondary text-primary">
                                <tr class="text-center">
                                    <th>CODIGO BARRAS</th>
                                    <th>PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                    <th>COSTO</th>
                                    <th>GANANCIA</th>
                                    <th>PRECIO</th>
                                    <th>CADUCIDAD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="productos">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col my-2 ml-1 pr-0 border">
                        <div class="d-flex flex-row-reverse">
                            <h4 class="border border-dark m-0 ml-2 p-1" id="total">$ 0.00</h4>
                            <!--form method="get" action="{url('/empleado')}}"-->
                            <!--{url('/departamento/'.$departamento->id.'/edit/')}}-->
                            <button type="button" onclick="verificarCompra()" class="btn btn-secondary d-flex ml-auto p-2">
                            GUARDAR COMPRA</button>
                            <!--/form-->
                        </div>
                    </div>
                    <!--div class="row mx-1 my-2 border">

                        <button type="button" onclick="verificarCompra()" class="btn btn-secondary d-flex ml-auto p-2">
                            GUARDAR COMPRA</button>
                    </div-->
                    <!--div class="d-flex flex-row-reverse bd-highlight m-1 ">
                        <button type="button" onclick="verificarCompra()" class="btn btn-secondary"> GUARDAR
                            COMPRA</button>
                    </div-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalConsulta">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">INGRESAR PRODUCTO</h5>
                <button id="cerrar" type="button" class="close" onclick="cerrarModal()" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModal">
                <div class="row">
                    <div class="text-secondary mx-2 mt-2 h6"> <small> ESCRIBA EL NOMBRE DEL PRODUCTO A AGREGAR </small></div>
                    <input type="text" class="form-control mx-2 mb-3 text-uppercase" placeholder="Buscar producto"
                        id="busquedaProducto" onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;" id="productosBusqueda">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda">
                        
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="crearProducto()">NUEVO PRODUCTO</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmarCompraModal" tabindex="-1" role="dialog"
    aria-labelledby="confirmarCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalConfirmarCompra">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmarCompraModalLabel">CONFIRMAR COMPRA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                   ANTES DE GUARDAR VERIFIQUE LA INFORMACION INGRESADA. ¿DESEA GUARDAR LA COMPRA?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                <button type="button" onclick="guardarCompra()" class="btn btn-primary">CONFIRMAR COMPRA</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
let productosCompra = [];
let productos = [];
//let productosSucursal = [];

function cargarProveedores() {
    const proveedor = document.querySelector('#proveedor');
    let proveedores = @json($proveedores);
    let cuerpo = "";
    for (let i in proveedores) {
        cuerpo = cuerpo + `<option value="` + proveedores[i].id + `">` + proveedores[i].nombre + `</option>`
    }
    proveedor.innerHTML = cuerpo;
}
cargarProveedores();

function buscarProductoEnCompra(idProducto) {
    if (productosCompra.length > 0)
        for (let count2 in productosCompra) {
            if (productosCompra[count2].id === idProducto) {
                return true;
            }
        }
    return false;
};


async function cargarProductos(producto) {
    let response = "Sin respuesta";
    try {
        response = await fetch(`/puntoVenta/producto/${producto}`);
        if (response.ok) {
            productos = await response.json();
            //if (productosSucursal.length === 0)
              //  productosSucursal = await cargarProductosSucursal();
            /*for (let i in productos) {
                productos[i].existencia = 0;
                productos[i].costo = 0; //productosSucursal[s].costo;
                productos[i].precio = 0; //productosSucursal[s].precio;
                productos[i].idSucursal = false;
                for (let s in productosSucursal) {
                    if (productosSucursal[s].idProducto === productos[i].id) {
                        productos[i].existencia = productosSucursal[s].existencia;
                        productos[i].costo = productosSucursal[s].costo;
                        productos[i].precio = productosSucursal[s].precio;
                        productos[i].idSucursal = true;
                    }

                }
            }*/
            //console.log(productos);
            return productos;

        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

/*async function cargarProductosSucursal() {
    let response = "Sin respuesta";
    try {
        response = await fetch(`/puntoVenta/sucursalProducto/{{session('sucursal')}}`);
        if (response.ok) {
            productosSucursal = await response.json();
            //console.log('los productosde la sucursal son: ',productosSucursal);
            return productosSucursal;
        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}*/

let ingresarProducto = document.querySelector('#cuerpoModal').innerHTML;
let ingresarProductoTitulo = document.querySelector('#exampleModalLabel').innerHTML;
//let botonCerrarModal = 0;
async function buscarProducto() {
    try {
        //if (productos.length === 0)
        //{
            const contenidoProducto = document.querySelector('#consultaBusqueda');
            const contenidoOriginal = contenidoProducto.innerHTML;
            contenidoProducto.innerHTML = 
            `<tr>
            <td colspan="5">
            <div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    CARGANDO PRODUCTOS
                </button>
            </div>
            </td>
            </tr>
            `;
            
        //}
        const entrada = document.querySelector('#busquedaProducto');
        if(entrada.value.length == 0)
        {
            contenidoProducto.innerHTML = "";//contenidoOriginal;
            return;
        }
            
        productos = await cargarProductos(entrada.value);
        console.log('Productos: ',productos);
        contenidoProducto.innerHTML = "";//contenidoOriginal;
        let productosEncontrados = document.querySelector('#consultaBusqueda');
        let contador = 1;
        let cuerpo = "";
        let departamentos = @json($departamentos);
        
        for (let i in productos) {
            //if (productos[i].nombre.toUpperCase().includes(entrada.value.toUpperCase())) {
                let departamento = "No lo busca";

                for (let o in departamentos) {
                    if (productos[i].idDepartamento === departamentos[o].id)
                        departamento = departamentos[o].nombre;
                }
                console.log(productos);
                cuerpo = cuerpo + `
                <tr onclick="agregarProducto(` + productos[i].id + `)" data-dismiss="modal">
                <td>` + contador++ + `</td>
                <td>` + productos[i].codigoBarras + `</td>
                <td>` + productos[i].nombre + `</td>
                <td>` + productos[i].existencia + `</td>
                <td>` + departamento + `</td>
            </tr>
            `;
            //}
        }
        productosEncontrados.innerHTML = cuerpo;
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
};

function agregarProductoACompra(id, codigoBarras, nombre, cantidad, costo, ganancia, precio, caducidad, idSucursal) {
    let producto = {
        id: id,
        codigoBarras: codigoBarras,
        nombre: nombre,
        cantidad: cantidad,
        costo: parseFloat(costo),
        ganancia: ganancia,
        precio: precio,
        caducidad: caducidad,
        idSucursal: idSucursal,
        fechaCaducidad: false
    };
    console.log(producto)
    productosCompra.push(producto);
}
var preProps = {
    decrementButton: "<strong>&minus;</strong>", // button text
    incrementButton: "<strong>&plus;</strong>", // ..
    groupClass: "my-0 mx-1 p-0", // css class of the resulting input-group
    buttonsClass: "btn-outline-secondary",
    buttonsWidth: "2rem",
    textAlign: "center", // alignment of the entered number
    autoDelay: 500, // ms threshold before auto value change
    autoInterval: 50, // speed of auto value change
    buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
    locale: navigator.language, // the locale, per default detected automatically from the browser
    template: // the template of the input
        '<div class="input-group ${groupClass}">' +
        '<div class="input-group-prepend"><button style="max-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus p-1" type="button">${decrementButton}</button></div>' +
        '<input type="text" inputmode="decimal" style="text-align: ${textAlign}" class="form-control form-control-text-input"/>' +
        '<div class="input-group-append"><button style="max-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
        '</div>'
}
//$("input[name='pagoCredito']").inputSpinner(preProps);
/*preProps.template = 
'<div class="input-group ${groupClass}">' +
        '<div class="input-group-prepend">'+'<div class="input-group-text">'+
        '<input type="checkbox" name="iva" id="iva" onchange="activarIva()"></div>'+
        '<button style="max-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus p-1" type="button">${decrementButton}</button></div>' +
        '<input type="text" inputmode="decimal" style="text-align: ${textAlign}" class="form-control form-control-text-input"/>' +
        '<div class="input-group-append"><button style="max-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
        '</div>';
*/
//$("input[name='inputIva']").inputSpinner(preProps);
$("input[name='pagoCredito']").inputSpinner(preProps);
$('input[id="pagoCredito"]').prop('disabled', true);
$('input[id="inputIva"]').prop('disabled', true);

function activarCredito() {
    let btn = document.querySelector('input[name="credito"]:checked');
    if (btn != null) {
        $('input[id="pagoCredito"]').prop('disabled', false);
    } else {
        $('input[id="pagoCredito"]').prop('disabled', true);
    }
}

function activarIva() {
    let btn = document.querySelector('input[name="iva"]:checked');
    if (btn != null) {
        $('input[id="inputIva"]').prop('disabled', false);

    } else {
        $('input[id="inputIva"]').prop('disabled', true);
    }
    for (let count1 in productosCompra) {
        costo(productosCompra[count1].id);
    }

}

function mostrarProductos() {
    let cuerpo = "";
    let contador = 1;
    for (let count1 in productosCompra) {

        //<th scope="row">` + contador++ + `</th>
        let checked = "";
        let disabled = "disabled";
        if (productosCompra[count1].fechaCaducidad) {
            checked = "checked";
            disabled = "";
        }

        cuerpo = cuerpo + `
        <tr>
            <td><p>` + productosCompra[count1].codigoBarras + `</p></td>
            <td>` + productosCompra[count1].nombre + `</td>
            <td><input name="cantidad" value="` + productosCompra[count1].cantidad + `" 
                onchange="cantidad(` + productosCompra[count1].id + `)"  
                id="cantidad` + productosCompra[count1].id + `" min="1" ` +
            ` type="number"/>` + `</td>
            <td><input name="costo" data-prefix="$"  value="` + productosCompra[count1].costo + `" 
                onchange="costo(` + productosCompra[count1].id + `)"  
                id="costo` + productosCompra[count1].id + `" min="0" ` +
            ` type="number" data-decimals="2"/>` + `</td>
            <td><input name="ganancia" data-prefix="%"  value="` + productosCompra[count1].ganancia + `" 
                onchange="ganancia(` + productosCompra[count1].id + `)"  
                id="ganancia` + productosCompra[count1].id + `" min="0" ` +
            ` type="number"/>` + `</td>
            <td><input name="precio" data-prefix="$"  value="` + productosCompra[count1].precio + `" 
                onchange="precio(` + productosCompra[count1].id + `)"  
                id="precio` + productosCompra[count1].id + `" min="0" ` +
            ` type="number" data-decimals="2" />` + `</td>
            <td>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text mx-0 px-1">
                        <input type="checkbox" class="mx-0" id="checked${productosCompra[count1].id}"
                        onclick="setFechaCaducidad(${productosCompra[count1].id})" ${checked}/>
                    </div>
                </div>
                <input onchange="caducidad(` + productosCompra[count1].id + `)" type="date" value="` +
            productosCompra[count1].caducidad + `" min="` + productosCompra[count1].caducidad +
            `" class="form-control px-0 mx-0" id="caducidad` + productosCompra[count1].id + `" ${disabled}/>
            </div>
            </td>
            <td><button type="button" class="btn btn-secondary" onclick="quitarProducto(` + productosCompra[count1]
            .id + `)"><i class="bi bi-trash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></i></button></td>
        `;
    }
    document.getElementById("productos").innerHTML = cuerpo;
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
            '<div class="input-group-prepend"><button style="max-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus p-1" type="button">${decrementButton}</button></div>' +
            '<input type="text" inputmode="decimal" style="text-align: ${textAlign};" class="form-control form-control-text-input"/>' +
            '<div class="input-group-append"><button style="max-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus p-1" type="button">${incrementButton}</button></div>' +
            '</div>'
    }
    //$("input[name='pagoCredito']").inputSpinner("destroy");
    $("input[name='cantidad']").inputSpinner(props);
    $("input[name='costo']").inputSpinner(props);
    $("input[name='ganancia']").inputSpinner(props);
    $("input[name='precio']").inputSpinner(props);
    //activarIva();

    

}
//mostrarProductos();
function cantidad(id) {
    const valorProducto = document.querySelector('#cantidad' + id);
    for (let i in productosCompra) {
        if (productosCompra[i].id === id) {
            productosCompra[i].cantidad = parseInt(valorProducto.value);
            console.log(productosCompra[i]);
        }
    }
    actualizarTotal();
}

function costo(id) {
    const costoProducto = document.querySelector('#costo' + id);
    for (let i in productosCompra) {
        if (productosCompra[i].id === id) {
            productosCompra[i].costo = parseFloat(costoProducto.value);
            //console.log(productosCompra[i]);
            let ganancia = ((productosCompra[i].costo * productosCompra[i].ganancia) / 100)
            let costo = productosCompra[i].costo;
            let precio = parseFloat(costo + ganancia);
            productosCompra[i].precio = precio.toFixed(2);
            let btnIva = document.querySelector('input[name="iva"]:checked');
            if (btnIva != null) {
                let iva = document.querySelector('input[name="inputIva"]');
                //console.log(iva)
                let costoIva = ((parseFloat(productosCompra[i].costo) * parseFloat(iva.value)) / 100);
                costoIva = costoIva.toFixed(2);
                precio = parseFloat(productosCompra[i].precio) + parseFloat(costoIva);
                productosCompra[i].precio = precio.toFixed(2);
            }
            console.log(productosCompra[i].precio)
            mostrarProductos();
            //productosCompra[i].costo;
        }
    }
    actualizarTotal();
}

function ganancia(id) {
    const gananciaProducto = document.querySelector('#ganancia' + id);
    for (let i in productosCompra) {
        if (productosCompra[i].id === id) {
            productosCompra[i].ganancia = parseInt(gananciaProducto.value);
            console.log(productosCompra[i]);
            let ganancia = ((productosCompra[i].costo * productosCompra[i].ganancia) / 100)
            let costo = productosCompra[i].costo;
            let precio = parseFloat(costo + ganancia);
            productosCompra[i].precio = precio.toFixed(2);
            //productosCompra[i].precio = productosCompra[i].precio.toFixed(2);
            let btnIva = document.querySelector('input[name="iva"]:checked');
            if (btnIva != null) {
                let iva = document.querySelector('input[name="inputIva"]');
                let costoIva = ((parseFloat(productosCompra[i].costo) * parseFloat(iva.value)) / 100);
                precio = parseFloat(productosCompra[i].precio) + parseFloat(costoIva);
                productosCompra[i].precio = precio.toFixed(2);
            }
            console.log(productosCompra[i].precio)
            mostrarProductos();
            //productosCompra[i].costo;
        }
    }
}

function precio(id) {
    const precioProducto = document.querySelector('#precio' + id);
    for (let i in productosCompra) {
        if (productosCompra[i].id === id) {
            let precio1 = parseFloat(precioProducto.value);
            productosCompra[i].precio = precio1.toFixed(2);
            //console.log(productosCompra[i]);
            let costo = productosCompra[i].costo;
            let precio2 = parseFloat(productosCompra[i].precio); // ((productosCompra[i].costo*productosCompra[i].ganancia)/100)
            precio2 = precio2.toFixed(2);
            console.log(precio2);
            let mult = precio2 * 100;
            mult = mult.toFixed(2);
            console.log(mult);
            let div = parseInt(mult / costo);
            console.log(div);
            let resultado = parseInt(div - 100);
            productosCompra[i].ganancia = resultado; //parseInt(((precio*100)/costo)-100);
            //console.log(resultado);
            let btnIva = document.querySelector('input[name="iva"]:checked');
            if (btnIva != null) {
                let iva = document.querySelector('input[name="inputIva"]');
                //let costoIva = ((parseFloat(productosCompra[i].costo) * parseFloat(iva))/100);
                //let ganancia = ((productosCompra[i].precio*100)/productosCompra[i].costo)-parseInt(iva.value)
                //productosCompra[i].precio = parseFloat(productosCompra[i].precio)+ parseFloat(costoIva);
                //console.log(productosCompra[i].ganancia);
                console.log(parseInt(iva.value));
                console.log(productosCompra[i].ganancia);
                productosCompra[i].ganancia = parseInt(productosCompra[i].ganancia - iva.value);
            }
            //console.log(productosCompra[i].ganancia);
            mostrarProductos();
            //productosCompra[i].costo;
        }
    }
}

function caducidad(id) {
    const caducidadProducto = document.querySelector('#caducidad' + id);
    for (let i in productosCompra) {
        if (productosCompra[i].id === id) {
            productosCompra[i].caducidad = caducidadProducto.value;

            //productosCompra[i].costo;
        }
    }
}

function fechaActual() {
    let fechaActual = new Date();
    let dia = fechaActual.getDate();
    let mes = (fechaActual.getMonth() + 1);
    let anio = fechaActual.getFullYear();

    if (dia < 10)
        dia = "0" + dia;
    if (mes < 10)
        mes = "0" + mes;

    return anio + "-" + mes + "-" + dia;
}
let total = 0;
function actualizarTotal()
{
    let etiquetaTotal = document.querySelector('#total');
    total = 0;
    for(let i in productosCompra)
    {
        let subtotal = productosCompra[i].cantidad * parseFloat(productosCompra[i].costo);
        total = total + subtotal;
    }
    etiquetaTotal.textContent = "$ " + total;
}

function agregarProducto(id) {
    for (let i in productos) {
        if (productos[i].id === id) {
            if (!buscarProductoEnCompra(id)) {

                //console.log('El producto a agregar es:',productos[i]);
                let ganancia = 0;
                if (productos[i].costo > 0)
                    ganancia = ((productos[i].precio * 100) / (productos[i].costo)) - 100;
                //console.log('La ganancia es:',ganancia);
                //console.log((productos[i].precio * 100));
                //console.log((productos[i].costo));
                //agregarProductoACompra(id,codigoBarras,nombre,cantidad,costo,ganancia,precio,caducidad)
                agregarProductoACompra(productos[i].id, productos[i].codigoBarras, productos[i].nombre,
                    1, productos[i].costo, ganancia, productos[i].precio, fechaActual(), productos[i].idSucursal
                );
            } else alert("YA AGREGÓ ESTE PRODUCTO");
        }
    }
    const entrada = document.querySelector('#busquedaProducto').value = "";
    mostrarProductos();
    actualizarTotal();
    activarIva();
    //console.log(productosCompra);
}

function quitarProducto(id) {

    let confirmacion = confirm("¿QUITAR PRODUCTO DE LA COMPRA?");
    if (confirmacion == true) {
        for (let i in productosCompra) {
            if (productosCompra[i].id === id)
                productosCompra.splice(i, 1);
        }
        actualizarTotal();
        mostrarProductos();
    }
    //var i = arr.indexOf( item );
    //if ( i !== -1 )  
}

function crearProducto() {
    const cuerpoModal = document.querySelector('#cuerpoModal');
    //ingresarProducto = cuerpoModal.innerHTML;
    const tituloModal = document.querySelector('#exampleModalLabel');
    const cerrar = document.querySelector('#cerrar');
    //ingresarProductoTitulo = tituloModal.innerHTML;

    //botonCerrarModal = cerrar.outerHTML;
    //cerrar.onclick="cerrarModal()";
    //cerrar.outerHTML = `<button id="cerrar" type="button" class="close" onclick="cerrarModal()" aria-label="Close">`
    tituloModal.innerHTML =
        `<label for="codigoBarras" class="m-0">
        <h5 class="text-primary">
            <strong>
                CREAR PRODUCTO
            </strong>
        </h5>
    </label>
    `;
    let departamentos = @json($departamentos);
    let departamentosOpciones = "";
    for (let i in departamentos) {
        departamentosOpciones = departamentosOpciones +
            `<option value="` + departamentos[i].id + `">` + departamentos[i].nombre + `</option>`
    }

    //
    //<form id="formularioProducto" enctype="multipart/form-data">
    let cuerpo = `
    <form class="needs-validation" novalidate id="formularioProducto" role="form" enctype="multipart/form-data">
    
    <div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="codigoBarras" class="col col-form-label">
                <h6> CODIGO DE BARRAS</h6>
            </label>
            <div class="col">
                <input type="text" name="codigoBarras" id="formCodigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="" required autocomplete="codigoBarras" autofocus>
            </div>
            <div class="invalid-feedback">
                POR FAVOR INGRESE UN CODIGO DE BARRAS
            </div>
        </div>
        <div class="form-group">
            <label for="nombre" class="col col-form-label">
                <h6>NOMBRE</h6>
            </label>
            <div class="col">
                <input type="text" name="nombre" id="formNombre" class="form-control" placeholder="Nombre productos" value="" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <label for="Descripcion" class="col col-form-label">
                <h6>DESCRIPCION</h6>
            </label>
            <div class="col">
                <textarea name="descripcion" id="formDescripcion" class="form-control" placeholder="Descripcion del producto" rows="2" cols="23" required></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="minimoStock" class="col col-form-label">
                <h6>MINIMO STOCK</h6>
            </label>
            <div class="col">
                <input type="number" name="minimoStock" id="minimoStock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="" autofocus required>
            </div>
        </div>
        <div class="form-group">
            <label for="Receta" class="col col-form-label">
                <h6>RECETA MEDICA</h6>
            </label>
            <div class="col">
                <select class="form-control" name="receta" id="formReceta" required>
                    <option value="">Elija una opcion</option>
                    <option value="SI" selected>SI</option>
                    <option value="NO" selected>NO</option>
                </select>
            </div>
        </div>
        
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="Departamento" class="col col-form-label">
                <h6>DEPARTAMENTO</h6>
            </label>
            <div class="col">
                <select class="form-control" name="idDepartamento" id="formDepartamento" required>
                    ` + departamentosOpciones + `
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="Imagen" class="col col-form-label">
                <h5><strong>FOTO</strong></h5>
            </label>
            <div class="col">
                <img id="imagenPrevisualizacion" class="img-fluid img-thumbnail mx-auto d-block">
                <input class="form-control-file" type="file" name="Imagen"
                    onchange="previsualizarImagen('formImagenProducto')" id="formImagenProducto" value="" autofocus>
            </div>
        </div>
        
    </div>
    </div>
    <!--button class="btn btn-outline-secondary" type="submit" id="btnEnviar" >CREAR PRODUCTO</button-->
    </form>
    <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" onclick="nuevoProducto()" id="btnEnviar" >CREAR PRODUCTO</button>
        <button type="button" class="btn btn-primary" onclick="cancelarProducto()">CANCELAR</button>
        <button type="button" class="btn btn-secondary" onclick="cerrarModal()" data-dismiss="modal">Close</button>
        
    </div>
    `;
    //

    cuerpoModal.innerHTML = cuerpo;

}

function previsualizarImagen(id) {
    const seleccionImagen = document.querySelector('#' + id);
    const imagen = document.querySelector('#imagenPrevisualizacion');
    const archivos = seleccionImagen.files;
    if (!archivos || !archivos.length) {
        imagen.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    imagen.src = objectURL;
}

function nuevoProducto() {
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var bol = 0;
    var validation = Array.prototype.filter.call(forms, function(form) {
        //form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            //event.preventDefault();
            //event.stopPropagation();
            //console.log('Entra aqui');
            bol = 1;
            //return false;
        }
        form.classList.add('was-validated');
        //}, false);
    });
    if (bol === 1)
        return false;
    
    const formulario = document.querySelector('#formularioProducto');
    /*const codigoBarras = document.querySelector('#formCodigoBarras');
    const nombre = document.querySelector('#formNombre');
    const descripcion = document.querySelector('#formDescripcion');
    const minimo_stock = document.querySelector('#formMinimoStock');
    const receta = document.querySelector('#formReceta');
    const departamento = document.querySelector('#formDepartamento');
    const img = document.getElementById("formImagenProducto");*/

    let datosProducto = new FormData(formulario);
    datosProducto.append('_token', "{{ csrf_token() }}");
    datosProducto.append('ajax', true);
    //alert(datosProducto);

    (async () => {
        try {
            //console.log(datosProducto);
            var init = {
                // el método de envío de la información será POST
                method: "POST",
                // el cuerpo de la petición es una cadena de texto 
                // con los datos en formato JSON
                body: datosProducto // convertimos el objeto a texto
            };
            //console.log('Aun llega aquí');
            let respuesta = await fetch('/puntoVenta/producto/', init);
            if (respuesta.ok) {
                //return console.log('Todo va bien');
                let resp = await respuesta.json();
                console.log(resp.nombre);
                
                const cuerpoModal = document.querySelector('#cuerpoModal');
                const tituloModal = document.querySelector('#exampleModalLabel');
                cuerpoModal.innerHTML = ingresarProducto;
                tituloModal.innerHTML = ingresarProductoTitulo;
                await cargarProductos(resp.nombre);
                agregarProducto(resp.id);
                $('#exampleModal').modal('hide');
            }

        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    })();

}

function cancelarProducto() {
    const cuerpoModal = document.querySelector('#cuerpoModal');
    const tituloModal = document.querySelector('#exampleModalLabel');
    cuerpoModal.innerHTML = ingresarProducto;
    tituloModal.innerHTML = ingresarProductoTitulo;
    buscarProducto();

}

function cerrarModal() {
    //const cerrar = document.querySelector('#cerrar');
    const cuerpoModal = document.querySelector('#cuerpoModal');
    const tituloModal = document.querySelector('#exampleModalLabel');
    cuerpoModal.innerHTML = ingresarProducto;
    tituloModal.innerHTML = ingresarProductoTitulo;
    const entrada = document.querySelector('#busquedaProducto').value = "";
    //cerrar.outerHTML = botonCerrarModal;
    $('#exampleModal').modal('hide');
}

function verificarCompra() {
    if (productosCompra.length === 0) {
        alert('NO TIENE NINGUN PRODUCTO AGREGADO');
    } else {
        $('#confirmarCompraModal').modal('show');
    }

}

async function guardarCompra() {
    try {
        const proveedor = document.querySelector('#proveedor');
        const fechaCompra = document.querySelector('#fechaCompra');
        //console.log(fechaCompra.value.length);
        //return ;
        if (fechaCompra.value.length == 0) {
            return alert('VERIFIQUE LA FECHA DE COMPRA POR FAVOR');
        }
        
        let json = JSON.stringify(productosCompra);
        let productos0 = [];
        let productos1 = [];
        //console.log('productosCompra',productosCompra);
        //return;
        for (let i in productosCompra) {
            if (productosCompra[i].idSucursal)
                productos1.push((productosCompra[i]));
            else
                productos0.push((productosCompra[i]));
        }
        //productosCompra.push(producto);
        let estado = "pagado";
        let iva = null;
        let btnIva = document.querySelector('input[name="iva"]:checked');
        if (btnIva != null)
            iva = document.querySelector('#inputIva').value;
        //return alert(iva);
        let btn = document.querySelector('input[name="credito"]:checked');
        const pagoCredito = document.querySelector('#pagoCredito');
        if (btn != null) {
            estado = "credito";
            if(pagoCredito.value.length==0)
                return alert('INGRESE UN VALOR VALIDO');
            if(pagoCredito.value>=total)
            return alert('EL ABONO NO PUEDE SER MAYOR O IGUAL AL PAGO DE LA COMPRA');
        }
        
        //if (parseFloat(pagoCredito.value) > 0) {
        
            const contenidoProducto = document.querySelector('#modalConfirmarCompra');
                const contenidoOriginal = contenidoProducto.innerHTML;
                contenidoProducto.innerHTML =
                    `<div class="d-flex justify-content-center my-3">
                <button class="btn btn-info" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    GUARDANDO COMPRA
                </button>
            </div>
            `;
        //console.log('productos0',productos0);
        //console.log('productos1',productos1);
        
        let spp = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: '/puntoVenta/sucursalProducto',
            // los datos que voy a enviar para la relación
            data: {
                datos: JSON.stringify(productos0),
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}",
            }
        });
        console.log(spp);
        let resp = await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: '/puntoVenta/sucursalProducto/editar/productos',
            // los datos que voy a enviar para la relación
            data: {
                datos: JSON.stringify(productos1),
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}",
            }
        });
        console.log(resp);
        await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: '/puntoVenta/compra',
            // los datos que voy a enviar para la relación
            data: {
                estado: estado,
                iva: iva,
                pago: parseFloat(pagoCredito.value),
                datos: json,
                proveedor: proveedor.value,
                fecha_compra: fechaCompra.value,
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}",
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //console.log(respuesta);

            console.log(respuesta); //JSON.stringify(respuesta));

        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('VERIFIQUE LA FECHA DE COMPRA POR FAVOR');
            console.log(jqXHR, textStatus, errorThrown);
        });
        contenidoProducto.innerHTML = contenidoOriginal;
        alert('COMPRA GUARDADA EXITOSAMENTE');
        productosCompra = [];
        mostrarProductos();
        $('#confirmarCompraModal').modal('hide');
        //await cargarProductosSucursal();
        //await cargarProductos();
        

        /*let respuestaCaducidad =  await $.ajax({
            // metodo: puede ser POST, GET, etc
            method: "POST",
            // la URL de donde voy a hacer la petición
            url: '/puntoVenta/productosCaducidad/',
            // los datos que voy a enviar para la relación
            data: {
                datos: json,
                //_token: $("meta[name='csrf-token']").attr("content")
                _token: "{{ csrf_token() }}",
            }
            // si tuvo éxito la petición
        }).done(function(respuesta) {
            //alert('COMPRA GUARDADA EXITOSAMENTE');
            //productosCompra = [];
            //mostrarProductos();
            //$('#confirmarCompraModal').modal('hide');
            console.log(respuesta); //JSON.stringify(respuesta));

        }).fail(function(jqXHR, textStatus, errorThrown) {
            //alert('VERIFIQUE LA FECHA DE COMPRA POR FAVOR');
            console.log(jqXHR, textStatus, errorThrown);
        });
        console.log(respuestaCaducidad);*/
        $('#pagoCredito').val(0.00);
        fechaCompra.value = "yyyy-MM-dd";
        $("#iva").prop('checked', false);
        $("#credito").prop('checked', false);
        activarIva();
        activarCredito();
        actualizarTotal();

    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

$("input[name='cantidad']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });
function setFechaCaducidad(id) {
    let seleccion = $(`#checked${id}`).is(":checked");
    productosCompra.find(p => p.id == id).fechaCaducidad = seleccion;
    //productosCompra[i].
    $(`#caducidad${id}`).prop('disabled', !seleccion);
}
</script>
<script src="{{ asset('js\mayusculas.js') }}"></script>
@endsection