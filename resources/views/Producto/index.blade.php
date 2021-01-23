@extends('header2')

@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
<div class="col-0 my-2 ml-5 px-1">
    <form method="get" action="{{url('/departamento/')}}">
        <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            DEPARTAMENTOS
        </button>
    </form>
</div>
<!--BOTON CREAR EMPLEADO-->
<div class="col-0 my-2 ml-5 px-1 ">
    <a class="btn btn-primary" href="{{ url('/producto/create')}}">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        NUEVO PRODUCTO </a>
    </a>
</div>
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-2 mb-4">
            <h4 class="text-primary">
                <strong>
                    CONSULTAR PRODUCTO
                </strong>
            </h4>

        </div>
        <div class="row col-12">
            <div class="col-2 border border-primary mt-2 mb-4 ml-4 mr-2">

                <br />
                <select name="idDepartamento" id="idDepartamento" onchange="buscarPorDepas()" required>
                    <option value="0">DEPARTAMENTO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                <br /> <br />
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-primary" for="flexCheckChecked">
                        PROXIMOS A CADUCAR
                    </label>
                    <br />
                </div>
                <!--
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    BAJOS DE EXISTENCIA
                </label>
            </div>
            -->

            </div>

            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group w-100">
                    <div class="row my-2">
                        <input class="form-control  mt-1 col-4 mr-3 " type="text" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarFolioNombre()">

                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                        <div class="mt-2 mx-2"> </div>
                        <h6 class="mx-3 mt-2"> BUSCAR POR:</h6>
                        <div class=" form-check mt-2">
                            <input class="form-check-input" type="radio" value="folio" name="checkbox2" onchange="buscarFolioNombre()" id="codigoBusq">
                            <label class="form-check-label" for="flexRadioDefault1">
                                CODIGO
                            </label>
                        </div>
                        <div class="mx-4 form-check mt-2">
                            <input class="form-check-input" type="radio" value="nombre" name="checkbox2" onchange="buscarFolioNombre()" id="nombreBusq" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
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
                        <tbody id="consultaBusqueda">

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
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="width:500px;" id="">
                <!--BODY MODAL-->
                <!-- <h6> BUSCAR PRODUCTO POR CODIGO O NOMBRE</h6>-->
                <label for="codigoBarras">
                    <h5 class="text-primary">
                        <strong>
                            PRODUCTO
                        </strong>
                    </h5>
                </label>
                <div class="col-6 input-group">
                    <!--BUSCADOR-->
                    <!--
                    <input type="text" class="form-control border-primary" size="15" placeholder="BUSCAR PRODUCTO" id="texto">
                       
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto" id="buscador" onkeyup="buscarProducto()">
 -->
                </div>
                <!--INFORMACION PRODUCTOS-->
                <div class="row" id="resultados">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- END MODAL-->

<!--POP UP-->

<!-- SCRIPT-->
<script>
    let productosVenta = [];
    const productos = @json($datosP);
    const d = @json($depa);
    let opcFolioNombre = "";

    function buscarProducto() {

        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        let contador = 1;
        for (count5 in productos) {
            if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                let departamento = "";
                for (count8 in d) {
                    if (productos[count5].idDepartamento === d[count8].id) {
                        departamento = d[count8].nombre;
                    }
                }
                let id = productos[count5].id;
                cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count5].id + `</th>
            <td>` + productos[count5].codigoBarras + `</td>
            <td>` + productos[count5].nombre + `</td>
            <td>` + productos[count5].existencia + `</td>
           <td>` + departamento + `</td>

           <td>` + `0` + `</td>
            <td>` + `0` + `</td>
            <td>` +
                    ` <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + id + `)" value="` + id + `">
               VER MAS
              </button>
            </td>            
        </tr>
        `;
            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;

    };


    function info4(id) {
        //Modal
        let datosProduct = "";
        let imagen = "";
        let departamento = "";
        for (count10 in productos) {
            if (productos[count10].id === id) {

                for (count11 in d) {
                    if (productos[count10].idDepartamento === d[count11].id) {
                        departamento = d[count11].nombre;
                    }
                }

                x = productos[count10].id;

                datosProduct =
                    `
                <div class="col-md-4">
                        <br/>
                        <label for="codigoBarras">
                            <h6> {{'CODIGO DE BARRAS'}}</h6>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h6>{{'NOMBRE'}}</h6>
                        </label>
                        <br /><br/><br/>
                        <label for="Descripcion">
                            <h6> {{'DESCRIPCION'}} </h6>
                        </label>
                        <br /><br /> <br/> <br/>
                        <label for="MinimoStock">
                            <h6> {{'MINIMO STOCK'}}</h6>
                        </label>
                        <br /> <br/>
                        <label for="Receta">
                            <h6> {{'RECETA MEDICA'}} </h6>
                        </label>
                        <br /><br />
                        <label for="idDepartamento">
                            <h6> {{'DEPARTAMENTO'}}</h6>
                        </label>
                        <br />
                    </div>
                    <br />

                    <div class="col-md-6">
                    
                        <br />
                        <!--El name debe ser igual al de la base de datos-->
                        <input type="text" name="codigoBarras" id="codigoBarras" class="form-control" placeholder="Ingresar codigo de barras" value="` + productos[count10].codigoBarras + `" required autocomplete="codigoBarras" autofocus disabled>
                        <br />
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre productos" value="` + productos[count10].nombre + ` " autofocus required disabled>
                        <br />
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion del producto" rows="3" cols="23" required disabled>
                        ` + productos[count10].descripcion + `</textarea>
                        <br />
                        
                        <input type="number" name="minimo_stock" id="minimo_stock" class="form-control" placeholder="Ingrese el minimo de productos permitidos" value="` + productos[count10].minimo_stock + `" autofocus required disabled>
                        <br />

                        <select class="form-control" name="Receta" id="Receta" required disabled>
                            <option value="">Elija una opcion</option>
                            <option value="si" selected>si</option>
                            <option value="no" selected>no</option>
                        </select>
                        <br />

                        <select class="form-control" name="Depa" id="Depa"  disabled>
                            <option value="" selected>` + departamento + ` </option>
                        </select>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1 text-center">
                        <br /><br />
                        <label for="Imagen">
                            <h5> <strong>{{'FOTO'}}</strong></h5>
                        </label required>
                        <br />
                        <img src="{{ asset('storage')}}/` + productos[count10].imagen + ` " alt="" width="200">
                        <br /><br />
                        
                        <a class="btn btn-primary" href="{{ url('/producto/` + x + `/edit')}}"> Editar </a>

                    </div>

                    <br/>
                `

            }
        }
        document.getElementById("resultados").innerHTML = datosProduct;
    };

    function buscarFolioNombre() {
        let seleccion = document.querySelector('input[name="checkbox2"]:checked');
        opcFolioNombre = seleccion.value;
        if (opcFolioNombre === 'nombre') {
            console.log(opcFolioNombre);
            buscarProducto();
        }
        if (opcFolioNombre === 'folio') {
            console.log(opcFolioNombre);
            buscarPorFolio();
        }
    }

    function buscarPorFolio() {
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        let cuerpo = "";
        let contador = 1;
        for (count20 in productos) {
            if (productos[count20].codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                let departamento = "";
                for (count21 in d) {
                    if (productos[count20].idDepartamento === d[count21].id) {
                        departamento = d[count21].nombre;
                    }
                }
                let id = productos[count20].id;
                cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count20].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count20].id + `</th>
            <td>` + productos[count20].codigoBarras + `</td>
            <td>` + productos[count20].nombre + `</td>
            <td>` + productos[count20].existencia + `</td>
           <td>` + departamento + `</td>
           <td>` + `0` + `</td>
            <td>` + `0` + `</td>
            <td>` +
                    ` <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + id + `)" value="` + id + `">
               VER MAS
              </button>
            </td>            
        </tr>
        `;
            }
        }
        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    };

    function buscarPorDepas() {
        let depa = document.querySelector('#idDepartamento');
      //  const palabraBusqueda = document.querySelector('#busquedaProducto');
            let cuerpo = "";
            let contador = 1;
   
        if (depa.value != "0") {
            for (count20 in productos) {
               // if (productos[count20].idDepartamento.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                if (productos[count20].idDepartamento == parseInt(depa.value)) {
                    let departamento = "";
                    for (count21 in d) {
                        if (productos[count20].idDepartamento === d[count21].id) {
                            departamento = d[count21].nombre;
                        }
                    }
                    let id = productos[count20].id;
                    cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count20].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count20].id + `</th>
            <td>` + productos[count20].codigoBarras + `</td>
            <td>` + productos[count20].nombre + `</td>
            <td>` + productos[count20].existencia + `</td>
           <td>` + departamento + `</td>
           <td>` + `0` + `</td>
            <td>` + `0` + `</td>
            <td>` +
                        ` <button type="button" class="btn btn-outline-info" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + id + `)" value="` + id + `">
               VER MAS
              </button>
            </td>            
        </tr>
        `;
                }
            }
            document.getElementById("consultaBusqueda").innerHTML = cuerpo;


        }
    }

    buscarProducto();
</script>

@endsection