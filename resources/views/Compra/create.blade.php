@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row">
        @section('subtitulo')
        COMPRAS
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
    <div class="row">
        <div class="col-12">
            <!--CONSULTAR PRODUCTO -->
            <div class="row border border-dark m-2 w-100">
                <div class="col-12">
                    <div class="row mx-2 mt-4">
                        <label for="">
                            <h5 class="text-primary">
                                <strong>
                                    INGRESAR PRODUCTOS
                                </strong>
                            </h5>
                        </label>
                    </div>
                    <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
                    <div class="form-inline">
                        <div class="form-group">
                            <label class="col form-check-label  mx-2" for="flexCheckChecked">
                                PROVEEDOR
                            </label>
                            <select class="col form-control mr-3" name="proveedor" id="proveedor" required>
                                <option value="idProveedor">PROVEEDOR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label  mx-2" for="flexCheckChecked">
                                FECHA
                            </label>
                            <input type="date" value="2020-01-09" min="" class="form-control" />
                            <!--select class="form-control" name="idDepartamento" id="idDepartamento" required>
                                <option value="">10/12/2020</option>
                            </select-->
                        </div>
                    </div>
                    <!-- TABLA -->
                    <div class="row mt-1 mb-1 ml-1 mr-1 border border-dark" style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary col-12">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRAS</th>
                                    <th>PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                    <th>COSTO</th>
                                    <th>GANANCIA %</th>
                                    <th>PRECIO</th>
                                    <th>CADUCIDAD</th>
                                </tr>
                            </thead>
                            <tbody id="productos">
                                <tr>
                                    <td></td>
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
                    <div class="row m-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                            onclick="buscarProducto()">
                            AGREGAR PRODUCTO
                        </button>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight m-1 ">
                        <button type="button" onclick="guardarCompra()" class="btn btn-secondary"> GUARDAR COMPRA</button>
                    </div>

                    <!--div class="col mt-1 mb-4 ml-4 mr-2">
                    <input type=" text" class="form-control" placeholder="Ingrese nombre del producto" />
                    <ul class="nav flex-column nav-pills">
                        <li class="btn btn-secondary nav-item m-1" onclick="producto()"><a class="nav-link">COCACOLA</a>
                        </li>
                        <li class="nav-item"><a class="nav-link">SABRITAS</a></li>
                        <li class="nav-item"><a class="nav-link">CHETOS</a></li>
                        <li class="nav-item"><a class="nav-link">PALMOLLIVE</a></li>
                    </ul>
                </div-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                <button id="cerrar" type="button" class="close" onclick="cerrarModal()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModal">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto"
                        id="busquedaProducto" onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
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
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="crearProducto()">NUEVO PRODUCTO</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let productosCompra = [];
let productos = [];

function cargarProveedores()
{
    const proveedor = document.querySelector('#proveedor');
    let proveedores = @json($proveedores);
    let cuerpo = "";
    for(let i in proveedores)
    {
        cuerpo = cuerpo + `<option value="`+proveedores[i].id+`">`+proveedores[i].nombre+`</option>`
    }
    proveedor.innerHTML = cuerpo;
}    
cargarProveedores();
function buscarProductoEnCompra(idProducto)
{
    for(let count2 in productosCompra)
    {
        if(productosCompra[count2].id===idProducto)
        {
            return true;
        }
    }
    return false;
};


function cargarProductos()
{
(async () => {
    try {
        let response = await fetch(`/producto/productos`);
        if (response.ok) {
            productos =  await response.json();
            //console.log(response);
        } else {
            console.log("No responde :'v");
            console.log(response);
            throw new Error(response.statusText);
        }
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
})();
}
cargarProductos();
let ingresarProducto = document.querySelector('#cuerpoModal').innerHTML;
let ingresarProductoTitulo = document.querySelector('#exampleModalLabel').innerHTML;
//let botonCerrarModal = 0;
function buscarProducto() {
    //const cuerpoModal = document.querySelector('#cuerpoModal');
    //ingresarProducto = cuerpoModal.innerHTML;
    //const tituloModal = document.querySelector('#exampleModalLabel');
    //const cerrar = document.querySelector('#cerrar');
    //ingresarProductoTitulo = tituloModal.innerHTML;
    const entrada = document.querySelector('#busquedaProducto');
    let productosEncontrados = document.querySelector('#consultaBusqueda');
    //const productos = @json($productos);
    let contador = 1;
    let cuerpo = "";
    let departamentos = @json($departamentos);
    for (let i in productos) {
        if (productos[i].nombre.toUpperCase().includes(entrada.value.toUpperCase())) {
            let departamento = "No lo busca";
            for(let o in departamentos)
            {
                if(productos[i].idDepartamento === departamentos[o].id)
                    departamento = departamentos[o].nombre;
            }
            cuerpo = cuerpo + `
            <tr onclick="agregarProducto(` + productos[i].id + `)" data-dismiss="modal">
                <td>` + contador++ + `</td>
                <td>` + productos[i].codigoBarras + `</td>
                <td>` + productos[i].nombre + `</td>
                <td>` + productos[i].existencia + `</td>
                <td>` + departamento + `</td>
            </tr>
            `;
        }
    }
    productosEncontrados.innerHTML = cuerpo;
};

function agregarProductoACompra(id, codigoBarras, nombre, cantidad, costo, ganancia, precio, caducidad) {
    let producto = {
        id: id,
        codigoBarras: codigoBarras,
        nombre: nombre,
        cantidad: cantidad,
        costo: parseInt(costo),
        ganancia: ganancia,
        precio: precio,
        caducidad: caducidad,
    };
    console.log(producto)
    productosCompra.push(producto);
}

function mostrarProductos() {
    let cuerpo = "";
    let contador = 1;
    for (let count1 in productosCompra) {
        cuerpo = cuerpo + `
        <tr>
            <th scope="row">` + contador++ + `</th>
            <td>` + productosCompra[count1].codigoBarras + `</td>
            <td>` + productosCompra[count1].nombre + `</td>
            <td><input  value="` + productosCompra[count1].cantidad + `" 
                onchange="cantidad(` + productosCompra[count1].id + `)"  
                id="cantidad` + productosCompra[count1].id + `" min="1" ` +
            ` type="number"/>` + `</td>
            <td><input data-prefix="$"  value="` + productosCompra[count1].costo + `" 
                onchange="costo(` + productosCompra[count1].id + `)"  
                id="costo` + productosCompra[count1].id + `" min="0" ` +
            ` type="number" data-decimals="2"/>`  + `</td>
            <td><input data-prefix="%"  value="` + productosCompra[count1].ganancia + `" 
                onchange="ganancia(` + productosCompra[count1].id + `)"  
                id="ganancia` + productosCompra[count1].id + `" min="0" ` +
            ` type="number"/>`  + `</td>
            <td><input data-prefix="$"  value="` + productosCompra[count1].precio + `" 
                onchange="precio(` + productosCompra[count1].id + `)"  
                id="precio` + productosCompra[count1].id + `" min="0" ` +
            ` type="number" data-decimals="2" />`  + `</td>
            <td><input onchange="caducidad(`+productosCompra[count1].id+`)" type="date" value="` + productosCompra[count1].caducidad + `" min="` +
            productosCompra[count1].caducidad + `" class="form-control" id="caducidad`+productosCompra[count1].id+`" />
            </td>
            <td><button type="button" class="btn btn-secondary" onclick="quitarProducto(`+productosCompra[count1].id+`)"><i class="bi bi-trash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></i></button></td>
        `;
    }
    document.getElementById("productos").innerHTML = cuerpo;
    $("input[type='number']").inputSpinner();
}

function cantidad(id)
{
    const valorProducto = document.querySelector('#cantidad'+id);
    for(let i in productosCompra)
    {
        if(productosCompra[i].id=== id)
        {
            productosCompra[i].cantidad = parseInt(valorProducto.value);
            console.log(productosCompra[i]);
        }
    }
}

function costo(id)
{
    const costoProducto = document.querySelector('#costo'+id);
    for(let i in productosCompra)
    {
        if(productosCompra[i].id=== id)
        {
            productosCompra[i].costo = parseFloat(costoProducto.value);
            console.log(productosCompra[i]);
            let ganancia = ((productosCompra[i].costo*productosCompra[i].ganancia)/100)
            let costo = productosCompra[i].costo;
            productosCompra[i].precio = costo + ganancia;
            console.log(productosCompra[i].precio)
            mostrarProductos();
            //productosCompra[i].costo;
        }
    }
}

function ganancia(id)
{
    const gananciaProducto = document.querySelector('#ganancia'+id);
    for(let i in productosCompra)
    {
        if(productosCompra[i].id=== id)
        {
            productosCompra[i].ganancia = parseInt(gananciaProducto.value);
            console.log(productosCompra[i]);
            let ganancia = ((productosCompra[i].costo*productosCompra[i].ganancia)/100)
            let costo = productosCompra[i].costo;
            productosCompra[i].precio = costo + ganancia;
            console.log(productosCompra[i].precio)
            mostrarProductos();
            //productosCompra[i].costo;
        }
    }
}

function precio(id)
{
    const precioProducto = document.querySelector('#precio'+id);
    for(let i in productosCompra)
    {
        if(productosCompra[i].id=== id)
        {
            productosCompra[i].precio = parseFloat(precioProducto.value);
            console.log(productosCompra[i]);
            let costo = productosCompra[i].costo;
            let precio =productosCompra[i].precio// ((productosCompra[i].costo*productosCompra[i].ganancia)/100)
            
            productosCompra[i].ganancia =parseInt(((precio*100)/costo))-100;
            console.log(productosCompra[i].precio)
            mostrarProductos();
            //productosCompra[i].costo;
        }
    }
}

function caducidad(id)
{
    const caducidadProducto = document.querySelector('#caducidad'+id);
    for(let i in productosCompra)
    {
        if(productosCompra[i].id=== id)
        {
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

function agregarProducto(id) {
    //const productos = @json($productos);

    for (let i in productos) {
        if (productos[i].id === id) {
            if(!buscarProductoEnCompra(id))
            {
            
            //agregarProductoACompra(id,codigoBarras,nombre,cantidad,costo,ganancia,precio,caducidad)
            agregarProductoACompra(productos[i].id, productos[i].codigoBarras, productos[i].nombre,
                1, productos[i].costo, 15, productos[i].precio, fechaActual(),departamento
            );
            }else alert("YA AGREGÓ ESTE PRODUCTO"); 
        }
    }
    const entrada = document.querySelector('#busquedaProducto').value="";
    mostrarProductos();
    console.log(productosCompra);
}

function quitarProducto(id) {

    for(let i in productosCompra)
    {
        if(productosCompra[i].id === id)
        productosCompra.splice( i, 1 );
    }
    mostrarProductos();
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
    let departamentosOpciones =""; 
    for(let i in departamentos)
    {
        departamentosOpciones = departamentosOpciones +
        `<option value="`+departamentos[i].id+`">`+departamentos[i].nombre+`</option>`
    }
    
    //
    //<form id="formularioProducto" enctype="multipart/form-data">
    let cuerpo = `
    <form id="formularioProducto" method="post" action="{{url('producto')}}" enctype="multipart/form-data">
    
    <div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="codigoBarras" class="col col-form-label">
                <h6> CODIGO DE BARRAS</h6>
            </label>
            <div class="col">
                <input type="text" name="codigoBarras" id="formCodigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="" required autocomplete="codigoBarras" autofocus>
            </div>
        </div>
        <div class="form-group">
            <label for="Nombre" class="col col-form-label">
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
                <textarea name="descripcion" id="formDescripcion" class="form-control" placeholder="Descripcion del producto" rows="2" cols="23" required>
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="MinimoStock" class="col col-form-label">
                <h6>MINIMO STOCK</h6>
            </label>
            <div class="col">
                <input type="number" name="minimo_stock" id="formMinimoStock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="" autofocus required>
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
                    `+departamentosOpciones+`
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
                    onchange="previsualizarImagen('formImagenProducto')" id="formImagenProducto" value="" autofocus required>
            </div>
        </div>
        
    </div>
    </div>
    <!--button class="btn btn-outline-secondary" type="button" onclick="nuevoProducto()" id="btnEnviar" data-dismiss="modal">CREAR PRODUCTO</button-->
    </form>
    <div class="modal-footer">
        <button class="btn btn-outline-secondary" type="button" onclick="nuevoProducto()" id="btnEnviar" data-dismiss="modal">CREAR PRODUCTO</button>
        <button type="button" class="btn btn-primary" onclick="cancelarProducto()">CANCELAR</button>
        <button type="button" class="btn btn-secondary" onclick="cerrarModal()" data-dismiss="modal">Close</button>
        
    </div>
    `;
    //
    
    cuerpoModal.innerHTML = cuerpo;
}

function previsualizarImagen(id)
{
    const seleccionImagen = document.querySelector('#'+id);
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

function nuevoProducto()
{
    const formulario = document.querySelector('#formularioProducto');
    const codigoBarras = document.querySelector('#formCodigoBarras');
    const nombre = document.querySelector('#formNombre');
    const descripcion = document.querySelector('#formDescripcion');
    const minimo_stock = document.querySelector('#formMinimoStock');
    const receta = document.querySelector('#formReceta');
    const departamento = document.querySelector('#formDepartamento');
    const img = document.getElementById("formImagenProducto");
    
    let datosProducto = new FormData(formulario);
    datosProducto.append('_token', "{{ csrf_token() }}");
    //alert(datosProducto);
     $.ajax({
      // metodo: puede ser POST, GET, etc
      method: "POST",
      // la URL de donde voy a hacer la petición
      url: '/producto',
      // los datos que voy a enviar para la relación
      data: datosProducto,
      processData: false,  // tell jQuery not to process the data
      contentType: false//productoNuevo,
      // si tuvo éxito la petición
    }).done(function(data)
    {
        (async () => {
    try {
        cargarProductos();
        const cuerpoModal = document.querySelector('#cuerpoModal');
        const tituloModal = document.querySelector('#exampleModalLabel');
        cuerpoModal.innerHTML = ingresarProducto;
        tituloModal.innerHTML = ingresarProductoTitulo;
        buscarProducto();
        agregarProducto(productos[productos.length - 1].id);
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
})();
        
        //console.log(respuesta);//JSON.stringify(respuesta));
    });
    

}

function cancelarProducto()
{
    const cuerpoModal = document.querySelector('#cuerpoModal');
    const tituloModal = document.querySelector('#exampleModalLabel');
    cuerpoModal.innerHTML = ingresarProducto;
    tituloModal.innerHTML = ingresarProductoTitulo;
    buscarProducto();
    
}
function cerrarModal()
{
    //const cerrar = document.querySelector('#cerrar');
    const cuerpoModal = document.querySelector('#cuerpoModal');
    const tituloModal = document.querySelector('#exampleModalLabel');
    cuerpoModal.innerHTML = ingresarProducto;
    tituloModal.innerHTML = ingresarProductoTitulo;
    const entrada = document.querySelector('#busquedaProducto').value="";
    //cerrar.outerHTML = botonCerrarModal;
    $('#exampleModal').modal('hide');
}
function guardarCompra()
{
    const proveedor = document.querySelector('#proveedor');
    let json = JSON.stringify(productosCompra)
     $.ajax({
      // metodo: puede ser POST, GET, etc
      method: "POST",
      // la URL de donde voy a hacer la petición
      url: '/compra',
      // los datos que voy a enviar para la relación
      data: {
        datos: json,
        proveedor:proveedor.value,
        //_token: $("meta[name='csrf-token']").attr("content")
        _token: "{{ csrf_token() }}"
      }
      // si tuvo éxito la petición
    }).done(function(respuesta)
    {
        alert(respuesta);
        console.log(respuesta);//JSON.stringify(respuesta));
    }).fail( function( jqXHR, textStatus, errorThrown ) {
    alert( 'Error!!' );
    console.log(jqXHR, textStatus, errorThrown);
});
}

</script>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
@endsection