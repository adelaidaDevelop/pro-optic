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
                            <select class="col form-control mr-3" name="idDepartamento" id="idDepartamento" required>
                                <option value="">PROVEEDOR</option>
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
                                    <!--tr>
                                        <td colspan="10">
                                            <input class="form-control" id="buscarProducto"
                                                onkeyup="buscarProducto()" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="date" value="2021-01-09" min="2021-01-09" max="2022-01-10" class="form-control" />
                                        </td>
                                    </tr-->
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
                        <button type="button" class="btn btn-secondary"> GUARDAR COMPRA</button>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="crearProducto()">NUEVO PRODUCTO</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let productosCompra = [];

function buscarProducto() {
    const entrada = document.querySelector('#busquedaProducto');
    let productosEncontrados = document.querySelector('#consultaBusqueda');
    const productos = @json($productos);
    let contador = 1;
    let cuerpo = "";
    for (let i in productos) {
        if (productos[i].nombre.toUpperCase().includes(entrada.value.toUpperCase())) {
            cuerpo = cuerpo + `
            <tr onclick="agregarProducto(` + productos[i].id + `)" data-dismiss="modal">
                <td>` + contador++ + `</td>
                <td>` + productos[i].codigoBarras + `</td>
                <td>` + productos[i].nombre + `</td>
                <td>` + productos[i].existencia + `</td>
                <td>` + productos[i].id + `</td>
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
        costo: costo,
        ganancia: ganancia,
        precio: precio,
        caducidad: caducidad
    };
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
                id="valor` + productosCompra[count1].id + `" min="1" ` +
            `" type="number"/>` + `</td>
            <td>` + productosCompra[count1].costo + `</td>
            <td>` + productosCompra[count1].ganancia + `</td>
            <td>` + productosCompra[count1].precio + `</td>
            <td><input type="date" value="` + productosCompra[count1].caducidad + `" min="` +
            productosCompra[count1].caducidad + `" class="form-control" />
            </td>
            <td><button type="button" class="btn btn-secondary" onclick="quitarProducto()">QUITAR</button></td>
        `;
    }
    document.getElementById("productos").innerHTML = cuerpo;
    $("input[type='number']").inputSpinner();
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
    const productos = @json($productos);

    for (let i in productos) {
        if (productos[i].id === id) {
            //agregarProductoACompra(id,codigoBarras,nombre,cantidad,costo,ganancia,precio,caducidad)
            agregarProductoACompra(productos[i].id, productos[i].codigoBarras, productos[i].nombre,
                1, productos[i].costo, 15, productos[i].precio, fechaActual()
            );

        }
    }
    mostrarProductos();
    console.log(productosCompra);
}

function quitarProducto() {
    alert('Ya se va a quitar, no te preocupes');
}
let ingresarProducto = 0;
function crearProducto() {
    const cuerpoModal = document.querySelector('#cuerpoModal');
    ingresarProducto = cuerpoModal.innerHTML;
    const tituloModal = document.querySelector('#exampleModalLabel');
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
    <button class="btn btn-outline-secondary" type="button" onclick="nuevoProducto()" id="btnEnviar">CREAR PRODUCTO</button>
    </form>
    `;
    //
    
    cuerpoModal.innerHTML = cuerpo;
    /*fetch(`/producto/create`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("cuerpoModal").innerHTML = html;
            //console.log(html);
        })*/
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
    //const archivos = img.files;
    //const objectURL = URL.createObjectURL(archiv);
    //const img = document.querySelector('#imagenPrevisualizacion');
    //const imagen = new FormData(document.getElementById("formImagenProducto"));//document.querySelector('#formImagenProducto');
    //imagen.append('Imagen',archivos[0])
    /*const productoNuevo = { codigoBarras:codigoBarras.value,nombre:nombre.value,
    descripcion: descripcion.value,minimo_stock:minimo_stock.value,receta:receta.value,
    departamento: departamento.value,imagen:imagen.value };*/
    /*const productoNuevo ='_token='+"{{ csrf_token() }}"+'&codigoBarras='+codigoBarras.value+'&nombre='+nombre.value+
    '&descripcion='+descripcion.value+'&minimo_stock='+minimo_stock.value+'&receta='+receta.value+
    '&idDepartamento='+departamento.value+'&Imagen='+img;
    console.log(productoNuevo);*/
    //let json = JSON.stringify(productosVenta)
    let datosProducto = new FormData(formulario);
    datosProducto.append('_token', "{{ csrf_token() }}");
    alert(datosProducto);
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
    }).done(function(respuesta)
    {
        const cuerpoModal = document.querySelector('#cuerpoModal');
        cuerpoModal.innerHTML = ingresarProducto;
        buscarProducto();
        //console.log(respuesta);//JSON.stringify(respuesta));
    });
    

}

</script>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
@endsection