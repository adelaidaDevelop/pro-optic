@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
<div class="col-0 my-2 p-1">
    <form method="get" action="{{url('/puntoVenta/departamento/')}}">
        <button class="btn btn-secondary ml-4 p-1" type="submit">
            <img src="{{ asset('img\departamento.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            DEPARTAMENTOS
        </button>
    </form>
</div>
<!--BOTON CREAR EMPLEADO-->
<div class="col-0 my-2 ml-3 p-1 ">
    <a class="btn btn-secondary p-1" href="{{ url('/puntoVenta/producto/create')}}">
        <img src="{{ asset('img\agregar2.png') }}" alt="Editar" width="25px" height="25px">
        NUEVO PRODUCTO </a>
    </a>
</div>
<div class="col-0 my-2 ml-3 p-1 ">
    <a class="btn btn-secondary p-1" href="{{ url('/puntoVenta/producto/stock')}}">
        <img src="{{ asset('img\agregar_stock.png') }}" class="img-thumbnail" alt="Editar" width="28px" height="28px">
        AGREGAR DE STOCK </a>
    </a>
</div>


<div class="col-2 my-2 ml-3 p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal" href=".modal_altaProductos_SucursalLogeado" id="altaProd" onclick=" return productosEnBajaSucursal()" value="">
        <img src="{{ asset('img\dar_alta.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        ALTA PRODUCTOS
    </button>
</div>
<!-- COMENTADO TEMPORAL
<div class="col-1 my-2  p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal"  href="{{ url('/producto/create')}}" id="altaProd"  value="">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        OFERTAS
    </button>
</div>




<div class="col- my-2 ml-3 p-1 ">
    <a class="btn btn-secondary" href="{{ url('/producto/create')}}">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        PROXIMOS A CADUCAR </a>
    </a>
</div>
-->


@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-2 mb-2 ">
            <h5 class="text-primary">
                <strong>
                    CONSULTAR PRODUCTO
                </strong>
            </h5>
        </div>
        <div class="row col-12">
            <div class="col-2 border border-primary  mb-4 ml-4 mr-5">
                <h6 class="text-primary mt-4">
                    FILTRAR POR:
                </h6>
                <select class="mt-1" name="idDepartamento" id="idDepartamento" onchange="buscarFiltroNombre2()" required>
                    <option value="">DEPARTAMENTO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                <div class=" input-group-text mt-4 px-0 py-auto ">
                    <input class="" type="checkbox" value="existencia" name="bajosExistencia" id="bajosExistencia" onchange="buscarFiltroNombre2()">
                    <h6 class="text-primary ml-1 my-auto ">
                        BAJOS DE EXISTENCIA
                    </h6>
                </div>
            </div>
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-8   mb-4 ml-4 mr-2">
                <div class="form-group w-100">
                    <div class="row my-0">
                        <input class="form-control text-uppercase  col-4 mr-3 " type="text" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarFiltroNombre2()">
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                        <div class="mt-2 mx-2"> </div>
                        <h6 class="mx-3 mt-2"> BUSCAR POR:</h6>
                        <div class=" input-group-text my-auto">
                            <input type="radio" value="folio" name="checkbox2" onchange="buscarFiltroNombre2()" id="codigoBusq">
                            <label class="ml-1 my-0" for="codigoBusq">
                                CODIGO
                            </label>
                        </div>
                        <div class=" input-group-text  ml-1 my-auto ">
                            <input type="radio" value="nombre" name="checkbox2" onchange="buscarFiltroNombre2()" id="nombreBusq" checked>
                            <label class="ml-1 my-0" for="nombreBusq">
                                NOMBRE
                            </label>
                        </div>

                    </div>
                </div>

                <!-- TABLA -->
                <div class="row" style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 " id="productos">
                        <thead class="table-secondary text-primary">

                            <tr>
                                <th>#</th>
                                <th>CODIGO BARRAS</th>
                                <th>NOMBRE</th>
                                <th>EXISTENCIA</th>
                                <th>DEPARTAMENTO</th>
                                <th>COSTO</th>
                                <th>PRECIO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda" class="text-uppercase ">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- MODAL-->

<!-- MODAL-->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1" style="color:#FFFFFF">
                            INFORMACION DEL PRODUCTO
                        </h6>
                    </div>
                    <div class="row" style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2 ml-4 px-1" style="color:#FFFFFF">
                            PRODUCTO
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <div class="row  " id="resultados">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL-->
<!--MODAL PARA CARGAR PRODUCTOS DADOS DE BAJA EN SUCURSAL LOGEADO-->
<div class="modal fade modal_altaProductos_SucursalLogeado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;height:500px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid ">
                    <div class="row" style="background:#3366FF">
                        <br />
                    </div>
                    <div class="row " style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2  px-1 mx-auto " style="color:#FFFFFF">
                            PRODUCTOS DADOS DE BAJA EN ESTA SUCURSAL
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <!-- TABLA -->
                <div id="vacio" class="text-center my-auto">
                    <div class="row w-100 " style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary ml-5  ">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRA</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>RECETA</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="filaTablas">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>

<!--POP UP-->

<!-- SCRIPT-->
<script>
    const productos = @json($datosP);
    const d = @json($depa);

    let opcFolioNombre = "";
    let opcBajosE = "";
    let productosSucursal = @json($productosSucursal);
    let productosList = [];
    let depaBandera = true;
    let bajosExisBandera = true;
    let folioNombreBandera = true;
    //  let nombreBandera = true;

    let prod_baja = "";

    // nombreOpc();
    buscarFiltroNombre2();

    /*
     function folioNombreOpc() {

         filtroProducto();
     }

     function deptoOpc() {
         // folioNombreBandera = false;
         depaBandera = true;
         // bajosExisBandera = false;
         // nombreBandera = false; //checar
         filtroProducto();
     }

     function bajosExisOpc() {
         //  folioNombreBandera = false;
         //   depaBandera = false;
         bajosExisBandera = true;
         //   nombreBandera = false; //checar
         filtroProducto();
     }

     function nombreOpc() {
         //  folioNombreBandera = false;
         //  depaBandera = false;
         //  bajosExisBandera = false;
         // nombreBandera = true; //checar

         buscarFiltroNombre();
     }

     */
    function buscarFiltroNombre2() {
        productosList = [];
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        for (let x in productosSucursal) {
            for (count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {
                    //BUSCAR POR FOLIO NOMBRE 
                    let seleccion = document.querySelector("input[name='checkbox2']:checked");
                    let opcFolioNombre = seleccion.value;
                    folioNombreBandera = true;
                    if (opcFolioNombre === 'nombre') {
                        $("#idDepartamento").prop('disabled', false);
                        $("#bajosExistencia").prop('disabled', false);

                        //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRES
                        if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            //BUSCAR POR DEPARTAMENTO
                            //     if (depaBandera == true) { // SI LA OPCION DEPARTAMENTO SE HABILITO 
                            let depa = document.querySelector('#idDepartamento');
                            if (depa.value != "") {
                                if (productos[count5].idDepartamento === parseInt(depa.value)) {
                                    //Cargar datos encontrados filtrado depto, nombre
                                    //BUSCAR PRODUCTOS BAJOS DE EXISTENCIA
                                    let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                                    if (seleccion != null) {
                                        opcBajosE = seleccion.value; //VARIABLE opcBajosE?
                                        if (opcBajosE === 'existencia') {
                                            console.log("si entra");
                                            if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                                //PRODUCTOS POR NOMBRE, DEPTO Y BAJOS EXISTENCIA
                                                let departamento = "";
                                                for (count21 in d) {
                                                    if (productos[count5].idDepartamento === d[count21].id) {
                                                        departamento = d[count21].nombre;
                                                    }
                                                }
                                                let id = productos[count5].id;
                                                let productosAdd = {
                                                    id: id,
                                                    codigoBarras: productos[count5].codigoBarras,
                                                    nombre: productos[count5].nombre,
                                                    existencia: productosSucursal[x].existencia,
                                                    idDepartamento: productos[count5].idDepartamento
                                                };
                                                productosList.push(productosAdd);


                                            }
                                        }
                                    } else {
                                        //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE, DEPTO
                                        // buscarFiltroNombre();
                                        let departamento = "";
                                        for (count21 in d) {
                                            if (productos[count5].idDepartamento === d[count21].id) {
                                                departamento = d[count21].nombre;
                                            }
                                        }
                                        let id = productos[count5].id;
                                        let productosAdd = {
                                            id: id,
                                            codigoBarras: productos[count5].codigoBarras,
                                            nombre: productos[count5].nombre,
                                            existencia: productosSucursal[x].existencia,
                                            idDepartamento: productos[count5].idDepartamento
                                        };
                                        productosList.push(productosAdd);


                                    }
                                }
                            } else {
                                //VERIFICAR BAJOS EXISTENCIA 
                                //BUSCAR PRODUCTOS POR NOMBRE, BAJOS DE EXISTENCIA
                                let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                                if (seleccion != null) {
                                    opcBajosE = seleccion.value; //VARIABLE opcBajosE?
                                    if (opcBajosE === 'existencia') {
                                        console.log("si entra");
                                        if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                            //PRODUCTOS POR NOMBRE Y BAJOS EXISTENCIA
                                            let departamento = "";
                                            for (count21 in d) {
                                                if (productos[count5].idDepartamento === d[count21].id) {
                                                    departamento = d[count21].nombre;
                                                }
                                            }
                                            let id = productos[count5].id;
                                            let productosAdd = {
                                                id: id,
                                                codigoBarras: productos[count5].codigoBarras,
                                                nombre: productos[count5].nombre,
                                                existencia: productosSucursal[x].existencia,
                                                idDepartamento: productos[count5].idDepartamento
                                            };
                                            productosList.push(productosAdd);
                                        }
                                    }
                                } else {
                                    //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE
                                    let departamento = "";
                                    for (count21 in d) {
                                        if (productos[count5].idDepartamento === d[count21].id) {
                                            departamento = d[count21].nombre;
                                        }
                                    }
                                    let id = productos[count5].id;
                                    let productosAdd = {
                                        id: id,
                                        codigoBarras: productos[count5].codigoBarras,
                                        nombre: productos[count5].nombre,
                                        existencia: productosSucursal[x].existencia,
                                        idDepartamento: productos[count5].idDepartamento
                                    };
                                    productosList.push(productosAdd);
                                }
                            }
                            //  }
                        } else {
                            // MENSAJE PRODUCTOS NO ENCONTRADOS
                        }


                    } else if (opcFolioNombre === 'folio') {
                        $("#idDepartamento").prop('disabled', true);
                        $("#bajosExistencia").prop('disabled', true);


                        if (productos[count5].codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            let departamento = "";
                            for (count21 in d) {
                                if (productos[count5].idDepartamento === d[count21].id) {
                                    departamento = d[count21].nombre;
                                }
                            }
                            let id = productos[count5].id;
                            let productosAdd = {
                                id: id,
                                codigoBarras: productos[count5].codigoBarras,
                                nombre: productos[count5].nombre,
                                existencia: productosSucursal[x].existencia,
                                idDepartamento: productos[count5].idDepartamento
                            };
                            productosList.push(productosAdd);
                        }
                    }


                }
            }
        }
        rellenar();
    };
    /*

    function filtroProducto() {
        productosList = [];
        const palabraBusqueda = document.querySelector('#busquedaProducto');

        //BUSCAR POR DEPARTAMENTO
        if (depaBandera == true) {
            for (let x in productosSucursal) {
                for (count5 in productos) {
                    if (productos[count5].id === productosSucursal[x].idProducto) {

                        let depa = document.querySelector('#idDepartamento');
                        // if (depa.value != "0") {
                        if (depa.value != "") {
                            if (productos[count5].idDepartamento === parseInt(depa.value)) {

                                let departamento = "";
                                for (count21 in d) {
                                    if (productos[count5].idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = productos[count5].id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: productos[count5].codigoBarras,
                                    nombre: productos[count5].nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: productos[count5].idDepartamento
                                };

                                productosList.push(productosAdd);

                            }
                        } else {
                            buscarFiltroNombre();
                        }
                    }
                }
            }

            rellenar();

        } else if (folioNombreBandera == true) {
            for (let x in productosSucursal) {
                for (count5 in productos) {
                    if (productos[count5].id === productosSucursal[x].idProducto) {

                        //BUSCAR POR FOLIO NOMBRE 
                        let seleccion = document.querySelector("input[name='checkbox2']:checked");
                        let opcFolioNombre = seleccion.value;
                        folioNombreBandera = true;
                        if (opcFolioNombre === 'nombre') {
                            //BUSCAR PRODUCTOS SUCURSAL TODOS SIN FILTRO
                            buscarFiltroNombre();
                        } else if (opcFolioNombre === 'folio') {
                            if (productos[count5].codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                                let departamento = "";
                                for (count21 in d) {
                                    if (productos[count5].idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = productos[count5].id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: productos[count5].codigoBarras,
                                    nombre: productos[count5].nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: productos[count5].idDepartamento
                                };
                                productosList.push(productosAdd);
                            }
                        }
                    }
                }
            }
            rellenar();

        } else if (bajosExisBandera == true) {
            for (let x in productosSucursal) {
                for (count5 in productos) {
                    if (productos[count5].id === productosSucursal[x].idProducto) {

                        //BUSCAR BAJOS EXISTENCIA
                        let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                        if (seleccion != null) {
                            opcBajosE = seleccion.value;
                            if (opcBajosE === 'existencia') {
                                console.log("si entra");
                                if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                    // if (productos[count20].idDepartamento.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                                    let departamento = "";
                                    for (count21 in d) {
                                        if (productos[count5].idDepartamento === d[count21].id) {
                                            departamento = d[count21].nombre;
                                        }
                                    }
                                    let id = productos[count5].id;
                                    let productosAdd = {
                                        id: id,
                                        codigoBarras: productos[count5].codigoBarras,
                                        nombre: productos[count5].nombre,
                                        existencia: productosSucursal[x].existencia,
                                        idDepartamento: productos[count5].idDepartamento
                                    };
                                    productosList.push(productosAdd);
                                }
                            }
                        } else {
                            //BUSCAR PRODUCTOS SUCURSAL TODOS SIN FILTRO
                            buscarFiltroNombre();

                        }
                    }
                }
            }
            rellenar();
        } else {
            buscarFiltroNombre();
        }
    };
    */

    function rellenar() {
        let cuerpo = "";
        let contador = 0;
        let departamento = "";
        for (let t in productosList) {
            console.log("prod list");
            for (let z in productosSucursal) {
                if (productosList[t].id === productosSucursal[z].idProducto) {
                    if (productosSucursal[z].status === 1) {
                        for (count8 in d) {
                            if (productosList[t].idDepartamento === d[count8].id) {
                                departamento = d[count8].nombre;
                            }
                        }
                        cuerpo = cuerpo + `
                            <tr onclick="" data-dismiss="modal">
                                <th scope="row">` + contador + `</th>
                                <td>` + productosList[t].codigoBarras + `</td>
                                <td>` + productosList[t].nombre + `</td>
                                <td>` + productosList[t].existencia + `</td>
                                <td>` + departamento + `</td>
                                <td>` + productosSucursal[z].costo + `</td>
                                <td>` + productosSucursal[z].precio + `</td>
                                <td>` +
                            ` <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + productosList[t].id + `)" value="` + productosList[t].id + `">
                                VER MAS
                                </button>
                                </td>            
                            </tr>
                            `;
                    }
                }
            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    };

    function info4(id) {
        //Modal
        //let x1= 0;
        let datosProduct = "";
        let imagen = "";
        let departamento = "";
        let ms = 0;
        for (let j in productosSucursal) {
            for (count10 in productos) {
                if (productos[count10].id === productosSucursal[j].idProducto) {
                    if (productos[count10].id === id) {
                        for (count11 in d) {
                            if (productos[count10].idDepartamento === d[count11].id) {
                                departamento = d[count11].nombre;
                            }
                        }
                        x1 = productos[count10].id;
                        x = productos[count10].id;
                        console.log(x);
                        ms = productosSucursal[j].minimoStock;
                        datosProduct =
                            `
                                    <div class="col-3">
                                            <br/>
                                            <label for="codigoBarras">
                                                <h6 class="ml-4"> {{'CODIGO DE BARRAS'}}</h6>
                                            </label>
                                        <br/>
                                            <label for="Nombre">
                                                <h6  class="ml-4 mt-4">{{'NOMBRE'}}</h6>
                                            </label>
                                            <br /><br/>
                                            <label for="Descripcion">
                                                <h6  class="ml-4"> {{'DESCRIPCION'}} </h6>
                                            </label>
                                            <br /><br /> <br/> <br/>
                                            <label for="MinimoStock">
                                                <h6  class="ml-4"> {{'MINIMO STOCK'}}</h6>
                                            </label>
                                            <br /> <br/>
                                            <label for="Receta">
                                                <h6  class="ml-4"> {{'RECETA MEDICA'}} </h6>
                                            </label>
                                            <br /><br />
                                            <label for="idDepartamento">
                                                <h6  class="ml-4"> {{'DEPARTAMENTO'}}</h6>
                                            </label>
                                            <br />
                                        </div>
                                        <div class="col-5">
                                            <br />
                                            <!--El name debe ser igual al de la base de datos-->
                                            <input type="text" name="codigoBarras" id="codigoBarras" class="form-control text-uppercase " placeholder="Ingresar codigo de barras" value="` + productos[count10].codigoBarras + `" required autocomplete="codigoBarras" autofocus disabled>
                                            <br />
                                            <input type="text" name="nombre" id="nombre" class="form-control text-uppercase" placeholder="Nombre productos" value="` + productos[count10].nombre + ` " autofocus required disabled>
                                            <br />
                                            <textarea name="descripcion" id="descripcion" class="form-control text-uppercase" placeholder="Descripcion del producto" rows="3" cols="23" required disabled>` + productos[count10].descripcion + `</textarea>
                                            <br />
                                            <input type="number" name="minimoStock" id="minimoStock" class="form-control text-uppercase" placeholder="Ingrese el minimo de productos permitidos" value="` + ms + `" autofocus required disabled>
                                            <br />
                                            <select class="form-control text-uppercase" name="Receta" id="Receta"  disabled>
                                                <option value="" selected>` + productos[count10].receta + ` </option>
                                            </select>
                                            <br />
                                            <select class="form-control text-uppercase" name="Depa" id="Depa"  disabled>
                                                <option value="" selected>` + departamento + ` </option>
                                            </select>
                                        </div>
                                        <div class="col-4 text-center">
                                            <br /><br />
                                            <label for="Imagen">
                                                <h5> <strong>{{'FOTO'}}</strong></h5>
                                            </label required>
                                            <br />
                                            <img src="{{ asset('storage')}}/` + productos[count10].imagen + ` " alt="" width="200">
                                            
                                            <br /><br />
                                            <a class="btn btn-primary" href="{{ url('/puntoVenta/producto/` + x + `/edit')}}"> EDITAR PRODUCTO </a>
                                            <br/><br/>
                                            
                                            <a class="btn btn-danger mb-4" data-method="delete" onclick="return confirm('¿Estas seguro de que deseas eliminar?')"  href="{{ url('/puntoVenta/productoEli3/` + x + `', [` + x + `])}}"> 
                                             DAR DE BAJA </a> 
                                             <a class="btn btn-primary mt-4"   href="#" onclick="subproductoExiste(` + x + `);return false;">
                                             CREAR SUBPRODUCTO </a> 
                                             
                                              
                                        </div>

                                        <br/>
                                    `;
                    }
                }
            }
        }
        document.getElementById("resultados").innerHTML = datosProduct;
    };

    function refrescar() {
        console.log("refrescar");
        location.reload();
    };

    async function subproductoExiste(id) {
        let response = "Sin respuesta";
        let response2 = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/veriUniqueSubproducto/?id=${id}`);

            if (response.ok) {
                Suc_Inac = await response.json();
                // let idProd =Suc_Inac['idProd'];
                let productosNue = Suc_Inac['producto'];
                let producto_sucursal = Suc_Inac['productosSucursal']; //retornar 1 dato
                let subproductos = Suc_Inac['subproducto'];
                let bandera = true;
                for (let y in producto_sucursal) {

                    for (let x in subproductos) {
                        if (subproductos[x].idSucursalProducto == producto_sucursal[y].id) {
                            bandera = false;
                            return alert("Este producto ya está activo en subproducto y no se puede volver a agregar");
                        }

                    }



                }

                if (bandera) {
                    redirect(id);
                   // response2 = await fetch(`/puntoVenta/subproducto/create/?id=${id}`);
                }
                console.log(Suc_Inac);
            } else {
                // Suc_Inac = "";
                console.log("No responde :'v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };

    function redirect(id) {
        window.location = `/puntoVenta/subproducto/create/?id=${id}`;
    }

    //
    async function productosEnBajaSucursal() {
        let cuerpo = "";
        let cont = 0;
        await productos0();

        console.log(prod_baja);
        for (let t in prod_baja) {
            for (let x in productos) {
                if (productos[x].id === prod_baja[t].idProducto) {
                    cont = cont + 1;
                    cuerpo = cuerpo + `
                    <tr>
                    <th >` + cont + `</th>
                    <td>` + productos[x].codigoBarras + `</td>
                    <td>` + productos[x].nombre + `</td>
                    <td>` + productos[x].descripcion + `</td>
                    <td>` + productos[x].idDepartamento + `</td>
                    <td>` + productos[x].receta + `</td>
                    <td>` +
                        ` 
                    <a class="btn btn-primary" href="{{ url('/puntoVenta/altaProducto/` + productos[x].id + `')}}"> ALTA </a>
                    </td>        
                    </tr>
                     `;
                }
            }
        }
        if (cuerpo === "") {
            let sin = ` <h3 class= "text-danger my-auto"> NO HAY PRODUCTOS DADOS DE BAJA EN ESTA SUCURSAL </h3>`;
            document.getElementById("vacio").innerHTML = sin;
        } else {
            document.getElementById("filaTablas").innerHTML = cuerpo;
        }
    };
    //reucperar sucursales inactivas
    async function productos0() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/productos_baja`);
            if (response.ok) {
                prod_baja = await response.json();
            } else {
                console.log("No responde :v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };
</script>

@endsection